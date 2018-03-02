/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/24
 */
window.PAGE_ACTION = function() {
    "use strict";

    var init_first = null, // 默认条件页面
        like_hate = null, // 赞和踩
        user_register = null,
        user_login = null;

    init_first = function() {
        $(function() {
            App.init(); // init core
            // init main slider
            var slider = $('.c-layout-revo-slider .tp-banner');
            var cont = $('.c-layout-revo-slider .tp-banner-container');
            var api = slider.show().revolution({
                delay: 15000,
                startwidth:1170,
                startheight: (App.getViewPort().width < App.getBreakpoint('md') ? 1024 : 620),
                navigationType: "hide",
                navigationArrows: "solo",
                touchenabled: "on",
                onHoverStop: "on",
                keyboardNavigation: "off",
                navigationStyle: "circle",
                navigationHAlign: "center",
                navigationVAlign: "center",
                fullScreenAlignForce:"off",
                shadow: 0,
                fullWidth: "on",
                fullScreen: "off",
                spinner: "spinner2",
                forceFullWidth: "on",
                hideTimerBar:"on",
                hideThumbsOnMobile: "on",
                hideNavDelayOnMobile: 1500,
                hideBulletsOnMobile: "on",
                hideArrowsOnMobile: "on",
                hideThumbsUnderResolution: 0,
                videoJsPath: "rs-plugin/videojs/",
            });
        })
    };

    like_hate = function() {
        $("a.zan_hate").on('click',function() {
            var _this = $(this);
            var data = {"data-do": _this.data('do'), "data-id": _this.data('id'), "data-type": _this.data('type')};
            ZP.api.like_hate({
                'data': data,
                successCallBack: function(result){
                    if ('1' == result.data) {
                        var num = parseInt(_this.find("span").text()) + 1;
                        _this.find("span").text(num);
                    }else if ('-1' == result.data) {
                        var num = parseInt(_this.find("span").text()) - 1;
                        if (0 > num) num = 0;
                        _this.find("span").text(num);
                    }
                    // ZP.utils.alert_warning(result.message, true);
                },
                failCallBack: ZP.utils.failCallBack
            });
        });
    };

    user_register = function() {

        $("li.user-register").on("click", function(e) {
            $("#registerModal").modal('show');
            // e.preventDefault();
        });
    };

    user_login = function() {

        $("li.user-login").on("click", function(e) {
            $("#loginModal").modal('show');
            // e.preventDefault();
        });
    };



    return {
        init: function (){
            init_first();
            user_register(); // 用户注册
            user_login(); // 用户登录
            like_hate(); // 赞和踩
        }
    };
}