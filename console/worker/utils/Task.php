<?php
/**
 * Created by PhpStorm.
 * User: yanzhipeng
 * Date: 2018/3/5
 * Time: 下午9:51
 */

class Task {

    private $__db;

    public function __construct($db) {

        $this->__db = $db;
    }

    public function getTasks() {

        $now = date('Y-m-d H:i:s');

        $tacks = $this->__db->createCommand("select * from {{%worker_task%}} where [[status]] = 1 and [[start_time]] <= :start_time and 
end_time > :end_time order by id asc ", [':start_time' => $now, ':end_time' => $now])->queryAll(); // ->getRawSql();
        return $tacks;
    }

    public function updateCron($task_id, $timer_id) {

        $result = $this->__db->createCommand()->update("worker_task", ['timer_id' => $timer_id,
            'start_active_time' => date('Y-m-d H:i:s'),
            'load_status' => 1,
            ], ['id' => $task_id])->execute();
        return $result;
    }

    public function clear_timer() {

        $res_clear = $this->__db->createCommand()->update("worker_task", ['timer_id' => 0, 'end_active_time' => date('Y-m-d H:i:s'), 'load_status' => 0, 'updated_at' => time()],
            ['status' => 1, 'load_status' => 0])->execute();
        return $res_clear;
    }


}