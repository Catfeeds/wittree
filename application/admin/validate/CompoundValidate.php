<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class CompoundValidate extends Validate
{
    protected $rule = [
        ['from_money', 'require','起始金额不能为空!'],
        ['end_money', 'require','结束不能为空!'],
        ['rate', 'require|float','利率不能为空!'],
    ];

}