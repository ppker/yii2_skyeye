<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/28
 * Project: Cat Visual
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii;
/**
 * Main backend application asset bundle.
 */
class PluginAsset extends AssetBundle{

    public $sourcePath = '@common/metronic/assets';
    public $css = [ // 全局css文件
        'global/plugins/bootstrap-select/css/bootstrap-select.min.css',
        'global/plugins/bootstrap-toastr/toastr.min.css',
    ];

    public $js = [
        'global/plugins/bootstrap-toastr/toastr.min.js', // toastr信息提示框
        'global/plugins/bootstrap-select/js/bootstrap-select.min.js', // bs风格select
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];

}