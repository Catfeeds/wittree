<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/22
 * Time: 14:06
 */

namespace app\admin\controller;

use app\admin\model\CustomerModel;
use app\admin\model\LessonModel;
use app\admin\model\OrderLearn;
use app\admin\model\OrderModel;

class Order extends Base
{
    /**
     * 用户购买课程列表
     */
    public function courseindex()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $limit = $param['pageSize'];
            $offset = ($param['pageNumber'] - 1) * $limit;

            $where = [];
            if (!empty($param['searchText'])) {
                $where['d.username'] = array('like', '%' . $param['searchText'] . '%');
            }
            $orderdetail = new OrderModel();
            $lesson = new LessonModel();
            $lessonlearn = new OrderLearn();
            $selectResult = $orderdetail->getOrderData($where, $offset, $limit);
            $course_status = config('course_status');
            foreach ($selectResult as $key => $vo) {
                $selectResult[$key]['operate'] = showOperate($this->makeButton($vo['id'], $vo['uid'], $vo['course_id']));
                $selectResult[$key]['status'] = $course_status[$vo['status']];
                $finishcount = $lessonlearn->getFinisnLesson($vo);
                $lessoncount = $lesson->getLessonCountByCourseId($vo['course_id']);
                if ($selectResult[$key]['status'] == 0) {
                    $selectResult[$key]['status'] = $finishcount."/".$lessoncount;
                }

                if ($finishcount == $lessoncount && $lessoncount !=0 && $finishcount != 0) {
                    $selectResult[$key]['status'] = "已完结";
                }

                if ($selectResult[$key]['over_time'] == 0){
                    $selectResult[$key]['over_time'] = "";
                } else {
                    $selectResult[$key]['over_time'] = date("Y-m-d H:i:s");
                }
            }
            $return['total'] = $orderdetail->getAllOrder($where);  // 总数据
            $return['rows'] = $selectResult;
            return json($return);
        }
        $customer_id = input('param.customer_id');
        $customer = new CustomerModel();
        return $this->fetch('', [
            'customer_id' => $customer_id,
            'customerdata' => $customer->getOneCustomer($customer_id),
        ]);
    }

    /**
     * 用户购买课时列表
     */
    public function lessonindex()
    {
        $order_id = input('param.order_id');
        $customer_id = input('param.customer_id');
        $course_id = input('param.course_id');
        $customer = new CustomerModel();
        $lessondata = db('lesson')->where('course_id', $course_id)->select();
        $finishdata = db('order_learn')->alias('a')
            ->field('a.*,b.id,b.title,a.create_time')
            ->join(['wit_lesson' => 'b'], 'a.lesson_id=b.id', 'left')
            ->join(['wit_order' => 'c'], 'c.id=a.order_id', 'left')
            ->where('a.order_id', $order_id)
            ->select();
        return $this->fetch('', [
            'customer_id' => $customer_id,
            'customerdata' => $customer->getOneCustomer($customer_id),
            'lessondata' => $lessondata,
            'finishdata' => $finishdata,
            'order_id' => $order_id,
            'course_id' => $course_id,
        ]);
    }

    /**
     * 课时进度设置
     * @return \think\response\Json
     */
    public function lessonset()
    {
        if (request()->isAjax()) {
            $param = input('param.');
            $data = [
                'uid' => $param['uid'],
                'order_id' => $param['order_id'],
                'course_id' => $param['course_id'],
                'lesson_id' => $param['lesson_id'],
                'learn_status' => 1,
                'create_time' => time(),
            ];
            $model = db('order_learn');
            $lesson = new LessonModel();
            $lessonlearn = new OrderLearn();
            $where = [
                'uid' => $param['uid'],
                'order_id' => $param['order_id'],
                'course_id' => $param['course_id'],
                'lesson_id' => $param['lesson_id'],
            ];
            $res = $model->where($where)->find();
            if (!empty($res)) {
                return json(msg(-1,'','已学习过！'));
            }
            $map['uid'] = $param['uid'];
            $map['course_id'] = $param['course_id'];
            $flag = $model->insert($data);
            $finishcount = $lessonlearn->getFinisnLesson($map);
            $lessoncount = $lesson->getLessonCountByCourseId($map['course_id']);
            if ($finishcount == $lessoncount && $lessoncount !=0 && $finishcount != 0) {
                db('order')->where($map)->update(['status'=>1,'over_time'=>time()]);
            }

            if ($flag) {
                return json(msg(1,'','学习成功！'));
            } else {
                return json(msg(-1,'','学习失败！'));
            }
        }
    }

    /**
     * 拼装操作按钮
     * @param $id
     * @param $customer_id
     * @return array
     */
    private function makeButton($id, $customer_id, $course_id)
    {
        return [
            '课时进度管理' => [
                'auth' => 'order/lessonindex',
                'href' => url('order/lessonindex', ['order_id' => $id, 'customer_id' => $customer_id, 'course_id' => $course_id]),
                'btnStyle' => 'primary',
                'icon' => 'fa fa-paste'
            ],
        ];
    }
}