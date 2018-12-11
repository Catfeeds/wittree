<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class CustomerValidate extends Validate
{
    protected $rule = [
        ['username', 'require|min:3,max:6|unique:customer','用户姓名不能为空！|用户姓名不能少于三个字符|用户名已存在！'],
        ['id_number', 'require','身份证不能为空！'],
        ['phone', 'require|unique:customer','联系电话不能为空！|手机号已存在！'],
    ];
}