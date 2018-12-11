<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\index\index.html";i:1544270236;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>首页</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm.min.css">
    <link rel="stylesheet" href="http://g.alicdn.com/msui/sm/0.6.2/css/sm-extend.min.css">
    <script type='text/javascript' src='http://g.alicdn.com/sj/lib/zepto/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='http://g.alicdn.com/msui/sm/0.6.2/js/sm.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='http://g.alicdn.com/msui/sm/0.6.2/js/sm-extend.min.js' charset='utf-8'></script>
    <script src="/static/index/javaScript/dist/js/swiper.min.js"></script>
    <link rel="stylesheet" href="/static/index/javaScript/dist/css/swiper.min.css"/>
    <script src="/static/index/javaScript/public.js"></script>
    <link rel="stylesheet" href="/static/index/css/index.css"/>
    <link rel="stylesheet" href="/static/index/css/public.css"/>
</head>
<body>
<!--<header class="bar bar-nav">-->
<!--<a class="button button-link button-nav pull-left" data-transition='slide-out'>-->
<!--<span class="icon icon-left" style="color: #000" onclick="gofu()"></span>-->
<!--</a>-->
<!--<h1 class="title">智慧树</h1>-->
<!--</header>-->
<!-- Slider -->
<div class="swiper-container clearfix" data-space-between='8'>
    <div class="swiper-wrapper clearfix">
        <div class="swiper-slide"><img src="/static/index/images/banner1.png" alt=""></div>
        <div class="swiper-slide"><img src="/static/index/images/banner2.png" alt=""></div>
        <div class="swiper-slide"><img src="/static/index/images/banner3.png" alt=""></div>
        <!--<div class="swiper-wrapper clearfix">-->
        <!--<div class="swiper-slide"><img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i1/TB1n3rZHFXXXXX9XFXXXXXXXXXX_!!0-item_pic.jpg_320x320q60.jpg" alt=""></div>-->
        <!--<div class="swiper-slide"><img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i4/TB10rkPGVXXXXXGapXXXXXXXXXX_!!0-item_pic.jpg_320x320q60.jpg" alt=""></div>-->
        <!--<div class="swiper-slide"><img src="http://gqianniu.alicdn.com/bao/uploaded/i4//tfscom/i1/TB1kQI3HpXXXXbSXFXXXXXXXXXX_!!0-item_pic.jpg_320x320q60.jpg" alt=""></div>-->
        <!--</div>-->
    </div>
</div>
<!--课程分类-->
<div class="less-ke">
    <p class="ke-list-title">课程分类</p>
    <div class="ke-list-box clearfix" style="background-color: #fff;padding-bottom: 0.1rem">
        <?php if(is_array($catelist) || $catelist instanceof \think\Collection || $catelist instanceof \think\Paginator): $k = 0; $__LIST__ = $catelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
        <!--<input type="hidden" name="id" class="cat_id" value="<?php echo $v['id']; ?>">-->
        <div class="ke-box ke-box1 " cat_id="<?php echo $v['id']; ?>" first_id="<?php echo $catelist[0]['id']; ?>"><img <?php if(empty($v['url'])): ?>src="/static/index/images/1.png"
                                                                                  <?php else: ?>src="<?php echo $v['url']; ?>" <?php endif; ?>}
            alt=""/><span><?php echo $v['cat_name']; ?></span>
            <p <?php if($k == 1): ?>class="ke-active" <?php endif; ?> value = "<?php echo $v['id']; ?>"></p></div>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        <div class="ke-box" >
            <img src="/static/index/images/1.png"  alt=""/>
            <span>期待更多</span>
        </div>
    </div>
    <div style="border-bottom:solid 2px #d6d6d6;">
    </div>
    <div class="guanggao-box">
        <div class="gundong-box2" style="margin-top: 0">
            <?php if(is_array($newdata) || $newdata instanceof \think\Collection || $newdata instanceof \think\Paginator): $k = 0; $__LIST__ = $newdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
            <p class="jp-ke"><img src="/static/index/images/laba.png" alt=""/><span><?php echo $v['title']; ?></span></p>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>


