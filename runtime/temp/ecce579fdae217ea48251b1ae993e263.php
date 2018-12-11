<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:93:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/admin\view\customer\findcourse.html";i:1542958915;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>课程进度查询</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/bootstrap-table/bootstrap-table-pagejump.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>课程进度查询</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->
            <!--<form id='commentForm' role="form" method="post" class="form-inline pull-right">-->
                <!--<div class="content clearfix m-b">-->
                    <!--<div class="form-group">-->
                        <!--<label>标题：</label>-->
                        <!--<input type="text" class="form-control" id="title" name="title">-->
                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <!--<button class="btn btn-primary" type="button" style="margin-top:5px" id="search"><strong>搜 索</strong>-->
                        <!--</button>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</form>-->
            <!--搜索框结束-->

            <div class="example-wrap">
                <div class="example">
                    <table class="table">
                        <thead>
                        <tr>
                            <th data-field="username">用户名</th>
                            <th data-field="title">课程</th>
                            <th data-field="status">课程状态(已学习/总课时)</th>
                            <th data-field="over_time">完成时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($orderdata) || $orderdata instanceof \think\Collection || $orderdata instanceof \think\Paginator): $i = 0; $__LIST__ = $orderdata;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo $vo['username']; ?></td>
                            <td><?php echo $vo['title']; ?></td>
                            <td><?php echo $vo['status']; ?></td>
                            <td><?php echo $vo['over_time']; ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
</div>
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/content.min.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table-mobile.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js"></script>
<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/admin/js/plugins/layer/layer.min.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table-pagejump.js"></script>
<script src="/static/admin/js/plugins/bootstrap-table/bootstrap-table-zh-CN.js"></script>
</body>
</html>
