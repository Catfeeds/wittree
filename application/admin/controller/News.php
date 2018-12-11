<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\controller;

use app\admin\model\NewsModel;

class News extends Base
{
    // 活动新闻列表
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
            $news = new NewsModel();
            $selectResult = $news->getNewsByWhere($where, $offset, $limit);
            foreach($selectResult as $key=>$vo){
                $selectResult[$key]['url'] = '<img src="' . $vo['url'] . '" width="40px" height="40px">';
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }

            $return['total'] = $news->getAllnews($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加活动新闻
    public function newsAdd()
    {
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $news = new newsModel();
            $flag = $news->addnews($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        return $this->fetch('newsadd');
    }

    public function newsEdit()
    {
        $news = new newsModel();
        if(request()->isPost()){
            $param = input('post.');
            unset($param['file']);
            $flag = $news->editnews($param);

            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $this->assign([
            'news' => $news->getOnenews($id)
        ]);
        return $this->fetch('newsedit');
    }

    public function newsDel()
    {
        $id = input('param.id');

        $news = new newsModel();
        $flag = $news->delnews($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    // 上传缩略图
    public function uploadImg()
    {
        if(request()->isAjax()){

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/news');
            if($info){
                $src =  '/upload/news' . '/' . date('Ymd') . '/' . $info->getFilename();
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
                'auth' => 'news/newsedit',
                'href' => url('news/newsedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'news/newsdel',
                'href' => "javascript:newsDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
