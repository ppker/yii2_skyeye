/**
 * Created by PhpStorm.
 * User: ZhiPeng
 * Github: https://github.com/ppker
 * Date: 2017/3/25
 */

window.PAGE_ACTION = function() {
    "use strict";

    var init_first = null, // 默认条件页面
        qxd = null,
        clear_car = null,
        plus_us = null, // 加上
        like_hate = null, // 赞和踩
        min_us = null; // 减去

    init_first = function() {
        $(function() {
            $("div.buy a.buy_car").on("click", function() {
                var in_car = $("button#qxd");
                var imgtodrag = $(this).parent().parent().siblings().find("img").eq(0);
                if (imgtodrag) {
                    var imgclone = imgtodrag.clone().offset({
                        top: imgtodrag.offset().top,
                        left: imgtodrag.offset().left
                    }).css({
                        'opacity': '0.5',
                        'position': 'absolute',
                        'height': '50px',
                        'width': '60px',
                        'z-index': '100'
                    }).appendTo($('body')).animate({
                        'top': in_car.offset().top + 10,
                        'left': in_car.offset().left + 10,
                        'width': 75,
                        'height': 75
                    }, 1000, 'easeInOutExpo');
                    setTimeout(function () {
                        in_car.effect('shake', { times: 2 }, 200);
                    }, 1500);

                    // 添加订单
                    console.log($(this).data());
                    ZP.api.add_shopping_car({
                        data: $(this).data(),
                        successCallBack: function(result){
                            // 新增的订单dom

                            if ([] != result.data && "" != result.data) {
                                if (1 == result.data.num) {
                                    var tmp = "<tr class='menu_dish'><td>" +  result.data.name  + "</td>" +
                                        "<td class='item-count clearfix'>" +
                                        '<span class="item-minus" data-dish_id="' + result.data.dish_id  +  '" type="button"></span><input class="item-count" disabled type="input" value="' + result.data.num   + '"><span class="item-plus" data-dish_id="' + result.data.dish_id  +  '" type="button"></span>' +
                                        "</td>" +
                                        '<td>¥<span class="this_price">'+ result.data.price + '</span></td>' +
                                        "</tr>";
                                    $("tbody.shopping_car_tbody tr.success").before(tmp);
                                } else if(1 < result.data.num){
                                    var dish_id = result.data.dish_id;
                                    $("tbody.shopping_car_tbody tr td span[data-dish_id='" + dish_id + "'").next().val(result.data.num);
                                }
                            }
                            // 份数和总价要进行相加
                            var total_num_f = $("#total_num_f").text() - 0;
                            $("#total_num_f").text(total_num_f + 1);
                            var total_price_f = $("#total_price_f").text() - 0;
                            $("#total_price_f").text(total_price_f + parseInt(result.data.price));
                        },
                        failCallBack: ZP.utils.failCallBack
                    });


                    imgclone.animate({
                        'width': 0,
                        'height': 0
                    }, function () {
                        $(this).detach();
                    });
                }
            });

        })
    };

    min_us = function () {
        $("table.table-shopping-car").on("click", "span.item-minus", function() {
            ZP.api.minus_shopping_car({
                data: $(this).data(),
                successCallBack: function(result){
                    // 新增的订单dom
                    if ("" != result.data && [] != result.data) {

                        var input = $("td span.item-minus[data-dish_id='" + result.data + "']").next("input.item-count");
                        var num = input.val();
                        var total_num_f = $("span#total_num_f").text() - 0;
                        total_num_f --;
                        if (total_num_f < 0) total_num_f = 0;
                        num --;
                        if (0 == num) {
                            input.parent().parent().remove();
                        } else {
                            input.val(num);
                        }
                        $("span#total_num_f").text(total_num_f);
                        // 单价
                        var this_price =  input.parent().next().find("span.this_price").text() - 0;
                        // 总价
                        var all_price = $("span#total_price_f").text() - 0;
                        var end_money = all_price - this_price;
                        if (end_money <= 0) end_money = 0;
                        $("span#total_price_f").text(end_money);
                    }
                },
                failCallBack: ZP.utils.failCallBack
            });
        });
    };

    plus_us = function () {
        $("table.table-shopping-car").on("click", "span.item-plus", function() {
            ZP.api.plus_shopping_car({
                data: $(this).data(),
                successCallBack: function(result){
                    // 新增的订单dom
                    if ("" != result.data && [] != result.data) {
                        var input = $("td span.item-plus[data-dish_id='" + result.data + "']").prev("input.item-count");
                        var num = input.val();
                        var total_num_f = $("span#total_num_f").text() - 0;
                        total_num_f ++;
                        num ++;
                        input.val(num);
                        $("span#total_num_f").text(total_num_f);
                        // 单价
                        var this_price =  input.parent().next().find("span.this_price").text() - 0;
                        // 总价
                        var all_price = $("span#total_price_f").text() - 0;
                        var end_money = all_price + this_price;
                        $("span#total_price_f").text(end_money);
                    }
                },
                failCallBack: ZP.utils.failCallBack
            });
        });
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





    clear_car = function() {
        $("div button#clear").on("click", function() {
            ZP.api.clear_shopping_car({
                data: {},
                successCallBack: function(result){
                    // 清空购物车
                    $("table.table-shopping-car tr.menu_dish").remove();
                    $("#total_num_f").text(0);
                    $("#total_price_f").text(0);
                },
                failCallBack: ZP.utils.failCallBack
            });
        });

    }

    qxd = function() {
        $("button#qxd").on("click", function() {
            ZP.api.qxd_shopping_car({
                data: {},
                successCallBack: function(result){
                    ZP.utils.alert_warning(result.message, true);
                },
                failCallBack: ZP.utils.failCallBack
            });
        });
    };


    return {
        init: function (){
            init_first();
            min_us();
            plus_us();
            clear_car();
            qxd();
            like_hate();
        }
    };
}
