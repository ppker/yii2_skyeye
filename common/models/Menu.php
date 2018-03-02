<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/1/18
 */

namespace common\models;

use Yii;
use common\components\db\ActiveRecord;

class Menu extends ActiveRecord {

    public static function tableName() {

        return '{{%menu}}';
    }

    public function rules() {

        return [
            [['pid', 'sort', 'hide', 'status'], 'integer'],
            [['title', 'group'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels() {

        return [
            'id' => 'ID',
            'title' => 'Title',
            'pid' => 'Pid',
            'sort' => 'Sort',
            'url' => 'Url',
            'hide' => 'Hide',
            'group' => 'Group',
            'status' => 'Status'
        ];
    }


}