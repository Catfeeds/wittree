<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/12/22
 * Time: 0:45
 */

namespace app\index\Controller;

use app\admin\model\AwardModel;
use app\index\model\CustomerLogModel;
use app\index\model\CustomerModel;
use think\Controller;

class Login extends Controller
{
    private $obj;

    public function _initialize()
    {
        $this->obj = new CustomerModel();
    }

    //登录页面
    public function login()
    {
        if (request()->isPost()) {
            $customer = new CustomerModel();
            $data = input('post.');
            if (empty($data['tell']) && empty($data['password'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '账号或密码错误']);
            } elseif (empty($data['password'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '密码错误']);
            }
            try {
                $res = $customer->where('phone', 'eq', $data['tell'])->find();
            } catch (\Exception $e) {
                return json(['code' => -1, 'data' => '', 'msg' => $e->getMessage()]);
            }
            if (!empty($res)) {
                if (md5($data['password']) != $res->password) {
                    return json(['code' => -1, 'data' => '', 'msg' => '密码错误']);
                }
            } elseif (!$res || $res->status != config('Customer_status')) {
                return json(['code' => -1, 'data' => '', 'msg' => '手机号不存在！']);
            }
            session('wit_user', $res, 'WitValue');
            return json(['code' => 0, 'data' => '', 'msg' => '登录成功！']);
        } else {
            return $this->fetch();
        }

    }

    //注册页面
    public function register()
    {
        if ($this->request->isAjax()) {
            $data = input('post.');
            if ($data['fid'] !== "") {
                return json(['code' => -1, 'data' => '', 'msg' => '请通过系统好友介绍进行注册！']);
            }
            $customer = new CustomerModel();
            $customerlog = new CustomerLogModel();
            //生成系统名字
            $savedata['username'] = 'wittree_' . $data['tell'];
            if ($data['fid'] !== "") {
                $savedata['fid'] = $data['fid'];
            }
            $savedata['phone'] = $data['tell'];
            $savedata['password'] = md5($data['password']);
            $savedata['status'] = 1;//启用
            $savedata['create_time'] = time();
            $flag = $customer->where('phone', $data['tell'])->find();
            if (!empty($flag)) {
                return json(['code' => -1, 'data' => '', 'msg' => '手机号已存在！']);
            }
            if ($data['password2'] !== $data['password']) {
                return json(['code' => -1, 'data' => '', 'msg' => '两次密码输入不一致！']);
            }
            if (strlen($data['password']) < 8 || strlen($data['password2']) < 8) {
                return json(['code' => -1, 'data' => '', 'msg' => '密码不能少于八位！']);
            }
            $res = $customer->insert($savedata);
            $award = new AwardModel();
            if ($res) {
                $customerlog->save(['uid' => $customer->getLastInsID(), 'create_time' => time(), 'type' => 6]);
                $award = $award->field('integral')->find();
                $customer->where('id', $data['fid'])->setInc('integral', $award['integral']);
                $customerlog->save(['uid' => $data['fid'], 'from_id' => $customer->getLastInsID(), 'desc' => '好友' . 'wittree_' . $data['tell'] . '注册成功' . '返利' . $award['integral'], 'integral' => $award['integral'], 'create_time' => time(), 'type' => 7]);
                return json(['code' => 0, 'data' => '', 'msg' => '注册成功！']);
            } else {
                return json(['code' => -1, 'data' => '', 'msg' => '注册失败！']);
            }
        } else {
            $param = input('param.uid');
            return $this->fetch('', [
                'fid' => $param,
            ]);
        }
    }

    //找回密码页面
    public function retrievePwd()
    {
        if (request()->isPost()) {

        } else {
            return $this->fetch();
        }
    }

    //重置密码页面
    public function resetPassword()
    {
        $data = input('post.');
        return $this->fetch('', [
            'phone' => $data['phone'],
        ]);
    }

    //执行重置密码操作
    public function resetPassUpdate()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $user = session('wit_user', '', 'WitValue');
            $password = md5($data['password']);
            $res = model('customer')->save(['password' => $password], ['phone' => $data['phone']]);
            if ($res) {
                $this->redirect('Login/resetSuccess');
            } else {
                $this->redirect('Login/resetFailer');
            }
        }
    }

    //操作失败页面
    public function resetFailer()
    {
        return $this->fetch();
    }

    //操作成功页面
    public function resetSuccess()
    {
        return $this->fetch();
    }

    public function logout()
    {
        session(null, 'WitValue');
        $this->redirect('Login/login');
    }

    /**
     * 修改密码
     */
    public function savepass()
    {
        if ($this->request->isAjax()) {
            $data = input('post.');
            if (empty($data['password']) && empty($data['password2'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '两次密码输入不一致！']);
            } elseif (empty($data['password'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '密码不能为空！']);
            } elseif (empty($data['password2'])) {
                return json(['code' => -1, 'data' => '', 'msg' => '重置密码不能为空！']);
            }
            $customer = new CustomerModel();
            $flag = $customer->where('phone', $data['phone'])->find();
            if (!$flag || $flag->status != 1) {
                return json(['code' => -1, 'data' => '', 'msg' => '手机号不存在或已被禁用！']);
            }
            $password = md5($data['password2']);
            $res = $customer->save(['password' => $password], ['phone' => $data['phone']]);
            if ($res) {
                return json(['code' => 0, 'data' => '', 'msg' => '重置密码成功！']);
            } else {
                return json(['code' => -1, 'data' => '', 'msg' => '重置密码失败！']);
            }
        } else {
            return $this->fetch();
        }
    }

    /**
     * 退出
     */
    public function loginout()
    {
        session(null, 'WitValue');
        $this->redirect('Login/login');
    }
}