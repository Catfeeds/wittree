<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\message.html";i:1544435834;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>消息列表</title>
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
    <link rel="stylesheet" href="/static/index/css/xiaoximingxi.css"/>
    <script src="/static/index/javaScript/jquery.js"></script>
</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">消息列表</h1>
</header>
<div class="them">
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['is_read'] != 2): ?>
    <div class="list" value="1">
        <img src="/static/index/images/laba2.png" class="laba" alt=""/>
        <div class="text-box" id="<?php echo $v['id']; ?>" mess_id="<?php echo $v['message_id']; ?>">
            <p class="titles"><span class="gonotice"></span><span><?php echo $v['mtime']; ?>&nbsp<?php echo $v['htime']; ?></span>
            </p>
            <p class="message-detail"><?php echo $v['content']; ?></p>
        </div>
        <?php if($v['is_read'] == 0): ?>
        <span class="dian"></span>
        <?php else: ?>
        <span></span>
        <?php endif; ?>
        <img src="/static/index/images/delete.png" class="delete" alt=""/>
    </div>
    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
</div>
<script>
    $(function () {
        $('.list').bind('touchmove', function (e) {
            startX = e.originalEvent.changedTouches[0].pageX,
                startY = e.originalEvent.changedTouches[0].pageY;
            //获取滑动屏幕时的X,Y
            endX = e.originalEvent.changedTouches[0].pageX,
                endY = e.originalEvent.changedTouches[0].pageY;
            //获取滑动距离
            distanceX = endX - startX;
            distanceY = endY - startY;
            //判断滑动方向
            if (Math.abs(distanceX) > Math.abs(distanceY) && distanceX > 0) {
                $('.list').width(0);
                $(this).css(width, "100%");
            } else if (Math.abs(distanceX) > Math.abs(distanceY) && distanceX < 0) {
                $('.list').width("100%");
                $(this).animate({width: "78%"}, 50);
            } else if (Math.abs(distanceX) < Math.abs(distanceY) && distanceY < 0) {
                console.log('往上滑动');
            } else if (Math.abs(distanceX) < Math.abs(distanceY) && distanceY > 0) {
                console.log('往下滑动');
            } else {
                $('.list').width("100%");
                $(this).animate({width: "78%"}, 50);
                console.log('点击');

            }
        });

        $(".delete").click(function () {
            var id = $(".text-box").attr("id");
            var message_id = $(".text-box").attr("mess_id");
            $.ajax({
                type: "POST",
                url: "<?php echo url('customer/delmessage'); ?>",
                data: {
                    id: id,
                    message_id:message_id
                },
                dataType: "json",
                success: function (data) {
                    if (data.code === -1) {

                    } else {
                        location.reload();
                    }
                }
            });
        });

        $(".text-box").click(function () {
            var mess_id = $(this).attr("mess_id");
            var id = $(this).attr("id");
            url = "<?php echo url("customer/messdetail"); ?>" + "?id=" + id + "&mess_id=" + mess_id;
            location.href = url;
        })
    });

</script>
</body>
</html>