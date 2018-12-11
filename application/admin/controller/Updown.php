<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/19
 * Time: 10:40
 */

namespace app\admin\controller;

use app\admin\model\CourseModel;
use app\admin\model\CustomerModel;
use app\admin\model\OrderModel;

/**
 * 用户上下分管理
 * Class Updown
 * @package app\admin\controller
 */
class Updown extends Base
{
    //上分(购买课程)
//    public function uppoint()
//    {
//        $course = new CourseModel();
//        $order = new OrderModel();
//        if ($this->request->isPost()) {
//            $data = input('post.');
//            $result = $order->isPayProject($data['course_id'], $data['uid']);
//            if ($result["code"] == -1) {
//                return json(msg($result['code'], $result['data'], $result['msg']));
//            }
//            $flag = $order->addOrder($data);
//            return json(msg($flag['code'], $flag['data'], $flag['msg']));
//        }
//        //获取所有的用户数据
//        $customer = new CustomerModel();
//        $userdata = $customer->getAllCustomerData();
//        $coursedata = $course->getAllCourseData();
//        return $this->fetch('', [
//            'userdata' => $userdata,
//            'coursedata' => $coursedata,
//        ]);
//    }

    //上分(购买课程)
    public function uppoint()
    {
        $customer = new CustomerModel();
        if ($this->request->isPost()) {
            $param = input('param.');
            if (empty($param['uid']) && empty($param['phone'])) {
                return json(-1, '', '用户或手机号不能为空！');
            }
            $map['id'] = $param['uid'];
            $map['phone'] = $param['phone'];
            $customerData = db('customer')->where($map)->find();
            if (empty($customerData)) {
                return json(msg(-1, '', '用户和手机号不一致'));
            }
            $operator_id = session('id');
            if ($param['type'] == 0) {
                $flag = $customer->uppoint($param['integral'], $param['uid'], $operator_id);
            } else {
                $flag = $customer->downpoint($param['integral'], $param['uid'], $operator_id);
            }
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        //获取所有的用户数据
        $userdata = $customer->getAllCustomerData();
        return $this->fetch('', [
            'userdata' => $userdata,
            'type' => config('uptype')
        ]);
    }

    //下分
    public function downpoint()
    {
        $customer = new CustomerModel();
        if ($this->request->isPost()) {
            $param = input('param.');
            $result = $customer->isCustomerIntegral($param['uid']);
            if ($result["code"] == -1) {
                return json(msg($result['code'], $result['data'], $result['msg']));
            }
            $operator_id = session('id');
            $flag = $customer->downpoint($param['integral'], $param['uid'], $operator_id);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        //获取所有的用户数据
        $userdata = $customer->getAllCustomerData();
        return $this->fetch('', [
            'userdata' => $userdata,
        ]);
    }


    /**
     * 用户购买课程列表
     */
    public function payprojectlist()
    {
        if (request()->isAjax()) {

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
//                $where['c.title'] = ['like', '%' . $param['searchText'] . '%'];
                $where['d.username'] = array('like', '%' . $param['searchText'] . '%');
            }
            $orderdetail = new OrderModel();
            $selectResult = $orderdetail->getOrderData($where, $offset, $limit);

            $paystatus = config('pay_status');

            foreach ($selectResult as $key => $vo) {
//                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['type'] = $paystatus[$vo['pay_status']];
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $selectResult[$key]['pay_time'] = date('Y-m-d H:i:s', $vo['pay_time']);
            }
            $return['total'] = $orderdetail->getAllOrder($where);  // 总数据
            $return['rows'] = $selectResult;
            return json($return);
        }

        return $this->fetch();
    }
}