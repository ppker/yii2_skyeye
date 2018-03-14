<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/20
 * Project: Cat Visual
 */

namespace api\controllers;

use Yii;
use yii\db\Query;
use yii\helpers\Url;
use backend\models\Menu;
use common\models\User;

class SystemController extends BaseController {

    protected $_cfg_status = ['0' => '禁用', '1' => '正常'];
    public $hide = ['0' => '显示', 1 => '隐藏'];
    public $status = [0 => '禁用', 1 => '正常'];
    public $api_type = [0 => '查询', 1 => '搜索'];

    public function actionSystem_menu() {

        Menu::get_node_list(0);
        $list = Menu::$end_menu_list;
        // $list = (new Query())->select('*')->from('menu')->orderBy(['pid' => SORT_ASC, 'sort' => SORT_ASC])->all();
        if (!empty($list)) {
            foreach ($list as &$v) {
                $v['hide'] = $this->hide[$v['hide']];
                $v['status'] = $this->status[$v['status']];
            }
        }
        return parent::re_format($list);
    }

    public function actionSystem_apito() {

        $data = \backend\models\AuthDepends::find()->asArray()->all();

        if (!empty($data)) {
            foreach ($data as &$v) {
                $v['type'] = $this->api_type[$v['type']];
                $v['status'] = $this->status[$v['status']];
                $v['created_at'] = date('Y-m-d H:i:s', $v['created_at']);
                $v['updated_at'] = date('Y-m-d H:i:s', $v['updated_at']);
            }
        }
        return parent::re_format($data);
    }

    public function actionSystem_apito_add() {

        $data = Yii::$app->request->post();
        if (empty($data['id'])) { // 新增
            $re = Yii::$app->db->createCommand()
                ->insert('{{%auth_depends}}', [
                    'page_url' => $data['page_url'],
                    'api_url' => $data['api_url'],
                    'type' => (int)$data['type'],
                    'status' => (int)$data['status'],
                    'created_at' => (int)time(),
                    'updated_at' => (int)time(),
                ])->execute();
            if (!$re) return ['success' => 0, 'message' => '添加失败！', 'data' => []];
            else return ['success' => 1, 'message' => '添加成功！', 'data' => []];

        } else { // 修改
            $re = Yii::$app->db->createCommand()->update('{{%auth_depends}}', [
                'page_url' => $data['page_url'],
                'api_url' => $data['api_url'],
                'type' => (int)$data['type'],
                'status' => (int)$data['status'],
                'updated_at' => (int)time(),
            ], ['id' => $data['id']])->execute();
            if (!$re) return ['success' => 0, 'message' => '更新失败！', 'data' => []];
            else return ['success' => 1, 'message' => '更新成功！', 'data' => []];
        }

    }


