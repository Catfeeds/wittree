<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23
 * Time: 15:42
 */

namespace app\admin\model;


use Think\Model;

class OrderLearn extends Model
{
    // 确定链接表名
    protected $name = 'order_learn';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    public function getFinisnLesson($where)
    {
        $map['uid'] = $where['uid'];
        $map['course_id'] = $where['course_id'];
        $count =  $this->where($map)
            ->count('lesson_id');
        return $count;
    }
}