<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/13
 */

namespace common\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\Url;

class UploadForm extends Model{

    public $imageFile;
    public $save_path = "upload/";

    public function rules() {

        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg,jpeg', 'maxFiles' => 1],
        ];
    }

    public function upload() {

        if ($this->validate()) {
            $base_path = Yii::getAlias("@frontend/web/images/");
            $real_file = $this->save_path . $this->imageFile->baseName . "_" . uniqid() . "." . $this->imageFile->extension;
            $re = $this->imageFile->saveAs($base_path . $real_file);
            if ($re) return $real_file;
            else return false;
        } else return false;
    }

}