<?php
/**
 * Created by PhpStorm.
 * CustomerModel: Administrator
 * Date: 2018/11/14
 * Time: 14:09
 */
namespace app\admin\validate;

use think\Validate;

class NewsValidate extends Validate
{
    protected $rule = [
        ['title', 'require|min:3,max:6','新闻标题不能为空！|新闻标题不能少于三个字符'],
        ['keywords', 'require','关键词不能为空！'],
        ['url', 'require','图片不能为空！'],
        ['content', 'require','内容不能为空！'],
    ];

}