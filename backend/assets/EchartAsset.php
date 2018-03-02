<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 2017/7/12
 * Time: 9:47
 * Desc:
 */


namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class EchartAsset extends AssetBundle {

    public $sourcePath = "@common/metronic/assets";
    public $css = [
    ];
    public $js = [ // 全局js文件
        'extend/plugins/echarts3/echarts.js',
        'extend/plugins/echarts3/theme/dark.js'
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];

}