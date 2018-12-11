<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\earndetail.html";i:1544424916;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>收益明细</title>
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
    <!--<script src="/static/index/javaScript/jquery.js"></script>-->
    <link rel="stylesheet" href="/static/index/css/shouyimixi.css"/>
    <link rel="stylesheet" href="/static/index/css/public.css"/>
</head>
<body>
<header class="bar bar-nav" style="position: fixed;top: 0;left: 0;z-index: 99999">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">收益明细</h1>
</header>

    <div class="mx-List">
        <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
        <li>
            <p class="clearfix"><span>收益</span> <span><?php echo $v['JEJL']; ?></span></p>
            <p  class="clearfix"><span><?php echo date("Y-m-d",$v['create_time']); ?></span> <span><?php echo $v['integral']; ?></span></p>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
    <!-- 加载提示符 -->
    <div class="infinite-scroll-preloader">
        <div class="preloader"></div>
    </div>
<script>
    var navOffset=$(".bar").offset().top;
    // var number=1;
    // var falg=true;
    // var html='';
    // /*加载更多*/
    // $(window).scroll(function() {
    //     var scrollTop = $(this).scrollTop();
    //     var scrollHeight = document.body.scrollHeight==0 ? document.documentElement.scrollHeight:document.body.scrollHeight;
    //     var windowHeight = $(this).height();
    //     if(scrollTop + windowHeight == scrollHeight && falg){
    //         number++;
    //         if(falg){
    //             $.ajax({
    //                 type: "POST",  //提交方式
    //                 url: "",//路径
    //                 data: {
    //                     "page": number,
    //                 },
    //                 success: function (result) {
    //                     if(result.error){
    //                         var htmlBtn ="<button style='width: 100%;height: 2rem;border: none;text-align: center;line-height: 2rem;font-size: 0.5rem'>没有更多了</button>";
    //                         $('.infinite-scroll-preloader').html(htmlBtn);
    //                         falg=false;
    //                         return false;
    //                     }
    //                     for(var i = 0;i <= result.data.length-1;i++) {
    //                         html += '  <li><p class="clearfix"><span>收益</span> <span>+20</span></p><p  class="clearfix"><span>2018-11-23</span> <span>18080</span></p> </li>';
    //                     }
    //                     // 添加新条目
    //                     $('.mx-List').append(html);
    //                 }
    //             });
    //         }
    //     }
    // })
</script>
</body>
</html>