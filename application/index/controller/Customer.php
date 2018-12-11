<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 13:34
 */

namespace app\index\controller;

use app\admin\model\CourseModel;
use app\index\model\CustomerAddressModel;
use app\index\model\CustomerMessageModel;
use app\index\model\DrawNewModel;
use app\index\model\FeedbackModel;
use app\admin\model\LessonModel;
use app\admin\model\LottoModel;
use app\admin\model\OrderLearn;
use app\index\model\CustomerLogModel;
use app\index\model\CustomerModel;
use app\admin\model\OrderModel;
use app\index\model\IntegralConfigModel;
use app\index\model\MessageModel;
use app\index\model\MessageReadModel;
use app\index\model\ScoreModel;
use app\index\model\SignModel;
use think\Controller;
use think\Db;
use think\Loader;
use think\Request;
use Endroid\QrCode\QrCode;

/**
 * 用户相关控制器
 * Class Customer
 * @package app\index\Controller
 */
//复利计算方法/*0-1-2-3-4-5-6/*60+2520*/
class Customer extends Base
{
    private $num;

    /**
     * 个人中心
     * @return mixed
     */
    public function index()
    {
        $customer = $this->account;
        return $this->fetch('', [
            'customer' => $customer,
        ]);
    }

    /**
     * 消息
     */
    public function message()
    {
        $message = new CustomerMessageModel();
        $messageread = new MessageReadModel();
        $user = $this->account;
        $where['uid'] = $user->id;
        $data = $message->getAllMessage($where);
        foreach ($data as $k => $v) {
            $data[$k]['mtime'] = date("m-d", $v['create_time']);
            $data[$k]['htime'] = date("h:i", $v['create_time']);
            $map['uid'] = $user->id;
            $map['mess_id'] = $v['message_id'];
            $readdata = $messageread->where($map)->find();
            if (!empty($readdata)) {
                if ($readdata['is_read'] == 0) {
                    $data[$k]['is_read'] = 0;
                }
                if($readdata['is_read'] == 1) {
                    $data[$k]['is_read'] = 1;
                }
                if($readdata['is_read'] == 2) {
                    $data[$k]['is_read'] = 2;
                }
            } else {
                $data[$k]['is_read'] = 0;
            }
        }
        return $this->fetch('', [
            'data' => $data
        ]);
    }

    /**
     * 消息详情
     */
    public function messdetail()
    {
        $param = input('param.');
        $message = new CustomerMessageModel();
        $data = $message->alias('a')->field('a.*,b.content')->join(['wit_message' => 'b'], 'a.message_id=b.id', 'left')->find($param['id']);
        $user = $this->account;
        $map['uid'] = $user->id;
        $map['mess_id'] = $param['mess_id'];
        $insertdata['uid'] = $user->id;
        $insertdata['is_read'] = 1;
        $insertdata['mess_id'] = $param['mess_id'];
        $messageread = new MessageReadModel();
        $flag = $messageread->where($map)->find();
        if (empty($flag)) {
            $messageread->save($insertdata);
        } else {
            $savedata['is_read'] = 1;
            $where['uid'] = $user->id;
            $where['mess_id'] = $param['mess_id'];
            $messageread->save($savedata, $where);
        }
        return $this->fetch('', [
            'data' => $data
        ]);
    }

