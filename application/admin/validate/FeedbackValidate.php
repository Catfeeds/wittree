<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 15:05
 */

namespace app\admin\validate;


class FeedbackValidate extends VideoValidate
{
    protected $rule = [
        ['uid', 'require','请登录！'],
        ['type', 'require','反馈类型不能为空！'],
        ['desc', 'require','描述不能为空！'],
    ];
}