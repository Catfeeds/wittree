<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 10:39
 */

namespace app\index\model;


use think\Model;

class LessonModel extends Model
{
    // 确定链接表名
    protected $name = 'lesson';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

}