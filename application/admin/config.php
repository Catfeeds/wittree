<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// $Id
return [
    // 模板参数替换
    'view_replace_str' => array(
        '__CSS__' => '/static/admin/css',
        '__JS__' => '/static/admin/js',
        '__IMG__' => '/static/admin/images',
    ),

    // 管理员状态
    'user_status' => [
        '1' => '正常',
        '2' => '禁用'
    ],
    //用户状态
    'Customer_status' => [
        '1' => '正常',
        '2' => '禁用'
    ],
    //用户性别
    'Customer_sex' => [
        '0' => '男',
        '1' => '女',
        '2' => '未知'
    ],
    // 角色状态
    'role_status' => [
        '1' => '启用',
        '2' => '禁用'
    ],
    //积分类型0-签到积分1-消费积分2-复利3-抽奖4-上分5-下分
    'integral_type' => [
        '0' => '签到',
        '1' => '消费积分',
        '2' => '复利',
        '3' => '抽奖',
        '4' => '上分(后台操作)',
        '5' => '下分(后台操作)',
        '6' => '注册',
        '7' => '推荐'
    ],

    //课程支付状态
    'pay_status' => [
        '0' => '已支付',
        '1' => '未支付'
    ],

    //上分类型
    'uptype' => [
        '0' => '上分',
        '1' => '下分'
    ],

    //反馈类型
    'feed_back_type' => [
        '0' => '课程',
        '1' => '登录',
        '2' => '密码',
        '3' => '手机绑定',
        '4' => '其他'
    ],

    //反馈状态 0-未处理1-已处理2-已查看
    'feed_back_status' => [
        '0' => '未处理',
        '1' => '已处理',
        '2' => '已查看',
    ],

    //课程状态
    'course_status' => [
        '0' => '未完结',
        '1' => '已完结',
    ],

    //课程是否上线
    'course_online' => [
        0 => '已上线',
        1 => '未上线'
    ],

    //专区
    'division' => [
        0 => '小学专区',
        1 => '初中专区',
        2 => '高中专区',
        3 => '建筑专区',
        4 => 'IT专区',
    ],

    //课时状态
    'lesson_status' => [
        '0' => '已学习',
        '1' => '未学习',
    ],

    //实名认证状态
    'real_auth' => [
        '0' => '未认证',
        '1' => '已认证',
        '2' => '提交申请',
        '3' => '审核未通过',
    ],

    // 多库测试
    'local' => [
        // 数据库类型
        'type' => 'mysql',
        // 服务器地址
        'hostname' => '127.0.0.1',
        // 数据库名
        'database' => 'test',
        // 数据库用户名
        'username' => 'root',
        // 数据库密码
        'password' => 'root',
        // 数据库编码默认采用utf8
        'charset' => 'utf8',
        // 数据库表前缀
        'prefix' => '',
    ],
];