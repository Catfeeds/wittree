<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\controller;

use app\admin\model\TurnModel;

class Turn extends Base
{
    // 轮播图列表
    public function index()
    {
        if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            $Turn = new TurnModel();
            $selectResult = $Turn->getTurnByWhere($where, $offset, $limit);
            $type = config('turn_type');
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['url'] = '<img src="' . $vo['url'] . '" width="40px" height="40px">';
                $selectResult[$key]['type'] = $type[$vo['type']];
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }

            $return['total'] = $Turn->getAllTurn($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加轮播图
    public function TurnAdd()
    {
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $Turn = new TurnModel();
            $flag = $Turn->addTurn($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $type = config('turn_type');
        return $this->fetch('Turnadd',[
            'type' => $type,
        ]);
    }

    public function TurnEdit()
    {
        $Turn = new TurnModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $flag = $Turn->editTurn($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $Turn = $Turn->getOneTurn($id);
        $type = config('turn_type');
        $this->assign([
            'turn' => $Turn,
            'type' => $type,
        ]);
        return $this->fetch('Turnedit');
    }

    public function TurnDel()
    {
        $id = input('param.id');

        $Turn = new TurnModel();
        $flag = $Turn->delTurn($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传缩略图
    public function uploadImg()
    {
        if(request()->isAjax()){

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/Turn');
            if($info){
                $src =  '/upload/Turn' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
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
                'auth' => 'turn/turnedit',
                'href' => url('Turn/turnedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'turn/turndel',
                'href' => "javascript:turnDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
