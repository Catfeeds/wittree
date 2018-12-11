<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\CategoryModel;

class Category extends Base
{
    // 课程分类列表
    public function index()
    {
        if (request()->isAjax()) {

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];

            $Category = new CategoryModel();
            $selectResult = $Category->getCategoryByWhere($where, $offset, $limit);
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['url'] = '<img src="' . $vo['url'] . '" width="40px" height="40px">';
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }


            $return['total'] = $Category->getAllCategory($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 上传缩略图
    public function uploadImg()
    {
        if(request()->isAjax()){

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/category');
            if($info){
                $src =  '/upload/category' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            }else{
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    // 添加课程分类
    public function CategoryAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $Category = new CategoryModel();
            $flag = $Category->addCategory($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $division = config('division');
        return $this->fetch('categoryadd', [
            'division' => $division
        ]);
    }

    public function CategoryEdit()
    {
        $Category = new CategoryModel();
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $flag = $Category->editCategory($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $division = config('division');
        $this->assign([
            'category' => $Category->getOneCategory($id),
            'division' => $division
        ]);
        return $this->fetch('categoryedit');
    }

    public function CategoryDel()
    {
        $id = input('param.id');
        $Category = new CategoryModel();
        $flag = $Category->delCategory($id);
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
                'auth' => 'category/categoryedit',
                'href' => url('category/categoryedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'category/categorydel',
                'href' => "javascript:categoryDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
