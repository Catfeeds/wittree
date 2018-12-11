<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\controller;

use app\admin\model\CategoryModel;
use app\admin\model\ChapterModel;
use app\admin\model\CourseModel;
use app\admin\model\LessonModel;
class Lesson extends Base
{
    // 课时列表
    public function index()
    {
        if (request()->isAjax()) {

            $param = input('param.');

            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['a.title'] = ['like', '%' . $param['searchText'] . '%'];
            }
            $Lesson = new LessonModel();
            $selectResult = $Lesson->getLessonByWhere($where, $offset, $limit);

            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['url'] = '<img src="' . $vo['url'] . '" width="40px" height="40px">';
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }

            $return['total'] = $Lesson->getAllLesson($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    public function LessonEdit()
    {
        $Lesson = new LessonModel();
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $flag = $Lesson->editLesson($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $lesson_model = new LessonModel();
        $course_model = new CourseModel();
        $chapterModel = new ChapterModel();
        $lessondata = $Lesson->getOneLesson($id);
        $coursedata = $course_model->field('id,title')->find($lessondata['course_id']);
        $chapterdata = $chapterModel->where('course_id', $coursedata['id'])->field('id,course_id,title')->select();
        $this->assign([
            'lessondata' => $lessondata,
            'coursedata' => $coursedata,
            'chapterdata' => $chapterdata
        ]);
        return $this->fetch('lessonedit');
    }

    public function LessonDel()
    {
        $id = input('param.id');
        $Lesson = new LessonModel();
        $flag = $Lesson->delLesson($id);
        return json(msg($flag['code'], $flag['data'], $flag['msg']));
    }

    public function lessonadd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $Lesson = new LessonModel();
            $flag = $Lesson->addLesson($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $Lesson_id = I('param.id');
        $Lesson_model = new LessonModel();
        return $this->fetch('', [
            'Lessondata' => $Lesson_model->field('id,title')->find($Lesson_id),
        ]);
    }

    // 上传缩略图
    public function uploadImg()
    {
        if (request()->isAjax()) {

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/Lesson');
            if ($info) {
                $src = '/upload/lesson' . '/' . date('Ymd') . '/' . $info->getFilename();
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
                'auth' => 'lesson/lessonedit',
                'href' => url('Lesson/Lessonedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'lesson/lessondel',
                'href' => "javascript:lessonDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
