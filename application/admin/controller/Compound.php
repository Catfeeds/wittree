<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\CustomerModel;
use app\admin\model\CompoundModel;

/**
 * 复利设置管理控制器
 * Class CustomerModel
 * @package app\admin\controller
 */
class Compound extends Base
{
    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            $integral = new CompoundModel();
            $selectResult = $integral->getCompoundsByWhere($where, $offset, $limit);
            // 拼装参数
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }
            $return['total'] = $integral->getAllCompounds($where);  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加签到配置
    public function CompoundAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            $integral = new CompoundModel();
            $flag = $integral->insertCompound($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        return $this->fetch('compoundadd');
    }

    // 编辑签到配置
    public function CompoundEdit()
    {
        $integral = new CompoundModel();

        if (request()->isPost()) {

            $param = input('post.');
            $flag = $integral->editCompound($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'compound' => $integral->getOneCompound($id),
        ]);
        return $this->fetch('compoundedit');
    }

    // 删除签到配置
    public function CompoundDel()
    {
        $id = input('param.id');
        $integral = new CompoundModel();
        $flag = $integral->delCompound($id);
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
                'auth' => 'compound/compoundedit',
                'href' => url('Compound/Compoundedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'compound/compounddel',
                'href' => "javascript:CompoundDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}