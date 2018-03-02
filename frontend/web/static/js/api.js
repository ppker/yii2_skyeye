(function(MAIN, $){
	
	"use strict";
	
	var self = MAIN.nameSpace.reg("api"),
		queue = [],
		ajax = null;
		
	ajax = function(options){
		var ret = null;
		
		if(MAIN.define.isAjaxLock){
			queue.push(options);
			/*
			if(typeof options.failCallBack === "function"){
				options.failCallBack({
					success: false,
					message: ZP.msg.ajaxLocked,
					data: null
				});
			}
			*/
		}else{
			
			options.async = typeof options.async === "undefined" ? true : options.async;
			options.async = options.successCallBack ? options.async : false;
			options.dataType = options.dataType ? options.dataType : "json";
			MAIN.define.isAjaxLock = true;

			$.ajax({
				async: options.async,
				// dataType: "json",
				dataType: options.dataType,
				type: "post",
				url: options.url,
				data: $.extend(options.data, {"access-token": g_username}) , // api的验证字段
				success: function(result, textStatus){
					MAIN.define.isAjaxLock = false;

					if(result.success && typeof options.successCallBack === "function"){
						options.successCallBack(result);
					}else if(typeof options.failCallBack === "function"){
						options.failCallBack(result);
					}
					ret = result;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown){
					MAIN.define.isAjaxLock = false;

					if(typeof options.failCallBack === "function"){
						options.failCallBack({
							success: false,
							message: errorThrown,
							data: null
						});
					}
				},
				complete: function(XMLHttpRequest, textStatus){
					MAIN.define.isAjaxLock = false;

					if(queue.length >= 1){
						var options = queue.shift();
						ajax(options);
					}
				}
			});
		}
		return ret;
	};

	///////////////////////////////////////////////////////////////////////

	/**
	 * add_shopping_car
     */
    self.add_shopping_car = function(options) {
        options = options ? options : {};
        options.url = "/api/web/frontend/add_shoppingcar";
        return ajax(options);
    };

	/**
	 * minus_shopping_car
	 */
	self.minus_shopping_car = function(options) {
		options = options ? options : {};
		options.url = "/api/web/frontend/minus_shopping_car";
		return ajax(options);
	};

    /**
     * plus_shopping_car
     */
    self.plus_shopping_car = function(options) {
        options = options ? options : {};
        options.url = "/api/web/frontend/plus_shopping_car";
        return ajax(options);
    };

    /**
     * clear_shopping_car
     */
    self.clear_shopping_car = function(options) {
        options = options ? options : {};
        options.url = "/api/web/frontend/clear_shopping_car";
        return ajax(options);
    };

    /**
     * qxd_shopping_car
     */
    self.qxd_shopping_car = function(options) {
        options = options ? options : {};
        options.url = "/api/web/frontend/qxd_shopping_car";
        return ajax(options);
    };

	/**
	 * like_hate
	 */
	self.like_hate = function(options) {
		options = options ? options : {};
		options.url = "/api/web/frontend/like_hate";
		return ajax(options);
	};

    /**
     * order_log
     */
    self.order_log = function(options) {
        options = options ? options : {};
        options.url = "/api/web/frontend/order_log";
        return ajax(options);
    };



})(ZP, jQuery);