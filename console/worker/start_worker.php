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

require_once __DIR__ . "/../../vendor/autoload.php";

// 加载utils类库
foreach (glob(__DIR__ . '/*.php') as $util_file) {
    require_once $util_file;
}

class Load_task {

    public static function into_timer($data) {

        $timer_id = Timer::add($data['interval'], ['Cron', 'invoke'], $data);

    }

}

Worker::$logFile = __DIR__ . "/workerman.log";
Worker::$pidFile = __DIR__ . "/workerman_task.pid";
Worker::$stdoutFile = __DIR__ . "/stdout.log";


$work = new Worker('text://0.0.0.0:2018');
$work->name = 'my_worker_timer';
$work->count = 1;
$work->protocol = 'Workerman\\Protocols\\Text';


// 开始装载定时任务
$work->onWorkerStart = function($work) {

    require_once __DIR__ . "/../../worker_yii.php";
    global $yii_app, $yii_db;
    $yii_app = Yii::$app;
    $yii_db = Yii::$app->db;

    $task_list = (new Task($yii_db))->getTasks();
    var_dump($task_list);die;

};

$work->onMessage = function($connection, $data) {

    echo "this is work's onMessage " . PHP_EOL;
};

$work->onWorkerStop = function($worker) {

    echo "Worker is stoping" . PHP_EOL;
};

if (!defined('GLOBAL_START')) {
    Worker::runAll();
}