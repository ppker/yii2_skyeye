<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/1/17
 * Project: Cat Visual
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LoginAsset extends AssetBundle {

    public $sourcePath = "@common/metronic/assets";


    public $css = [ // 全局css文件
        'global/plugins/select2/css/select2.min.css',
        'global/plugins/select2/css/select2-bootstrap.min.css',
        'pages/css/login-5.min.css',
    ];
    public $js = [ // 全局js文件
        'global/plugins/jquery-validation/js/jquery.validate.min.js',
        'global/plugins/jquery-validation/js/additional-methods.min.js',
        'global/plugins/select2/js/select2.full.min.js',
        'global/plugins/backstretch/jquery.backstretch.min.js',
        'global/scripts/app.min.js',
        'pages/scripts/login-5.min.js',
    ];
    public $depends = [
        'backend\assets\IeAsset',
        'backend\assets\CoreAsset'
    ];

}