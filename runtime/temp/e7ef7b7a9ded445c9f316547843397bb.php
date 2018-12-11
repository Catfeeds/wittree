<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\index.html";i:1544407885;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>个人中心</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <script type='text/javascript' src='http://g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='http://g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='http://g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    <script src="/static/index/javaScript/public.js"></script>
    <link rel="stylesheet" href="/static/index/css/user-index.css"/>
    <link rel="stylesheet" href="/static/index/css/public.css"/>
</head>
<body>
<!--<header class="bar bar-nav">-->
    <!--<a class="button button-link button-nav pull-left" data-transition='slide-out'>-->
        <!--<span class="icon icon-left" style="color: #000" onclick="gofu()"></span>-->
    <!--</a>-->
    <!--<h1 class="title">个人中心</h1>-->
<!--</header>-->

<div class="them">
    <div class="portrait clearfix">
        <img <?php if($user['face'] == ''): ?>src="/static/index/images/head.jpg"<?php else: ?>src="<?php echo $user['face']; ?>"<?php endif; ?> alt=""/>
        <p class="name"><?php echo $customer['username']; ?></p>
        <p>余额:<?php echo $customer['integral']; ?></p>
    </div>

<?php if($user['role_id'] != 0): ?>
    <div class="top-btns">
        <a href="<?php echo url('Customer/mybuycourse'); ?>">
            <img src="/static/index/images//i-ke.png" alt=""/>
            <p>我的课程</p>
        </a>
        <a href="<?php echo url('customer/stat'); ?>">
            <img src="/static/index/images//i-pai.png" alt=""/>
            <p>统计（管理员）</p>
        </a>
        <a href="<?php echo url('Customer/rank'); ?>">
            <img src="/static/index/images//i-t.png" alt=""/>
            <p>排行榜</p>
        </a>
    </div>
<?php else: ?>

    <div class="top-btns clearfix">
        <a href="<?php echo url('Customer/mybuycourse'); ?>" style="width: 49%">
            <img src="/static/index/images//i-ke.png" alt=""/>
            <p>我的课程</p>
        </a>
        <a href="<?php echo url('Customer/rank'); ?>" style="width: 49%">
            <img src="/static/index/images//i-t.png" alt=""/>
            <p>排行榜</p>
        </a>
    </div>
<?php endif; ?>

    <div class="list-btns">
        <a href="<?php echo url('customer/myexpandcode'); ?>"
           class="clearfix"><span>我的推广码</span><span><?php echo $user['code']; ?></span></a>
        <a href="<?php echo url('customer/myexpand'); ?>" class="clearfix"><span>我的推广</span><span
                class="icon icon-right"></span></a>
        <a href="<?php echo url('customer/customerearndetail'); ?>" class="clearfix"><span>记录明细</span><span
                class="icon icon-right"></span></a>
        <a href="<?php echo url('customer/message'); ?>" class="clearfix"><span>消息</span><span class="icon icon-right"></span></a>
        <a href="<?php echo url('customer/updatepass',array('uid'=>$customer['id'])); ?>" class="clearfix"><span>修改密码</span><span
                class="icon icon-right"></span></a>
        <!--<a href="#" class="clearfix"><span>修改手机号</span><span class="icon icon-right"></span></a>-->
        <a href="<?php echo url('customer/myaddress'); ?>" class="clearfix"><span>修改地址</span><span
                class="icon icon-right"></span></a>
        <a href="<?php echo url('customer/checkId'); ?>" class="clearfix"><span>身份证验证</span><span
                class="icon icon-right"></span></a>
        <a href="<?php echo url('customer/feedback'); ?>" class="clearfix"><span>意见反馈</span><span
                class="icon icon-right"></span></a>
        <a href="<?php echo url('login/logout'); ?>" class="clearfix"><span>退出登录</span><span class="icon icon-right"></span></a>
    </div>
</div>


<nav class="nav">
    <a href="<?php echo url('customer/compound'); ?>">
        <img src="/static/index/images/zhu2.png" alt=""/>
        <p>复利</p>
    </a>
    <a href="<?php echo url('index/index'); ?>" class="tab-active">
        <img src="/static/index/images/home.png" alt=""/>
        <p>首页</p>
    </a>
    <a href="<?php echo url('customer/index'); ?>">
        <img src="/static/index/images/I2.png" alt=""/>
        <p>我的</p>
    </a>
</nav>


<script>

</script>
</body>
</html>