    public function actionMenu_add() {

        $data = Yii::$app->request->post();
        $model = new Menu();
        if (empty($data['id'])) { // 新增
            unset($data['id'], $data['_csrf-backend']);
            if ($model->load($data) && $model->save()) {
                return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            $menu = Menu::findOne((int)$data['id']);
            if (!empty($menu)) {
                unset($data['id'], $data['backend']);
                if ($menu->load($data) && $menu->update()) {
                    return ['success' => 1, 'message' => '更新成功！', 'data' => []];
                } else return ['success' => 0, 'message' => '更新失败！', 'data' => []];
            }
        }
    }

    public function actionInit_form_api() {

        $data = Menu::find()->select(['id', 'name' => 'title'])->orderBy(['pid' => SORT_ASC, 'sort' => SORT_ASC])->asArray()->all();
        array_unshift($data, ['id' => '0', 'name' => '无']);
        return parent::re_format($data);
    }

    public function actionUser_select_api() {

        $data = User::find()->select(['id', 'name' => 'username'])->orderBy(['id' => SORT_ASC])->asArray()->all();
        return parent::re_format($data);
    }


    /**
     * 获取所有用户的真实姓名,id
     * @return array
     */
    public function actionSelect_users_api() {

        $data = User::find()->select(["id", 'name' => 'realname'])->asArray()->all();
        return parent::re_format($data);
    }


    public function actionMenu_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '查询失败！', 'data' => []];
        $data = (new Menu())->find()->where(['id' => (int)$id])->asArray()->one();
        return parent::re_format($data);
    }

    public function actionSystem_apito_del() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少参数ID！', 'data' => []];
        if (Yii::$app->db->createCommand()->delete('{{%auth_depends}}', ['id' => $id])->execute()) {
            return ['success' => 1, 'message' => '批量删除成功！', 'data' => []];
        } else return ['success' => 0, 'message' => '批量删除失败！', 'data' => []];
    }


    public function actionMenu_del() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少菜单ID参数！', 'data' => []];

        if (is_array($id)) {
            if (Menu::deleteAll(['in', 'id', $id])) {
                return ['success' => 1, 'message' => '批量删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '批量删除失败！', 'data' => []];
        }else {
            if (Menu::findOne($id)->delete()) {
                return ['success' => 1, 'message' => '删除成功！', 'data' => []];
            } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
        }

    }

    public function actionSystem_apito_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少参数ID!', 'data' => []];
        $data = (new \yii\db\Query())->from('{{%auth_depends}}')->where(['id' => $id])->createCommand()->queryOne();
        return parent::re_format($data);
    }

    public function actionSystem_task() {

        $data = (new \yii\db\Query())->select('worker_task.*, user.username')->from('{{%worker_task}}')->leftJoin('user', 'user.id = worker_task.user_id')->all();

        $arr_invoke = [1 => 'yii_cli', 2 => 'curl'];
        $arr_persistent = [0 => '仅执行一次', 1 => '每天执行'];
        $arr_status = [0 => '禁用', 1 => '正常', 2 => '删除'];
        $arr_load_status = [0 => '未装载', 1 => '已装载'];
        if (!empty($data)) {
            foreach ($data as &$val) {
                $val['invoke_type'] = $arr_invoke[$val['invoke_type']];
                $val['persistent'] = $arr_persistent[$val['persistent']];
                $val['status'] = $arr_status[$val['status']];
                $val['load_status'] = $arr_load_status[$val['load_status']];
                $val['created_at'] = date('Y-m-d H:i:s', $val['created_at']);
                $val['updated_at'] = date('Y-m-d H:i:s', $val['updated_at']);
            }
        }

        // var_dump($data);die;
        return parent::re_format($data);
    }


    public function actionTask_del() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少参数 id', 'data' => []];
        $res = Yii::$app->db->createCommand()->update('{{%worker_task%}}', [
            'end_active_time' => date('Y-m-d H:i:s'),
            'timer_id' => 0,
            'status' => 2,
            'load_status' => 0,
            'updated_at' => date('Y-m-d H:i:s')
        ], ['id' => $id])->execute();
        if ($res) {
            return ['success' => 1, 'message' => '删除成功！', 'data' => []];
        } else return ['success' => 0, 'message' => '删除失败！', 'data' => []];
    }

    public function actionTask_add() {

        $post = Yii::$app->getRequest()->post();
        if (is_null($post)) return ['success' => 0, 'message' => '缺少参数！', 'data' => []];
        if (empty($post['id'])) { // 新增
            unset($post['id'], $post['_csrf-backend'], $post['access-token']);
            $post['created_at'] = time();
            $post['updated_at'] = time();
            $res = Yii::$app->db->createCommand()->insert('{{%worker_task%}}', $post)->execute();
            if ($res) return ['success' => 1, 'message' => '添加成功！', 'data' => []];
            else return ['success' => 0, 'message' => '添加失败！', 'data' => []];
        } else { // 修改
            unset($post['_csrf-backend'], $post['access-token']);
            $post['updated_at'] = time();
            $res = Yii::$app->db->createCommand()->update('{{%worker_task%}}', $post, ['worker_task.id' => $post['id']])->execute();
            if ($res) return ['success' => 1, 'message' => '修改成功！', 'data' => []];
            else return ['success' => 0, 'message' => '修改失败！', 'data' => []];
        }
    }

    public function actionTask_get() {

        $id = Yii::$app->getRequest()->post('id');
        if (is_null($id)) return ['success' => 0, 'message' => '缺少参数！', 'data' => []];
        $data = (new \yii\db\Query())->select('worker_task.*, user.username')->from('{{%worker_task}}')->leftJoin('user', 'user.id = worker_task.user_id')
            ->where(['worker_task.id' => (int)$id])->limit(1)->one();

        $arr_invoke = [1 => 'yii_cli', 2 => 'curl'];
        $arr_persistent = [0 => '仅执行一次', 1 => '每天执行'];
        $arr_status = [0 => '禁用', 1 => '正常', 2 => '删除'];
        $arr_load_status = [0 => '未装载', 1 => '已装载'];
        if (!empty($data)) {
            $data['invoke_type'] = $arr_invoke[$data['invoke_type']];
            $data['persistent'] = $arr_persistent[$data['persistent']];
            $data['status'] = $arr_status[$data['status']];
            $data['load_status'] = $arr_load_status[$data['load_status']];
            $data['created_at'] = date('Y-m-d H:i:s', $data['created_at']);
            $data['updated_at'] = date('Y-m-d H:i:s', $data['updated_at']);
        }

        // var_dump($data);die;
        return parent::re_format($data);

    }

    public function actionTask_active() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少参数!', 'data' => []];

    }

    public function actionTask_unactive() {

        $id = Yii::$app->getRequest()->post('id');
        if (empty($id)) return ['success' => 0, 'message' => '缺少参数!', 'data' => []];
    }

}
