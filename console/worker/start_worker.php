<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-5
 * Time: 下午5:14
 * Desc:
 */

use \Workerman\Worker;
use \Workerman\Lib\Timer;

class Load_task {

    public static function into_timer($data) {

        $timer_id = Timer::add($data['interval'], ['Cron', 'invoke'], $data);

    }

}




$work = new Worker('text://0.0.0.0:2018');
$work->name = 'my_worker_timer';
$work->count = 1;
$work->protocol = 'Workerman\\Protocols\\Text';

// 开始装载定时任务
$work->onWorkerStart = function($work) {

};