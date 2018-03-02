<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/4
 * Project: Cat Visual
 */

namespace api\controllers;

use common\models\User;
use yii\db\Query;
use backend\models\UserForm;
use backend\models\AvatarForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Yii;

class UserController extends BaseController {


    protected $account_status = [0 => '禁用', 10 => '正常'];

    public function actionIndex() {

        $list = (new Query())->select('id, username, realname, email, status, created_at')->from('user')->orderBy(['created_at' => SORT_DESC])->all();
        if (!empty($list) && is_array($list)) {
            foreach ($list as &$v) {
                $v['status'] = $this->account_status[$v['status']];
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
            }
        }
        return parent::re_format($list);
    }

    public function actionUser_add() {

        $model = new UserForm();
        $post = Yii::$app->request->post();
        if (isset($post['id']) && !empty($post['id'])) {
            $user = $model->findOne($post['id']);
            if ($user->load($post) && $user->save()) {
                return ['success' => 1, 'message' => '更新成功', 'data' => []];
            } else return ['success' => 0, 'message' => '更新失败', 'data' => []];
        }


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            if ($user = $model->save()) {
                return ['success' => 1, 'message' => '添加成功', 'data' => []];
            }
        } else {
            $error_data = $model->getErrors();
            if (!empty($error_data) && is_array($error_data)) {
                return ['success' => 0, 'message' => current($error_data)[0], 'data' => []];
            } else {
                return ['success' => 0, 'message' => '填写的表单有不符合要求的内容，请检查', 'data' => []];
            }
        }
    }

    public function actionUser_del () {

        $id = Yii::$app->getRequest()->post('id');
        if ($id) {
            $model = new UserForm();
            if (!is_array($id) && $user = $model->findOne($id)) {
                if($user->delete()) return ['success' => 1, 'message' => '删除成功', 'data' => []];
                else return ['success' => 0, 'message' => '删除失败', 'data' => []];
            } elseif (is_array($id)) {
                $ids = implode(",", $id);
                $re = $model->deleteAll("id in (" . $ids .")");
                if ($re) return ['success' => 1, 'message' => '删除成功', 'data' => []];
                else return ['success' => 0, 'message' => '删除失败', 'data' => []];
            }
        }
    }

    public function actionUser_get() {

        $id = Yii::$app->getRequest()->post('id');
        if ($id) {
            $model = new UserForm();
            $user = $model->find()->where(['id' => $id])->asArray()->one();
            if (!empty($user)) return ['success' => 1, 'message' => '查询成功', 'data' => $user];
            else return ['success' => 0, 'message' => '查询失败', 'data' => []];
        }
    }

    public function actionUser_reset() {

        $id = Yii::$app->request->post('id');
        if ($id) {
            $user = User::findOne($id);
            $user->password = "123456";
            if ($user->save()) {
                return ['success' => 1, 'message' => '重置成功', 'data' => []];
            } else return ['success' => 0, 'message' => '重置失败', 'data' => []];
        }
    }


    public function actionUser_setuser() {

        $data = Yii::$app->getRequest()->post();

        if (isset($data['form_avatar']) && !empty($data['form_avatar'])) { // 上传头像
            $model = Yii::createObject(AvatarForm::className());

            if ($model->load($data)) {
                if ($model->user->avatar) {
                    $re = $model->deleteImage();
                }
                $image = $model->uploadImage();
                $hasError = true;
                if (false !== $image) {
                    $path = $model->getNewUploadedImageFile();

                    if ($image->saveAs($path)) $hasError = false;
                }
                if ($hasError) $model->useDefaultImage();

                if (false === $model->save()) $hasError = true;

                if (!$hasError) {
                    return ['success' => 1, 'message' => '您的头像更新成功', 'data' => ''];
                } else {
                    return ['success' => 0, 'message' => '您的头像更新失败', 'data' => ''];
                }
            }
            return ['success' => 0, 'message' => '您的头像更新失败', 'data' => ''];
        }

        $user = User::findByUsername($data['access-token']);
        if (empty($user)) return ['success' => 0, 'message' => '参数异常', 'data' => []];
        if ($data['new_pwd'] !== $data['re_pwd']) return ['success' => 0, 'message' => '两次输入的新密码不一样', 'data' => []];
        if (Yii::$app->security->validatePassword($data['current_pwd'], $user->password_hash)) {
            $user->password = $data['re_pwd'];
            if ($user->save()) {
                return ['success' => 1, 'message' => '修改密码成功', 'data' => []];
            } else return ['success' => 0, 'message' => '修改密码失败，请联系管理员', 'data' => []];
        } else return ['success' => 0, 'message' => '原始密码错误', 'data' => []];

    }




    /**
     * 获取用户的授权
     * @return array
     */
    public function actionUser_auth() {

        $id  = Yii::$app->request->post('id');
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();

        if (($user_id = Yii::$app->request->post('user_id')) && ($param = Yii::$app->request->post('param'))) {
            $auth->revokeAll($user_id);
            $role = $auth->getRole($param);
            $re = $auth->assign($role, $user_id);
            if($re) {
                return ['success' => 1, 'message' => '授权成功', 'data' => []];
            }else ['success' => 0, 'message' => '授权失败', 'data' => []];
        }

        if ($id) {
            $arr_roles = ArrayHelper::toArray($roles, [
                'yii\rbac\Role' => [
                    'type',
                    'name',
                    'description',
                    'ruleName',
                    'data',
                    'createdAt',
                    'updatedAt'
                ],
            ]);
            $group = array_keys($auth->getAssignments($id));

            if (!empty($arr_roles) || !empty($group)) {
                return ['success' => 1, 'message' => '查询成功', 'data' => ['all' => $arr_roles, 'now' => $group]];
            }else {
                return ['success' => 0, 'message' => '查询失败', 'data' => []];
            }
        }
    }

    public function actionAccess_index() {

        $roles = Yii::$app->authManager->getRoles();
        if (!empty($roles)) {
            $roles = ArrayHelper::toArray($roles);
            if (!empty($roles)) {
                foreach ($roles as &$v) {
                    $v['createdAt'] = date('Y-m-d H:i:s', $v['createdAt']);
                    $v['updatedAt'] = date('Y-m-d H:i:s', $v['updatedAt']);
                }
            }
            if (!empty($roles)) return ['success' => 1, 'message' => '查询成功', 'data' => array_values($roles)];
            else return ['success' => 0, 'message' => '查询失败', 'data' => []];
        }
    }

    public function actionAccess_add() {

        $data = Yii::$app->request->post();
        if (!empty($data)) {
            $get_role = Yii::$app->authManager->getRole($data['old_name']);

            if (!empty($get_role)) { // 进行修改
                $get_role->name = $data['name'];
                $get_role->description = $data['description'];
                if ($re = Yii::$app->authManager->update($data['old_name'], $get_role)) {
                    return ['success' => 1, 'message' => '修改成功', 'data' => []];
                } else return ['success' => 0, 'message' => '修改失败', 'data' => []];
            }

            $role = Yii::$app->authManager->createRole($data['name']);
            $role->description = $data['description'];
            if (Yii::$app->authManager->add($role)) {
                return ['success' => 1, 'message' => '添加成功', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败', 'data' => []];
        }
    }

    public function actionAccess_get() {

        $name = Yii::$app->request->post("id");
        if (!empty($name)) {
            $role = Yii::$app->authManager->getRole($name);
            if ($role) {
                return ['success' => 1, 'message' => '查询成功', 'data' => ArrayHelper::toArray($role)];
            } else return ['success' => 0, 'message' => '查询失败', 'data' => []];
        }
    }

    public function actionAccess_del() {

        $id = Yii::$app->request->post("id");
        if (empty($id)) return ['success' => 0, 'message' => '操作失败，缺少参数', 'data' => []];
        if (is_array($id)) {


            $ids = "'" . implode("','", $id) . "'";
            $command = Yii::$app->db->createCommand("delte from `auth_item` where name in($ids) and type = 1");
            $re = $command->execute();
            if ($re) return ['success' => 1, 'message' => '删除成功', 'data' => []];
            else return ['success' => 0, 'message' => '删除失败', 'data' => []];
        }

        $role = Yii::$app->authManager->getRole($id);
        if (Yii::$app->authManager->remove($role)) return ['success' => 1, 'message' => '删除成功', 'data' => []];
        else return ['success' => 0, 'message' => '删除失败', 'data' => []];
    }



}