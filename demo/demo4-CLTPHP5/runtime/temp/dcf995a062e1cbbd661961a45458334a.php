<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/auth/adminRule.html";i:1500618080;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
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
        <a href="<?php echo url('ruleAdd'); ?>" class="layui-btn layui-btn-small">
            <i class="fa fa-plus"></i> 添加权限
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box table-responsive">
            <form class="layui-form layui-form-pane">
                <table class="layui-table table-hover" lay-even>
                    <thead>
                    <tr>
                        <th><?php echo lang('id'); ?></th>
                        <th><?php echo lang('icon'); ?></th>
                        <th>权限名称</th>
                        <th>控制器/方法</th>
                        <th>是否验证权限</th>
                        <th>菜单<?php echo lang('status'); ?></th>
                        <th><?php echo lang('order'); ?></th>
                        <th><?php echo lang('action'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($admin_rule) || $admin_rule instanceof \think\Collection || $admin_rule instanceof \think\Paginator): $i = 0; $__LIST__ = $admin_rule;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $v['id']; ?></td>
                        <td><i style="font-size:18px;" class="fa <?php echo $v['icon']; ?>"></i></td>
                        <td><?php echo $v['lefthtml']; ?><?php echo $v['title']; ?></td>
                        <td><?php echo $v['href']; ?></td>
                        <td>
                            <?php if($v["authopen"] == 1): ?>
                            <a class="red" href="javascript:" onclick="return tzyes('<?php echo $v['id']; ?>');" title="已开启">
                                <div id="yz<?php echo $v['id']; ?>">
                                    <button class="layui-btn layui-btn-mini layui-btn-danger">
                                        无需验证
                                    </button>
                                </div>
                            </a>
                            <?php else: ?>
                            <a class="red" href="javascript:" onclick="return tzyes('<?php echo $v['id']; ?>');" title="已禁用">
                                <div id="yz<?php echo $v['id']; ?>">
                                    <button class="layui-btn layui-btn-warm layui-btn-mini">需要验证</button>
                                </div>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($v["menustatus"] == 1): ?>
                            <a class="red" href="javascript:" onclick="return stateyes('<?php echo $v['id']; ?>');" title="已开启">
                                <div id="zt<?php echo $v['id']; ?>">
                                    <button class="layui-btn layui-btn-warm layui-btn-mini">显示状态</button>
                                </div>
                            </a>
                            <?php else: ?>
                            <a class="red" href="javascript:" onclick="return stateyes('<?php echo $v['id']; ?>');" title="已禁用">
                                <div id="zt<?php echo $v['id']; ?>">
                                    <button class="layui-btn layui-btn-danger layui-btn-mini">隐藏状态</button>
                                </div>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td><input name="<?php echo $v['id']; ?>" class="list_order layui-input" value=" <?php echo $v['sort']; ?>" size="10"/></td>
                        <td>
                            <a href="<?php echo url('ruleEdit',array('id'=>$v['id'])); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                            <a href="javascript:;" class="layui-btn layui-btn-mini layui-btn-danger" onclick="return del('<?php echo $v['id']; ?>');"><?php echo lang('del'); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">
                                <button type="button" class="layui-btn  layui-btn-small" lay-submit="" lay-filter="sort"><?php echo lang('order'); ?></button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="page" class="page">
        </div>
    </div>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>

<script>
    layui.use(['form', 'layer'], function() {
        var form = layui.form(),layer = layui.layer;
        form.on('submit(sort)', function(data){
            $.post("<?php echo url('ruleOrder'); ?>",data.field,function(res){
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
    function del(id) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('ruleDel'); ?>?id=" + id + "";
        });
    }
    function stateyes(id) {
        $.post('<?php echo url("ruleState"); ?>', {id: id}, function (data) {
            if (data.code) {
                if (data.msg == "状态禁止") {
                    var a = '<button class="layui-btn layui-btn-danger layui-btn-mini">隐藏状态</button>'
                    $('#zt' + id).html(a);
                } else {
                    var b = '<button class="layui-btn layui-btn-warm layui-btn-mini">显示状态</button>'
                    $('#zt' + id).html(b);
                }
                return false;
            }else{
                layer.msg(data.msg,{time:1000,icon:2});
                return false;
            }
        });
        return false;
    }
    function tzyes(id) {
        $.post('<?php echo url("ruleTz"); ?>', {id: id}, function (data) {
            if (data.status) {
                if (data.info == '无需验证') {
                    var a = '<button class="layui-btn layui-btn-danger layui-btn-mini">无需验证</button>'
                    $('#yz' + id).html(a);
                    return false;
                } else {
                    var b = '<button class="layui-btn layui-btn-warm layui-btn-mini">需要验证</button>'
                    $('#yz' + id).html(b);
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