<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/admin\view\stat\index.html";i:1542787834;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户积分统计管理</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="__CSS__/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__CSS__/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="__CSS__/animate.min.css" rel="stylesheet">
    <link href="__CSS__/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="__CSS__/plugins/sweetalert/sweetalert.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>用户积分统计列表</h5>
            </div>
            <div class="ibox-content">
                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>签到积分统计</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="echarts" id="echarts-line-chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>每日复利统计</h5>

                        </div>
                        <div class="ibox-content">
                            <div class="echarts" id="echarts-line-compound"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>课程进展统计</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="echarts" id="echarts-line-course"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>用户统计</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="echarts" id="echarts-line-user"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>推荐人统计</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="echarts" id="echarts-line-recommend"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>
<!-- 角色分配 -->
<div class="col-sm-12" style="display: none" id="wait">
    <div class="ibox ">
        <div class="ibox-content">
            <div class="spiner-example">
                <div class="sk-spinner sk-spinner-three-bounce">
                    <div class="sk-bounce1"></div>
                    <div class="sk-bounce2"></div>
                    <div class="sk-bounce3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="__JS__/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="__JS__/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="__JS__/plugins/suggest/bootstrap-suggest.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/sweetalert/sweetalert.min.js"></script>
<script src="__JS__/plugins/layer/layer.min.js"></script>
<script src="__JS__/plugins/echarts/echarts-all.js"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<!--<script src="__JS__/demo/echarts-demo.min.js"></script>-->
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
<script type="text/javascript">
    $(function () {
        var data = data=eval(<?php echo json_encode($signdata);?>);
        console.log(data);

        var e = echarts.init(document.getElementById("echarts-line-chart")), a = {
            title: {text: "一周签到积分变化"},
            tooltip: {trigger: "axis"},
            legend: {data: ["最高积分", "最低积分"]},
            grid: {x: 40, x2: 40, y2: 24},
            calculable: !0,
            xAxis: [{type: "category", boundaryGap: !1, data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]}],
            yAxis: [{type: "value", axisLabel: {formatter: "{value}"}}],
            series: [{
                name: "最高积分",
                type: "line",
                data: [data['monmax'],data['tuemax'],data['wedmax'],data['thumax'],data['frimax'],data['satmax'],data['weekmax']],
                markPoint: {data: [{type: "max", name: "最大值"}, {type: "min", name: "最大值"}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            }, {
                name: "最低积分",
                type: "line",
                data: [data['monmin'],data['tuemin'],data['wedmin'],data['thumin'],data['frimin'],data['satmin'],data['weekmin']],
                markPoint: {data: [{name: "周最低", value: data['maxdata'], xAxis: 1, yAxis: -1.5}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            }]
        };
        e.setOption(a), $(window).resize(e.resize);
    });
    $(function () {
        var compounddata = data=eval(<?php echo json_encode($compounddata);?>);
        var f = echarts.init(document.getElementById("echarts-line-compound")), a = {
            title: {text: "一周每日复利积分变化"},
            tooltip: {trigger: "axis"},
            legend: {data: ["最高积分", "最低积分"]},
            grid: {x: 40, x2: 40, y2: 24},
            calculable: !0,
            xAxis: [{type: "category", boundaryGap: !1, data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]}],
            yAxis: [{type: "value", axisLabel: {formatter: "{value}"}}],
            series: [{
                name: "最高积分",
                type: "line",
                data: [compounddata['monmax'],compounddata['tuemax'],compounddata['wedmax'],compounddata['thumax'],compounddata['frimax'],compounddata['satmax'],compounddata['weekmax']],
                markPoint: {data: [{type: "max", name: "最大值"}, {type: "min", name: "最大值"}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            }, {
                name: "最低积分",
                type: "line",
                data: [compounddata['monmin'],compounddata['tuemin'],compounddata['wedmin'],compounddata['thumin'],compounddata['frimin'],compounddata['satmin'],compounddata['weekmin']],
                markPoint: {data: [{name: "周最低", value: data['maxdata'], xAxis: 1, yAxis: -1.5}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            }]
        };
        f.setOption(a), $(window).resize(f.resize);
    })

    $(function () {
        var userdata = data=eval(<?php echo json_encode($userdata);?>);
        var g = echarts.init(document.getElementById("echarts-line-user")), a = {
            title: {text: "一周每日用户注册变化"},
            tooltip: {trigger: "axis"},
            legend: {data: ["注册人数"]},
            grid: {x: 40, x2: 40, y2: 24},
            calculable: !0,
            xAxis: [{type: "category", boundaryGap: !1, data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]}],
            yAxis: [{type: "value", axisLabel: {formatter: "{value}"}}],
            series: [{
                name: "注册人数",
                type: "line",
                data: [userdata['monmax'],userdata['tuemax'],userdata['wedmax'],userdata['thumax'],userdata['frimax'],userdata['satmax'],userdata['weekmax']],
                markPoint: {data: [{type: "max", name: "注册人数"}, {type: "min", name: "注册人数"}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            }, ]
        };
        g.setOption(a), $(window).resize(g.resize);
    })

    $(function () {
        var userdata = data=eval(<?php echo json_encode($userdata);?>);
        var g = echarts.init(document.getElementById("echarts-line-user")), a = {
            title: {text: "一周每日用户注册变化"},
            tooltip: {trigger: "axis"},
            legend: {data: ["注册人数"]},
            grid: {x: 40, x2: 40, y2: 24},
            calculable: !0,
            xAxis: [{type: "category", boundaryGap: !1, data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]}],
            yAxis: [{type: "value", axisLabel: {formatter: "{value}"}}],
            series: [{
                name: "注册人数",
                type: "line",
                data: [userdata['monmax'],userdata['tuemax'],userdata['wedmax'],userdata['thumax'],userdata['frimax'],userdata['satmax'],userdata['weekmax']],
                markPoint: {data: [{type: "max", name: "注册人数"}, {type: "min", name: "注册人数"}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            }, ]
        };
        g.setOption(a), $(window).resize(g.resize);
    })

    $(function () {
        var recommenddata = data=eval(<?php echo json_encode($recommenddata);?>);
        var g = echarts.init(document.getElementById("echarts-line-recommend")), a = {
            title: {text: "一周每日推荐人变化"},
            tooltip: {trigger: "axis"},
            legend: {data: ["推荐人数"]},
            grid: {x: 40, x2: 40, y2: 24},
            calculable: !0,
            xAxis: [{type: "category", boundaryGap: !1, data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]}],
            yAxis: [{type: "value", axisLabel: {formatter: "{value}"}}],
            series: [{
                name: "推荐人数",
                type: "line",
                data: [recommenddata['monmax'], recommenddata['tuemax'], recommenddata['wedmax'], recommenddata['thumax'], recommenddata['frimax'], recommenddata['satmax'], recommenddata['weekmax']],
                markPoint: {data: [{type: "max", name: "推荐人数"}, {type: "min", name: "推荐人数"}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            },]
        };
        g.setOption(a), $(window).resize(g.resize);
    })

    $(function () {
        var coursedata = data=eval(<?php echo json_encode($coursedata);?>);
        var g = echarts.init(document.getElementById("echarts-line-course")), a = {
            title: {text: "一周每日课程进展变化"},
            tooltip: {trigger: "axis"},
            legend: {data: ["课程进展"]},
            grid: {x: 40, x2: 40, y2: 24},
            calculable: !0,
            xAxis: [{type: "category", boundaryGap: !1, data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]}],
            yAxis: [{type: "value", axisLabel: {formatter: "{value}"}}],
            series: [{
                name: "课程进展",
                type: "line",
                data: [coursedata['monmax'], coursedata['tuemax'], coursedata['wedmax'], coursedata['thumax'], coursedata['frimax'], coursedata['satmax'], coursedata['weekmax']],
                markPoint: {data: [{type: "max", name: "课程进展"}, {type: "min", name: "课程进展"}]},
                markLine: {data: [{type: "average", name: "平均值"}]}
            },]
        };
        g.setOption(a), $(window).resize(g.resize);
    })
</script>
</body>
</html>
