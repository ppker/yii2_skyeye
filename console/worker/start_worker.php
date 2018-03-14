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


// 加载utils类库
foreach (glob(__DIR__ . '/utils/*.php') as $util_file) {
    require_once $util_file;
}

class Load_task {

    public static function into_timer($data) {

        $timer_id = Timer::add($data['timer_interval'], ['Cron', 'invoke'], [$data]);
        // 更新任务定时器信息
        global $yii_db;
        (new Task($yii_db))->updateCron($data['id'], $timer_id);
        return $timer_id;
    }

}

global $yii_app;
global $yii_db;

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
    global $yii_app;
    global $yii_db;
    $yii_app = Yii::$app;
    $yii_db = Yii::$app->db;

    $task_list = (new Task($yii_db))->getTasks();

    if (empty($task_list)) return;
    foreach ($task_list as $val) {
        Load_task::into_timer($val);
    }

    echo "定时任务模块 started by " . date('Y-m-d H:i:s') . PHP_EOL;

};

$work->onMessage = function($connection, $data) {

    global $yii_db;
    $data = json_decode(rtrim($data), true);
    if (!empty($data) && is_array($data)) {
        switch($data['type']) {
            case 'add':
                $task_data = (new Task($yii_db))->getTaskById((int)$data['id']);
                if (!empty($task_data)) $res_end = Load_task::into_timer($task_data);
                break;
            case 'stop':
                $task_data = (new Task($yii_db))->getTaskById((int)$data['id']);
                if (!empty($task_data)) {
                    Timer::del($task_data['timer_id']);
                    global $yii_db;
                    $res_end = $yii_db->createCommand()->update("worker_task", ['timer_id' => 0, 'end_active_time' => date('Y-m-d H:i:s'),
                        'load_status' => 0, 'updated_at' => time()], ['id' => (int)$data['id']])->execute();
                }
                break;
            default:
                $res_end = false;
                break;
        }
        if (false == $res_end) {
            $send_data = ['success' => 0, 'message' => '抱歉,操作失败！', 'data' => []];
        } else $send_data = ['success' => 1, 'message' => '恭喜你,操作成功!', 'data' => []];
        $connection->send(json_encode($send_data));
    }

};

$work->onWorkerStop = function($worker) {

    global $yii_db;
    $res_clear = (new Task($yii_db))->clear_timer();
    echo "Worker is stoping!" . PHP_EOL;

};

if (!defined('GLOBAL_START')) {
    Worker::runAll();
}