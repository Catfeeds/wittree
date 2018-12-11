<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class TurnValidate extends Validate
{
    protected $rule = [
        ['url', 'require','图片不能为空！'],
    ];

}