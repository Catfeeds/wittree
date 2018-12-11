<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class OrderValidate extends Validate
{
    protected $rule = [
        ['uid', 'require','用户不能为空！'],
        ['order_number', 'require','订单号不能为空！'],
    ];

}