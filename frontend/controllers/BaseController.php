<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/28
 * Project: Cat Visual
 */

namespace frontend\controllers;

use Yii;
use common\components\Controller;
use yii\web\NotFoundHttpException;

class BaseController extends Controller {

    public function success($data = []) {
        Yii::$app->session->set('zp_alert', $data);
        if (isset($data['url']) && !empty($data['url'])) {
            return $this->redirect($data['url']);
            // return Yii::$app->end(0, $this->redirect($data['url']));
        }
    }

    public function flash($message, $type = 'info', $url = null) {

        Yii::$app->getSession()->setFlash($type, $message);
        if (null != $url) {
            Yii::$app->end(0, $this->redirect($url));
        }
    }

}