<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class IntegralConfigValidate extends Validate
{
    protected $rule = [
        ['day', 'require','天数不能为空!'],
        ['integral', 'require','积分数不能为空！'],
    ];

}