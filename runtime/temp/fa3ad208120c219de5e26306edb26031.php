<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\myexpand.html";i:1544274416;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的推广</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <script type='text/javascript' src='http://g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='http://g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='http://g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    <link rel="stylesheet" href="/static/index/javaScript/layui/css/layui.css"/>
    <script src="/static/index/javaScript/layui/layui.js"></script>
    <script src="/static/index/javaScript/public.js"></script>
    <link rel="stylesheet" href="/static/index/css/public.css"/>
    <link rel="stylesheet" href="/static/index/css/wodetuiguang.css"/>
</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">我的推广</h1>
</header>
<div class="them" style="background-image:url('/static/index/images/tuiguang-b1.png') ">
    <img <?php if($user['face'] != ''): ?>src="<?php echo $user['face']; ?>"<?php else: ?>src="/static/index/images/face.jpg"<?php endif; ?> class="name-img" alt=""/>
    <p class="name-text"><?php echo $user['username']; ?></p>
    <p class="tui-ren">推广人数&nbsp;&nbsp;<?php echo $userdata['expand_count']; ?>&nbsp;&nbsp;&nbsp;积分&nbsp;&nbsp;<?php echo $user['integral']; ?> </p>
    <div class="reshu-list" style="background-image: url('/static/index/images/tuiguang-b2.png')">
        <img src="/static/index/images/tuiguang-b3.png" class="yun1" alt=""/>
        <img src="/static/index/images/tuiguang-b4.png" class="yun2" alt=""/>
        <p class="Iyao">我邀请的好友</p>
        <div class="I-list">
            <?php if(is_array($userdata['expand_data']) || $userdata['expand_data'] instanceof \think\Collection || $userdata['expand_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $userdata['expand_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <p ><img <?php if($v['face'] != ''): ?>src="<?php echo $v['face']; ?>"<?php else: ?>src="/static/index/images/head.jpg"<?php endif; ?> alt=""/><span><?php echo $v['username']; ?></span><span><?php echo date("Y-m-d",$v['create_time']); ?></span></p>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<script>

</script>
</body>
</html>