<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\index\coursedetail.html";i:1544264088;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>课程详情</title>
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
    <link rel="stylesheet" href="/static/index/css/index.css"/>
    <link rel="stylesheet" href="/static/index/css/public.css"/>
    <style>
        .banner {
            background-size: 100% 100%;
            background-repeat: no-repeat;
            height: 22%;
            margin-top: 2.2rem;
        }

        .banner .content-box {
            height: 80%;
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #fdfdfd;
            border-radius: 0.8rem 0.8rem 0 0;
        }

        .banner .content-box .img-top {
            width: 4rem;
            height: 4rem;
            border-radius: 0.5rem;
            vertical-align: top;
            border: 2px solid #ffffff;
        }

        .banner .content-box .titles {
            display: inline-block;
            vertical-align: top;
            margin-left: 0.4rem;
        }

        .banner .content-box .titles p {
            margin: 0;
        }

        .banner .content-box .content1 {
            padding: 0 0 1rem 1rem;
            margin: -2rem 0 0 0;
            border-bottom: 1px solid #eeeeee;
        }

        .banner .content-box .content1 .titles p:first-child {
            margin-top: 0.3rem;
            color: #ffffff;
        }

        .banner .content-box .content1 .titles p:nth-child(2) {
            font-size: 0.7rem;
            margin-top: 0.6rem;
        }

        .banner .content-box .content1 .titles p:nth-child(3) {
            font-size: 0.72rem;
        }

        .content2 {
            padding: 0 1rem;
        }

        .content2 p:last-child {
            font-size: 0.7rem;
            text-indent: 1.5rem;
        }
    </style>
</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000;float: left;margin-top: 0.5rem;" onclick="gofu()"></span>
    </a>
    <h1 class="title">智慧树</h1>
</header>
<div class="banner" style="background-image: url('/static/index/images/banner.png')">
    <div class="content-box">
        <div class="content1">
            <img src="<?php echo $coursedata['thumb']; ?>" class="img-top" alt=""/>
            <div class="titles">
                <p><?php echo $coursedata['title']; ?></p>
                <p><?php echo $coursedata['keywords']; ?></p>
                <p>共<?php echo $lessoncount; ?>节课</p>
            </div>
        </div>
        <div class="content2">
            <p>内容简介</p>
            <p><?php echo $coursedata['desc']; ?></p>
        </div>
        <div class="content-block">
            <p><a href="#" class="button button-round">立即购买(<?php echo $coursedata['price']; ?>)</a></p>
        </div>
    </div>
</div>


<script>
    $(function () {
        $(".button-round").click(function () {
            //判断是否登录
            var uid;
            $.ajax({
                type: "POST",  //提交方式
                url: "<?php echo url('Index/isLoginUser'); ?>",//路径
                data: {},
                async: false,
                success: function (result) {
                    console.log(result)
                    if (result.code == -1) {
                        setTimeout(function () {
                            $.toast(result.msg);
                            location.href = "<?php echo url('login/login'); ?>";
                            return false;
                        }, 2000);
                    }
                    if (result.code == 0) {
                        uid = result.data;
                    }
                }
            });
            $.ajax({
                type:"POST",
                url :"<?php echo url('Customer/buycourse'); ?>",
                data:{
                    uid:uid,
                    price:<?php echo $coursedata['price']; ?>,
                    course_id:<?php echo $coursedata['id']; ?>,
                },
                success: function (result) {
                    console.log(result)
                    if (result.code == -1) {
                        $.toast(result.msg);
                    }
                    if (result.code == 0) {
                        $.toast(result.msg);
                    }
                }
            })
        })

    })
</script>
</body>
</html>