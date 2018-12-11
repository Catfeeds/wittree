<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/index\view\customer\stat.html";i:1544256735;}*/ ?>
<!DOCTYPE html>
<html style="font-size: 20px">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>统计页面</title>
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
<header class="bar bar-nav">
    <a class="button button-link button-nav pull-left" data-transition='slide-out'>
        <span class="icon icon-left" style="color: #000" onclick="gofu()"></span>
    </a>
    <h1 class="title">统计</h1>
</header>
<!--顶部黄色-->
<div class="top-o">

</div>
<!--趋势图-->
<div class="ech-box">
    <p class="ech-title">本周签到积分变化（分）</p>
    <div id="main" style="width: 100%;height:16rem;padding-bottom:3rem;margin-top: -2rem;"></div>
</div>
<div class="ech-box">
    <p class="ech-title">本周复利积分变化（分）</p>
    <div id="compound" style="width: 100%;height:16rem;padding-bottom:3rem;margin-top: -2rem;"></div>
</div>
<div class="ech-box">
    <p class="ech-title">本周课程进展变化（课时）</p>
    <div id="course" style="width: 100%;height:16rem;padding-bottom:3rem;margin-top: -2rem;"></div>
</div>
<div class="ech-box">
    <p class="ech-title">本周用户注册变化（人）</p>
    <div id="register" style="width: 100%;height:16rem;padding-bottom:3rem;margin-top: -2rem;"></div>
</div>
<div class="ech-box">
    <p class="ech-title">本周推荐人变化（人）</p>
    <div id="recommend" style="width: 100%;height:16rem;padding-bottom:3rem;margin-top: -2rem;"></div>
</div>

<script>
    $(function () {
        var data =eval(<?php echo json_encode($signdata);?>);
        var compounddata =eval(<?php echo json_encode($compounddata);?>);
        var userdata =eval(<?php echo json_encode($userdata);?>);
        var recommenddata =eval(<?php echo json_encode($recommenddata);?>);
        var coursedata =eval(<?php echo json_encode($coursedata);?>);
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

        var dataList = ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]
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
                data: [data['monsum'],data['tuesum'],data['wedsum'],data['thusum'],data['frisum'],data['satsum'],data['weeksum']],
                type: 'line',
                symbolSize: 8,
                color: ['#fd8650'],
                symbol: 'circle'
            },
            ]
        };
        myChart.setOption(option);

        //复利
        var compound = echarts.init(document.getElementById('compound'));
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
                data: [compounddata['monsum'],compounddata['tuesum'],compounddata['wedsum'],compounddata['thusum'],compounddata['frisum'],compounddata['satsum'],compounddata['weeksum']],
                type: 'line',
                symbolSize: 8,
                color: ['#fd8650'],
                symbol: 'circle'
            }]
        };
        compound.setOption(option);

        //课程进展
        var course = echarts.init(document.getElementById('course'));
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
                data: [coursedata['monsum'], coursedata['tuesum'], coursedata['wedsum'], coursedata['thusum'], coursedata['frisum'], coursedata['satsum'], coursedata['weeksum']],
                type: 'line',
                symbolSize: 8,
                color: ['#fd8650'],
                symbol: 'circle'
            }]
        };
        course.setOption(option);

        //用户注册变化
        var register = echarts.init(document.getElementById('register'));
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
                data: [userdata['monsum'],userdata['tuesum'],userdata['wedsum'],userdata['thusum'],userdata['frisum'],userdata['satsum'],userdata['weeksum']],
                type: 'line',
                symbolSize: 8,
                color: ['#fd8650'],
                symbol: 'circle'
            }]
        };
        register.setOption(option);

        //推荐人变化
        var recommend = echarts.init(document.getElementById('recommend'));
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
                data: [recommenddata['monsum'], recommenddata['tuesum'], recommenddata['wedsum'], recommenddata['thusum'], recommenddata['frisum'], recommenddata['satsum'], recommenddata['weeksum']],
                type: 'line',
                symbolSize: 8,
                color: ['#fd8650'],
                symbol: 'circle'
            }]
        };
        recommend.setOption(option);
    })
</script>
</body>
</html>