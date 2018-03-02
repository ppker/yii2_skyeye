<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/4/12
 * Project: Cat Visual
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class ToastrAsset extends AssetBundle {

    public $sourcePath = "@common/metronic/assets";

    public $css = [ // 全局css文件
        'global/plugins/bootstrap-toastr/toastr.min.css'
    ];
    public $js = [ // 全局js文件
        'global/plugins/bootstrap-toastr/toastr.min.js', // toastr信息提示框
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}