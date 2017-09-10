<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/donation/index.html";i:1500445998;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
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
        <form class="layui-form" style="float:left;">
            <div class="layui-form-item" style="margin:0;">
                <div class="layui-input-inline">
                    <input type="text" name="key" id="key" class="layui-input" placeholder="<?php echo lang('pleaseEnter'); ?>关键字！">
                </div>
                <div class="layui-form-mid layui-word-aux" style="padding:0;">
                    <button type="button" class="layui-btn" id="search"><i class="fa fa-search" aria-hidden="true"></i> <?php echo lang('search'); ?></button>
                    <a href="<?php echo url('index'); ?>" class="layui-btn">显示全部</a>
                </div>
            </div>
        </form>
        <a href="<?php echo url('add'); ?>" class="layui-btn" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i><?php echo lang('add'); ?>捐赠名单</a>
        <div style="clear: both;"></div>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>捐赠<?php echo lang('list'); ?></legend>
        <div class="layui-field-box table-responsive">
            <table class="layui-table table-hover">
                <thead>
                <tr>
                    <th><input type="checkbox" id="selected-all" onclick="$('input[name*=\'id\']').prop('checked', this.checked);"></th>
                    <th><?php echo lang('name'); ?></th>
                    <th>金额</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <!--内容容器-->
                <tbody id="con">

                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2">
                        <button type="button" class="layui-btn layui-btn-small" onclick="return delall();"><?php echo lang('del'); ?></button>
                    </td>
                    <td colspan="7">
                        <!--分页容器-->
                        <div id="paged" style="text-align: right"></div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </fieldset>
</div>

<!--模板-->
<script type="text/html" id="conTemp">
    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td><input type="checkbox" name="id[]" value="{{ item.id }}"></td>
        <td>{{ item.name }}</td>
        <td>{{ item.money }}</td>
        <td>{{ getdate(item.addtime) }}</td>
        <td>
            <a href="<?php echo url('edit'); ?>?id={{item.id}}" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
            <a href="javascript:;" onclick="return del({{item.id}})" data-id="1" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
        </td>
    </tr>
    {{# }); }}
</script>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>

<script>

    layui.config({
        base: '__ADMIN__/js/'
    }).use(['paging', 'code','icheck','layer'], function() {
        layui.code();
        var paging = layui.paging(),layer = parent.layer === undefined ? layui.layer : parent.layer;

        paging.init({
            url: "<?php echo url('index'); ?>", //地址
            elem: '#con', //内容容器
            params: {}, //发送到服务端的参数
            tempElem: '#conTemp', //模块容器
            pageConfig: { //分页参数配置
                elem: '#paged', //分页容器
                pageSize: 15 //分页大小
            },
            success: function() { //渲染成功的回调
                //alert('渲染成功');
            },
            fail: function(msg) { //获取数据失败的回调
                //alert('获取数据失败')
            },
            complate: function() { //完成的回调
                //alert('处理完成');
            }
        });
        //搜索
        $('#search').on('click', function() {
            var $this = $(this);
            var key = $('#key').val();
            if($.trim(key)=='') {
                layer.msg('<?php echo lang('pleaseEnter'); ?>关键字！');
                return;
            }
            //调用get方法获取数据
            paging.get({
                key: key //获取输入的关键字。
            });
        });

    });
    function del(id) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('del'); ?>?id=" + id;
        });
    }
    function delall() {
        var ids = '';
        $('input[name*=\'id\']:checked').each(function (){
            ids += $(this).val() + ',';
        });
        layer.confirm('确认要删除选中信息吗？', {icon: 3}, function(index){
            $.post("<?php echo url('delall'); ?>", {ids:ids}, function (result) {
                layer.alert(result.msg,{icon:6},function(){
                    window.location.href = result.url;
                });
                return false;
            });
            layer.close(index);
        })

    }
    function getdate(date){
        var date = new Date(date*1000);//如果date为10位不需要乘1000
        var Y = date.getFullYear() + '-';
        var M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        var D = (date.getDate() < 10 ? '0' + (date.getDate()) : date.getDate()) + ' ';
        var h = (date.getHours() < 10 ? '0' + date.getHours() : date.getHours()) + ':';
        var m = (date.getMinutes() <10 ? '0' + date.getMinutes() : date.getMinutes()) + ':';
        var s = (date.getSeconds() <10 ? '0' + date.getSeconds() : date.getSeconds());
        return Y+M+D+h+m+s;
    }
</script>