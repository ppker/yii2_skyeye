<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-6
 * Time: 下午5:50
 * Desc:
 */

use \Workerman\Lib\Timer;

class Cron {

    public function __construct() {

    }

    public static function invoke($data) {

        $now =time();
        $now_s = date('H:i:s');
        $now_m = date('H:i');

        if ($now >= strtotime($data['start_time']) && $now < strtotime($data['end_time'])) {

        }

    }
}