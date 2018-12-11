<?php
/**
 * Created by PhpStorm.
 * Customeraddress: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\model;

use think\Model;

class CustomeraddressModel extends Model
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
     * 根据搜索条件获取用户地址列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getCustomeraddresssByWhere($where, $offset, $limit)
    {
        return $this->alias('a')
            ->field('a.*,b.id uid,username')
            ->join(['wit_customer' => 'b'], 'a.uid=b.id', 'left')
            ->where($where)
            ->limit($offset, $limit)
            ->order('id desc')
            ->select();
    }

    /**
     * 根据搜索条件获取所有的用户地址数量
     * @param $where
     */
    public function getAllCustomeraddresss($where)
    {
        return $this->alias('a')
            ->field('a.*,b.id user_id,username')
            ->join(['wit_customer' => 'b'], 'a.uid=b.id', 'left')
            ->where($where)
            ->count();
    }

    /**
     * 插入用户地址信息
     * @param $param
     */
    public function insertCustomeraddress($param)
    {
        try {

            $result = $this->validate('CustomeraddressValidate')->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Customeraddress/index'), '添加用户地址成功');
            }
        } catch (PDOException $e) {

            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑用户地址信息
     * @param $param
     */
    public function editCustomeraddress($param)
    {
        try {

            $result = $this->validate('CustomeraddressValidate')->save($param, ['id' => $param['id']]);

            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Customeraddress/index'), '编辑用户地址成功');
            }
        } catch (PDOException $e) {
            return msg(-2, '', $e->getMessage());
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

    /**
     * 根据用户地址id获取用户地址信息
     * @param $id
     */
    public function getOneCustomeraddress($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 更新用户地址状态
     * @param array $param
     */
    public function updateStatus($param = [], $uid)
    {
        try {

            $this->where('id', $uid)->update($param);
            return msg(1, '', 'ok');
        } catch (\Exception $e) {

            return msg(-1, '', $e->getMessage());
        }
    }

    //获取客户端我的地址列表
    public function getAllAddressByUid($uid)
    {
        $where['uid'] = $uid;
        return $this->field('id,uid,address,phone,doorplate,linkman')->where($where)->select();
    }

}
