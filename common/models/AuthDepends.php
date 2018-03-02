<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-1-19
 * Time: 下午3:23
 * Desc:
 */

namespace common\models;
use Yii;
use common\components\db\ActiveRecord;

class AuthDepends extends ActiveRecord {

    public static function tableName() {

        return '{{%auth_depends}}';
    }

    public function rules() {

        return [
            [['id', 'type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['page_url', 'api_url'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels() {

        return [
            'id' => 'ID',
            'page_url' => 'Page_url',
            'api_url' => 'Api_url',
            'type' => 'Type',
            'status' => 'Status',
            'created_at' => 'Created_at',
            'updated_at' => 'Updated_at',
        ];
    }


}