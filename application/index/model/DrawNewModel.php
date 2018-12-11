<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 13:52
 */

namespace app\index\model;

use think\Model;

class DrawNewModel extends Model
{
    // 确定链接表名
    protected $name = 'draw_new';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }
}