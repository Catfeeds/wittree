<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:96:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\buycourselist.html";i:1544270871;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>我的课程</title>
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
    <link rel="stylesheet" href="/static/index/css/Ike-list.css"/>

</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">我的课程</h1>
</header>
<div class="banner" style="background-image: url('/static/index/images/banner.png')">
    <div class="content-box">
        <div class="content1">
            <img src="<?php echo $course['thumb']; ?>" class="img-top" alt=""/>
            <div class="titles">
                <p><?php echo $course['title']; ?></p>
                <p><?php echo $course['keywords']; ?></p>
                <p>共<?php echo $course['lessoncount']; ?>节课</p>
            </div>
        </div>
        <div class="content2">
          <p class="ke-z">章节</p>
            <div class="ke-list">
                <?php if(is_array($lesson) || $lesson instanceof \think\Collection || $lesson instanceof \think\Paginator): $i = 0; $__LIST__ = $lesson;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <p class="clearfix">
                    <span><?php echo $v['lesson']; ?> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v['title']; ?></span>
                    <span><?php echo $v['learn_status']; ?></span>
                </p>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

    </div>
</div>


<script>

</script>
</body>
</html>