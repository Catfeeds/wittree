<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 16:29
 */

namespace app\admin\model;

use Think\Model;

class CustomerLogModel extends Model
{
    // 确定链接表名
    protected $name = 'customer_log';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 添加后台操作用户上下分记录
     * @param $data
     * @param $type
     * @param $operator_id
     */
    public function addCustomerLog($uid, $integral, $type, $operator_id)
    {
        $param['uid'] = $uid;
        $param['integral'] = $integral;
        $param['type'] = $type;
        $param['operator_id'] = $operator_id;
        $flag = $this->save($param);
        return $flag ? true : false;
    }

    /**
     * @param $type 0-签到积分1-消费积分2-复利3-抽奖4-后台上分5-后台下分
     */
    public function getCompoundWeekData($type)
    {
        return $this->whereTime('create_time', 'w')->where('type', $type)->select();
    }

    /**
     * 获取用户某个类别总积分
     * @param $where
     * @return int|string
     */
    public function getCountByCustomerId($where){
        return $this->where($where)->count('integral');
    }
}