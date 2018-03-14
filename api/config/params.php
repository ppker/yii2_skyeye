<?php
return [
    'adminEmail' => 'admin@example.com',

    'api_rule_user' => [
    	'GET,POST index' => 'index', // 显示用户列表
    	'GET,POST user_add' => 'user_add', // 新增账户
        'GET,POST user_del' => 'user_del', // 删除账号 需关联权限
        'GET,POST user_get' => 'user_get', // 获取用户信息
        'GET,POST user_reset' => 'user_reset', // 重置密码
        'GET,POST user_auth' => 'user_auth', // 用户授权
        'GET,POST access_index' => 'access_index', // 角色获取
        'GET,POST access_add' => 'access_add', // 角色添加
        'GET,POST access_get' => 'access_get', // 角色获取
        'GET,POST access_del' => 'access_del', // 角色删除
        'GET,POST user_setuser' => 'user_setuser', // 修改用户自己的密码
    ],

    'api_rule_system' => [
        'GET,POST system_menu' => 'system_menu', // menu_list
        'GET,POST menu_add' => 'menu_add',
        'GET,POST init_form_api' => 'init_form_api', // 获取网站菜单项的下拉菜单
        'GET,POST menu_get' => 'menu_get',
        'GET,POST menu_del' => 'menu_del',
        'GET,POST select_users_api' => 'select_users_api', // 获取用户的 real_name,id

        // api的权限关联配制
        'GET,POST system_apito' => 'system_apito',
        'GET,POST system_apito_add' => 'system_apito_add',
        'GET,POST system_apito_del' => 'system_apito_del',
        'GET,POST system_apito_edit' => 'system_apito_edit',
        'GET,POST system_apito_get' => 'system_apito_get',

        //　定时任务的配制
        'GET,POST system_task' => 'system_task',
        'GET,POST user_select_api' => 'user_select_api',
        'GET,POST task_add' => 'task_add',
        'GET,POST task_del' => 'task_del',
        'GET,POST task_get' => 'task_get',
        'GET,POST task_active' => 'task_active',
        'GET,POST task_unactive' => 'task_unactive',

    ],

    'socket_server' => "tcp://0.0.0.0:2018",

];
