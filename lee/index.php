<?php
/**
 * Created by PhpStorm.
 * User: heretreeli
 * Date: 17/6/11
 * Time: 02:52
 */


use Workerman\Lib\Timer;

include_once '../vendor/autoload.php';

$worker = new Workerman\Worker();
$worker->count = 1;
$worker->name = 'lee';

$file = __DIR__ . '/lee.txt';

$worker->onWorkerStart = function () use($file) {
    Timer::add(3, function () use ($file){
        file_put_contents($file, date('Y-m-d H:i:s') . "\n", FILE_APPEND);
    });
};

$worker->listen();

Workerman\Worker::runAll();