<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\ConsumerdetailModel;
use app\admin\model\CustomerModel;
use app\admin\model\UserModel;

class Consumerdetail extends Base
{
    // 消费明细列表
    public function index()
    {
        if (request()->isAjax()) {

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['b.username'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $Consumerdetail = new CustomerModel();
            $selectResult = $Consumerdetail->getConsumerData($where, $offset, $limit);
            $typeconfig = config('integral_type');
            foreach ($selectResult as $key => $vo) {
                if ($vo['type'] == 1) {
                    $selectResult[$key]['type'] = $vo['desc'];
                } else {
                    $selectResult[$key]['type'] = $typeconfig[$vo['type']];
                }
                if (empty($vo['operator_id'])) {
                    $selectResult[$key]['user_name'] = '无';
                }
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }
            $return['total'] = $Consumerdetail->getAllConsumer($where);  // 总数据
            $return['rows'] = $selectResult;
            return json($return);
        }
        return $this->fetch();
    }

    // 添加消费明细
    public function ConsumerdetailAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $Consumerdetail = new ConsumerdetailModel();
            $flag = $Consumerdetail->addConsumerdetail($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        return $this->fetch('consumerdetailadd');
    }

    public function ConsumerdetailEdit()
    {
        $Consumerdetail = new ConsumerdetailModel();
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $flag = $Consumerdetail->editConsumerdetail($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $this->assign([
            'Consumerdetail' => $Consumerdetail->getOneConsumerdetail($id)
        ]);
        return $this->fetch('consumerdetailedit');
    }

    public function ConsumerdetailDel()
    {
        $id = input('param.id');

        $Consumerdetail = new ConsumerdetailModel();
        $flag = $Consumerdetail->delConsumerdetail($id);
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
                'auth' => 'consumerdetail/consumerdetailedit',
                'href' => url('Consumerdetail/Consumerdetailedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'consumerdetail/consumerdetaildel',
                'href' => "javascript:ConsumerdetailDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
