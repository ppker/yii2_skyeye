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
        $now_datetime = date('Y-m-d H:i:s');
        $now_s = date('H:i:s');
        $now_m = date('H:i');
        $yii_path = __DIR__ . "/../../../yii";

        if ($now >= strtotime($data['start_time']) && $now < strtotime($data['end_time'])) {
            if (1 == $data['persistent']) {
                if (!self::timeSure($data, $now_s, $now_m)) return false;
            } else if (0 == $data['persistent']) {
                if (!self::timeSure($data, $now_s, $now_m)) return false;
            } else return false;

            // make log
            $code = 1;
            $program_begin_time = microtime(true);
            $program_begin_memory = memory_get_usage();

            $result = '';
            switch($data['invoke_type']) {
                case 1: // cli
                    exec("php {$yii_path} {$data['command']} 2>&1", $ret);
                    if (isset($ret[0]) && !empty($ret[0])) {
                        $result = $ret[0];
                    } else $code = 0;
                    break;
                case 2: // curl
                    $res = self::CURL($data['command']);
                    $result = $res;
                    $code = json_decode($res, true)['success'];
                    break;
                default:
                    break;
            }

            $program_end_time = microtime(true);
            $program_end_memory = memory_get_usage();
            $cost_time = $program_end_time - $program_begin_time; // 花费时间
            $cost_memory = $program_end_memory - $program_begin_memory; // 花费内存

            $log_data = [
                'task_id' => (int)$data['id'],
                'run_time' => (string)$now_datetime,
                'cost_time' => round($cost_time, 4),
                'cost_memory' => (int)$cost_memory,
                'data' => (string)$result,
                'code' => (int)$code,
                'created_at' => time(),
                'updated_at' => time()
            ];

            global $yii_db;
            $res_log = $yii_db->createCommand()->insert('worker_task_log', $log_data)->execute();
        } else if ($now >= strtotime($data['end_time'])) { // task transient delete this task
            Timer::del($data['timer_id']);
            global $yii_db;
            $res_upload = $yii_db->createCommand()->update("worker_task", ['timer_id' => 0, 'end_active_time' => date('Y-m-d H:i:s'),
                'load_status' => 0, 'updated_at' => time()], ['id' => $data['id']])->execute();
        }

    }

    public static function timeSure($data, $now_s, $now_m) {

        if (empty($data['trigger_time'])) return false;
        if ('00' == substr($data['trigger_time'], -2)) { // 精确到分钟
            if (0 !== strpos($data['trigger_time'], $now_m)) return false;
        } else { // 精确到秒
            if (0 !== strpos($data['trigger_time'], $now_s)) return false;
        }

        return true;
    }


    public static function CURL($url, $postData = '', $timeOut = 20, $proxy = '', $header = '') {

        $ch = curl_init();

        $options = array(
            CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.82 Safari/537.36",
            // CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0",
            CURLOPT_TIMEOUT        => $timeOut,
            CURLOPT_RETURNTRANSFER => true, // 成功只返回结果，不自动输出内容
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => 1,
            // CURLOPT_FOLLOWLOCATION => true, 这个是关于重定向的
        );

        if ("https" == substr($url, 0, 5)) {
            $options[CURLOPT_SSL_VERIFYPEER] = false;
            $options[CURLOPT_SSL_VERIFYHOST] = false;
        }

        //代理
        if ($proxy) {
            $options[CURLOPT_PROXY] = $proxy;
            $options[CURLOPT_PROXYTYPE] = CURLPROXY_SOCKS5;
        }

        //post
        if (!empty($postData)) {
            // 对$postData数据进行处理
            $postData = http_build_query($postData);
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = $postData;
            $options[CURLOPT_HTTPHEADER] = ['Content-Type: application/x-www-form-urlencoded; charset=UTF-8', 'Content-Length: ' . strlen($postData)];

            // if (!empty($header)) $options[CURLOPT_HTTPHEADER] = $header; // 注入头部信息
            $options[CURLOPT_ENCODING] = 'gzip'; // 解码
        }
        if (!empty($header)) $options[CURLOPT_HTTPHEADER] = $header; // 注入头部信息
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);


        $info = curl_getinfo($ch);
        $err = curl_error($ch);
        if ($info['http_code'] !== 200) {
            $err = curl_error($ch);
            // var_dump($err);die;
        }
        curl_close($ch);
        if (200 == $info['http_code']) {
            return json_encode(['success' => 1, 'data' => [], 'message' => '执行成功']);
        } else return json_encode(['success' => 0, 'data' => [], 'message' => '抱歉,执行失败']);
    }






}