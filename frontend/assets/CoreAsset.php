<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/28
 * Project: Cat Visual
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CoreAsset extends AssetBundle {

    public $sourcePath = "@common/metronic/assets";

    public $css = [ // 全局css文件
        // 字体库
        // 'global/css/google_font.css',
        'global/plugins/font-awesome/css/font-awesome.min.css',
        'global/plugins/simple-line-icons/simple-line-icons.min.css',
        // bootstrap
        'global/plugins/bootstrap/css/bootstrap.min.css',
        'global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'global/plugins/bootstrap-sweetalert/sweetalert.css',
        'global/css/components-rounded.min.css', // 圆角组件样式
        'global/css/plugins.min.css',
        'pages/css/error.min.css',
    ];

    public $js = [ // 全局js文件
        'extend/core/nameSpace.js',
        'global/plugins/jquery.min.js',
        'global/plugins/bootstrap/js/bootstrap.min.js',
        'extend/plugins/Bootstrap_validate/validator.js',
        'global/plugins/js.cookie.min.js', // cookie manager
        'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js', // nice slimcroll similar facebook
        'global/plugins/jquery.blockui.min.js', // ajax遮罩层ui
        'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js', // bootstrap下拉选择
        'global/plugins/bootstrap-sweetalert/sweetalert.min.js',
    ];
    public $depends = [];

}