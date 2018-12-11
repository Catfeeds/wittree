<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 15:32
 */

namespace app\index\model;


use think\Model;

class CustomerAddressModel extends Model
{
    // 确定链接表名
    protected $name = 'address';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 获取前端用户地址列表
     * @param $uid
     * @return int|string
     */
    public function getAllCutomerAddressByUid($uid)
    {
        return $this->alias('a')
            ->field('a.*,b.id user_id,username')
            ->join(['wit_customer' => 'b'], 'a.uid=b.id', 'left')
            ->where(['uid' => $uid])
            ->order("a.id", 'desc')
            ->select();
    }

    /**
     * 插入用户地址信息
     * @param $param
     */
    public function insertCustomeraddress($param)
    {
        try {
            $result = $this->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            } else {
                return ['code' => 0, 'data' => '', 'msg' => '编辑用户地址成功'];
            }
        } catch (PDOException $e) {
            return ['code' => -1, 'data' => '', 'msg' => '编辑用户地址成功'];
        }
    }

    /**
     * 编辑用户地址信息
     * @param $param
     */
    public function editCustomeraddress($param)
    {
        try {

            $result = $this->save($param, ['id' => $param['id']]);

            if (false === $result) {
                // 验证失败 输出错误信息
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            } else {
                return ['code' => 0, 'data' => '', 'msg' => '编辑用户地址成功'];
            }
        } catch (PDOException $e) {
            return ['code' => -1, 'data' => '', 'msg' => '编辑用户地址成功'];
        }
    }

    /**
     * 删除用户地址
     * @param $id
     */
    public function delCustomeraddress($id)
    {
        try {
            $this->where('id', $id)->delete();
            return msg(1, '', '删除用户地址成功');
        } catch (PDOException $e) {
            return msg(-1, '', $e->getMessage());
        }
    }

    /**
     * 客户端删除地址
     */
    public function delCustomeraddressByUid($where)
    {
        try {
            $this->where($where)->delete();
            return msg(1, '', '删除用户地址成功');
        } catch (PDOException $e) {
            return msg(-1, '', $e->getMessage());
        }
    }

}