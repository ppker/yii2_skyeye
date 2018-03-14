/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-7
 * Time: 下午5:09
 * Desc:
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_limit = null, // 默认条件页面
        btn_edit = null,
        btn_active = null,
        btn_unactive = null,
        btn_del = null; // 单个删除的按钮

    btn_edit = function() { // 编辑操作
        $("table tr .btn-group li").on("click", "a[actionrule='edit']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.system_task_get({
                    data: {id: $id},
                    successCallBack: function(result){

                        $("#addModal h4.modal-title").text('任务编辑');
                        $("#addModal input[name='id']").val(result.data.id);
                        $("#addModal input[name='title']").val(result.data.title);

                        $("#addModal input[name='title']").val(result.data.title);
                        $("select #invoke_type").selectpicker('val', result.data.invoke_type);
                        $("#addModal input[name='command']").val(result.data.command);
                        $("#addModal input[name='timer_interval']").val(result.data.timer_interval);
                        $("#addModal input[name='start_time']").val(result.data.start_time);
                        $("#addModal input[name='end_time']").val(result.data.end_time);
                        $("#addModal input[name='trigger_time']").val(result.data.trigger_time);

                        $("select #persistent").selectpicker('val', result.data.persistent);
                        $("#addModal input[name='timer_id']").val(result.data.timer_id);
                        $("#addModal input[name='start_active_time']").val(result.data.start_active_time);
                        $("#addModal input[name='end_active_time']").val(result.data.end_active_time);

                        $("select #status").selectpicker('val', result.data.status);
                        $("select #user_id").selectpicker('val', result.data.user_id);
                        $("select #load_status").selectpicker('val', result.data.load_status);

                        $("#addModal").modal('show');
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };

    btn_del = function() { // 单个删除按钮

        $("table tr .btn-group li").on("click", "a[actionrule='del']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.system_task_del({
                    data: {id: $id},
                    successCallBack: function(result){
                        ZP.utils.alert_warning(result.message, true);
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };


    // active
    btn_active = function() {

        $("table tr .btn-group li").on("click", "a[actionrule='active']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.system_task_active({
                    data: {id: $id},
                    successCallBack: function(result) {
                        ZP.utils.alert_warning(result.message, true);
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };

    // unactive
    btn_unactive = function() {

        $("table tr .btn-group li").on("click", "a[actionrule='unactive']", function() {
            var $id = $(this).attr("actionid");
            if ($id) {
                ZP.api.system_task_unactive({
                    data: {id: $id},
                    successCallBack: function(result) {
                        ZP.utils.alert_warning(result.message, true);
                    },
                    failCallBack: ZP.utils.failCallBack
                });
            }
        });
    };


    init_limit = function() {
        ZP.utils.default_list({
            'api_url': 'system_task', // list的api
            'template_path': 'system/task_index.html',
            'dataTable': $.extend(true, {}, ZP.utils.default_dataTable_list, {scrollX: true}),
            'all_del_api': 'system_task_del',
            'add_api': 'system_task_add',
            'init_form_api': {'api': 'user_select_api', 'id': 'user_id'},
            'btn_edit': btn_edit,
            'btn_del': btn_del,
        });
    };

    return {
        init: function (){
            init_limit();

            btn_active();
            btn_unactive();

            ZP.utils.target_second();
            ZP.utils.target_time_second();

        }
    };


}