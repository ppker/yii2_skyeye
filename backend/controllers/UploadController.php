<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/13
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\UploadForm;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class UploadController extends BaseController {

    public $enableCsrfValidation = false;

    public function actionUpload() {

        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($file = $model->upload()) {
                echo json_encode(['success' => 1, 'message' => '上传图片成功', 'data' => $file]);
            } else {
                echo json_encode(['success' => 0, 'message' => '上传图片失败', 'data' => '']);
            }
        }
    }

}