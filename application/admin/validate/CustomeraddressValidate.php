<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class CustomeraddressValidate extends Validate
{
    protected $rule = [
        ['linkman', 'require|min:3,max:6','联系人不能为空！|联系人不能少于三个字符'],
        ['uid', 'require','所属用户不能为空！'],
        ['sex', 'require','性别不能为空！'],
        ['phone', 'require','联系电话不能为空！'],
        ['doorplate', 'require','门牌号不能为空！'],
        ['address', 'require','地址不能为空！'],
    ];

}