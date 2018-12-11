<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/29
 * Time: 15:32
 */

namespace app\server\controller;

use app\index\controller\Cron;
use think\worker\Server;

class Worker extends Server
{
    protected $processes = 1;

    public function onWorkerStart($work)
    {
        $handle = new Cron();
        $handle->add_timer();
    }
}