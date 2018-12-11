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

class Course extends Base
{
    // 课程列表
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
            $Course = new CourseModel();
            $selectResult = $Course->getCourseByWhere($where, $offset, $limit);
            $course_status = config('course_online');
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['thumb'] = '<img src="' . $vo['thumb'] . '" width="40px" height="40px">';
                $selectResult[$key]['status'] = $course_status[$vo['status']];
                $selectResult[$key]['lesson_num'] = db('lesson')->where('course_id', $vo['id'])->count('id');
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id']));
                $selectResult[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
            }

            $return['total'] = $Course->getAllCourse($where);  // 总数据
            $return['rows'] = $selectResult;

            return json($return);
        }

        return $this->fetch();
    }

    // 添加课程
    public function CourseAdd()
    {
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $Course = new CourseModel();
            $param['admin_id'] = $operator_id = session('id');
            $flag = $Course->addCourse($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }
        $cat_model = new CategoryModel();
        $catdata = $cat_model->getAllCate();
        return $this->fetch('courseadd', [
            'cat_name' => $catdata,
            'online' => config('course_online')
        ]);
    }

    public function CourseEdit()
    {
        $Course = new CourseModel();
        if (request()->isPost()) {
            $param = input('post.');
            unset($param['file']);
            $param['admin_id'] = $operator_id = session('id');
            $flag = $Course->editCourse($param);
            return json(msg($flag['code'], $flag['data'], $flag['msg']));
        }

        $id = input('param.id');
        $cat_model = new CategoryModel();
        $this->assign([
            'course' => $Course->getOneCourse($id),
            'cat_name' => $cat_model->getAllCate(),
            'online' => config('course_online')
        ]);
        return $this->fetch('courseedit');
    }

    public function CourseDel()
    {
        $id = input('param.id');
        $Course = new CourseModel();
        $flag = $Course->delCourse($id);
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
        $course_id = input('param.id');
        $course_model = new CourseModel();
        $chapterModel = new ChapterModel();
        $chapterdata = $chapterModel->where('course_id', $course_id)->field('id,course_id,title')->select();
        return $this->fetch('', [
            'coursedata' => $course_model->field('id,title')->find($course_id),
            'chapterdata' => $chapterdata
        ]);
    }

    // 上传缩略图
    public function uploadImg()
    {
        if (request()->isAjax()) {

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload/Course');
            if ($info) {
                $src = '/upload/Course' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            } else {
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    /**
     * 查看
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function lookcourse()
    {
        $course_model = new CourseModel();
        $course_id = input('param.id');
        $course = $course_model->getOneCourse($course_id);
        return $this->fetch('', [
            'course' => $course,
            'online' => config('course_online')
        ]);
    }

    /**
     * 拼装操作按钮
     * @param $id
     * @return array
     */
    private function makeButton($id)
    {
        return [
            '查看' => [
                'auth' => 'course/lookcourse',
                'href' => url('course/lookcourse', ['id' => $id]),
                'btnStyle' => 'info',
                'icon' => 'fa fa-paste'
            ],
            '编辑' => [
                'auth' => 'course/courseedit',
                'href' => url('Course/Courseedit', ['id' => $id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
            '添加课时' => [
                'auth' => 'course/lessonadd',
                'href' => url('course/lessonadd', ['id' => $id]),
                'btnStyle' => 'success',
                'icon' => 'fa fa-paste'
            ],
            '删除' => [
                'auth' => 'course/coursedel',
                'href' => "javascript:courseDel(" . $id . ")",
                'btnStyle' => 'danger',
                'icon' => 'fa fa-trash-o'
            ]
        ];
    }
}
