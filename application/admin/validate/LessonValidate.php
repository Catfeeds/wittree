<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\validate;

use think\Validate;

class LessonValidate extends Validate
{
    protected $rule = [
        ['title', 'require|min:3,max:6', '标题不能为空！|标题不能少于三个字符'],
        ['course_id', 'require', '课程id不能为空'],
        ['url', 'require', '缩略图不能为空！'],
        ['lesson', 'require', '课时不能为空！'],
    ];

}