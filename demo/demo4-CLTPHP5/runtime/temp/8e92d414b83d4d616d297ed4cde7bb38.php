<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/category/index.html";i:1500443992;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Paging</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="__ADMIN__/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="__ADMIN__/css/global.css" media="all">
    <link rel="stylesheet" href="__ADMIN__/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="__ADMIN__/css/style.css">
    <link rel="stylesheet" href="__ADMIN__/css/animate.css" />
</head>
<body>
<div class="admin-main fadeInUp animated">
    <blockquote class="layui-elem-quote">
        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-small">
            <i class="fa fa-plus"></i> <?php echo lang('add'); ?>分类
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend><?php echo $title; ?></legend>
        <div class="layui-field-box table-responsive">
            <form class="layui-form layui-form-pane">
                <table class="layui-table table-hover">
                    <thead>
                    <tr>

                        <th>编号</th>
                        <th>栏目名称<span id="cateNameMsg">(点击查看内容)</span></th>
                        <th>所属模型</th>
                        <th>导航</th>
                        <th><?php echo lang('order'); ?></th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <!--内容容器-->
                    <tbody id="con">
                    <?php echo $categorys; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="7">
                            <button type="button" class="layui-btn  layui-btn-small" lay-submit="" lay-filter="sort"><?php echo lang('order'); ?></button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </fieldset>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>

<script>
    layui.use(['form', 'layer'], function() {
        var form = layui.form(), layer = layui.layer;
    });
    function stateyes(id) {
        $.post('<?php echo url("editState"); ?>', {id: id}, function (data) {
            if (data.status) {
                if (data.info == '状态禁止') {
                    var a = '<button class="layui-btn layui-btn-danger layui-btn-mini">状态禁用</button>'
                    $('#zt' + id).html(a);
                    layer.msg(data.info, {icon: 5});
                    return false;
                } else {
                    var b = '<button class="layui-btn layui-btn-warm layui-btn-mini">状态开启</button>'
                    $('#zt' + id).html(b);
                    layer.msg(data.info, {icon: 6});
                    return false;
                }
            } else{
                layer.msg(data.msg,{time:1000,icon:2});
                return false;
            }
        });
        return false;
    }
    function del(id) {
        layer.confirm('你确定要删除该栏目及其子栏目吗？', {icon: 3}, function (index) {
            $.post('<?php echo url("del"); ?>', {id: id}, function (data) {
                if (data.status == 1) {
                    layer.alert(data.info, {icon: 6}, function(index){
                        layer.close(index);
                        window.location.href=data.url;
                    });
                }else{
                    layer.msg(data.info,{icon:5});
                }
            });
            layer.close(index);
        });
    }
    //排序提交
    layui.use(['form', 'layer'], function() {
        var form = layui.form(),layer = layui.layer;
        form.on('submit(sort)', function(data){
            $.post("<?php echo url('cOrder'); ?>",data.field,function(res){
                if(res.code > 0){
                    layer.msg(res.msg,{time:1000,icon:1},function(){
                        location.href = res.url;
                    });
                }else{
                    layer.msg(res.msg,{time:1000,icon:2});
                }
            })
        });
    });
</script>