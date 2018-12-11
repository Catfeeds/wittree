<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\LottoModel;

class Lotto extends Base
{
    // 积分设置列表
    public function index()
    {
        if (request()->isAjax()) {

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];

            $Lotto = new LottoModel();
            $selectResult = $Lotto->getLottoByWhere($where, $offset, $limit);
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }


            $return['total'] = $Lotto->getAllLotto($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    /**
     * 抽奖次数设置
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function setting()
    {
        if ($this->request->isPost()) {
            $param = input('param.');
            $res = db('draw')->where(['id'=>$param['id']])->update(['se_num'=>$param['se_num']]);
            if ($res) {
                return msg(1, url('Lotto/setting'), '设置成功！');
            } else {
                return msg(-1, '', '设置失败！');
            }
        }
        $data = db('draw')->find();
        return $this->fetch('',[
            'data' => $data
        ]);
    }

    // 添加积分设置
    public function LottoAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            $Lotto = new LottoModel();
            $flag = $Lotto->addLotto($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        return $this->fetch('lottoadd');
    }

    public function LottoEdit()
    {
        $Lotto = new LottoModel();
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $flag = $Lotto->editLotto($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $this->assign([
            'lotto' => $Lotto->getOneLotto($id)
        ]);
        return $this->fetch('lottoedit');
    }

    public function LottoDel()
    {
        $id = input('param.id');
        $Lotto = new LottoModel();
        $flag = $Lotto->delLotto($id);
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
                'auth' => 'lotto/lottoedit',
                'href' => url('lotto/lottoedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'lotto/lottodel',
                'href' => "javascript:lottoDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
