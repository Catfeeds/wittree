<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\messdetail.html";i:1544177782;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>消息详情</title>
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
    <link rel="stylesheet" href="/static/index/css/register.css"/>
    <link rel="stylesheet" href="/static/index/css/public.css"/>
    <style>
        html,body{
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        .shouyi{
            margin-top: 2.2rem;
            width: 100%;
            height: 100%;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            overflow: hidden;
        }
        .shouyi .sy-title{
            margin-top:15% ;
            text-align: center;
            margin-bottom: 0;
        }
        .shouyi .content1{
            width: 70%;
            margin:16% auto 0 auto;
        }
        .shouyi .content1 p{
            margin-top: 1.5rem;
            font-size: 0.72em;
        }
        .shouyi .content1 p:last-child{
            margin: 0;
            text-indent:1.4rem;
        }
    </style>
</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">消息详情</h1>
</header>
<div class="shouyi" style="background-image: url('/static/index/images/shouyibeijing.png')">
    <p class="sy-title">消息详情</p>
    <div class="content1">
        <p><?php echo $data['content']; ?></p>
    </div>
</div>

<script>
    $(".shouyi").height($("body").height()-$("header").height())
</script>
</body>
</html>