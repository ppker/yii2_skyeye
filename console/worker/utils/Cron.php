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
            if (1 == $data['persistent']) {
                if (!$this->timeSure($data, $now_s, $now_m)) return false;
            } else if (0 == $data['persistent']) {
                if (!$this->timeSure($data, $now_s, $now_m)) return false;
            } else return false;



        }

    }

    public function timeSure($data, $now_s, $now_m) {

        if (empty($data['trigger_time'])) return false;
        if ('00' == substr($data['trigger_time'], -2)) { // 精确到分钟
            if (0 !== strpos($data['trigger_time'], $now_m)) return false;
        } else { // 精确到秒
            if (0 !== strpos($data['trigger_time'], $now_s)) return false;
        }

        return true;
    }

}