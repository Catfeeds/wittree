<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:91:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\compound.html";i:1544260819;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>用户复利页面</title>
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
    <script src="/static/index/javaScript/echarts..js"></script>
    <!--<script src="/static/index/javaScript/jquery.js"></script>-->
    <link rel="stylesheet" href="/static/index/css/compound-interest.css"/>
    <link rel="stylesheet" href="/static/index/css/public.css"/>
</head>
<body>
<!--<header class="bar bar-nav">-->
    <!--<a class="button button-link button-nav pull-left" data-transition='slide-out'>-->
        <!--<span class="icon icon-left" style="color: #000" onclick="gofu()"></span>-->
    <!--</a>-->
    <!--<h1 class="title">复利</h1>-->
<!--</header>-->
<!--顶部黄色-->
<div class="top-o">
    <p class="sy-title">昨日收益(分)</p>
    <span class="top-img"><a href="<?php echo url('customer/earnshow'); ?>"><img src="/static/index/images/oder.png" alt=""/></a><a
            href="<?php echo url('customer/earndetail'); ?>"><img src="/static/index/images/flList.png" alt=""/></a></span>
    <p class="sy-number"><?php echo $data['yesterdayearn']; ?></p>
    <p class="jifen">总积分&nbsp;<?php echo $data['totalearn']; ?> &nbsp;分</p>
    <div class="detailed clearfix">
        <div class="detailed1">
            <span>累计收益（分）</span>
            <span><?php echo $data['totalearn']; ?></span>
            <i class="line"></i>
        </div>
        <div class="detailed2">
            <span>七日收益（分）</span>
            <span><?php echo $data['sevenearn']; ?></span>
        </div>
    </div>
</div>

<!--抽奖按钮-->

<div class="draw">
    <div class="draw-btn clearfix">
        <a href="#" class="qiandao-box">签到</a>
        <a href="<?php echo url('customer/compoundrank'); ?>">排行榜</a>
        <a href="<?php echo url('customer/draw'); ?>">抽奖</a>
    </div>
</div>

<!--趋势图-->
<div class="ech-box">
    <p class="ech-title">七日收益趋势（分）</p>
    <div id="main" style="width: 100%;height:16rem;padding-bottom:3rem;margin-top: -2rem;"></div>
</div>

<div class="qiandao" id="qiandao121212" style="display: block" value="1">
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
        <button class="qiandao-btn">签到</button>
    </div>
</div>


<nav class="nav">
    <a href="<?php echo url('customer/compound'); ?>">
        <img src="/static/index/images/zhu.png" alt=""/>
        <p>复利</p>
    </a>
    <a href="<?php echo url('index/index'); ?>" class="tab-active">
        <img src="/static/index/images/home.png" alt=""/>
        <p>首页</p>
    </a>
    <a href="<?php echo url('customer/index'); ?>">
        <img src="/static/index/images/I.png" alt=""/>
        <p>我的</p>
    </a>
</nav>
<script>
    $(function () {
        var uid = <?php echo $user['id']; ?>;
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
                    $("body").css("overflow", "visible");
                } else {
                    $(".qiandao").css("display", "block");
                    $("body").css("overflow", "visible")
                }
            }
        });

        $(".qiandao-box").click(function () {
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
                        $.toast(result.msg);
                        $(".qiandao121212").css("display", "none");
                        $("body").css("overflow", "visible")
                    } else {
                        $(".qiandao121212").css("display", "block");
                    }
                }
            });

        });

        $(".cha").click(function () {
            $("body").css("overflow","visible")
            $("#qiandao121212").css("opacity","0");
            $("#qiandao121212").css("z-index","-99999");
        });
        //    if($(".qiandao").attr("value")==="1"){
        //        $("body").css("overflow","hidden")
        //    }

        $(".qiandao .qiandao-btn").click(function () {
            //签到
            $(".qiandao button").click(function () {

                $(".qiandao").css("display", "none");
                $("body").css("overflow", "visible");
                $(".qiandao").attr("value", "");
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
        });

        var firstdata = <?php echo json_encode($firstdata); ?>;
        var twodata = <?php echo json_encode($twodata); ?>;
        var threedata = <?php echo json_encode($threedata); ?>;
        var fourdata = <?php echo json_encode($fourdata); ?>;
        var fivedata = <?php echo json_encode($fivedata); ?>;
        var sixdata = <?php echo json_encode($sixdata); ?>;
        var sevendata = <?php echo json_encode($sevendata); ?>;
        var d1 = new Date();
        //前一天
        var d2 = new Date(d1.getTime() - 24 * 60 * 60 * 1000);
        //前两天
        var d3 = new Date(d1.getTime() - 48 * 60 * 60 * 1000);
        //前三天
        var d4 = new Date(d1.getTime() - 72 * 60 * 60 * 1000);
        //前四天
        var d5 = new Date(d1.getTime() - 96 * 60 * 60 * 1000);
        //前五天
        var d6 = new Date(d1.getTime() - 120 * 60 * 60 * 1000);
        //前六天
        var d7 = new Date(d1.getTime() - 144 * 60 * 60 * 1000);

        var dataList = [(d7.getMonth() + 1) + "-" + d7.getDate(), (d6.getMonth() + 1) + "-" + d6.getDate(), (d5.getMonth() + 1) + "-" + d5.getDate(), (d4.getMonth() + 1) + "-" + d4.getDate(), (d3.getMonth() + 1) + "-" + d3.getDate(), (d2.getMonth() + 1) + "-" + d2.getDate(), (d1.getMonth() + 1) + "-" + d1.getDate()]
        var myChart = echarts.init(document.getElementById('main'));
        option = {
            xAxis: {
                type: 'category',
                data: dataList,
                boundaryGap: false,
                splitLine: {show: false},
                axisLine: {
                    lineStyle: {
                        color: '#bfbfbf'
                    }
                }
            },
            yAxis: {
                type: 'value',
                boundaryGap: false,
                splitLine: {show: false},
                axisLine: {
                    lineStyle: {
                        color: '#bfbfbf'
                    }
                }
            },
            series: [{
                data: [firstdata['integral'], twodata['integral'], threedata['integral'], fourdata['integral'], fivedata['integral'], sixdata['integral'], sevendata['integral']],
                type: 'line',
                symbolSize: 8,
                color: ['#fd8650'],
                symbol: 'circle'
            }]
        };
        myChart.setOption(option);
    })
</script>
</body>
</html>