    /**
     * 删除消息
     */
    public function delmessage()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $message = new CustomerMessageModel();
            $messageread = new MessageReadModel();
            $user = $this->account;
            $res = $message->where(['id'=>$param['id']])->find();
            if ($res['uid'] !== 0) {
                $flag = $message->where('id', $param['id'])->delete();
                if ($flag) {
                    $map['uid'] = $user->id;
                    $map['mess_id'] = $param['message_id'];
                    $messageread->where($map)->delete();
                }
            } else {
                $data['mess_id'] = $param['message_id'];
                $data['uid'] = $user->id;
                $data['is_read'] = 2;
                $flag = $messageread->insert($data);
            }
            if ($flag) {
                return json(['code' => 0, 'data' => '', 'msg' => '删除成功！']);
            } else {
                return json(['code' => -1, 'data' => '', 'msg' => '删除失败！']);
            }
        }
    }

    /**
     * 收益说明页面
     */
    public function earnshow()
    {
        return $this->fetch();
    }

    /**
     * 我的推广码页面
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function myexpandcode()
    {
        $user = $this->account;
        $url = "http://" . $_SERVER["SERVER_NAME"] . "/index/login/register?uid={$user->id}";
        halt($url);
        $url = $this->create_code($url);
        $this->assign('url', $url);
        return $this->fetch();
    }

    public function create_code($url)
    {
        $qrCode = new QrCode('Life is too short to be generating QR codes');
        //设置前景色
        $qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 0]);
        //设置背景色
        $qrCode->setBackgroundColor(['r' => 250, 'g' => 255, 'b' => 255, 'a' => 10]);
        //设置二维码大小
        $qrCode->setSize(200);
        $qrCode->setPadding(20);
        $qrCode->setText($url);
        //获取二维码数据
        $img = $qrCode->getDataUri();
        return $img;
    }

    /**
     * 绑定手机号
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function bindphone()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            if (empty($param['code'])) {
                return json(msg(-1, '', '验证码不能为空！'));
            }
            if (empty($param['phone'])) {
                return json(msg(-1, '', '手机号不能为空！'));
            }
            $user = $this->account;
            $flag = db('customer')->update(['phone' => $param['phone']], ['id' => $user->id]);
            if ($flag) {
                return json(msg(0, '', '绑定手机号成功！'));
            } else {
                return json(msg(-1, '', '绑定手机号失败！'));
            }
        }
    }

    /**
     * 修改密码
     */
    public function updatePass()
    {
        if ($this->request->isAjax()) {
            $user = $this->account;
            $data = input('post.');
            if ($user->id !== (int)$data['uid']) {
                return json(['code' => -1, 'data' => '', 'msg' => '参数非法！']);
            }
//            if (empty($data['code'])) {
//                return json(['code'=>-1,'data'=>'','msg'=>'验证码不能为空！']);
//            }
            if (empty($data['lastpass'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '旧密码不能为空！']);
            }
            if (md5($data['lastpass']) !== $user->password) {
                return json(['code' => -1, 'data' => '', 'msg' => '旧密码错误！']);
            }
            if (strlen($data['password1']) < 8 || strlen($data['password2']) < 8) {
                return json(['code' => -1, 'data' => '', 'msg' => '密码不能少于八位！']);
            }
            if (empty($data['password1']) || empty($data['password2'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '密码不能为空！']);
            }
            if ($data['password1'] !== $data['password2']) {
                return json(['code' => -1, 'data' => '', 'msg' => '两次密码输入不一致！']);
            }
            $password = md5($data['password2']);
            $customer = new CustomerModel();
            $flag = $customer->whereTime('id', $user->id)->find();
            $res = $customer->save(['password' => $password], ['id' => $data['uid']]);
            if ($res) {
                return json(['code' => 0, 'data' => '', 'msg' => '修改密码成功！']);
            } else {
                return json(['code' => -1, 'data' => '', 'msg' => '修改密码失败！']);
            }
        } else {
            $param = input('param.');
            return $this->fetch('', [
                'uid' => $param['uid'],
            ]);
        }
    }

    /**
     * 复利收益明细页面
     */

    /**
     * 修改手机号
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function savephone()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $customer = new CustomerModel();
            $customerdata = $customer->where('phone', $param['phone'])->find();
            $user = session('wit_user');
            if (empty($user)) {
                return json(msg(-1, '', '请登录！'));
            }
            if (empty($customerdata)) {
                return json(msg(-1, '', '手机号错误！'));
            }
            if (empty($param['phone'])) {
                return json(msg(-1, '', '手机号不能为空！'));
            }
            if (empty($param['code'])) {
                return json(msg(-1, '', '验证码不能为空！'));
            }
            if (empty($param['phone1']) || $param['phone1'] != $param['phone2']) {
                return json(msg(-1, '', '新手机号为空或两次输入不匹配！'));
            }
            try {
                $res = $customer->save(['phone' => $param['phone2']], ['id' => $user->id]);
                if ($res) {
                    return json(msg(0, '', '修改手机号成功！'));
                } else {
                    return json(msg(-1, '', '修改手机号失败！'));
                }
            } catch (\Exception $e) {
                return json(msg(-1, '', $e->getMessage()));
            }

        }
    }

    /**
     * 验证身份证
     * @return \think\response\Json
     */
    public function checkId()
    {
        $customer = new CustomerModel();
        $user = $this->account;
        if ($this->request->isAjax()) {
            $param = input('param.');
            $user = $customer->field('id,is_auth')->find($user->id);
            if ($user['is_auth'] == 2) {
                return json(['code' => -1, 'data' => '', 'msg' => '您已提交过申请!请耐心等待']);
            }
            if (empty($param['real_name'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '真实姓名不能为空!']);
            }
            if (empty($param['id_number'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '身份证号不能为空!']);
            }
            if (empty($param['id_url'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '身份证照片不能为空!']);
            }
            if (!CheckIsIDCard($param['id_number'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '身份证号码错误!']);
            }
            try {
                $flag = $customer->save(['real_name' => $param['real_name'], 'id_number' => $param['id_number'], 'id_url' => $param['id_url'], 'is_auth' => 2], ['id' => $user->id]);
                if ($flag) {
                    return json(msg(0, '', '身份验证申请提交成功！'));
                } else {
                    return json(msg(-1, '', '失败！'));
                }
            } catch (\Exception $e) {
                return json(msg(-1, '', $e->getMessage()));
            }
        } else {
            $user = $customer->field('id,is_auth')->find($user->id);
            if ($user['is_auth'] == 2 || $user['is_auth'] == 1) {
                return $this->redirect(url('customer/authreturn'));
            }
            return $this->fetch();
        }
    }

    public function authreturn()
    {
        return $this->fetch();
    }

    /**
     * 课程详情-立即购买详情
     * @return \think\response\Json
     */
    public function buycourse()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $order = new OrderModel();
            $customer = new CustomerModel();
            $customerlog = new CustomerLogModel();
            $data['uid'] = $param['uid'];
            $data['course_id'] = $param['course_id'];
            $data['order_number'] = createOrderNumber();
            $data['total_price'] = $param['price'];
            $data['status'] = 0;
            $data['pay_time'] = time();
            $data['pay_status'] = 1;
            $data['create_time'] = time();
            $map['uid'] = $param['uid'];
            $map['course_id'] = $param['course_id'];
            $orderdata = $order->where($map)->find();
            if (!empty($orderdata)) {
                return json(['code' => -1, 'data' => '', 'msg' => '您已购买过此课程！']);
            }
            $customerdata = $customer->where('id', $param['uid'])->find();
            if ($customerdata['integral'] == 0 || $customerdata['integral'] < $param['price']) {
                return json(['code' => -1, 'data' => '', 'msg' => '积分不足！']);
            }
            //启动事务
            Db::startTrans();
            try {
                $res = $order->insert($data);
                $course = (new CourseModel())->find($param['course_id']);
                $logdata['uid'] = $param['uid'];
                $logdata['integral'] = $param['price'];
                $logdata['type'] = 1;
                $logdata['create_time'] = time();
                $logdata['desc'] = "购买" . $course['title'] . "课程";
                $flag = $customerlog->insert($logdata);
                $result = $customer->where('id', $param['uid'])->setDec('integral', $param['price']);
                Db::commit();
                if ($res && $flag && $result) {
                    return json(msg(0, '', '购买成功！'));
                } else {
                    return json(msg(-1, '', '购买失败！'));
                }
            } catch (\Exception $e) {
                //回滚事务
                Db::rollback();
                return json(msg(-1, '', $e->getMessage()));
            }
        }
    }

    /**
     * 判断是否签到
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function isSign()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $current = date('Y-m-d H:i:s', time());
            $signModel = new SignModel();
            $hasSign = $signModel->where("uid", $param['uid'])->find();
            $count = $hasSign['si_count'];
            if ($hasSign) {
                $lastSignDay = strtotime("{$hasSign['si_time']}");
                $lastSign = date('Y-m-d', $lastSignDay);
                $today = date('Y-m-d', time());
                if ($lastSign == $today) {
                    return json(['code' => -1, 'data' => '', 'msg' => "今天已签到,您已连续签到 <font color='green'> {$count} </font>天"]);
                } else {
                    return json(['code' => 0, 'data' => '', 'msg' => ""]);
                }
            }
        }
    }

    /**
     * 签到
     */
    public function sign()
    {
        if ($this->request->isAjax()) {
            $time = time();
            $param = input('param.');
            if ($param['tag'] == 'sign') {
                $current = date('Y-m-d H:i:s', time());
                $signModel = new SignModel();
                $hasSign = $signModel->where("uid", $param['uid'])->find();
                $count = $hasSign['si_count'];
                if ($hasSign) {
                    $lastSignDay = strtotime("{$hasSign['si_time']}");
                    $lastSign = date('Y-m-d', $lastSignDay);
                    $today = date('Y-m-d', time());
                    if ($lastSign == $today) {
                        return json(['code' => 2, 'data' => '', 'msg' => "今天已签到,您已连续签到 <font color='green'> {$count} </font>天"]);
                    }
                    $residueHour = 24 + 24 - date('H', $lastSignDay); //有效的签到时间  (签到当天剩余的小时+1天的时间)
                    $formatHour = strtotime(date('Y-m-d H', $lastSignDay) . ':00:00');
                    $lastSignDate = strtotime("+{$residueHour}hour", $formatHour);
                    $count = $count + 1;
                    $sign = $signModel->where("uid", $param["uid"])->update(array('si_time' => $current, 'si_count' => $count)); //签到表
                    if ($count > 7) {
                        $count = 1;
                    }
                    $integral = db('integral_config')->where('day', $count)->find();
                    if ($sign) {
                        $data = array(
                            'userid' => $param['uid'],
                            'sc_score' => $integral['integral'],
                            'sc_detail' => '签到+' . $integral['integral'],
                            'sc_type' => 0,
                            'sc_time' => time()
                        );
                        $logdata = array(
                            'uid' => $param['uid'],
                            'integral' => $integral['integral'],
                            'desc' => '签到+' . $integral['integral'],
                            'type' => 0,
                            'create_time' => time()
                        );
                        $res = (new ScoreModel())->insert($data); //积分表
                        $flag = (new CustomerLogModel())->insert($logdata);
                        if ($count > 0) {
                            (new CustomerModel())->where('id', $param['uid'])->setInc('integral', $integral['integral']);
                            return json(['code' => 0, 'data' => '', 'msg' => "<font color='green'>签到成功,您已连续签到 <font color='red'> {$count} </font> 天!</font>"]);
                        }
                    } else {
                        return json(['code' => -1, 'data' => '', 'msg' => '签到失败,请稍后重试！']);
                    }
                } else {
                    $sign = $signModel->insert(array('uid' => $param["uid"], 'si_count' => 1)); //签到表
                }
                $count = 1;
                $integral = db('integral_config')->where('day', $count)->find();
                if ($sign) {
                    $data = array(
                        'userid' => $param['uid'],
                        'sc_score' => $integral['integral'],
                        'sc_detail' => '签到+' . $integral['integral'],
                        'sc_type' => 0,
                        'sc_time' => time()
                    );
                    $logdata = array(
                        'uid' => $param['uid'],
                        'integral' => $integral['integral'],
                        'desc' => '签到+' . $integral['integral'],
                        'type' => 0,
                        'create_time' => time()
                    );
                    $res = (new ScoreModel())->insert($data); //积分表
                    $flag = (new CustomerLogModel())->insert($logdata);
                    if ($count > 0) {
                        (new CustomerModel())->where('id', $param['uid'])->setInc('integral', $integral['integral']);
                        return json(['code' => 0, 'data' => '', 'msg' => "<font color='green'>签到成功,您已连续签到 <font color='red'> {$count} </font> 天!</font>"]);
                    }
                } else {
                    return json(['code' => -1, 'data' => '', 'msg' => '签到失败,请稍后重试！']);
                }

            }
        }
    }

    /**
     * 意见反馈
     */
    public function feedback()
    {
        if ($this->request->isAjax()) {
            $data = input('post.');
            $user = $this->account;
            $data['uid'] = $user->id;
            $data['create_time'] = time();
            $feedModel = new FeedbackModel();
            $res = $feedModel->addFeedback($data);
            if ($res) {
                return json(['code' => 0, 'data' => '', 'msg' => '成功！']);
            } else {
                return json(['code' => -1, 'data' => '', 'msg' => '失败！']);
            }
        } else {
            return $this->fetch('', [
                'feedback_type' => config('feed_back_type')
            ]);
        }
    }

    // 上传反馈缩略图
    public function uploadfeedback()
    {
        if (request()->isAjax()) {

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size' => 15678, 'ext' => 'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'upload/feedback');
            if ($info) {
                $src = '/upload/feedback' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            } else {
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    // 上传身份证件
    public function uploadcheckid()
    {
        if (request()->isAjax()) {

            $file = request()->file('file');
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->validate(['size' => 15678, 'ext' => 'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'upload/checkid');
            if ($info) {
                $src = '/upload/checkid' . '/' . date('Ymd') . '/' . $info->getFilename();
                return json(msg(0, ['src' => $src], ''));
            } else {
                // 上传失败获取错误信息
                return json(msg(-1, '', $file->getError()));
            }
        }
    }

    //我的地址列表
    public function myaddress()
    {
        $address = new CustomeraddressModel();
        $user = $this->account;
        $data = $address->getAllCutomerAddressByUid($user->id);
        return $this->fetch('', [
            'data' => $data
        ]);
    }

    //编辑我的地址列表
    public function saveaddress()
    {
        $address = new CustomeraddressModel();
        if ($this->request->isAjax()) {
            $data = input('post.');
            $user = $this->account;
            if ($data['status'] == 1) {
                $address->where(['uid' => $user->id])->update(['status' => 0]);
            }
            $flag = $address->editCustomeraddress($data);
            if ($flag) {
                return json($flag);
            } else {
                return json($flag);
            }
        } else {
            $param = input('param.');
            $data = $address->find($param['id']);
            return $this->fetch('', [
                'data' => $data,
            ]);
        }
    }

    public function tishi()
    {
        return $this->fetch();
    }

    //删除我的地址列表
    public function deladdress()
    {
        if ($this->request->isAjax()) {
            $address = new CustomeraddressModel();
            $data = input('post.');
            $flag = $address::destroy($data['data']);
            if ($flag) {
                return json(['code' => 0, 'data' => '', 'msg' => '删除地址成功！']);
            } else {
                return json(['code' => -1, 'data' => '', 'msg' => '删除地址失败！']);
            }
        } else {
            return json(['code' => -1, 'data' => '', 'msg' => '网络错误！']);
        }
    }

    //添加我的地址
    public function addaddress()
    {
        if ($this->request->isAjax()) {
            $address = new CustomeraddressModel();
            $data = input('post.');
            $user = $this->account;
            if ($data['status'] == 1) {
                $address->where(['uid' => $user->id])->update(['status' => 0]);
            }
            $data['uid'] = $user->id;
            $flag = $address->insertCustomeraddress($data);
            if ($flag) {
                return json($flag);
            } else {
                return json($flag);
            }
        } else {
            return $this->fetch();
        }
    }

    /**
     * 我的推广
     */
    public function myexpand()
    {
        $user = $this->account;
        $userdata = db('customer')->field('id,username,fid,integral')->find($user->id);
        $userdata['expand_count'] = db('customer')->where('fid', $user->id)->count('id');
        $userdata['expand_data'] = db('customer')->order('create_time desc')->where('fid', $user->id)->select();
        return $this->fetch('myexpand', [
            'userdata' => $userdata
        ]);
    }

    /**
     * 已购买课程
     */
    public function mybuycourse()
    {
        $user = $this->account;
        $order = new OrderModel();
        $lesson = new LessonModel();
        $lessonlearn = new OrderLearn();
        $orderdata = $order->getOrderDataByCustomerId($user->id);
        $course_status = config('course_status');
        foreach ($orderdata as $key => $vo) {
            $orderdata[$key]['status'] = $course_status[$vo['status']];
            $finishcount = '(已学习)' . $lessonlearn->getFinisnLesson($vo) . '课时';
            $lessoncount = $lesson->getLessonCountByCourseId($vo['course_id']) . '课时';
            $orderdata[$key]['status'] = $finishcount . "/" . $lessoncount;
        }
        return $this->fetch('', [
            'orderdata' => $orderdata,
        ]);
    }


    /**
     * 已购买课程列表
     */
    public function buycourselist()
    {
        $param = input('param.');
        $course = new CourseModel();
        $lesson = new LessonModel();
        $lessonlearn = new OrderLearn();
        $user = $this->account;
        $map['uid'] = $user->id;
        $map['course_id'] = $param['course_id'];
        $learndata = $lessonlearn->field('id,uid,lesson_id,course_id,learn_status')->where($map)->select();
        $coursedata = $course->find($param['course_id']);
        $coursedata['lessoncount'] = $lesson->where('course_id', $param['course_id'])->count('id');
        $lesson_data = $lesson->where('course_id', $param['course_id'])->select();
        foreach ($lesson_data as $k => $v) {
            $learndata = $lessonlearn->where(['uid' => $user->id, 'lesson_id' => $v['id']])->find();
            if ($learndata['learn_status'] == 0) {
                $lesson_data[$k]['learn_status'] = "未学习";
            } else {
                $lesson_data[$k]['learn_status'] = "已学习";
            }
        }
        return $this->fetch('', [
            'course' => $coursedata,
            'lesson' => $lesson_data
        ]);
    }

    /**
     * 课时详情
     */
    public function lessondetail()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $lesson = new LessonModel();
            $data = $lesson->find($param['lesson_id']);
            if (!empty($data)) {
                return json(msg(0, $data, '获取数据成功！'));
            } else {
                return json(msg(-1, '', '获取数据失败！'));
            }
        }
    }

    /**
     * 记录明细
     */
    public function mylogdata()
    {
        $user = $this->account;
        $customerlog = new CustomerLogModel();
        $data = $customerlog->where('uid', $user->id)->select();
        return $this->fetch('', [
            'data' => $data
        ]);
    }

    /**
     * 记录明细详情
     */
    public
    function logdetail()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $customerlog = new CustomerLogModel();
            $data = $customerlog->find($param['log_id']);
            if (!empty($data)) {
                return json(msg(0, $data, '获取数据成功！'));
            } else {
                return json(msg(-1, '', '获取数据失败！'));
            }
        }
    }

    /**
     * 排行榜
     */
    public function rank()
    {
        $customerlog = new CustomerLogModel();
        $customer = new CustomerModel();
        if ($this->request->isAjax()) {
            $param = input('param.');
            if ($param['type'] == 0) {
                $data = $customer->field('id,username,fid')->select();
                $recount = [];
                foreach ($data as $k => $v) {
                    $data[$k]['recount'] = $customer->where('fid', $v['id'])->count('id');
                    if (empty($v['face'])) {
                        $data[$k]['face'] = "/static/index/images/face.jpg";
                    }
                    $volume[$k] = $v['recount'];
                }
                array_multisort($volume, SORT_DESC, $data);
                foreach ($data as $k => $v) {
                    $data[$k]['key'] = $k + 1;
                    if ($data[$k]['key'] == 1) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p1.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 2) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p2.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 3) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p3.png\" class=\"p\" alt=\"\"/>";
                    } else {
                        $data[$k]['rankstr'] = " <span class=\"number-p\">{$data[$k]['key']}</span>";
                    }
                }
            } elseif ($param['type'] == 1) {
                $data = $customer->field('id,username,fid,integral')->select();
                foreach ($data as $k => $v) {
                    if (empty($v['face'])) {
                        $data[$k]['face'] = "/static/index/images/face.jpg";
                    }
                    $volume[$k] = $v['integral'];
                }
                array_multisort($volume, SORT_DESC, $data);
                foreach ($data as $k => $v) {
                    $data[$k]['key'] = $k + 1;
                    if ($data[$k]['key'] == 1) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p1.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 2) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p2.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 3) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p3.png\" class=\"p\" alt=\"\"/>";
                    } else {
                        $data[$k]['rankstr'] = " <span class=\"number-p\">{$data[$k]['key']}</span>";
                    }
                }
            } elseif ($param['type'] == 2) {
                $data = $customer->field('id,username,fid,integral')->select();
                foreach ($data as $k => $v) {
                    if (empty($v['face'])) {
                        $data[$k]['face'] = "/static/index/images/face.jpg";
                    }
                    $map['uid'] = $v['id'];
                    $map['type'] = 2;
                    $data[$k]['integral'] = $customerlog->field('id,uid,type,integral')->where($map)->whereTime('create_time', 'yesterday')->avg('integral');
                    $volume[$k] = $v['integral'];
                }
                array_multisort($volume, SORT_DESC, $data);
                foreach ($data as $k => $v) {
                    $data[$k]['key'] = $k + 1;
                    if ($data[$k]['key'] == 1) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p1.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 2) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p2.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 3) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p3.png\" class=\"p\" alt=\"\"/>";
                    } else {
                        $data[$k]['rankstr'] = " <span class=\"number-p\">{$data[$k]['key']}</span>";
                    }
                }
            } else {
                $data = $customer->field('id,username,fid,integral')->select();
                foreach ($data as $k => $v) {
                    if (empty($v['face'])) {
                        $data[$k]['face'] = "/static/index/images/face.jpg";
                    }
                    $map['uid'] = $v['id'];
                    $map['type'] = 2;
                    $data[$k]['integral'] = $customerlog->field('id,uid,type,integral')->where($map)->sum('integral');
                    $volume[$k] = $v['integral'];
                }
                array_multisort($volume, SORT_DESC, $data);
                foreach ($data as $k => $v) {
                    $data[$k]['key'] = $k + 1;
                    if ($data[$k]['key'] == 1) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p1.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 2) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p2.png\" class=\"p\" alt=\"\"/>";
                    } elseif ($data[$k]['key'] == 3) {
                        $data[$k]['rankstr'] = "<img src=\"/static/index/images/p3.png\" class=\"p\" alt=\"\"/>";
                    } else {
                        $data[$k]['rankstr'] = " <span class=\"number-p\">{$data[$k]['key']}</span>";
                    }
                }
            }
            if (!empty($data)) {
                return json(['code' => 0, 'data' => $data, '获取数据成功！']);
            } else {
                return json(['code' => -1, 'data' => '', '获取数据失败！']);
            }
        }
        $user = $this->account;
        $recount = $customer->where('fid', $user->id)->count('id');
        return $this->fetch('', [
            'recount' => $recount
        ]);
    }

    /**
     * 统计
     */
    public function stat()
    {
        $customter = new \app\admin\model\CustomerModel();
        $orderlearn = new OrderLearn();
        $signdata = $customter->getIntegralWeekData(0);//签到
        $wastedata = $customter->getIntegralWeekData(1);//消费
        $compounddata = $customter->getIntegralWeekData(2);//复利
        $lottodata = $customter->getIntegralWeekData(3);//抽奖
        $updata = $customter->getIntegralWeekData(4);//上分
        $downdata = $customter->getIntegralWeekData(5);//下分
        $userdata = $customter->getIntegralWeekData(6);//注册
        $recommend = $customter->getRecommendWeekData();//推荐人统计
        $signArr = getArr($signdata, 0);//签到数据
        $compounddataArr = getArr($compounddata, 0);//复利
        $userdataArr = getArr($userdata, 1);//注册
        $recommendArr = getCountArr($recommend);//推荐人
        $course = $orderlearn->whereTime('create_time', 'week')->select();
        $courseArr = getCourseArr($course);
        return $this->fetch('', [
            'signdata' => $signArr,
            'compounddata' => $compounddataArr,
            'userdata' => $userdataArr,
            'coursedata' => $courseArr,
            'recommenddata' => $recommendArr,
        ]);
        return $this->fetch();
    }

    /**
     * 复利显示页面
     * @return \think\response\Json
     */
    public function compound()
    {
        $cuslog = new CustomerLogModel();
        $integralconfig = new IntegralConfigModel();
        $ingralconfigdata = $integralconfig->getIntegralData();
        $user = $this->account;
        $where['uid'] = $user->id;
        $where['type'] = 2;
        $yesterdayearn = $cuslog->where($where)->whereTime('create_time', 'yesterday')->count('integral');//昨日复利收益
        $totalearn = $cuslog->where($where)->sum('integral');//总积分
        $today = time();//今天
        $firstday = strtotime("-1 day");//昨天
        $twoday = strtotime("-2 day");//前天
        $threeday = strtotime("-3 day");//前三天
        $fourday = strtotime("-4 day");//前四天
        $fiveday = strtotime("-5 day");//前五天
        $sixday = strtotime("-6 day");//前六天
        $w1['create_time'] = $today;
        $w1['uid'] = $user->id;
        $w1['type'] = 2;
        $firstdata = $cuslog->field('uid,type,create_time,IFNULL(integral,0)')->where($w1)->find();//今日收益
        $w2['create_time'] = $firstday;
        $w2['uid'] = $user->id;
        $w2['type'] = 2;
        $twodata = $cuslog->field('uid,type,create_time,IFNULL(integral,0)')->where($w2)->find();//昨天天收益
        $w3['create_time'] = $twoday;
        $w3['uid'] = $user->id;
        $w3['type'] = 2;
        $threedata = $cuslog->field('uid,type,create_time,IFNULL(integral,0)')->where($w3)->find();//前两天收益
        $w4['create_time'] = $threeday;
        $w4['uid'] = $user->id;
        $w4['type'] = 2;
        $fourdata = $cuslog->field('uid,type,create_time,IFNULL(integral,0)')->where($w4)->find();//前三天收益
        $w5['create_time'] = $fourday;
        $w5['uid'] = $user->id;
        $w5['type'] = 2;
        $fivedata = $cuslog->field('uid,type,create_time,IFNULL(integral,0)')->where($w5)->find();//前四天收益
        $w6['create_time'] = $fiveday;
        $w6['uid'] = $user->id;
        $w6['type'] = 2;
        $sixdata = $cuslog->field('uid,type,create_time,IFNULL(integral,0)')->where($w6)->find();//前五天收益
        $w7['create_time'] = $sixday;
        $w7['uid'] = $user->id;
        $w7['type'] = 2;
        $sevendata = $cuslog->field('uid,type,create_time,IFNULL(integral,0)')->where($w7)->find();//前六天收益
        $sevenearn = $cuslog->where($where)->whereTime('create_time', 'last week')->sum('integral');//七日收益
        $data['yesterdayearn'] = $yesterdayearn;
        $data['totalearn'] = $totalearn;
        $data['sevenearn'] = $sevenearn;
        if ($firstdata['integral'] == null) {
            $firstdata['integral'] = 0;
        }
        if ($twodata['integral'] == null) {
            $twodata['integral'] = 0;
        }
        if ($threedata['integral'] == null) {
            $threedata['integral'] = 0;
        }
        if ($fourdata['integral'] == null) {
            $fourdata['integral'] = 0;
        }
        if ($fivedata['integral'] == null) {
            $fivedata['integral'] = 0;
        }
        if ($sixdata['integral'] == null) {
            $sixdata['integral'] = 0;
        }
        if ($sevendata['integral'] == null) {
            $sevendata['integral'] = 0;
        }
        return $this->fetch('', [
            'data' => $data,
            'integraldata' => $ingralconfigdata,
            'firstdata' => $firstdata,
            'twodata' => $twodata,
            'threedata' => $threedata,
            'fourdata' => $fourdata,
            'fivedata' => $fivedata,
            'sixdata' => $sixdata,
            'sevendata' => $sevendata,
        ]);
    }

    /**
     * 个人中心收益明细
     */
    public function customerearndetail()
    {
        $user = $this->account;
        $customerlog = new CustomerLogModel();
        $data = $customerlog->alias('a')
            ->field('a.*,b.id customer_id,b.username')
            ->join(['wit_customer' => 'b'], 'a.uid=b.id', 'left')
            ->order('a.create_time desc')
            ->select();
        $typeconfig = config('integral_type');
        foreach ($data as $key => $vo) {
            $data[$key]['typedesc'] = $typeconfig[$vo['type']];
            $data[$key]['create_time'] = date('Y-m-d H:i:s', $vo['create_time']);
        }
        return $this->fetch('', [
            'data' => $data,
        ]);
    }

    /**
     * 复利收益明细
     */
    public function earndetail()
    {
        $user = $this->account;
        $uid = $user->id;
        $data = Db::query("SELECT T3.*, (T3.JZJ - T3.JJS) YJ\n" .
            "  FROM (SELECT WIT_CUSTOMER_LOG.*,\n" .
            "               CASE\n" .
            "                 WHEN TYPE = 2 THEN\n" .
            "                 CONCAT('+',INTEGRAL)\n" .
            "               END JEJL,\n" .
            "               (SELECT SUM(T1.INTEGRAL)\n" .
            "                  FROM WIT_CUSTOMER_LOG T1\n" .
            "                 WHERE T1.UID = '" . $uid . "'\n" .
            "                   AND T1.TYPE = 2\n" .
            "                   AND T1.CREATE_TIME <= WIT_CUSTOMER_LOG.CREATE_TIME) JZJ,\n" .
            "               CASE\n" .
            "                 WHEN (SELECT SUM(T2.INTEGRAL)\n" .
            "                         FROM WIT_CUSTOMER_LOG T2\n" .
            "                        WHERE T2.UID = '" . $uid . "'\n" .
            "                          AND T2.TYPE = 2\n" .
            "                          AND T2.CREATE_TIME <= WIT_CUSTOMER_LOG.CREATE_TIME) IS NULL THEN\n" .
            "                  0\n" .
            "                 ELSE\n" .
            "                  (SELECT SUM(T2.INTEGRAL)\n" .
            "                     FROM WIT_CUSTOMER_LOG T2\n" .
            "                    WHERE T2.UID = '" . $uid . "'\n" .
            "                      AND T2.TYPE = 2\n" .
            "                      AND T2.CREATE_TIME <= WIT_CUSTOMER_LOG.CREATE_TIME)\n" .
            "               END JJS\n" .
            "          FROM WIT_CUSTOMER_LOG\n" .
            "         WHERE WIT_CUSTOMER_LOG.UID = '" . $uid . "'\n" .
            "         AND WIT_CUSTOMER_LOG.TYPE = 2\n" .
            "         ORDER BY WIT_CUSTOMER_LOG.CREATE_TIME DESC) T3"
        );
        return $this->fetch('', [
            'data' => $data,
        ]);
    }

    /**
     * 累计收益
     */
    public function addearn()
    {
        if ($this->request->isAjax()) {
            $cuslog = new CustomerLogModel();
            $user = $this->account;
            $uid = $user->id;
            $where['uid'] = $user->id;
            $where['type'] = 2;
            $totalearn = $cuslog->where($where)->sum('integral');//总积分
            $data['logdata'] = $cuslog->where($where)->select();
            $data['totalearn'] = $totalearn;
            if (!empty($data)) {
                return json(msg(0, $data, '获取数据成功！'));
            } else {
                return json(msg(-1, '', '获取数据失败！'));
            }
        }
    }

    /**
     * 复利排行榜
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function compoundrank()
    {
        if ($this->request->isAjax()) {
            $customer = new CustomerModel();
            $customerlog = new CustomerLogModel();
            $data = $customer->field('id,username,fid,integral')->select();
            foreach ($data as $k => $v) {
                if (empty($v['face'])) {
                    $data[$k]['face'] = "/static/index/images/face.jpg";
                }
                $map['uid'] = $v['id'];
                $map['type'] = 2;
                $data[$k]['integral'] = $customerlog->field('id,uid,type,integral')->where($map)->sum('integral');
                $volume[$k] = $v['integral'];
            }
            array_multisort($volume, SORT_DESC, $data);
            foreach ($data as $k => $v) {
                $data[$k]['key'] = $k + 1;
                if ($data[$k]['key'] == 1) {
                    $data[$k]['rankstr'] = "<img src=\"/static/index/images/p1.png\" class=\"p\" alt=\"\"/>";
                } elseif ($data[$k]['key'] == 2) {
                    $data[$k]['rankstr'] = "<img src=\"/static/index/images/p2.png\" class=\"p\" alt=\"\"/>";
                } elseif ($data[$k]['key'] == 3) {
                    $data[$k]['rankstr'] = "<img src=\"/static/index/images/p3.png\" class=\"p\" alt=\"\"/>";
                } else {
                    $data[$k]['rankstr'] = " <span class=\"number-p\">{$data[$k]['key']}</span>";
                }
            }
            if (!empty($data)) {
                return json(['code' => 0, 'data' => $data, '获取数据成功！']);
            } else {
                return json(['code' => -1, 'data' => '', '获取数据失败！']);
            }
        }
        return $this->fetch();
    }

    /**
     * 抽奖次数
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function drawnum()
    {
        if ($this->request->isAjax()) {
            $res = db('draw')->find();
            if ($res['se_num'] == 0) {
                return json(['code' => 0, 'data' => '', 'msg' => '抽奖次数不限！']);
            } else {
                return json(['code' => -1, 'data' => $res['se_num'], 'msg' => '限制次数！']);
            }
        }
    }


    /**
     * 抽奖
     */
    public function draw()
    {
        $lotto = new LottoModel();
        if ($this->request->isAjax()) {
            $current = date('Y-m-d H:i:s', time());
            $cdmodel = db('customer_draw');
            $draw = db('draw');
            $user = $this->account;
            $today = date('Y-m-d', time());
            $has = $cdmodel->where("uid", $user->id)->find();
            $count = $has['draw_num'];
            $flag = $draw->find();
            if ($flag['se_num'] !== 0) {
                if ($has) {
                    $lastSignDay = strtotime("{$has['draw_time']}");
                    $lastSign = date('Y-m-d', $lastSignDay);
                    $count = $count + 1;
                    if ($lastSign !== $today && $flag['se_num'] == $has['draw_num']) {
                        $cdmodel->where("uid", $user->id)->update(array('draw_num' => 0)); //签到表
                    }
                    if ($lastSign == $today && $flag['se_num'] == $has['draw_num']) {
                        return json(['code' => -1, 'data' => '', 'msg' => "抽奖次数已到上限！"]);
                    }
                    if ($lastSign !== $today) {
                        if (($flag['se_num'] < $has['draw_num']) || ($flag['se_num'] == $has['draw_num'])) {
                            return json(['code' => -1, 'data' => '', 'msg' => "抽奖次数已到上限！"]);
                        }
                    }
                    $cdmodel->where("uid", $user->id)->update(array('draw_time' => $current, 'draw_num' => $count)); //签到表
                } else {
                    $count = 1;
                    $data['uid'] = $user->id;
                    $data['draw_num'] = $count;
                    $data['draw_time'] = $current;
                    $cdmodel->insert($data);
                }
            }

            $prize_arr = $lotto->select();
            foreach ($prize_arr as $k => $v) {
                $arr[$v['id']] = $v['odds'];
            }
            $prize_id = $this->getRand($arr); //根据概率获取奖项id
            foreach ($prize_arr as $k => $v) { //获取前端奖项位置
                if ($v['id'] == $prize_id) {
                    $prize_site = $k;
                    break;
                }
            }
            $res = $prize_arr[$prize_id - 1]; //中奖项
            $data['prize_name'] = $res['title'];
            $data['prize_site'] = $prize_site;//前端奖项从-1开始
            $data['integral'] = $res['integral'];
            if (!empty($data)) {
                return json(['code' => 0, 'data' => $data, 'msg' => '获取数据成功！']);
            } else {
                return json(['code' => 0, 'data' => '', 'msg' => '获取数据失败！']);
            }
        }
        $lotto = new LottoModel();
        $data = $lotto->field('id,integral,title')->select();
        $drawnew = (new DrawNewModel())->field('desc,create_time')->limit(10)->order('create_time', 'desc')->select();
        foreach ($drawnew as $k => $v) {
            $drawnew[$k]['create_time'] = format_date($v['create_time']);
        }
        return $this->fetch('', [
            'data' => $data,
            'drawnew' => $drawnew,
        ]);
    }

    /**
     * 抽奖后操作
     * @return \think\response\Json
     */
    public function savedrawlog()
    {
        if ($this->request->isAjax()) {
            $param = input('param.');
            $cuslog = new CustomerLogModel();
            $customer = new CustomerModel();
            $drawnew = new DrawNewModel();
            Db::startTrans();
            try {
                $user = $this->account;
                $data['uid'] = $user->id;
                $data['integral'] = $param['integral'];
                $data['type'] = 3;
                $data['create_time'] = time();
                $flag = $cuslog->save($data);
                $res = $customer->where('id', $user->id)->setInc('integral', $param['integral']);
                $savedata['uid'] = $user->id;
                $savedata['desc'] = $user->username . "抽奖获得" . $param['integral'] . "分";
                $savedata['create_time'] = time();
                $result = $drawnew->save($savedata);
                Db::commit();
                if ($flag && $res && $result) {
                    return json(['code' => 0, 'data' => '', 'msg' => '抽奖成功！']);
                } else {
                    return json(['code' => -1, 'data' => '', 'msg' => '抽奖失败！']);
                }
            } catch (\Exception $e) {
                Db::rollback();
                return json(['code' => -1, 'data' => '', 'msg' => $e->getMessage()]);
            }
        }
    }

    /**
     * 获取抽奖数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getLotto()
    {
        if ($this->request->isAjax()) {
            $lotto = new LottoModel();
            $data = $lotto->field('id,integral,title')->select();
            if (!empty($data)) {
                return json(['code' => 0, 'data' => $data, 'msg' => '获取数据成功！']);
            } else {
                return json(['code' => 0, 'data' => '', 'msg' => '获取数据失败！']);
            }
        }
    }

    //获取抽奖随机数
    private function getRand($proArr)
    {
        $result = '';
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);//关键
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }
}