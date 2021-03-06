<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\rank.html";i:1543887969;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>排行榜</title>
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
    <link rel="stylesheet" href="/static/index/css/ranking.css"/>
</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">排行榜</h1>
</header>
<div class="them">
    <div class="top-names" style="background-image: url('/static/index/images/phb.png')">
        <img <?php if($user['face'] != ''): ?>src="<?php echo $user['face']; ?>"<?php else: ?>src="/static/index/images/face.jpg"<?php endif; ?> class="name-img" alt=""/>
        <p class="name"><?php echo $user['username']; ?></p>
        <p class="jifen">推广人数 &nbsp;<?php echo $recount; ?> &nbsp;&nbsp;积分 &nbsp;<?php echo $user['integral']; ?></p>
        <div class="names-btns clearfix">
            <span class="t-active recommend">推荐人数</span>
            <span>积分</span>
            <span>每日复利</span>
            <span>总复利</span>
        </div>
    </div>
    <div class="p-list-box">

    </div>
</div>
<script>
    $(function () {
        //获取推荐人数排行榜
        $.ajax({
            type: "POST",  //提交方式
            url: "<?php echo url('Customer/rank'); ?>",//路径
            data: {
                type: 0,
            },
            success: function (result) {
                if (result.code == -1) {
                    $('.p-list-box').html("");
                }
                var html = "";
                if (result.code == 0) {
                    for (var i = 0; i <= result.data.length - 1; i++) {
                        html += '<p>'+result.data[i].rankstr+'' +
                            ' <img\n' +
                            '                src=' + result.data[i]['face'] + ' class="name-img" alt=""/> <span\n' +
                            '                class="name-text">' + result.data[i].username + '</span> <span class="number">' + result.data[i]['recount'] + '人</span>' +
                            '</p>';
                    }
                    // 添加新条目
                    $('.p-list-box').html(html);
                }

            }
        });
        $(".names-btns span").click(function () {
            $(this).addClass("t-active").siblings().removeClass("t-active");
            var that = $(this).index();
            $.ajax({
                type: "POST",  //提交方式
                url: "<?php echo url('Customer/rank'); ?>",
                data: {
                    type:that
                },
                success: function (result) {
                    if (result.code == -1) {
                        $('.p-list-box').html("");
                    }
                    var html = "";
                    if (result.code == 0 && that == 0){
                        for (var i = 0; i <= result.data.length - 1; i++) {
                            html += '<p>'+result.data[i].rankstr+'' +
                                ' <img\n' +
                                '                src=' + result.data[i]['face'] + ' class="name-img" alt=""/> <span\n' +
                                '                class="name-text">' + result.data[i].username + '</span> <span class="number">' + result.data[i]['recount'] + '人</span>' +
                                '</p>';
                        }
                        // 添加新条目
                        $('.p-list-box').html(html);
                    } else {
                        for (var i = 0; i <= result.data.length - 1; i++) {
                            html += '<p>'+result.data[i].rankstr+'' +
                                ' <img\n' +
                                '                src=' + result.data[i]['face'] + ' class="name-img" alt=""/> <span\n' +
                                '                class="name-text">' + result.data[i].username + '</span> <span class="number">' + result.data[i]['integral'] + '分</span>' +
                                '</p>';
                        }
                        // 添加新条目
                        $('.p-list-box').html(html);
                    }
                }
            });
        })
    })
</script>
</body>
</html>