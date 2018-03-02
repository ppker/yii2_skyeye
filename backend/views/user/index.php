<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2017/1/20
 * Project: Cat Visual
 */
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = '用户账号';
$this->params['title_sub'] = '管理用户账号信息';
?>


<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">管理用户账号信息</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn blue btn-outline btn-circle" href="javascript:;" id="btn_add">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> 新增用户</span>
                        </a>
                        <a class="btn red btn-outline btn-circle" href="javascript:;" actionrule="delete" id="btn_all_del">
                            <i class="fa fa-remove"></i>
                            <span class="hidden-xs"> 删除用户</span>
                        </a>
                    </div>


                    <div class="btn-group">
                        <a class="btn green btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                            <i class="fa fa-share"></i>
                            <span class="hidden-xs"> 设置 </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right" id="sample_3_tools">
                            <li>
                                <a href="javascript:;" data-action="0" class="tool-action">
                                    <i class="icon-printer"></i> Print</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="1" class="tool-action">
                                    <i class="icon-check"></i> Copy</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="2" class="tool-action">
                                    <i class="icon-doc"></i> PDF</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="3" class="tool-action">
                                    <i class="icon-paper-clip"></i> Excel</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-action="4" class="tool-action">
                                    <i class="icon-cloud-upload"></i> CSV</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="javascript:;" data-action="5" class="tool-action">
                                    <i class="icon-refresh"></i> 刷新</a>
                            </li>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="table">

                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>

<!--模态框-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">新增用户</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" role="form" data-toggle="validator" class="form-horizontal">
                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_login" class="control-label col-sm-4">账号</label>
                            <div class="col-sm-8">
                                <input type="text" value="" placeholder="请输入登录账号" class="form-control" name="username" minlength="3" data-remote="<?= Url::toRoute(['site/check_user']) ?>" data-remote-error="用户名已被注册" required />
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sex" class="control-label col-sm-4">性别</label>
                            <div class="col-sm-8 text-center">

                                <label class="mt-radio radio-inline">
                                    <input type="radio" name="sex" value="0" checked />保密
                                    <span></span>
                                </label>
                                <label class="mt-radio radio-inline">
                                    <input type="radio" name="sex" value="1" />男
                                    <span></span>
                                </label>
                                <label class="mt-radio radio-inline">
                                    <input type="radio" name="sex" value="2" />女
                                    <span></span>
                                </label>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <!--<div class="form-group">
                            <label for="role_id" class="control-label col-sm-4">角色<span class="required"> * </span></label>
                            <div class="col-sm-8">
                                <select class="form-control"  name="role_id" id="role_id">

                                </select>

                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="user_pass" class="control-label col-sm-4">密码</label>
                            <div class="col-sm-8">
                                <input type="password" value="" class="form-control"  name="password_hash" pattern="^[\w-]{6,16}" data-error="密码6到16位字母和数字组合" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_status" class="control-label col-sm-4">用户状态</label>
                            <div class="col-sm-8">
                                <select class="form-control"  name="status" id="role_id" required>
                                    <option value="10" selected>正常</option>
                                    <option value="0">禁用</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user_signature" class="control-label col-sm-2">个性签名</label>
                            <div class="col-sm-10">
                                <input type="text" value=""  placeholder="他太懒，什么也没留下~" class="form-control"  name="signature" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user_email" class="control-label col-sm-2">邮箱</label>
                            <div class="col-sm-10">
                                <input type="email" value=""  placeholder="email address" class="form-control"  name="email" pattern="^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$" data-error="邮箱格式错误" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 text-center">
                            <button type="button" class="btn default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn green" id="btn-save">添加</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="ruleModal" tabindex="-1" role="dialog" aria-labelledby="ruleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">用户授权</h4>
            </div>
            <div class="modal-body">
                <form id="authForm" role="form" data-toggle="validator" class="form-horizontal">
                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                    <input type="hidden" name="user_id" id="auth_user_id">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="user_param" class="control-label col-sm-3" style="padding-top: 0;">用户组</label>
                            <div class="mt-radio-list col-sm-9">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 col-md-12 text-center">
                            <button type="button" class="btn default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn green" id="btn-auth-save">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>