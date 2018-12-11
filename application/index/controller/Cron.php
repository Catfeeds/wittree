<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/29
 * Time: 13:33
 */

namespace app\index\controller;

use app\admin\model\LessonModel;
use app\admin\model\OrderLearn;
use app\index\model\CompoundModel;
use app\index\model\CustomerLogModel;
use app\index\model\CustomerModel;
use app\index\model\OrderModel;
use think\Controller;
use think\Db;
use Workerman\Lib\Timer;

/**
 * 每天计算用户复利控制器
 * Class Cron
 * @package app\index\controller
 */
class Cron extends Controller
{
    public function add_timer()
    {
        Timer::add(1, array($this, 'calculate'), array(), true);
    }

    /**
     * 每日复利计算
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function calculate()
    {
        if (time() / 86400 == 0) {
            $order = new OrderModel();
            $customer = new CustomerModel();
            $customerlog = new CustomerLogModel();
            $lesson = new LessonModel();
            $compound = new CompoundModel();
            $lessonlearn = new OrderLearn();
            $data = $order->getOrderData();
            foreach ($data as $k => $v) {
                $price = $v['total_price'];
                $countlesson = $lesson->getLessonCountByCourseId($v['course_id']);
                $finishcount = $lessonlearn->getFinisnLesson($v);
                $data[$k]['countlesson'] = $countlesson;
                if ($countlesson !== 0) {
                    $nofinishcount = $countlesson - $finishcount;
                    $average = ($price) / ($countlesson);
                    $integral = $average * $nofinishcount;
                    $compoundData = $compound->getAllCompoundData();
                    foreach ($compoundData as $k1 => $v1) {
                        if ($integral > $v1['from_money'] && $integral < $v1['end_money']) {
                            $calcuIntegral = $integral * $v1['rate'];
                            //启动事务
                            Db::startTrans();
                            try {
                                $res = $customer->where('id', $v['uid'])->setInc('integral', $calcuIntegral);
                                $savedata['uid'] = $v['uid'];
                                $savedata['type'] = 2;
                                $savedata['integral'] = $calcuIntegral;
                                $savedata['create_time'] = time();
                                $flag = $customerlog->addCustomerLog($savedata);
                                Db::commit();
                                if ($res && $flag) {
                                    return true;
                                } else {
                                    return false;
                                }
                            } catch (\Exception $e) {
                                //回滚事务
                                Db::rollback();
                            }
                        }
                    }
                }
            }
        }
    }
}