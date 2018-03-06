<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 18-3-5
 * Time: 下午4:48
 * Desc:
 */

ini_set('display_errors', 'on');
use \Workerman\Worker;

if (0 === strpos(strtolower(PHP_OS), 'win')) exit("start.php not support windows, please use start_for_win.bat\n");
if (!extension_loaded('pcntl')) exit("Please install pcntl extension. See http://doc3.workerman.net/appendices/install-extension.html\n");
if (!extension_loaded('posix')) exit("Please install posix extension. See http://doc3.workerman.net/appendices/install-extension.html\n");

define('GLOBAL_START', 1);
require_once __DIR__ . "/../../vendor/autoload.php";

foreach (glob(__DIR__ . "/start_*.php") as $start_file) {
    require_once $start_file;
}

Worker::runAll();
