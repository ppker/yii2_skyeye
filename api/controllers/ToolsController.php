<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 2017/10/19
 * Time: 16:20
 * Desc:
 */

namespace api\controllers;

use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\DatabaseSql;
use Yii;

class ToolsController extends BaseController {

    public function init() {

        parent::init();
    }

    public function actionSelect_original() {
        $data = Yii::$app->getRequest()->post();
        if (empty($data) || !isset($data['sql_id'])) return ['success' => 0, 'message' => '参数发生异常！', 'data' => []];

        // search data and make data

        $end_data = (new DatabaseSql)->make_tools_data($data);

        return parent::re_format($end_data);
    }

    public function actionSelect_multiple_page_url() {

        $data = (new \yii\db\Query())->select(['name' => 'name', 'id' => 'name'])->where(['not like', 'name', 'app-api/%', false])->from('auth_item')->all();
        return parent::re_format($data);
    }

    public function actionSelect_multiple_api_url() {

        $data = (new \yii\db\Query())->select(['name' => 'name', 'id' => 'name'])->where(['like', 'name', 'app-api/%', false])->from('auth_item')->all();
        return parent::re_format($data);
    }
}