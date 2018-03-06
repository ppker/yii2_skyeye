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
}