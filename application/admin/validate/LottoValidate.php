<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class LottoValidate extends Validate
{
    protected $rule = [
        ['title', 'require','抽奖标题不能为空！'],
        ['integral', 'require','抽奖规则不能为空！'],
        ['odds', 'require','抽奖几率不能为空！'],
    ];

}