<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/admin\view\feedback\checkfeed.html";i:1542852499;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查看反馈信息</title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="/static/admin/js/layui/css/layui.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-10">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>编辑反馈信息</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="commentForm" method="post"
                          action="<?php echo url('feedback/feedbackedit'); ?>">
                        <input type="hidden" name="id" id="feed_id" value="<?php echo $feedback['id']; ?>">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户名：</label>
                            <div class="input-group col-sm-7">
                                <input id="username" type="text" class="form-control" name="username"
                                       value="<?php echo $feedback['username']; ?>" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">反馈类型：</label>
                            <div class="input-group col-sm-7">
                                <input id="type" class="form-control" name="type" value="<?php echo $feedback['type']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">缩略图：</label>
                            <input name="url" id="thumbnail" value="<?php echo $feedback['url']; ?>" type="hidden"/>
                            <div class="form-inline">
                                <div class="input-group col-sm-2">
                                    <button type="button" class="layui-btn" id="test1">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                                <div class="input-group col-sm-3">
                                    <div id="sm">
                                        <img src="<?php echo $feedback['url']; ?>" width="40px" height="40px"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">描述：</label>
                            <div class="input-group col-sm-7">
                                <textarea id="description" class="form-control" name="desc" required=""
                                          aria-required="true"><?php echo $feedback['desc']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">处理：</label>
                            <div class="input-group col-sm-6">
                                <?php if(is_array($feedbackstatus) || $feedbackstatus instanceof \think\Collection || $feedbackstatus instanceof \think\Paginator): if( count($feedbackstatus)==0 ) : echo "" ;else: foreach($feedbackstatus as $key=>$vo): ?>
                                <div class="radio i-checks col-sm-4">
                                    <label>
                                        <input type="radio" class="check_feed_status" value="<?php echo $key; ?>" <?php if($key == $feedback['status']): ?>checked<?php endif; ?> name="status">
                                        <i></i> <?php echo $vo; ?></label>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-8">
                                <!--<input type="button" value="提交" class="btn btn-primary" id="postform"/>-->
                                <button class="btn btn-primary" type="button" onclick="history.go(-1)">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/bootstrap.min.js?v=3.3.6"></script>
<script src="/static/admin/js/content.min.js?v=1.0.0"></script>
<script src="/static/admin/js/plugins/validate/jquery.validate.min.js"></script>
<script src="/static/admin/js/plugins/validate/messages_zh.min.js"></script>
<script src="/static/admin/js/plugins/iCheck/icheck.min.js"></script>
<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/admin/js/plugins/layer/layer.min.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script src="/static/admin/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="/static/admin/js/layui/layui.js"></script>
<script src="/static/admin/js/jquery.form.js"></script>
<script type="text/javascript">

    var index = '';

    function showStart() {
        index = layer.load(0, {shade: false});
        return true;
    }

    function showSuccess(res) {

        layer.ready(function () {
            layer.close(index);
            if (1 == res.code) {
                layer.alert(res.msg, {title: '友情提示', icon: 1, closeBtn: 0}, function () {
                    window.location.href = res.data;
                });
            } else if (111 == res.code) {
                window.location.reload();
            } else {
                layer.msg(res.msg, {anim: 6});
            }
        });
    }

    $(document).ready(function () {
        $(".i-checks").iCheck({checkboxClass: "icheckbox_square-green", radioClass: "iradio_square-green",});
        // 编辑角色
        var options = {
            beforeSubmit: showStart,
            success: showSuccess
        };

        $('#commentForm').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });

        $('#keywords').tagsinput('add', 'some tag');
        $(".bootstrap-tagsinput").addClass('col-sm-12').find('input').addClass('form-control')
            .attr('placeholder', '输入后按enter');

        // 上传图片
        layui.use('upload', function () {
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                , url: "<?php echo url('feedback/uploadImg'); ?>" //上传接口
                , done: function (res) {
                    //上传完毕回调
                    $("#thumbnail").val(res.data.src);
                    $("#sm").html('<img src="' + res.data.src + '" style="width:40px;height: 40px;"/>');
                }
                , error: function () {
                    //请求异常回调
                }
            });
        });
    });

    // 表单验证
    $.validator.setDefaults({
        highlight: function (e) {
            $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
        },
        success: function (e) {
            e.closest(".form-group").removeClass("has-error").addClass("has-success")
        },
        errorElement: "span",
        errorPlacement: function (e, r) {
            e.appendTo(r.is(":radio") || r.is(":checkbox") ? r.parent().parent().parent() : r.parent())
        },
        errorClass: "help-block m-b-none",
        validClass: "help-block m-b-none"
    });

    $(function () {
        $("input:radio[name='status']").on('ifChecked', function (event) {
            var status = $(this).val();
            var feed_id = eval(<?php echo json_encode($feedback['id']);?>);
            $.post("<?php echo url('feedback/check_feed_back'); ?>", {'status': status, 'feed_id': feed_id}, function (res) {
                if (res.code == 1) {
                    layer.alert(res.msg, {icon: 1}, function () {
                        window.location.reload();
                    });
                }
            })
        });
    })

</script>
</body>
</html>
