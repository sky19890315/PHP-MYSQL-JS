<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/auth/adminList.html";i:1500887540;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
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
        <a href="<?php echo url('adminAdd'); ?>" class="layui-btn layui-btn-small">
            <i class="fa fa-plus"></i> <?php echo lang('add'); ?><?php echo lang('admin'); ?>
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend><?php echo lang('admin'); ?><?php echo lang('list'); ?></legend>
        <div class="layui-field-box table-responsive">
            <table class=" layui-table table-hover">
                <thead>
                <tr>
                    <th><?php echo lang('username'); ?></th>
                    <th><?php echo lang('email'); ?></th>
                    <th><?php echo lang('userGroup'); ?></th>
                    <th><?php echo lang('tel'); ?></th>
                    <th><?php echo lang('ip'); ?></th>
                    <th><?php echo lang('status'); ?></th>
                    <th><?php echo lang('action'); ?></th>
                </tr>
                </thead>
                <tbody id="con">
                </tbody>
                <tfoot>
                <tr>
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
<script type="text/html" id="conTemp">
    {{# layui.each(d.list, function(index, item){ }}
    <tr>
        <td>{{ item.username}}</td>
        <td>{{ item.email}}</td>
        <td>{{ item.title}}</td>
        <td>{{ item.tel}}</td>
        <td>{{ item.ip}}</td>
        <td>


            {{# if(item.admin_id==1){ }}

                <div>
                    <button disabled class="layui-btn layui-btn-mini layui-btn-disabled"><?php echo lang('enabled'); ?></button>
                </div>
            {{# }else{  }}
                {{# if(item.is_open==1){ }}
                    <a class="red" href="javascript:" onclick="return stateyes('{{ item.admin_id }}');" title="<?php echo lang('enabled'); ?>">
                        <div id="zt{{ item.admin_id }}">
                            <button class="layui-btn layui-btn-warm layui-btn-mini"><?php echo lang('enabled'); ?></button>
                        </div>
                    </a>
                {{# }else{  }}
                    <a class="red" href="javascript:" onclick="return stateyes('{{ item.admin_id }}');" title="<?php echo lang('disabled'); ?>">
                        <div id="zt{{ item.admin_id }}">
                            <button class="layui-btn layui-btn-danger layui-btn-mini"><?php echo lang('disabled'); ?></button>
                        </div>
                    </a>
                {{# } }}
            {{# } }}
        </td>
        <td>
            <a href="<?php echo url('adminEdit'); ?>?admin_id={{item.admin_id}}" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
            {{# if(item.admin_id==1){ }}
            <a href="#" class="layui-btn layui-btn-mini layui-btn-disabled"><?php echo lang('del'); ?></a>
            {{# }else{  }}
            <a href="javascript:;" onclick="return del({{item.admin_id}})" class="layui-btn layui-btn-danger layui-btn-mini"><?php echo lang('del'); ?></a>
            {{# } }}
        </td>
    </tr>
    {{# }); }}
</script>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>

<script>
    layui.config({
        base: '__ADMIN__/js/'
    }).use(['paging','form', 'layer'], function() {
        var paging = layui.paging(),form = layui.form(), layer = layui.layer;
        paging.init({
            url: "<?php echo url('adminList'); ?>", //地址
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
        if (id == 1) {
            layer.msg('<?php echo lang("Super administrator cannot be deleted"); ?>', {time: 1800,icon:0});
            return false;
        }
        layer.confirm('<?php echo lang("Are you sure you want to delete it"); ?>', {icon: 3}, function (index) {
            window.location.href = "<?php echo url('adminDel'); ?>?admin_id="+id;
        });
    }
    function stateyes(id) {
        $.post('<?php echo url("adminState"); ?>',{'id': id},function (data) {
            if (data.status==1) {
                if (data.info == "<?php echo lang('disabled'); ?>") {
                    var a = '<button class="layui-btn layui-btn-danger layui-btn-mini"><?php echo lang("disabled"); ?></button>'
                    $('#zt' + id).html(a);
                    return false;
                } else {
                    var b = '<button class="layui-btn layui-btn-warm layui-btn-mini"><?php echo lang("enabled"); ?></button>'
                    $('#zt' + id).html(b);
                    return false;
                }
            }else{
                layer.msg(data.msg,{time:1000,icon:2});
                return false;
            }
        });
        return false;
    }
</script>