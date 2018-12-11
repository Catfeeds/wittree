<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 10:43
 */

namespace app\admin\model;


use think\Model;

class OrderModel extends Model
{
    // 确定链接表名
    protected $name = 'order';
    protected $autoWriteTimestamp = true;

    protected $auto = ['create_time'];

    //返回原有数据  不自动进行时间转换
    public function getCreateTimeAttr($time)
    {
        return $time;
    }

    /**
     * 上分（购买课程）
     * @param $param
     */
    public function addOrder($param)
    {
        try {
            $coursedata = db('course')->field('price')->find($param['course_id']);
            $param['order_number'] = createOrderNumber();
            $param['total_price'] = $coursedata['price'];
            $param['pay_time'] = time();
            $paystatus = array_search('已支付', config('pay_status'));
            $param['pay_status'] = config('pay_status');
            $result = $this->validate('OrderValidate')->save($param);
            $id = $this->getLastInsID();
            $data['course_id'] = $param['course_id'];
            $data['uid'] = $param['uid'];
            $data['price'] = $coursedata['price'];
            $data['order_id'] = $id;
            $res = db('order_course')->insert($data);
            if (false === $result && $res === 0) {
                // 验证失败 输出错误信息
                return msg(-1, '', $this->getError());
            } else {

                return msg(1, url('Updown/uppoint'), '上分(购买课程)成功');
            }
        } catch (\Exception $e) {
            return msg(-2, '', $e->getMessage());
        }
    }

    /**
     * 判断是否已购买课程
     * @param $projectid
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function isPayProject($projectid, $uid)
    {
        $paystatus = array_search('已支付', config('pay_status'));
        $where = [
            'course_id' => $projectid,
            'uid' => $uid,
        ];
        $result = db('order_course')->where($where)->find();
        $usermodel = new CustomerModel();
        $coursemodel = new CourseModel();
        $userdata = $usermodel->field('id,username')->find($uid);
        $coursedata = $coursemodel->field('id,title')->find($projectid);
        if (!empty($result)) {
            return msg(-1, '', $userdata['username'] . '已购买过' . $coursedata['title'] . '教程');
        }
    }

    /**
     * 根据用户id查询课程进度
     * @param $customer_id
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getOrderDataByCustomerId($customer_id)
    {
        $data = $this->alias('a')
            ->field('a.*,b.id course_id,b.title,b.thumb,b.desc,c.id as customer_id,c.username')
            ->join(['wit_course' => 'b'], 'b.id=a.course_id', 'left')
            ->join(['wit_customer' => 'c'], 'c.id=a.uid', 'left')
            ->where(['a.uid' => $customer_id])
            ->order('a.id desc')
            ->select();
        return $data;
    }

    /**
     * 购买课程查询
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getOrderData($where, $offset, $limit)
    {
        return $this->alias('a')
            ->field('a.*,b.id course_id,b.title,b.thumb,c.id as customer_id,c.username')
            ->join(['wit_course' => 'b'], 'b.id=a.course_id', 'left')
            ->join(['wit_customer' => 'c'], 'c.id=a.uid', 'left')
            ->where($where)
            ->limit($offset, $limit)
            ->order('a.id desc')
            ->select();
    }

    /**
     * 根据搜索条件获取所有的购买课程
     * @param $where
     */
    public function getAllOrder($where)
    {
        return $this->alias('a')
            ->field('a.*,b.id course_id,b.title,b.thumb,c.id as customer_id,c.username')
            ->join(['wit_course' => 'b'], 'b.id=a.course_id', 'left')
            ->join(['wit_customer' => 'c'], 'c.id=a.uid', 'left')
            ->where($where)
            ->order('a.id desc')
            ->count();
    }

    /**
     * 根据客户id获取用户所有的已购买课程
     */
    public function getOrderByCustomerId($customer_id)
    {
        $where['a.uid'] = $customer_id;
        $where['a.pay_status'] = 1;
        return $this->alias('a')
            ->field('a.id,a.course_id,a.pay_status,b.id course_id,b.title')
            ->join(['wit_course' => 'b'], 'a.course_id=b.id', 'left')
            ->where($where)
            ->column('b.title', 'a.id');
    }
}