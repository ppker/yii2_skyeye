<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/2/19
 */

use yii\helpers\Html;
use backend\assets\ToastrAsset;
use frontend\assets\ToastrAsset as FtoastrAsset;

if ('' != $app) FtoastrAsset::register($this);
else ToastrAsset::register($this);

$str = json_encode($data);
$js = "ZP.utils.webSuccess(JSON.parse('" . $str . "'))";
$this->registerJs($js);
?>