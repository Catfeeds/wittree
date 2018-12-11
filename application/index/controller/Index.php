<?php

namespace app\index\controller;

use app\index\model\CategoryModel;
use app\index\model\CourseModel;
use app\index\model\IntegralConfigModel;
use app\index\model\NewsModel;
use think\Controller;
use Workerman\Lib\Timer;

class Index extends Controller
{
//    public function add_timer()
//    {
//        Timer::add(1, array($this, 'index1'), array(), true);
//    }
//
//
//    public function index1()
//    {
//        Log::write(date("Y-m-d H:i:s"));
//    }

    /**
     * 首页显示
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $where = [];
        if ($this->request->isGet()) {
            $param = input('param.');
            if (isset($param['id'])) {
                $where['cat_id'] = $param['id'];
            }
        }
        $new = new NewsModel();
        $cate = new CategoryModel();
        $course = new CourseModel();
        $new = new NewsModel();
        $newdata = $new->select();
        $integralconfig = new IntegralConfigModel();
        $newList = $new->getNewsList(5);
        $cateList = $cate->getCateList(10);
        $where['status'] = 0;
        $courseList = $course->getCourseList($where, 10);
        $ingralconfigdata = $integralconfig->getIntegralData();
        return $this->fetch('', [
            'newlist' => $newList,
            'catelist' => $cateList,
            'courselist' => $courseList,
            'integraldata' => $ingralconfigdata,
            'newdata' => $newdata,
        ]);
    }

    /**
     * 获取班级数据
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getCourse()
    {
        if ($this->request->isAjax()) {
            $param = input('post.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (isset($param['cat_id'])) {
                $where['cat_id'] = $param['cat_id'];
            }
            $map['status'] = 0;
            $course = new CourseModel();
            $courseList = $course->getCourseListByCatId($where, $offset, $limit);
            $count = $course->getCourseListByCatIdCount($where, $offset, $limit);
            foreach ($courseList as $key => $value) {
                $courseList[$key]['link_url'] = url('index/coursedetail', array('id' => $value['id']));
            }
            if (!empty($courseList)) {
                return json(['code' => 0, 'data' => $courseList, '获取数据成功！']);
            } else {
                return json(['code' => -1, 'data' => '', '获取数据失败！']);
            }
        }

    }

    public function isCourseData(){
        if ($this->request->isAjax()) {
            $param = input('post.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;
            $where = [];
            if (isset($param['cat_id'])) {
                $where['cat_id'] = $param['cat_id'];
            }
            $map['status'] = 0;
            $course = new CourseModel();
            $count = $course->getCourseListByCatIdCount($where, $offset, $limit);
            if($count > $limit) {
                return json(['code' => 1, 'data' => '', '']);
            } else {
                return json(['code' => -1, 'data' => '', '']);
            }
        }
    }

    /**
     * 新闻详情
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function newdetail()
    {
        $param = input('param.');
        $new = new NewsModel();
        $newsdata = $new->field('id,url,content')->find($param['id']);
        return $this->fetch('', [
            'newsdata' => $newsdata,
        ]);
    }

    /**
     * 课程详情
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function coursedetail()
    {
        $param = input('param.');
        $course = new CourseModel();
        $map['status'] = 0;
        $map['id'] = $param['id'];
        $coursedata = $course->field('id,title,thumb,desc,keywords,price')->where($map)->find();
        $lessoncount = db('lesson')->where('course_id', $param['id'])->count('id');
        return $this->fetch('', [
            'coursedata' => $coursedata,
            'lessoncount' => $lessoncount,
        ]);
    }

    /**
     * 获取签到奖励数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function signdata()
    {
        if ($this->request->isAjax()) {
            $data = db('integral_config')->select();
            if (!empty($data)) {
                return json(msg(0, '', '获取数据成功！'));
            } else {
                return json(msg(-1, '', '获取数据失败！'));
            }
        }
    }

    /**
     * 更多分类数据显示
     * @return mixed
     */
    public function morecate()
    {
        if ($this->request->isGet()) {
            $categoay = new CategoryModel();
            //小学专区
            $where['division'] = 0;
            $grade = $categoay->getCateListByWhere($where);
            //初中专区
            $map['division'] = 1;
            $junior = $categoay->getCateListByWhere($map);
            //高中专区
            $w['division'] = 2;
            $senior = $categoay->getCateListByWhere($w);
            //建筑专区
            $m['division'] = 3;
            $arch = $categoay->getCateListByWhere($m);
            //IT专区
            $w1['division'] = 4;
            $it = $categoay->getCateListByWhere($w1);
        }
        return $this->fetch('', [
            'grade' => $grade,
            'junior' => $junior,
            'senior' => $senior,
            'arch' => $arch,
            'it' => $it,
        ]);
    }

    //判断是否登录返回用户id
    public function isLoginUser()
    {
        if ($this->request->isAjax()) {
            $user = session('wit_user', '', 'WitValue');
            if (empty($user)) {
                return json(['code' => -1, 'data' => '', 'msg' => '请登录！']);
            } else {
                return json(['code' => 0, 'data' => $user->id, 'msg' => '获取用户id成功！']);
            }
        }
    }

    public function notice(){
        return $this->fetch();
    }

}
