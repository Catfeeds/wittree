<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\model;

use think\Model;

class CustomerModel extends Model
{
    // 确定链接表名
    protected $name = 'customer';
    protected $autoWriteTimestamp = true;
    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 根据搜索条件获取用户列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getCustomersByWhere($where, $offset, $limit)
    {
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }

    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllCustomers($where)
    {
        return $this->where($where)->count();
    }

    /**
     * 获取用户积分明细数据
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getConsumerData($where, $offset, $limit)
    {
        $data = db('customer_log')->alias('a')
            ->field('a.*,b.id customer_id,b.username,c.id user_id,c.user_name')
            ->join(['wit_customer' => 'b'], 'a.uid=b.id', 'left')
            ->join(['wit_user' => 'c'], 'c.id=a.operator_id', 'left')
            ->limit($offset, $limit)
            ->order('a.id desc')
            ->where($where)
            ->select();
        return $data;
    }

    /**
     * 获取积分明细总数
     * @param $where
     * @return int|string
     */
    public function getAllConsumer($where)
    {
        $count = db('customer_log')->alias('a')
            ->field('a.*,b.id customer_id,b.username,c.id user_id,c.user_name')
            ->join(['wit_customer' => 'b'], 'a.uid=b.id', 'left')
            ->join(['wit_user' => 'c'], 'c.id=a.operator_id', 'left')
            ->order('a.id desc')
            ->where($where)
            ->count();
        return $count;
    }

    /**
     * 插入用户信息
     * @param $param
     */
    public function insertCustomer($param)
    {
        try {

            $result = $this->validate('CustomerValidate')->save($param);
            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Customer/index'), '添加用户成功');
            }
        } catch (PDOException $e) {

            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 编辑用户信息
     * @param $param
     */
    public function editCustomer($param)
    {
        try {

            $result = $this->validate('CustomerValidate')->save($param, ['id' => $param['id']]);

            if (false === $result) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Customer/index'), '编辑用户成功');
            }
        } catch (PDOException $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 获取所有的用户
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAllCustomerData()
    {
        return $this->field('id,username')->select();
    }

    /**
     * 删除用户
     * @param $id
     */
    public function delCustomer($id)
    {
        try {

            $this->where('id', $id)->delete();
            return msg(1, '', '删除用户成功');

        } catch (PDOException $e) {
            return msg(-1, '', $e->getMessage());
        }
    }

    /**
     * 根据用户名获取用户信息
     * @param $name
     */
    public function findCustomerByName($name)
    {
        return $this->where('Customer_name', $name)->find();
    }

    /**
     * 根据用户id获取用户信息
     * @param $id
     */
    public function getOneCustomer($id)
    {
        return $this->where('id', $id)->find();
    }

    /**
     * 上分
     * @param $integral 积分
     * @param $uid 用户id
     * @operator 操作人id
     * @return array
     * @throws \think\Exception
     */
    public function uppoint($integral, $uid, $operator_id)
    {
        try {
            $this->startTrans();
            $customterlog = new CustomerLogModel();
            $flag = $customterlog->addCustomerLog($uid, $integral, 4, $operator_id);
            $result = $this->where('id', $uid)->setInc('integral', $integral);
            if (false === $result || $flag === false) {
                $this->rollback();
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {
                $this->commit();
                return msg(1, url('updown/uppoint'), '用户上分成功');
            }
        } catch (PDOException $e) {
            $this->rollback();
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 下分
     * @param $integral 积分
     * @param $uid 用户id
     * @param $operator_id 操作人id
     * @return array
     * @throws \think\Exception
     */
    public function downpoint($integral, $uid, $operator_id)
    {
        try {
            $this->startTrans();
            $customterlog = new CustomerLogModel();
            $flag = $customterlog->addCustomerLog($uid, $integral, 5, $operator_id);
            $result = $this->where('id', $uid)->setDec('integral', $integral);
            if (false === $result || $flag === false) {
                $this->rollback();
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {
                $this->commit();
                return msg(1, url('updown/uppoint'), '用户下分成功');
            }
        } catch (PDOException $e) {
            $this->rollback();
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * @param $type 0-签到积分1-消费积分2-复利3-抽奖4-后台上分5-后台下分6-注册
     */
    public function getIntegralWeekData($type)
    {
        $customterlog = new CustomerLogModel();
        $data = $customterlog->whereTime('create_time', 'week')->where('type', $type)->select();
        return $data;
    }

    public function getIntegralSevenData($where)
    {
        $customterlog = new CustomerLogModel();
        $data = $customterlog->where($where)->sum('integral');
        return $data;
    }

    public function getRecommendWeekData()
    {
        return $this->field('id,create_time')->whereTime('create_time', 'week')->where('fid', 'neq', '0')->select();
    }

    /**
     * 查询用户的积分
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function isCustomerIntegral($uid)
    {
        $res = $this->field('id,integral,username')->find($uid);
        if ($res['integral'] == 0) {
            return msg(-1, '', $res['username'] . '积分已为0，不能再下分');
        }
    }

    /**
     * 更新用户状态
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
}
