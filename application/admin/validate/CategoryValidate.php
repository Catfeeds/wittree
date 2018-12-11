<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class CategoryValidate extends Validate
{
    protected $rule = [
        ['cat_name', 'require','分类名不能为空！'],
    ];

}