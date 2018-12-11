<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */

namespace app\admin\validate;

use think\Validate;

class CourseValidate extends Validate
{
    protected $rule = [
        ['title', 'require|min:3,max:6', '标题不能为空！|标题不能少于三个字符'],
        ['cat_id', 'require', '课程类别不能为空'],
        ['price', 'require', '价格不能为空'],
        ['thumb', 'require', '缩略图不能为空！'],
//        ['keywords', 'require', '关键词不能为空！'],
        ['desc', 'require', '描述不能为空！'],
//        ['content', 'require', '内容不能为空！'],
    ];

}