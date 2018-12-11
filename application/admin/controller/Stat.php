<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/20
 * Time: 11:31
 */

namespace app\admin\controller;

use app\admin\model\CustomerModel;
use app\admin\model\OrderLearn;
/**
 * 统计管理控制器
 * Class Stat
 * @package app\admin\controller
 */
class Stat extends Base
{
    public function index()
    {
        //1542611387 1542697787 1542784187 1542870587 1542956987 1543043387 1543129787
//        insert into wit_customer_log(uid,integral,type,create_time) value(31,0,6,1543129787);
//        insert into wit_customer_log(uid,integral,type,create_time) value(32,0,6,1543129787);
//        insert into wit_customer_log(uid,integral,type,create_time) value(33,0,6,1543129787);
//        insert into wit_customer_log(uid,integral,type,create_time) value(34,0,6,1543129787);
//        insert into wit_customer_log(uid,integral,type,create_time) value(35,0,6,1543129787);

//        insert into wit_customer_log(uid,integral,type,create_time) value(26,0,6,1543043387);
//        insert into wit_customer_log(uid,integral,type,create_time) value(27,0,6,1543043387);
//        insert into wit_customer_log(uid,integral,type,create_time) value(28,0,6,1543043387);
//        insert into wit_customer_log(uid,integral,type,create_time) value(29,0,6,1543043387);
//        insert into wit_customer_log(uid,integral,type,create_time) value(30,0,6,1543043387);
//        insert into wit_customer_log(uid,integral,type,create_time) value(31,0,6,1543043387);
        $customter = new CustomerModel();
        $orderlearn = new OrderLearn();
        $signdata = $customter->getIntegralWeekData(0);//签到
        $wastedata = $customter->getIntegralWeekData(1);//消费
        $compounddata = $customter->getIntegralWeekData(2);//复利
        $lottodata = $customter->getIntegralWeekData(3);//抽奖
        $updata = $customter->getIntegralWeekData(4);//上分
        $downdata = $customter->getIntegralWeekData(5);//下分
        $userdata = $customter->getIntegralWeekData(6);//注册
        $recommend = $customter->getRecommendWeekData();//推荐人统计
        $signArr = getArr($signdata,0);//签到数据
        $compounddataArr =  getArr($compounddata,0);//复利
        $userdataArr =  getArr($userdata,1);//注册
        $recommendArr = getCountArr($recommend);//推荐人
        $course = $orderlearn->whereTime('create_time','week')->select();
        $courseArr = getCourseArr($course);
        return $this->fetch('', [
            'signdata' => $signArr,
            'compounddata' => $compounddataArr,
            'userdata' => $userdataArr,
            'coursedata' => $courseArr,
            'recommenddata' => $recommendArr,
        ]);
    }
}