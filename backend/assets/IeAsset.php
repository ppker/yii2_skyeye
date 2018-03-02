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
class IeAsset extends AssetBundle {

    public $sourcePath = "@common/metronic/assets";
    public $css = [];
    public $js = [
        'global/plugins/respond.min.js', // 支持媒体查询 Respond.js让IE6-8支持CSS3 Media Query | bootstrap就引入了这个文件 （如果要实现跨域 配置稍繁琐 有闪屏现象体验感稍佳）
        'global/plugins/excanvas.min.js',
        'global/plugins/ie8.fix.min.js', // 主要解决ie8的css问题
    ];

    public $jsOptions = ['condition' => 'lt IE9'];

    public $depends = [];

}