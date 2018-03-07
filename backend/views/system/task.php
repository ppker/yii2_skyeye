<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-7
 * Time: 下午4:33
 * Desc:
 */

use yii\widgets\ActiveForm;
use \yii\helpers\Url;

$this->title = '定时任务管理';
$this->params['title_sub'] = '管理定时任务信息';
?>

<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">管理定时任务信息</span>
                </div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn blue btn-outline btn-circle" href="javascript:;" id="btn_add">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> 新增任务</span>
                        </a>
                        <a class="btn red btn-outline btn-circle" href="javascript:;" actionrule="delete" id="btn_all_del">
                            <i class="fa fa-remove"></i>
                            <span class="hidden-xs"> 删除任务</span>
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
                <h4 class="modal-title">新增任务</h4>
            </div>
            <div class="modal-body">
                <form id="addForm" role="form" data-toggle="validator" class="form-horizontal">
                    <input type="hidden" name="<?= Yii::$app->getRequest()->csrfParam; ?>" value="<?= Yii::$app->getRequest()->getCsrfToken(); ?>">
                    <input type="hidden" name="id" value="" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="control-label col-sm-3">名称</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入菜单名" class="form-control" name="title" minlength="1" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sort" class="control-label col-sm-3">排序</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入排序" class="form-control" name="sort" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hide" class="control-label col-sm-3">隐藏</label>
                            <div class="col-sm-9 text-center" style="margin-top: 7px;">
                                <label class="mt-radio radio-inline">
                                    <input type="radio" name="hide" value="0" checked />显示
                                    <span></span>
                                </label>
                                <label class="mt-radio radio-inline">
                                    <input type="radio" name="hide" value="1" />隐藏
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="url" class="control-label col-sm-3">URL</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入URL" class="form-control" name="url" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="group" class="control-label col-sm-3">分组</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入分组" class="form-control" name="group" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label col-sm-3">状态</label>
                            <div class="col-sm-9 text-center" style="margin-top: 7px;">
                                <label class="mt-radio radio-inline">
                                    <input type="radio" name="status" value="1" checked />正常
                                    <span></span>
                                </label>
                                <label class="mt-radio radio-inline">
                                    <input type="radio" name="status" value="0" />禁用
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pid" class="control-label col-sm-2">上级菜单</label>
                            <div class="col-sm-10">
                                <select class="bs-select form-control" data-live-search="true"  name="pid" id="pid_id" data-size="8" required>

                                </select>
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