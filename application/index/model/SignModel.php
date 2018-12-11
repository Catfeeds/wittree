<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 11:53
 */

namespace app\index\model;


use think\Model;

class SignModel extends Model
{
    // 确定链接表名
    protected $name = 'sign';
    protected $autoWriteTimestamp = true;
}