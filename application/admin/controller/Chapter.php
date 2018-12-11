<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\ChapterModel;
use app\admin\model\CourseModel;

class Chapter extends Base
{
    // 课程章节列表
    public function index()
    {
        if (request()->isAjax()) {

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];

            $Chapter = new ChapterModel();
            $selectResult = $Chapter->getChapterByWhere($where, $offset, $limit);
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }


            $return['total'] = $Chapter->getAllChapter($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加课程章节
    public function ChapterAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            $Chapter = new ChapterModel();
            $flag = $Chapter->addChapter($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $courseModel = new CourseModel();
        $course_data = $courseModel->getAllCourseData();
        return $this->fetch('chapteradd',[
            'course_data' => $course_data
        ]);
    }

    public function ChapterEdit()
    {
        $Chapter = new ChapterModel();
        if (request()->isPost()) {
            $param = input('post.');
            $flag = $Chapter->editChapter($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $courseModel = new CourseModel();
        $course_data = $courseModel->getAllCourseData();
        $this->assign([
            'chapter' => $Chapter->getOneChapter($id),
            'course_data' => $course_data
        ]);
        return $this->fetch('chapteredit');
    }

    public function ChapterDel()
    {
        $id = input('param.id');
        $Chapter = new ChapterModel();
        $flag = $Chapter->delChapter($id);
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
                'auth' => 'chapter/chapteredit',
                'href' => url('Chapter/Chapteredit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'chapter/chapterdel',
                'href' => "javascript:chapterDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
