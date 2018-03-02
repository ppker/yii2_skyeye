<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/2/19
 */

namespace backend\assets;

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
        'backend\assets\EndAsset'
    ];
}