<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/4/18
 * Project: Cat Visual
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class TableAsset extends AssetBundle {

    public $sourcePath = "@common/metronic/assets";
    public $css = [ // 全局css文件

        'extend/plugins/DataTables/datatables.min.css',
    ];
    public $js = [ // 全局js文件
        'extend/plugins/DataTables/datatables.min.js',
    ];
    public $depends = [
        'backend\assets\PluginAsset'
    ];

}