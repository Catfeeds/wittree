<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\CustomerModel;
use app\admin\model\MessageModel;

class Message extends Base
{
    // 消息列表
    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (!empty($param['searchText'])) {
                $where['content'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $Message = new MessageModel();
            $selectResult = $Message->getMessageByWhere($where, $offset, $limit);
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }

            $return['total'] = $Message->getAllMessage($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加消息
    public function MessageAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            $Message = new MessageModel();
            $flag = $Message->addMessage($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $customer = new CustomerModel();
        $customer = $customer->getAllCustomerData();
        $this->assign([
            'customer' => $customer
        ]);
        return $this->fetch('Messageadd');
    }

    public function MessageEdit()
    {
        $Message = new MessageModel();
        $customer = new CustomerModel();
        if (request()->isPost()) {
            $param = input('post.');
            $flag = $Message->editMessage($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $customer = $customer->getAllCustomerData();
        $this->assign([
            'message' => $Message->getOneMessage($id),
            'customer' => $customer
        ]);
        return $this->fetch('Messageedit');
    }

    public function MessageDel()
    {
        $id = input('param.id');
        $Message = new MessageModel();
        $flag = $Message->delMessage($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传缩略图
    public function uploadImg()
    {
        if (request()->isAjax()) {

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/Message');
            if ($info) {
                $src = '/upload/Message' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            } else {
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
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
                'auth' => 'message/messageedit',
                'href' => url('message/messageedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'message/messagedel',
                'href' => "javascript:messageDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
