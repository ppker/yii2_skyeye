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

        /*$user_index = $auth->createPermission('app-api/user/index');
        $user_index->description = "创建了app-api/user/index的权限";
        $auth->add($user_index);*/

        /*$user_add = $auth->createPermission('app-api/user/user_add');
        $user_add->description = '创建了app-api/user/user_add的权限';
        $auth->add($user_add);*/

        $permissions = [
            'app-api/user/user_add',
            'app-api/user/user_auth',
            'app-api/user/user_del',
            'app-api/user/user_get',
            'app-api/user/user_reset',
            'app-api/user/user_setuser',

            'app-api/user/access_add',
            'app-api/user/access_del',
            'app-api/user/access_get',
            'app-api/user/access_index',

            'app-api/system/init_form_api',
            'app-api/system/menu_add',
            'app-api/system/menu_del',
            'app-api/system/menu_get',
            'app-api/system/select_users_api',
            'app-api/system/system_menu',

            'user/setuser',
            'user/access',
            'user/access_set',
            'system/menu',
        ];

        foreach ($permissions as $key => $permission) {
            $add_permission = $auth->createPermission($permission);
            $add_permission->description = "创建了" . $permission . "的权限";
            $auth->add($add_permission);
            echo "$key \n";
        }


        echo "---end \n";
    }
}