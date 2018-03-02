<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 2017/7/7
 * Time: 16:07
 * Desc:
 */
namespace backend\assets;
use yii\web\AssetBundle;

class Login2Asset extends AssetBundle {

    public $sourcePath = '@common/metronic/assets';

    public $css = [
        'login2/css/login_style.css',
    ];

    public $js = [
        'global/plugins/jquery-validation/js/jquery.validate.min.js',
        'global/plugins/jquery-validation/js/additional-methods.min.js',
        'global/plugins/select2/js/select2.full.min.js',
        'global/plugins/backstretch/jquery.backstretch.min.js',
        'global/scripts/app.min.js',
        // 'login2/js/login2.js',
        'login2/js/login3.js',
    ];

    public $depends = [
        'backend\assets\IeAsset',
        'backend\assets\CoreAsset',
    ];

}