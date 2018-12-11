<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\myaddress.html";i:1544068759;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>地址列表</title>
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
    <!--<link rel="stylesheet" href="/static/index/css/shenfen.css"/>-->
    <style>
        html, body {
            background-color: #f2f2f2;
        }

        .them {
            margin-top: 2.2rem;
        }

        .them .ress {
            padding: 0.5rem 1rem;
            background: #FFFFFF;
            overflow: hidden;
            border-bottom: 1px solid #cccccc;
            position: relative;
        }

        .them .ress-box {
            position: relative;
        }

        .them .ress-box .dian {
            display: inline-block;
            width: 0.8rem;
            height: 0.8rem;
            border: 1px solid #000;
            border-radius: 50%;
            margin-top: 1rem;
            position: absolute;
            top: 0rem;
            left: 0rem;
        }

        .them .ress-box .name {
            font-size: 0.9rem;
            margin-left: 2rem;
        }

        .them .ress-box .tell {
            color: #797979;
        }

        .them .dizhi-text {
            margin-left: 2rem;
            padding-right: 2rem;
        }

        .them .dizhi-text .mo {
            display: inline-block;
            width: 2rem;
            height: 1rem;
            background: #fe9d37;
            text-align: center;
            color: #FFFFFF;
            line-height: 1rem;
            border-radius: 0.5rem;
        }

        .them .ress a {
            position: absolute;
            top: 1rem;
            right: 0.5rem;
            color: #aaa;
        }

        nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2.2rem;
            background-color: #fff;
        }

        nav a {
            display: block;
            width: 2rem;
            height: 2rem;
            margin: 0 auto;
        }

        nav a img {
            display: block;
            width: 1.5rem;
            height: 1.5rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gourl()"></span>
    </a>
    <img class="pull-right" id="delAddress" src="/static/index/images/delete.png"
         style="color: #000;font-size: 0.8rem;margin-top: 0.5rem;position: relative;z-index: 999999;width: 1.1rem;height: 1rem;">
    <h1 class="title">地址列表</h1>
</header>
<div class="them">
    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
    <div class="ress" id="1">
        <p class="ress-box"><span class="dian" value="1" address_id="<?php echo $v['id']; ?>"></span><span
                class="name"><?php echo $v['link_name']; ?> </span><span
                class="tell"><?php echo $v['phone']; ?></span></p>
        <p class="dizhi-text"><?php if($v['status'] == 1): ?><span class="mo">默认</span><?php endif; ?> <span><?php echo $v['address']; ?></span>
        </p>
        <a href="<?php echo url('customer/saveaddress',array('id'=>$v['id'])); ?>">编辑</a>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<nav>
    <a href="<?php echo url('customer/addaddress'); ?>"><img src="/static/index/images/jia.png" alt=""/></a>
</nav>
<script>
    $(function () {

        var address_arr = new Array();
        var address_id;
        $(".ress-box .dian").click(function () {
            address_id = $(this).attr("address_id");
            if ($(this).attr("value") == "1") {
                $(this).attr("value", "0");
                $(this).css("background", "#fcdc08");
                address_arr.push(address_id)
            } else {
                $(this).attr("value", "1")
                $(this).css("background", "#ffffff");
                // address_arr.unshift(address_id);
                address_arr.splice($.inArray(address_id, address_arr),1);
            }
            console.log(address_arr)
        });

        $("#delAddress").click(function () {
            var address_str = address_arr.join(",");
            // console.log(address_arr);
            $.ajax({
                type: "POST",
                url: "<?php echo url('customer/deladdress'); ?>",
                data: {
                    data:address_str,
                },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    if (data.code === -1) {
                        $.toast(data.msg);
                    } else {
                        $.toast(data.msg);
                        location.reload();
                    }
                }
            });
        })


        $("header .pull-right").bind("click", function () {
            var arrID = [];
            var htmlID = $(".dian[value*='1']").parents(".ress");
            for (var i = 0; i < htmlID.length; i++) {

            }


//            $.ajax({
//                type:"POST",
//                url:"",
//                data:{
//                    name:$(".sh-name").val(),
//                    tell:$(".sh-name1").val(),
//                    diqu:$(".sh-name2").val(),
//                    dizhi:$(".sh-name3").val(),
//                    moren:$(this).attr("value")
//                },
//                dataType: "json",
//                success: function(data) {
//                    if(data.error===false){
//                        $.toast(data.msg);
//                    }else{
//                        $.toast(data.msg);
//                    }
//                }
//            });
        })

    })

    function gourl() {
        location.href = "<?php echo url('customer/index'); ?>";
    }

</script>
</body>
</html>