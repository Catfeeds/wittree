<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\myexpandcode.html";i:1544421862;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的推广码</title>
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
    <link rel="stylesheet" href="/static/index/css/public.css"/>
    <style>
        html,body{
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .tuiguang-box{
            margin-top: 2.2rem;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            overflow: hidden;
            position: relative;
        }
        .tuiguang-box .name-title{
            margin-top: 2rem;
            position: relative;
        }
        .tuiguang-box .name-title img{
            width: 2.5rem ;
            height: 2.5rem;
            border-radius: 50%;
            position: absolute;
            top: 0;
            left: 1rem;
        }
        .tuiguang-box .name-title span{
            font-size: 0.7rem;
        }
        .tuiguang-box .name-title .name{
            position: absolute;
            left: 4rem;
            top: 0.3rem;
        }
        .tuiguang-box .name-title .jifen{
            position: absolute;
            left: 4rem;
            top: 1.3rem;
        }
        .tuiguang-box .erweima{
            width: 30%;
            margin: 0 auto 0 auto;
            display: block;
            position: absolute;
            left: 50%;
            margin-left: -13%;
            top: 30%;
        }
    </style>
</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">我的推广码</h1>
</header>
<div class="tuiguang-box" style="background-image: url('/static/index/images/wodema.png')">
    <div class="name-title">
        <img <?php if($user['face'] == ''): ?>src="/static/index/images/9B4DB0F9-EF78-41b2-B0D0-26D489764EB5.png"<?php else: ?>src="<?php echo $user['face']; ?>"<?php endif; ?> alt=""/>
        <span class="name"><?php echo $user['username']; ?></span>
        <span class="jifen">积分&nbsp;&nbsp;<?php echo $user['integral']; ?></span>
    </div>
    <img src="<?php echo $url; ?>" class="erweima">
    <!--<img src="https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=847853172,894993951&fm=27&gp=0.jpg" class="erweima" alt=""/>-->
</div>
<script>
    $(".tuiguang-box").height($("body").height()-$("header").height())
</script>
</body>
</html>