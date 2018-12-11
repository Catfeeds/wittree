<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 14:21
 */

namespace app\index\model;


use think\Model;

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
     * @param $type 0-签到积分1-消费积分2-复利3-抽奖4-后台上分5-后台下分6-注册
     */
    public function getIntegralWeekDataByUid($where)
    {
        $map['type'] = $where['type'];
        $map['uid'] = $where['uid'];
        $customterlog = new CustomerLogModel();
        $data = $customterlog->whereTime('create_time', 'last week')->where($where)->select();
        return $data;
    }

    /**
     * 添加复利记录
     * @param $data
     * @param $type
     * @param $operator_id
     */
    public function addCustomerLog($data)
    {
        $flag = $this->save($data);
        return $flag ? true : false;
    }
}