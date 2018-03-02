<?php
/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/2/18
 */

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = '角色管理';
$this->params['title_sub'] = '设置用户权限信息';
$this->registerJs("var route_end = 'user/access';", \yii\web\View::POS_END);
?>


<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">设置用户权限信息</span>
                </div>

            </div>
            <div class="portlet-body form">
                <form action="<?= \yii\helpers\Url::current() ?>" method="post" class="form-auth">
                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                    <?php foreach ($node_list as $node): ?>
                        <div style="">
                            <div class="form-group" style="margin-bottom:0px;background:#eee;padding:5px;">
                                <div class="mt-checkbox-inline" style="padding:2px 0;">
                                    <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom: 0px;padding-left: 5px;"><?= $node['title'] ?></label>
                                </div>
                            </div>
                            <div style="padding:5px;border:1px #eee solid;">
                                <?php if (isset($node['child'])): ?>
                                    <?php foreach ($node['child'] as $child): ?>

                                        <div class="form-group" style="margin-bottom:0px;">
                                            <div class="mt-checkbox-inline" style="padding:2px 0;">
                                                <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:0px;">
                                                    <input type="checkbox" name="rules[]" value="<?= $child['url'] ?>" <?php echo in_array($child['url'], $auth_rules) ? "checked" : ""; ?> >
                                                    <span></span>
                                                    <?= $child['title'] ?>
                                                </label>

                                                <?php if (!empty($child['apito'])): ?>
                                                    <?php foreach ($child['apito'] as $apito): ?>
                                                        <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:0px;">
                                                            <input type="checkbox" name="rules[]" value="<?= $apito['api_url'] ?>" <?php echo in_array($apito['api_url'], $auth_rules) ? "checked" : ""; ?> >
                                                            <span></span>
                                                            <?= $apito['api_url'] ?>
                                                        </label>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>



                                            </div>
                                        </div>

                                        <div>
                                            <?php if (!empty($child['child'])): ?>
                                                <div class="form-group" style="margin-left:50px;margin-bottom:0px;">
                                                    <div class="mt-checkbox-inline" style="padding:2px 0;">
                                                        <?php foreach ($child['child'] as $op): ?>
                                                            <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:5px;">
                                                                <input type="checkbox" name="rules[]" value="<?= $op['url']?>" <?php echo in_array($op['url'], $auth_rules) ? "checked" : ""; ?> >
                                                                <span></span>
                                                                <?= $op['title']?>
                                                            </label>

                                                            <?php if (!empty($op['apito'])): ?>
                                                                <?php foreach ($op['apito'] as $apito): ?>
                                                                    <label class="mt-checkbox mt-checkbox-outline" style="margin-bottom:0px;">
                                                                        <input type="checkbox" name="rules[]" value="<?= $apito['api_url'] ?>" <?php echo in_array($apito['api_url'], $auth_rules) ? "checked" : ""; ?> >
                                                                        <span></span>
                                                                        <?= $apito['api_url'] ?>
                                                                    </label>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>

                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="form-actions">
                        <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-auth']) ?>
                        <?= Html::button('取消', ['class' => 'btn']) ?>
                    </div>

                </form>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>