<!--班级列表-->
<!--<p class="class-title">班级列表</p>-->
<div class="class">
    <div class="class-list clearfix">

    </div>
    <div class="infinite-scroll-preloader" style="padding-bottom: 11rem;display: none">
        <div class="preloader1">加载更多</div>
    </div>
</div>

<div class="class" style="display: none">
    <div class="class-list clearfix">

    </div>
    <div class="infinite-scroll-preloader" style="padding-bottom: 11rem;display: none">
        <div class="preloader1">加载更多</div>
    </div>
</div>

<div class="class" style="display: none">
    <div class="class-list clearfix">

    </div>
    <div class="infinite-scroll-preloader" style="padding-bottom: 11rem;display: none">
        <div class="preloader1">加载更多</div>
    </div>
</div>

<div class="class" style="display: none">
    <div class="class-list clearfix">

    </div>
    <div class="infinite-scroll-preloader" style="padding-bottom: 11rem;display: none">
        <div class="preloader1">加载更多</div>
    </div>
</div>


<nav class="nav">
    <a href="<?php echo url('customer/compound'); ?>">
        <img src="/static/index/images/zhu2.png" alt=""/>
        <p>复利</p>
    </a>
    <a href="<?php echo url('index/index'); ?>" class="tab-active">
        <img src="/static/index/images/home2.png" alt=""/>
        <p>首页</p>
    </a>
    <a href="<?php echo url('customer/index'); ?>">
        <img src="/static/index/images/I.png" alt=""/>
        <p>我的</p>
    </a>
</nav>


<div class="qiandao" style="display: block" value="1">
    <div class="qiandao-box">
        <span class="cha"> × </span>
        <p class="qidao-title">每日签到</p>
        <div class="qiandao-list">
            <?php if(is_array($integraldata) || $integraldata instanceof \think\Collection || $integraldata instanceof \think\Paginator): $k = 0; $__LIST__ = $integraldata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?>
            <div><img <?php if($k == 7): ?>src="/static/index/images/bao.png"
                      <?php else: ?>src="/static/index/images/bi.png" <?php endif; ?> class="bi" alt=""/><span><?php echo $v['integral']; ?>积分</span> <img
                    src="/static/index/images/dui.png" class="dui" alt=""/></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <button>签到</button>
    </div>
</div>

