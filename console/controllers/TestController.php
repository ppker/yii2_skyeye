<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-6
 * Time: 下午4:44
 * Desc:
 */

namespace console\controllers;
use Yii;

class TestController extends BaseController {

    public function actionIndex() {

        Yii::info('this is index method', 'api');
    }

    public function actionIndex2() {

        Yii::info('this is index2 method', 'api');
    }
}