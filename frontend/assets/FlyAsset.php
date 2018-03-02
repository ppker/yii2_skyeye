<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/20
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii;
/**
 * Main backend application asset bundle.
 */
class FlyAsset extends AssetBundle{

    public $sourcePath = '@common/metronic/assets';
    public $css = [];

    public $js = [
        // 'extend/plugins/fly/jquery.fly.js',
        'extend/plugins/fly/jquery.ui.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];



}