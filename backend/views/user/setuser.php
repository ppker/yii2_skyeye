<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 2017/8/29
 * Time: 13:55
 * Desc:
 */
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

\backend\assets\AppAsset::addCss($this, Yii::getAlias('@web/css/profile.css'));
$this->registerCss("table.table-left td {text-align: left;}");
$this->title = '个人信息';
$this->params['title_sub'] = '管理我的个人信息';
?>

<div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE SIDEBAR -->
                                <div class="profile-sidebar">
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light profile-sidebar-portlet ">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-userpic">
                                            <?= Html::img(Yii::$app->user->identity->getUserAvatar(200), ['class' => 'img-responsive', 'alt' => 'avatar']); ?>

                                        </div>
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> <?= Yii::$app->user->identity->username; ?> </div>
                                            <div class="profile-usertitle-job"> DEVELOPER </div>
                                        </div>
                                        <!-- END SIDEBAR USER TITLE -->
                                        <!-- SIDEBAR BUTTONS -->
                                        <div class="profile-userbuttons">
                                            <button type="button" class="btn btn-circle green btn-sm">Follow</button>
                                            <button type="button" class="btn btn-circle red btn-sm">Message</button>
                                        </div>
                                        <!-- END SIDEBAR BUTTONS -->
                                        <!-- SIDEBAR MENU -->
                                        <!--<div class="profile-usermenu">
                                            <ul class="nav">
                                                <li>
                                                    <a href="page_user_profile_1.html">
                                                        <i class="icon-home"></i> Overview </a>
                                                </li>
                                                <li class="active">
                                                    <a href="page_user_profile_1_account.html">
                                                        <i class="icon-settings"></i> Account Settings </a>
                                                </li>
                                                <li>
                                                    <a href="page_user_profile_1_help.html">
                                                        <i class="icon-info"></i> Help </a>
                                                </li>
                                            </ul>
                                        </div>-->
                                        <!-- END MENU -->
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light ">
                                        <!-- STAT -->
                                        <div class="row list-separated profile-stat">
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 37 </div>
                                                <div class="uppercase profile-stat-text"> 项目 </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 51 </div>
                                                <div class="uppercase profile-stat-text"> 任务 </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-6">
                                                <div class="uppercase profile-stat-title"> 61 </div>
                                                <div class="uppercase profile-stat-text"> 更新 </div>
                                            </div>
                                        </div>
                                        <!-- END STAT -->
                                        <div>
                                            <h4 class="profile-desc-title">关于 Keanu Reeves</h4>
                                            <span class="profile-desc-text" style="margin-left: 36px;"> 一个十分帅气的男人。 </span>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-globe"></i>
                                                <a href="http://www.keenthemes.com">www.keenthemes.com</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-twitter"></i>
                                                <a href="http://www.twitter.com/keenthemes/">@keenthemes</a>
                                            </div>
                                            <div class="margin-top-20 profile-desc-link">
                                                <i class="fa fa-facebook"></i>
                                                <a href="http://www.facebook.com/keenthemes/">keenthemes</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                </div>
                                <!-- END BEGIN PROFILE SIDEBAR -->
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">账户设置</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
                                                        <li class="">
                                                            <a href="#tab_1_1" data-toggle="tab">个人信息</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_2" data-toggle="tab">设置头像</a>
                                                        </li>
                                                        <li class="active">
                                                            <a href="#tab_1_3" data-toggle="tab">修改密码</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_4" data-toggle="tab">隐私设置</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane " id="tab_1_1">
                                                            <form role="form" action="#">
                                                                <div class="form-group">
                                                                    <label class="control-label">姓名</label>
                                                                    <input type="text" placeholder="陆小凤" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">手机号</label>
                                                                    <input type="text" placeholder="+18521568316" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">兴趣爱好</label>
                                                                    <input type="text" placeholder="电脑,跑步,游泳" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">职业</label>
                                                                    <input type="text" placeholder="自由职业者" class="form-control" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">座右铭</label>
                                                                    <textarea class="form-control" rows="3" placeholder="我是一只会修行的小鱼人。"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">个人网址</label>
                                                                    <input type="text" placeholder="http://www.mywebsite.com" class="form-control" /> </div>
                                                                <div class="margiv-top-10">
                                                                    <a href="javascript:;" class="btn green"> 保存 </a>
                                                                    <a href="javascript:;" class="btn default"> 取消 </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                        <!-- CHANGE AVATAR TAB -->
                                                        <div class="tab-pane" id="tab_1_2">
                                                            <p> 上传你的头像吧。 </p>



                                                            <div>
                                                               <?= Html::img(Yii::$app->user->identity->getUserAvatar(200)); ?>
                                                            </div>


                                                            <form id="form_avatar" role="form" data-toggle="validator" method="post" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                                                                    <input type="hidden" name="form_avatar" value="1">
                                                                    <input type="file" id="avatar" name="avatar">
                                                                </div>
                                                                <div class="margin-top-10">
                                                                    <button type="reset" class="btn default">取消</button>
                                                                    <button type="submit" class="btn green">提交</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE AVATAR TAB -->
                                                        <!-- CHANGE PASSWORD TAB -->
                                                        <div class="tab-pane active" id="tab_1_3">
                                                            <form id="form_reset" role="form" data-toggle="validator">
                                                                <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                                                                <div class="form-group">
                                                                    <label class="control-label">当前密码</label>
                                                                    <input type="password" class="form-control" name="current_pwd" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">新密码</label>
                                                                    <input type="password" class="form-control" name="new_pwd" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">重复新密码</label>
                                                                    <input type="password" class="form-control" name="re_pwd" /> </div>
                                                                <div class="margin-top-10">
                                                                    <button type="reset" class="btn default">取消</button>
                                                                    <button type="submit" class="btn green">更新</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE PASSWORD TAB -->
                                                        <!-- PRIVACY SETTINGS TAB -->
                                                        <div class="tab-pane" id="tab_1_4">
                                                            <form action="#">
                                                                <table class="table table-light table-hover table-left">
                                                                    <tr>
                                                                        <td> 是否保留浏览痕迹</td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios1" value="option1" checked /> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios1" value="option2" /> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 是否银行账户新增100W美刀 </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios11" value="option1" checked/> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios11" value="option2"/> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 是否接受来自陌生人的消息 </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios21" value="option1" checked/> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios21" value="option2" /> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td> 是否新增一辆保时捷跑车 </td>
                                                                        <td>
                                                                            <div class="mt-radio-inline">
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios31" value="option1" checked/> Yes
                                                                                    <span></span>
                                                                                </label>
                                                                                <label class="mt-radio">
                                                                                    <input type="radio" name="optionsRadios31" value="option2" /> No
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                <!--end profile-settings-->
                                                                <div class="margin-top-10">
                                                                    <a href="javascript:;" class="btn red"> 提交 </a>
                                                                    <a href="javascript:;" class="btn default"> 取消 </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PRIVACY SETTINGS TAB -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
                        </div>