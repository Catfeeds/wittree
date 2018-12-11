<?php
/**
 * Created by PhpStorm.
 * Customeraddress: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\CustomeraddressModel;
use app\admin\model\CustomerModel;

/**
 * 用户地址管理控制器
 * Class Customeraddress
 * @package app\admin\controller
 */
class Customeraddress extends Base
{
    public function index()
    {
        if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['b.username'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $Customeraddress = new CustomeraddressModel();
            $selectResult = $Customeraddress->getCustomeraddresssByWhere($where, $offset, $limit);

            $sex = config('Customer_sex');

            // 拼装参数
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }

            $return['total'] = $Customeraddress->getAllCustomeraddresss($where);  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加用户地址
    public function CustomeraddressAdd()
    {
        if(request()->isPost()){
            $param = input('post.');
            if (empty($param)) {
                $param['face'] = '/static/admin/images/profile_small.jpg'; // 默认头像
            }
            $param['password'] = md5('000000' . config('salt'));
            $user = new CustomeraddressModel();
            $flag = $user->insertCustomeraddress($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $customer = new CustomerModel();
        $userdata = $customer->getAllCustomerData();
        $this->assign([
            'sex' => config('Customer_sex'),
            'userdata' => $userdata
        ]);
        return $this->fetch('customeraddressadd');
    }


    // 编辑用户地址
    public function CustomeraddressEdit()
    {
        $user = new CustomeraddressModel();

        if(request()->isPost()){
            $param = input('post.');
            $flag = $user->editCustomeraddress($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $customer = new CustomerModel();
        $userdata = $customer->getAllCustomerData();
        $this->assign([
            'customeraddress' => $user->getOneCustomeraddress($id),
            'sex' => config('Customer_sex'),
            'userdata' => $userdata
        ]);
        return $this->fetch('customeraddressedit');
    }

    // 删除用户地址
    public function CustomeraddressDel()
    {
        $id = input('param.id');
        $role = new CustomeraddressModel();
        $flag = $role->delCustomeraddress($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }


    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '编辑' => [
                'auth' => 'customeraddress/customeraddressedit',
                'href' => url('Customeraddress/CustomeraddressEdit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'customeraddress/customeraddressdel',
                'href' => "javascript:CustomeraddressDel(" .$id .")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}