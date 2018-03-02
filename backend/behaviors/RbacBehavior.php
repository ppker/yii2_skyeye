<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/7
 * Project: Cat Visual
 */

namespace backend\behaviors;

use Behat\Gherkin\Exception\Exception;
use Yii;
use yii\base\Controller;
use backend\models\Menu;
use yii\web\ForbiddenHttpException;
use yii\base\Behavior;

class RbacBehavior extends Behavior {

    public $allowActions = [];
    public function events() {

        return [
            Controller::EVENT_BEFORE_ACTION => 'rbacAction'
        ];
    }

    public function rbacAction($event) {

        $event->isValid = true; // 继续执行
        $rule = $event->action->getUniqueId();

        if ('show' == $event->action->id) { // 兼容通用show
            $id = Yii::$app->getRequest()->get('menu_id');
            $rule .= "/" . $id;
        }

        if (!in_array($rule, Yii::$app->params['check_session'])) { // 兼容后台绑定的api权限控制
            if (empty(Yii::$app->session->get('username'))) {
                Yii::$app->user->logout();
                Yii::$app->getResponse()->redirect(Yii::$app->gethomeUrl());
                // return Yii::$app->user->loginRequired();
            }
        }
        foreach ($this->allowActions as $allow) {
            if ('*' == substr($allow, -1)) {
                if (0 === strpos($rule, rtrim($allow, '*'))) return true;
            } else {
                if ($rule == $allow) return true;
            }
        }

        if (Menu::checkRule($rule)) return true;
        $event->isValid = false;
        $this->denyAccess();

    }

    protected function denyAccess() {

        if (\Yii::$app->user->getIsGuest()) {
            return \Yii::$app->user->loginRequired();
        } else {
            // Yii::$app->user->logout();
            // Yii::$app->getResponse()->redirect(Yii::$app->gethomeUrl());
            throw new ForbiddenHttpException(Yii::t('yii', 'you are not allowed to perform this action.'));
        }
    }

}