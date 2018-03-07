<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-2
 * Time: 下午3:15
 * Desc:
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
use PhpOffice\PhpSpreadsheet;
use yii\db\Query;

class BaseController extends Controller {

    public function actions() {

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    public function init() {

        parent::init();
        ini_set("memory_limit", "2000M");
        set_time_limit(0);
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
            Yii::info(var_export($err, true));
            Yii::info("哈哈哈，MR.Robot find some errors!");
        }
        curl_close($ch);
        return $info['http_code'] !== 200 ? false : $result;
    }


}
