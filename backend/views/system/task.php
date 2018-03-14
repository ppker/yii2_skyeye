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
    <div class="modal-dialog" style="width: 56%;">
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
                            <label for="title" class="control-label col-sm-3">任务标题</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入任务标题" class="form-control" name="title" minlength="1" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invoke_type" class="control-label col-sm-3">触发类型</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="invoke_type" id="invoke_type" data-size="8" required>
                                    <option value="1" selected="selected">yii_cli</option>
                                    <option value="2">curl</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="command" class="control-label col-sm-3">任务命令</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入任务命令" class="form-control" name="command" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="timer_interval" class="control-label col-sm-3">定时器间隔</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入定时器间隔" class="form-control" min="1" name="timer_interval" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_time" class="control-label col-sm-4">任务开始时间</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon" style="line-height: 1.42;">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input style="width: 205px;height: 34px;margin-top: 0;" type="text" placeholder="任务开始时间" value="" name="start_time" class="form-control input-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_time" class="control-label col-sm-4">任务截止时间</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon" style="line-height: 1.42;">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input style="width: 205px;height: 34px;margin-top: 0;" type="text" placeholder="任务截止时间" value="" name="end_time" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">


                        <div class="form-group">
                            <label for="trigger_time" class="control-label col-sm-4">任务触发时间</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon" style="line-height: 1.42;">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input style="width: 205px;height: 34px;margin-top: 0;" type="text" placeholder="任务触发时间" value="" name="trigger_time" class="form-control input-sm trigger_hour">
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="persistent" class="control-label col-sm-3">执行次数</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="persistent" id="persistent" data-size="8" required>
                                    <option value="1" selected="selected">每天执行</option>
                                    <option value="0">仅执行一次</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="timer_id" class="control-label col-sm-3">定时器id</label>
                            <div class="col-sm-9">
                                <input type="text" value="" placeholder="请输入定时器id" class="form-control" name="timer_id" required>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_active_time" class="control-label col-sm-4">任务激活时间</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon" style="line-height: 1.42;">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input style="width: 205px;height: 34px;margin-top: 0;" type="text" placeholder="任务开始激活时间" value="" name="start_active_time" class="form-control input-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="end_active_time" class="control-label col-sm-4">任务结束激活时间</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon" style="line-height: 1.42;">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input style="width: 205px;height: 34px;margin-top: 0;" type="text" placeholder="任务结束激活时间" value="" name="end_active_time" class="form-control input-sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="control-label col-sm-3">任务状态</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="status" id="status" data-size="8" required>
                                    <option value="0">禁用</option>
                                    <option value="1" selected="selected">正常</option>
                                    <option value="2">删除</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group col-md-6">
                            <label for="user_id" class="control-label col-sm-3">任务创建人</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="user_id" id="user_id" data-size="8" required>

                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="load_status" class="control-label col-sm-3">任务状态</label>
                            <div class="col-sm-9">
                                <select class="bs-select form-control" data-live-search="true"  name="load_status" id="load_status" data-size="8" required>
                                    <option value="0" selected="selected">未装载</option>
                                    <option value="1">已装载</option>
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