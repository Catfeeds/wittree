<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 13:52
 */

namespace app\index\model;

use think\Model;

class MessageModel extends Model
{
    // 确定链接表名
    protected $name = 'message';
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
    public function getAllMessage($where)
    {
        return $this->where("uid = {$where['uid']} OR uid = 0")->select();
    }
}