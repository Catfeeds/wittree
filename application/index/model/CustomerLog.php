<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 14:21
 */

namespace app\index\model;


use think\Model;

class CustomerLog extends Model
{
    // 确定链接表名
    protected $name = 'customer_log';
    protected $autoWriteTimestamp = true;
}