<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/2/28
 * Project: Cat Visual
 */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\EndAsset;
use common\widgets\Toastr;

EndAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="<?= Yii::$app->language; ?>" />
    <title><?= $this->title; ?> | <?= \Yii::$app->setting->get('siteName') ?> | <?= \Yii::$app->setting->get('siteTitle') ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="<?= Yii::$app->setting->get('siteKeyword'); ?>"
          name="description" />
    <?= Html::csrfMetaTags() ?>
    <meta content="" name="author" />
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?=Yii::getAlias('@web/favicon.ico'); ?>" />
</head>
<!-- END HEAD -->
<body class="page-container-bg-solid">
<?php $this->beginBody() ?>

<div class="page-wrapper">
    <div class="page-wrapper-row">
        <div class="page-wrapper-top">
            <!-- BEGIN HEADER -->
            <?= $this->render('@app/views/layouts/public/header.php', ['data' => '']); ?>
            <!-- END HEADER -->
        </div>
    </div>

    <div class="page-wrapper-row full-height">
        <div class="page-wrapper-middle">
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <!-- BEGIN PAGE CONTENT BODY -->
                    <!-- BEGIN PAGE CONTENT BODY -->
                    <div class="page-content">
                        <!--<div class="container">-->
                            <!-- BEGIN PAGE BREADCRUMBS -->
                            <!--<ul class="page-breadcrumb breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Dashboard</span>
                                </li>
                            </ul>-->
                            <!-- END PAGE BREADCRUMBS -->
                            <!-- BEGIN PAGE CONTENT INNER -->
                        <!--</div>-->
                        <?= Toastr::widget(['app' => 'frontend']); ?>
                        <?= $content ?>
                            <!-- END PAGE CONTENT INNER -->

                    </div>
                    <!-- END PAGE CONTENT BODY -->
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
                <!-- BEGIN QUICK SIDEBAR -->


                <!-- BEGIN QUICK SIDEBAR -->
                <?php // $this->render('@app/views/layouts/public/quick_sidebar.php', ['data' => '']); ?>
                <!-- END QUICK SIDEBAR -->


            </div>
            <!-- END CONTAINER -->
        </div>
    </div>

    <!-- BEGIN FOOTER -->
    <?= $this->render('@app/views/layouts/public/footer.php', ['data' => '']); ?>
    <!-- END FOOTER -->

</div>


<nav class="quick-nav">
    <a class="quick-nav-trigger" href="#0">
        <span aria-hidden="true"></span>
    </a>
    <ul>
        <li>
            <a href="javascript:;" target="_blank">
                <span>小宠物</span>
                <i class="icon-ghost"></i>
            </a>
        </li>
        <li>
            <a href="javascript:;" target="_blank">
                <span>引导</span>
                <i class="icon-compass"></i>
            </a>
        </li>
        <li>
            <a href="javascript:;" target="_blank">
                <span>更新日志</span>
                <i class="icon-graph"></i>
            </a>
        </li>
    </ul>
    <span aria-hidden="true" class="quick-nav-bg"></span>
</nav>
<div class="quick-nav-overlay"></div>


<!-- END THEME LAYOUT SCRIPTS -->
<?php $this->endBody() ?>
</body>

<script type="text/javascript">
    var g_username = "<?= Yii::$app->session->get('username') ?>";
    (window.PAGE_ACTION && $(window).ready(window.PAGE_ACTION().init));
</script>

</html>
<?php $this->endPage() ?>
