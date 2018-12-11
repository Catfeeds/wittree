<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 13:52
 */

namespace app\index\model;

use think\Model;

class CustomerMessageModel extends Model
{
    // 确定链接表名
    protected $name = 'customer_message';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 查询用户信息
     * @param $where
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
//    public function getAllMessage($where)
//    {
//        return $this->alias('a')
//            ->field('a.uid user_id,a.id,a.message_id,a.create_time,b.id message_id,b.content,c.uid,c.mess_id,IFNULL(c.is_read,0) is_read')
//            ->join(['wit_message'=>'b'],'a.message_id=b.id','left')
//            ->join(['wit_message_read'=>'c'],'c.uid=a.message_id','left')
//            ->where("a.uid = {$where['uid']} OR a.uid = 0")
//            ->select();
//    }

    public function getAllMessage($where)
    {
        return $this->alias('a')
            ->field('a.uid,a.id,a.message_id,a.create_time,b.id message_id,b.content,c.id customer_id')
            ->join(['wit_message'=>'b'],'a.message_id=b.id','left')
            ->join(['wit_customer'=>'c'],'c.id=a.uid','left')
            ->where("a.uid = {$where['uid']} OR a.uid = 0")
            ->select();
    }
}