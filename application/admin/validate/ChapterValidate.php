<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class ChapterValidate extends Validate
{
    protected $rule = [
        ['title', 'require','章节不能为空！'],
        ['course_id', 'require','课程id不能为空！'],
    ];

}