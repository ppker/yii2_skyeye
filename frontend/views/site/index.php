<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\EndAsset;
use yii\bootstrap\ActiveForm;

$this->title = '点餐首页';  
$this->params['title_sub'] = '点餐';

EndAsset::addScript($this, Yii::getAlias("@web/static/js/views/site/index.js"));
?>

<div class="c-layout-page">
    <section class="c-layout-revo-slider c-layout-revo-slider-4">
        <div class="tp-banner-container c-theme" style="height: 620px">
            <div class="tp-banner">
                <ul>
                    <!--BEGIN: SLIDE #1 -->
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="1000">
                        <img alt="" src="<?= Yii::getAlias('@web/static/images/backgrounds/bg-43.jpg');?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <div class="caption customin customout tp-resizeme" data-x="center" data-y="center" data-hoffset="" data-voffset="-50" data-speed="500" data-start="1000" data-customin="x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-easing="Back.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                            <h3 class="c-block-bordered c-font-48 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                Never say die.</h3>
                        </div>
                        <!--<div class="caption lft tp-resizeme" data-x="center" data-y="center" data-voffset="110" data-speed="900" data-start="2000" data-easing="easeOutExpo">
                            <a href="#" class="c-action-btn btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase">Learn More</a>
                        </div>-->
                    </li>
                    <!--END -->
                    <!--BEGIN: SLIDE #2 -->
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="1000">
                        <img alt="" src="<?= Yii::getAlias('@web/static/images/backgrounds/bg-20.jpg');?>" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <div class="caption customin customout tp-resizeme" data-x="center" data-y="center" data-hoffset="" data-voffset="-50" data-speed="500" data-start="1000" data-customin="x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-easing="Back.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                            <h3 class="c-block-bordered c-font-48 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                Never put off what you can do<br>
                                today until tomorrow.</h3>
                        </div>
                        <!--<div class="caption lft tp-resizeme" data-x="center" data-y="center" data-voffset="110" data-speed="900" data-start="2000" data-easing="easeOutExpo">
                            <a href="#" class="c-action-btn btn btn-lg c-btn-square c-theme-btn c-btn-bold c-btn-uppercase">Learn More</a>
                        </div>-->
                    </li>
                    <!--END -->
                    <!--BEGIN: SLIDE #3 -->
                    <li data-transition="fade" data-slotamount="1" data-masterspeed="700" data-delay="6000" data-thumb="">
                        <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                        <img src="<?= Yii::getAlias('@web/static/images/revo_slide/blank.png');?>" alt="">
                        <div class="caption fulllscreenvideo tp-videolayer" data-x="0" data-y="0" data-speed="600" data-start="1000" data-easing="Power4.easeOut" data-endspeed="500" data-endeasing="Power4.easeOut" data-autoplay="true" data-autoplayonlyfirsttime="false" data-nextslideatend="true" data-videowidth="100%" data-videoheight="100%" data-videopreload="meta" data-videomp4="<?= Yii::getAlias('@web/static/video/video-2.mp4');?>" data-videowebm="" data-videocontrols="none" data-forcecover="1" data-forcerewind="on" data-aspectratio="16:9" data-volume="mute" data-videoposter="<?= Yii::getAlias('@web/static/images/revo_slide/blank.png');?>">
                        </div>
                        <div class="caption customin customout tp-resizeme" data-x="center" data-y="center" data-hoffset="" data-voffset="-30" data-speed="500" data-start="1000" data-customin="x:0;y:0;z:0;rotationX:0.5;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-easing="Back.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-endspeed="600">
                            <h3 class="c-block-bordered-square c-font-55 c-font-bold c-font-center c-font-uppercase c-font-white c-block">
                                Believe that god is fair.</h3>
                        </div>
                        <!--<div class="caption lft tp-resizeme" data-x="center" data-y="center" data-voffset="130" data-speed="900" data-start="2000" data-easing="easeOutExpo">
                            <a href="#" class="c-action-btn btn c-btn-square c-btn-border-2x c-btn-white c-btn-sbold c-btn-uppercase">Purchase</a>
                        </div>-->
                    </li>
                    <!--END -->
                </ul>
            </div>
        </div>
    </section>
</div>




<div class="container" style="padding: 50px 0;">
    <div class="page-content-inner">

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light portlet-fit ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class=" icon-layers font-green"></i>
                            <span class="caption-subject font-green bold uppercase">饭店列表</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="mt-element-card mt-element-overlay">
                            <div class="row">
                                <?php if (!empty($data)) {
                                    foreach ($data as $key => $value) {
                                        echo $this->render('_item', ['model' => $value]);
                                    }
                                } else {
                                    echo \Yii::t('app', '此处没有数据');
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


<!--模态框-->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">用户注册</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    'action' => Url::to(['site/signup']),
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => false
                ]); ?>
                <?= $form->field($model, 'username'); ?>
                <?= $form->field($model, 'email'); ?>
                <?= $form->field($model, 'realname') ?>
                <?= $form->field($model, 'password')->passwordInput(); ?>
                <div class="form-group">
                    <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">用户登录</h4>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'form-login',
                    'action' => Url::to(['site/login']),
                    // 'enableAjaxValidation' => true,
                    // 'enableClientValidation' => false
                ]); ?>
                <?= $form->field($login_model, 'username', ['inputOptions' => ['tabindex' => 1]]); ?>
                <?= $form->field($login_model, 'password', ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2']])->passwordInput()->label('密码' . '(' . Html::a('忘记密码?', ['frontend/web/site/request-password-reset'], ['tabindex' => 5]) . ')') ?>
                <?= $form->field($login_model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']); ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>