<script>

    $(function () {
        var cat_id;
        var number = 1;
        var falg = true;
        cat_id = $(".ke-box").attr("first_id");
        $(".infinite-scroll-preloader").css('display', 'block');
        $("body").css("overflow", "visible")
        $.ajax({
            type: "POST",  //提交方式
            url: "<?php echo url('Index/getCourse'); ?>",//路径
            data: {
                "cat_id": cat_id,
                "pageSize": 8,
                "pageNumber": 1
            },
            success: function (result) {
                if (result.code == -1) {
                    var htmlBtn = "<button style='width: 100%;height: 2rem;border: none;text-align: center;line-height: 2rem;font-size: 0.5rem'>没有更多了</button>";
                    $('.infinite-scroll-preloader').html(htmlBtn);
                    $('.class-list').html("");
                    // number=1
                    return false;
                }
                var html = "";
                for (var i = 0; i <= result.data.length - 1; i++) {
                    html += ' <div class="class-list-box clearfix">' +
                            '<a href=' + result.data[i]['link_url'] + '>'+
                        ' <img src=' + result.data[i].thumb + ' alt=""/> ' +
                        '<div class="right-list"><p class="list-title">' + result.data[i].title + '</p> ' +
                        '<p class="list-title2">' + result.data[i].desc + '</p> ' +
                        '</div> </a>' +
                        '</div>';
                }
                // 添加新条目
                $('.class-list').html(html);
            }
        });
        $(".guanggao-box").css("height", $(".guanggao-box .jp-ke").css("height"))
        var mtop = parseInt($(".gundong-box2").css("marginTop"));
        setInterval(function () {
            mtop += parseInt($(".gundong-box2 .jp-ke").css("height"));
            $(".gundong-box2").css("margin-top", -mtop);
            if (parseInt($(".gundong-box2").css("margin-top")) === -($(".gundong-box2 .jp-ke").length * parseInt($(".gundong-box2 .jp-ke").css("height")))) {
                $(".gundong-box2").css("margin-top", 0);
                mtop = 0;
            }
        }, 3000)


        $(".cha").click(function () {
            $(".qiandao").css("display", "none");
            $("body").css("overflow", "visible");
        });

        //判断是否登录
        var uid;
        $.ajax({
            type: "POST",  //提交方式
            url: "<?php echo url('Index/isLoginUser'); ?>",//路径
            data: {},
            async: false,
            success: function (result) {
                // if (result.code == -1) {
                //     setTimeout(function () {
                //         $.toast(result.msg);
                //         location.href = "<?php echo url('login/login'); ?>";
                //         return false;
                //     }, 2000);
                // }
                if (result.code == 0) {
                    uid = result.data;
                }
            }
        });

        //判断是否已签到
        $.ajax({
            type: "POST",  //提交方式
            url: "<?php echo url('Customer/isSign'); ?>",//路径
            data: {
                uid: uid,
            },
            async: false,
            success: function (result) {
                if (result.code == -1) {
                    $(".qiandao").css("display", "none");
                    $("body").css("overflow", "visible")
                }
                if (result.code == 0) {
                    $(".qiandao").css("display", "block");
                    $("body").css("overflow", "visible")
                }
            }
        });

        //签到
        $(".qiandao button").click(function () {
            $(".qiandao").css("display", "none");
            $("body").css("overflow", "visible");
            $(".qiandao").attr("value", "");
            $.ajax({
                type: "POST",  //提交方式
                url: "<?php echo url('Index/isLoginUser'); ?>",//路径
                data: {},
                async: false,
                success: function (result) {
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
                type: "POST",  //提交方式
                url: "<?php echo url('Customer/sign'); ?>",//路径
                data: {
                    "uid": uid,
                    "tag": "sign"
                },
                success: function (result) {
                    if (result.code == -1) {
                        $.toast(result.msg)
                        return false;
                    }

                    if (result.code == 2) {
                        $.toast(result.msg);
                        return false;
                    }

                    if (result.code == 0) {
                        setTimeout(function () {
                            $.toast(result.msg)
                        }, 2000);
                        $(".qiandao").css("display", "none");
                        $("body").css("overflow", "visible")
                    }
                }
            });

        });

        //    if($(".qiandao").attr("value")==="1"){
        //        $("body").css("overflow","hidden")
        //    }

        // $(".qiandao button").click(function () {
        //     $(".qiandao").css("display", "none");
        //     $("body").css("overflow", "visible")
        //     $(".qiandao").attr("value", "")
        //     $.toast("签到成功")
        // });


        var swiper = new Swiper('.swiper-container', {
            autoplay: 3000,
            speed: 1000,
            autoplayDisableOnInteraction: false,
            loop: true,
            spaceBetween: -130,
            centeredSlides: true,
            slidesPerView: 100,
            pagination: '.swiper-pagination',
            paginationClickable: true,
            onInit: function (swiper) {
                swiper.slides[2].className = "swiper-slide swiper-slide-active";//第一次打开不要动画
            },
            breakpoints: {
                //当宽度小于等于320
                320: {
                    slidesPerView: 1.1,
                    spaceBetween: 3
                },
                //当宽度小于等于480
                480: {
                    slidesPerView: 1.1,
                    spaceBetween: 3
                },
                //当宽度小于等于640
                640: {
                    slidesPerView: 1.1,
                    spaceBetween: 3
                }
            }
        });

        //课程分类切换
        $(".ke-box1").click(function () {
            $(".infinite-scroll-preloader").html('<div class="preloader1">加载更多</div>');
            falg = true;
            $(".ke-box span").css("color", " #000");
            $(this).children("span").css("color", " #f07681");
            $(".ke-box p").removeClass("ke-active")
            $(this).children("p").addClass("ke-active");
            cat_id = $(this).attr("cat_id");
            $(".infinite-scroll-preloader").css('display', 'block');
            $.ajax({
                type: "POST",  //提交方式
                url: "<?php echo url('Index/getCourse'); ?>",//路径
                data: {
                    "cat_id": cat_id,
                    "pageSize": 8,
                    "pageNumber": number
                },
                success: function (result) {
                    if (result.code == -1) {
                        var htmlBtn = "<button class='nodata' style='width: 100%;height: 2rem;border: none;text-align: center;line-height: 2rem;font-size: 0.5rem;display: block'>没有更多了</button>";
                        $('.infinite-scroll-preloader').html(htmlBtn);
                        $('.class-list').html("");
                        // number=1
                        return false;
                    }

                    var html = "";
                    for (var i = 0; i <= result.data.length - 1; i++) {
                        html += ' <div class="class-list-box clearfix">' +
                                '<a href=' + result.data[i]['link_url'] + '>'+
                            ' <img src=' + result.data[i].thumb + ' alt=""/> ' +
                            '<div class="right-list"> <p class="list-title">' + result.data[i].title + '</p> ' +
                            '<p class="list-title2">' + result.data[i].desc + '</p> ' +
                            '</div> </a>' +
                            '</div>';
                    }
                    // html += '<div class="infinite-scroll-preloader" style="padding-bottom: 11rem">' +
                    //     '<div class="preloader1">加载更多</div>' +
                    //     '</div>';
                    // 添加新条目
                    $('.class-list').html(html);
                }
            });
        });
        // $(".ke-box").click(function () {
        //     $(".ke-box span").css("color", " #000");
        //     $(this).children("span").css("color", " #f07681");
        //     $(".ke-box p").removeClass("ke-active")
        //     $(this).children("p").addClass("ke-active");
        // });
        var number = 1;
        var falg = true;
        var html = '';
        /*加载更多*/
        $(".infinite-scroll-preloader").bind("click", ".preloader1", function () {
            html = "";
            number++;
            if (falg) {
                $.ajax({
                    type: "POST",  //提交方式
                    url: "<?php echo url('Index/getCourse'); ?>",//路径
                    data: {
                        "cat_id": cat_id,
                        "pageSize": 8,
                        "pageNumber": number
                    },
                    success: function (result) {
                        if (result.code == -1) {
                            var htmlBtn = "<button class='nodata' style='width: 100%;height: 2rem;border: none;text-align: center;line-height: 2rem;font-size: 0.5rem;display: block'>没有更多了</button>";
                            $('.infinite-scroll-preloader').html(htmlBtn);
                            falg = false;
                            number = 1;
                            return false;
                        } else {
                            for (var i = 0; i <= result.data.length - 1; i++) {
                                html += ' <div class="class-list-box clearfix">' +
                                        '<a href=' + result.data[i]['link_url'] + '>'+
                                    ' <img src=' + result.data[i].thumb + ' alt=""/> ' +
                                    '<div class="right-list"> <p class="list-title">' + result.data[i].title + '</p> ' +
                                    '<p class="list-title2">' + result.data[i].desc + '</p> ' +
                                    '</div> </a>' +
                                    '</div>';
                            }
                            // 添加新条目
                            $('.class-list').append(html);
                        }

                    }
                });
            }
        });
        $(".swiper-slide").click(function () {
            window.location.href = "<?php echo url('index/notice'); ?>";
        })
    })


</script>
</body>
</html>