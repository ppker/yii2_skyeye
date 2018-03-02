<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/3/10
 * Project: Cat Visual
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class UploadAsset extends AssetBundle {

    public $sourcePath = "@common/metronic/assets";
    public $css = [ // 全局css文件

        'global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
        'global/plugins/jquery-file-upload/css/jquery.fileupload.css',
        'global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css'
    ];
    public $js = [ // 全局js文件
        'global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js',
        'global/plugins/jquery-file-upload/js/vendor/tmpl.min.js',
        'global/plugins/jquery-file-upload/js/vendor/load-image.min.js',
        'global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js',
        'global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js',
        'global/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-image.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-video.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js'
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];

}