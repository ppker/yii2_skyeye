<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@common/metronic/assets';
    public $css = [
    ];
    public $js = [
        'extend/core/define.js',
        'extend/core/utils.js',
        '../../static/js/api.js',
    ];
    public $depends = [
        'frontend\assets\IeAsset',
        'frontend\assets\CoreAsset'
    ];

    /*public static function addScript($view, $jsfile) {

        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }
    public static function addCss($view, $cssfile) {

        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'frontend\assets\AppAsset']);
    }*/

}
