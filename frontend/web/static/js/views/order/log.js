/**
 * author: ZhiPeng
 * date: 2017/4/18
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_limit = null, // 默认条件页面

    init_limit = function() {
        ZP.utils.default_list({
            'api_url': 'order_log', // list的api
            'template_path': '@order/order_log.html',
            'dataTable': $.extend(true, {}, ZP.utils.default_dataTable_list, {}),
        });
        ZP.utils.menu_top();
    };

    return {
        init: function (){
            init_limit();
        }
    };

}