<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:95:"D:\phpStudy\PHPTutorial\WWW\wittree\public/../application/admin\view\customer\findcustomer.html";i:1542952384;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查看用户</title>
    <link href="__CSS__/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="__CSS__/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="__CSS__/animate.min.css" rel="stylesheet">
    <link href="__CSS__/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="__CSS__/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="__JS__/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
    <link href="__JS__/layui/css/layui.css" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-10">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>用户查看</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" id="commentForm" method="post"
                          action="#">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户名称：</label>
                            <div class="input-group col-sm-4">
                                <input id="customername" type="text" class="form-control" name="username" required="" aria-required="true" value="<?php echo $customer['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">头像：</label>
                            <input name="face" id="thumbnail" value="<?php echo $customer['face']; ?>" type="hidden"/>
                            <div class="form-inline">
                                <div class="input-group col-sm-2">
                                    <button type="button" class="layui-btn" id="test1">
                                        <i class="layui-icon">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                                <div class="input-group col-sm-3">
                                    <div id="sm">
                                        <img src="<?php echo $customer['face']; ?>" width="40px" height="40px"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">性别：</label>
                            <div class="input-group col-sm-6">
                                <?php if(is_array($sex) || $sex instanceof \think\Collection || $sex instanceof \think\Paginator): if( count($sex)==0 ) : echo "" ;else: foreach($sex as $key=>$vo): ?>
                                <div class="radio i-checks col-sm-4">
                                    <label>
                                        <input type="radio" value="<?php echo $key; ?>" <?php if($key == $customer['sex']): ?>checked<?php endif; ?> name="sex"> <i></i> <?php echo $vo; ?></label>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否启用：</label>
                            <div class="input-group col-sm-6">
                                <?php if(is_array($status) || $status instanceof \think\Collection || $status instanceof \think\Paginator): if( count($status)==0 ) : echo "" ;else: foreach($status as $key=>$vo): ?>
                                <div class="radio i-checks col-sm-4">
                                    <label>
                                        <input type="radio" value="<?php echo $key; ?>" <?php if($key == $customer['status']): ?>checked<?php endif; ?> name="status"> <i></i> <?php echo $vo; ?></label>
                                </div>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">推广号：</label>
                            <div class="input-group col-sm-4">
                                <input id="last_code" type="text" value="<?php echo $customer['last_code']; ?>" class="form-control" name="last_code" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">联系电话：</label>
                            <div class="input-group col-sm-4">
                                <input id="phone" type="text" value="<?php echo $customer['phone']; ?>" class="form-control" name="phone" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">身份证：</label>
                            <div class="input-group col-sm-4">
                                <input id="id_number" type="text" value="<?php echo $customer['id_number']; ?>" class="form-control" name="id_number" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">地址：</label>
                            <div class="input-group col-sm-4">
                                <input id="address" type="text" value="<?php echo $customer['address']; ?>" class="form-control" name="address" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">总积分：</label>
                            <div class="input-group col-sm-4">
                                <input id="total_integral" type="text" value="<?php echo $customer['total_integral']; ?>" class="form-control" name="total_integral" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">复利积分：</label>
                            <div class="input-group col-sm-4">
                                <input id="co_integral" type="text" value="<?php echo $customer['co_integral']; ?>" class="form-control" name="co_integral" required="" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">推荐奖励：</label>
                            <div class="input-group col-sm-4">
                                <input id="re_integral" type="text" value="<?php echo $customer['re_integral']; ?>" class="form-control" name="re_integral" required="" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">推荐人：</label>
                            <div class="input-group col-sm-4">
                                <input id="recomand_name" type="text" value="<?php echo $customer['recomand_name']; ?>" class="form-control" name="recomand_name" required="" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">推广人数：</label>
                            <div class="input-group col-sm-4">
                                <input id="recomand_count" type="text" value="<?php echo $customer['recomand_count']; ?>" class="form-control" name="recomand_count" required="" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">已购买课程：</label>
                            <div class="input-group col-sm-4">
                                <input id="pay_course" type="text" value="<?php echo $customer['pay_course']; ?>" class="form-control" name="pay_course" required="" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">注册时间：</label>
                            <div class="input-group col-sm-4">
                                <input id="create_time" type="text" value="<?php echo date('Y-m-d',$customer['create_time']); ?>" class="form-control" name="create_time" required="" aria-required="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">二维码链接：</label>
                            <div class="input-group col-sm-4">
                                <input id="code_url" type="text" value="<?php echo $customer['code_url']; ?>" class="form-control" name="code_url" required="" aria-required="true">
                            </div>
                        </div>
                        <!--<div class="form-group">-->
                            <!--<label class="col-sm-3 control-label">银行卡号：</label>-->
                            <!--<div class="input-group col-sm-4">-->
                                <!--<input id="bank_number" type="text" class="form-control" name="bank_number" value="<?php echo $customer['bank_number']; ?>" required="" aria-required="true">-->
                            <!--</div>-->
                        <!--</div>-->

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
<script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/validate/jquery.validate.min.js"></script>
<script src="__JS__/plugins/validate/messages_zh.min.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/layer/layer.min.js"></script>
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="__JS__/layui/layui.js"></script>
<script src="__JS__/jquery.form.js"></script>
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


</script>
</body>
</html>
