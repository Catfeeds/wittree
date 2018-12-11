<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\CustomerLogModel;
use app\admin\model\CustomerModel;
use app\admin\model\LessonModel;
use app\admin\model\OrderLearn;
use app\admin\model\OrderModel;
use app\admin\model\RoleModel;


/**
 * 用户管理控制器
 * Class CustomerModel
 * @package app\admin\controller
 */
class Customer extends Base
{
    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['username'] = ['like', '%' . $param['searchText'] . '%'];
            }
            if (!empty($param['searchPhone'])) {
                $where['phone'] = $param['searchPhone'];
            }
            $Customer = new CustomerModel();
            $customerlog = new CustomerLogModel();
            $selectResult = $Customer->getCustomersByWhere($where, $offset, $limit);
            $status = config('Customer_status');
            $sex = config('Customer_sex');
            $real_auth = config('real_auth');
            // 拼装参数
            foreach ($selectResult as $key => $vo) {
                if ($selectResult[$key]["face"] == "") {
                    $selectResult[$key]['face'] = '<img src="/static/index/images/face.jpg" width="40px" height="40px">';
                } else {
                    $selectResult[$key]['face'] = '<img src="' . $vo['face'] . '" width="40px" height="40px">';
                }
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $selectResult[$key]['status'] = $status[$vo['status']];
                $selectResult[$key]['sex'] = $sex[$vo['sex']];
                $selectResult[$key]['is_auth'] = $real_auth[$vo['is_auth']];
                if (empty($selectResult[$key]['fid'])) {
                    $selectResult[$key]['recomand_name'] = "无";
                } else {
                    $cdata = $Customer->getOneCustomer($selectResult[$key]['fid']);
                    $selectResult[$key]['recomand_name'] = $cdata['username'];
                }
                $map['type'] = 7;
                $map['uid'] = $selectResult[$key]['id'];
                $selectResult[$key]['re_integral'] = $customerlog->getCountByCustomerId($map);
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }
            $return['total'] = $Customer->getAllCustomers($where);  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    public function authindex()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['real_name'] = ['like', '%' . $param['searchText'] . '%'];
            }
            if (!empty($param['searchPhone'])) {
                $where['phone'] = $param['searchPhone'];
            }
            $where['is_auth'] = 2;//提交申请用户
            $Customer = new CustomerModel();
            $selectResult = $Customer->getCustomersByWhere($where, $offset, $limit);
            $status = config('Customer_status');
            $sex = config('Customer_sex');
            $real_auth = config('real_auth');
            // 拼装参数
            foreach ($selectResult as $key => $vo) {
                if ($selectResult[$key]["face"] == "") {
                    $selectResult[$key]['face'] = '<img src="/static/index/images/face.jpg" width="40px" height="40px">';
                } else {
                    $selectResult[$key]['face'] = '<img src="' . $vo['face'] . '" width="40px" height="40px">';
                }
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $selectResult[$key]['is_auth'] = $real_auth[$vo['is_auth']];
                $selectResult[$key]['sex'] = $sex[$vo['sex']];
                $selectResult[$key]['operate'] = showOperate($this->makeAuthButton($vo['id']));
            }
            $return['total'] = $Customer->getAllCustomers($where);  //总数据
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加用户
    public function customerAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            if (empty($param)) {
                $param['face'] = '/static/admin/images/profile_small.jpg'; // 默认头像
            }
            $param['password'] = md5('000000' . config('salt'));
            $param['code'] = GetRandStr(5);
            if (!CheckIsIDCard($param['id_number'])) {
                return json(msg(-1, '', '身份证号码错误'));
            }
            $user = new CustomerModel();
            $res = $user->where('id_number',$param['id_number'])->find();
            if (!empty($res)) {
                return json(msg(-1, '', '身份证号码已存在！'));
            }
            $flag = $user->insertCustomer($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $role = new RoleModel();
        $this->assign([
            'status' => config('Customer_status'),
            'sex' => config('Customer_sex'),
            'role' => $role->getRole(),
        ]);
        return $this->fetch('customeradd');
    }

    //审核实名认证
    public function authsave()
    {
        $user = new CustomerModel();

        if (request()->isPost()) {
            $param = input('post.');
            $flag = $user->save($param, ['id' => $param['id']]);
            if ($flag) {
                return json(msg(1, url('customer/index'), '审核成功'));
            } else {
                return json(msg(1, '', '审核失败'));
            }
        }
        $id = input('param.id');
        $this->assign([
            'customer' => $user->getOneCustomer($id),
            'is_auth' => config('real_auth'),
        ]);
        return $this->fetch('authsave');
    }

    // 编辑用户
    public function customerEdit()
    {
        $user = new CustomerModel();

        if (request()->isPost()) {

            $param = input('post.');
            unset($param['file']);
            if (!CheckIsIDCard($param['id_number'])) {
                return json(msg(-1, '', '身份证号码错误'));
            }
            $flag = $user->editCustomer($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $role = new RoleModel();
        $this->assign([
            'customer' => $user->getOneCustomer($id),
            'status' => config('Customer_status'),
            'sex' => config('Customer_sex'),
            'role' => $role->getRole(),
        ]);
        return $this->fetch('customeredit');
    }

    //查看
    public function findcustomer()
    {
        $user = new CustomerModel();
        $customerlog = new CustomerLogModel();
        $order = new OrderModel();
        $id = input('param.id');
        $customer = $user->getOneCustomer($id);
        if (empty($customer['fid'])) {
            $customer['recomand_name'] = "无";
        } else {
            $cdata = $user->getOneCustomer($customer['fid']);
            $customer['recomand_name'] = $cdata['username'];
        }
        $map['type'] = 7;
        $map['uid'] = $customer['id'];
        $customer['re_integral'] = $customerlog->getCountByCustomerId($map);
        $w['type'] = 2;
        $w['uid'] = $customer['id'];
        $customer['co_integral'] = $customerlog->getCountByCustomerId($w);
        $w1['uid'] = $customer['id'];
        $customer['total_integral'] = $customerlog->getCountByCustomerId($w1);
        $w2['fid'] = $customer['id'];
        $customer['recomand_count'] = $user->where($w2)->count('id');
        $coursedata = $order->getOrderByCustomerId($customer['id']);
        $customer['pay_course'] = implode('-', $coursedata);
        $this->assign([
            'customer' => $customer,
            'status' => config('Customer_status'),
            'sex' => config('Customer_sex'),
        ]);
        return $this->fetch();
    }

    // 删除用户
    public function customerDel()
    {
        $id = input('param.id');
        $role = new CustomerModel();
        $flag = $role->delCustomer($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传用户头像
    public function uploadImg()
    {
        if (request()->isAjax()) {

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/face');
            if ($info) {
                $src = '/upload/face' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            } else {
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    //进度
    public function findcourse()
    {
        $param = input('param.');
        $order = new OrderModel();
        $lesson = new LessonModel();
        $lessonlearn = new OrderLearn();
        $orderdata = $order->getOrderDataByCustomerId($param['id']);
        $course_status = config('course_status');
        foreach ($orderdata as $key => $vo) {
            $orderdata[$key]['status'] = $course_status[$vo['status']];
            $finishcount = $lessonlearn->getFinisnLesson($vo);
            $lessoncount = $lesson->getLessonCountByCourseId($vo['course_id']);
            if ($orderdata[$key]['status'] == 0) {
                $orderdata[$key]['status'] = $finishcount . "/" . $lessoncount;
            }

            if ($finishcount == $lessoncount && $lessoncount != 0 && $finishcount != 0) {
                $orderdata[$key]['status'] = "已完结";
            }

            if ($orderdata[$key]['over_time'] == 0) {
                $orderdata[$key]['over_time'] = "";
            } else {
                $orderdata[$key]['over_time'] = date("Y-m-d H:i:s");
            }
        }
        return $this->fetch('', [
            'orderdata' => $orderdata,
        ]);
    }

    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '查看' => [
                'auth' => 'customer/findcustomer',
                'href' => url('customer/findcustomer', ['id' => $id]),
                'btnStyle' => 'info',
                'icon' => 'fa fa-paste'
            ],
            '进度' => [
                'auth' => 'customer/findcourse',
                'href' => url('customer/findcourse', ['id' => $id]),
                'btnStyle' => 'info',
                'icon' => 'fa fa-paste'
            ],
            '编辑' => [
                'auth' => 'customer/customeredit',
                'href' => url('customer/customerEdit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'customer/customerdel',
                'href' => "javascript:customerDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ],
        ];
    }

    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeAuthButton($id)
    {
        return [
            '审核' => [
                'auth' => 'customer/authsave',
                'href' => url('customer/authsave', ['id' => $id]),
                'btnStyle' => 'info',
                'icon' => 'fa fa-paste'
            ],
        ];
    }
}