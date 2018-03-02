<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/1/19
 * Project: Cat Visual
 */

namespace common\components\rbac;


class Rule extends \yii\rbac\Rule {

    public $name = 'isAuthor';

    public function execute($user, $item, $params) {

        return true;
        return isset($params['post']) ? $params['post']->createdBy == $user : false;
    }
}