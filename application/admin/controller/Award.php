<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\controller;

use app\admin\model\AwardModel;

class Award extends Base
{
    // 推荐人奖励列表
    public function index()
    {
        if(request()->isAjax()){

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['title'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $Award = new AwardModel();
            $selectResult = $Award->getAwardByWhere($where, $offset, $limit);

            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['url'] = '<img src="' . $vo['url'] . '" width="40px" height="40px">';
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }

            $return['total'] = $Award->getAllAward($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加推荐人奖励
    public function AwardAdd()
    {
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $Award = new AwardModel();
            $flag = $Award->addAward($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        return $this->fetch('awardadd');
    }

    public function AwardEdit()
    {
        $Award = new AwardModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $flag = $Award->editAward($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $award = $Award->getOneAward($id);
        $this->assign([
            'award' => $award
        ]);
        return $this->fetch('awardedit');
    }

    public function AwardDel()
    {
        $id = input('param.id');

        $Award = new AwardModel();
        $flag = $Award->delAward($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传缩略图
    public function uploadImg()
    {
        if(request()->isAjax()){

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/Award');
            if($info){
                $src =  '/upload/Award' . '/' . date('Ymd') . '/' . $info->getFilename();
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
                'auth' => 'award/awardedit',
                'href' => url('Award/Awardedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'award/awarddel',
                'href' => "javascript:AwardDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
