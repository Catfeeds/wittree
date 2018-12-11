<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 11:41
 */

namespace app\index\model;


use think\Model;

class CustomerModel extends Model
{
    // 确定链接表名
    protected $name = 'customer';
    protected $autoWriteTimestamp = true;
}