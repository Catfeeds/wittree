<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\CustomerModel;
use app\admin\model\IntegralConfigModel;

/**
 * 签到设置管理控制器
 * Class CustomerModel
 * @package app\admin\controller
 */
class Integralconfig extends Base
{
    public function index()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            $integral = new IntegralConfigModel();
            $selectResult = $integral->getIntegralConfigsByWhere($where, $offset, $limit);
            // 拼装参数
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
            }
            $return['total'] = $integral->getAllIntegralConfigs($where);  //总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加签到配置
    public function integralconfigAdd()
    {
        if (request()->isPost()) {

            $param = input('post.');
            $integral = new IntegralConfigModel();
            $flag = $integral->insertIntegralConfig($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        return $this->fetch('integralconfigadd');
    }

    // 编辑签到配置
    public function integralconfigEdit()
    {
        $integral = new IntegralConfigModel();

        if (request()->isPost()) {

            $param = input('post.');
            $flag = $integral->editIntegralConfig($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $id = input('param.id');
        $this->assign([
            'integralconfig' => $integral->getOneIntegralConfig($id),
        ]);
        return $this->fetch('integralconfigedit');
    }

    // 删除签到配置
    public function integralconfigDel()
    {
        $id = input('param.id');
        $integral = new IntegralConfigModel();
        $flag = $integral->delIntegralConfig($id);
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
                'auth' => 'integralconfig/integralconfigedit',
                'href' => url('integralconfig/integralconfigedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'integralconfig/integralconfigdel',
                'href' => "javascript:integralconfigDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}