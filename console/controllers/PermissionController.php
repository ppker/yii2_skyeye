<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-2
 * Time: 下午3:37
 * Desc:
 */

namespace console\controllers;

use Yii;

class PermissionController extends BaseController {

    public function actionIndex() {

        $auth = Yii::$app->AuthManager;

        /*$admin = $auth->createRole('administer');
        $admin->description = "创建了administer角色";
        $auth->add($admin);
        $auth->assign($admin, 1);
        echo "ok";*/

        /*$user_index = $auth->createPermission('user/index');
        $user_index->description = "创建了user/index的权限";
        $auth->add($user_index);*/

        $user_index = $auth->createPermission('app-api/user/index');
        $user_index->description = "创建了app-api/user/index的权限";
        $auth->add($user_index);
        echo "ok\n";
    }
}