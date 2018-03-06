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
        $tasks = $this->__db->createCommand()->select('*')->from('worker_task')->where('status = 1 and start_time <= :start_time and 
        end_time < :end_time', [
            ':start_time' => $now,
            ':end_time' => $now
        ])->order('id asc')->queryAll();

        var_dump($tasks);die;
    }
}