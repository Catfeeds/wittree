<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 14:16
 */

namespace app\index\model;


use think\Model;

class OrderModel extends Model
{
// 确定链接表名
    protected $name = 'order';
    protected $autoWriteTimestamp = true;

    /**
     * 查询所有用户的购买课程
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getOrderData()
    {
        return $this->alias('a')
            ->field('a.*,b.id course_id,b.title,b.thumb,c.id as customer_id,c.username,c.integral,d.id order_id,d.uid,d.total_price')
            ->join(['wit_course' => 'b'], 'b.id=a.course_id', 'left')
            ->join(['wit_customer' => 'c'], 'c.id=a.uid', 'left')
            ->join(['wit_order' => 'd'], 'd.uid=c.id', 'left')
            ->order('a.id desc')
            ->select();
    }
}