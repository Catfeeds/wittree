<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/11/22
 * Time: 15:58
 */
namespace app\index\Controller;

use think\Controller;

class Base extends Controller
{
    public $account = '';

    public function _initialize()
    {
        //检查是否登录
        $isLogin = $this->isLogin();
        if (!$isLogin) {
            return $this->redirect(url('Login/login'));
        }
        $this->assign('user', $this->getLoginUser());
    }

    /**
     * 检查是否登录
     * @return bool
     */
    public function isLogin()
    {
        //获取session值
        $wit_user = $this->getLoginUser();
        if ($wit_user && $wit_user->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取账户信息
     * @return mixed|string
     */
    public function getLoginUser()
    {
        if (!$this->account) {
            $this->account = session('wit_user', '', 'WitValue');
        }
        return $this->account;
    }



}