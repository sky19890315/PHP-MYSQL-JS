<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/ad/index.html";i:1500445658;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
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
        <form class="layui-form" style="float:left;" action="<?php echo url('index'); ?>" method="post">
            <div class="layui-form-item" style="margin:0;">
                <div class="layui-input-inline">
                    <input type="text" name="key" id="key" class="layui-input" placeholder="<?php echo lang('pleaseEnter'); ?>关键字！" value="<?php echo $testkey; ?>" >
                </div>
                <div class="layui-form-mid layui-word-aux" style="padding:0;">
                    <button type="submit" class="layui-btn"><i class="fa fa-search" aria-hidden="true"></i> <?php echo lang('search'); ?></button>
                    <a href="<?php echo url('index'); ?>" class="layui-btn">显示全部</a>
                </div>
            </div>
        </form>
        <a href="<?php echo url('add'); ?>" class="layui-btn" style="float:right;"><i class="fa fa-plus" aria-hidden="true"></i><?php echo lang('add'); ?><?php echo lang('ad'); ?></a>
        <div style="clear: both;"></div>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend><?php echo lang('ad'); ?>管理</legend>
        <div class="layui-field-box table-responsive">
            <form class="layui-form layui-form-pane">
                <table class="layui-table table-hover">
                    <thead>
                    <tr>
                        <th>编号</th>
                        <th>广告名称</th>
                        <th>所属位置</th>
                        <th><?php echo lang('add'); ?><?php echo lang('time'); ?></th>
                        <th><?php echo lang('order'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <!--内容容器-->
                    <tbody id="con">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td><?php echo $v['ad_id']; ?></td>
                        <td><?php echo $v['name']; if($v['pic']): ?><img src="__ADMIN__/images/image.gif"><?php endif; ?></td>
                        <td><?php echo $v['typename']; ?></td>
                        <td><?php echo date('Y-m-d h:i',$v['addtime']); ?></td>
                        <td><input name="<?php echo $v['ad_id']; ?>" value="<?php echo $v['sort']; ?>" class="list_order"/></td>
                        <td>
                            <?php if($v["open"] == 1): ?>
                            <a class="red" href="javascript:;" onclick="return stateyes('<?php echo $v['ad_id']; ?>');" title="已开启">
                                <div id="zt<?php echo $v['ad_id']; ?>">
                                    <button class="layui-btn layui-btn-warm layui-btn-mini">状态开启</button>
                                </div>
                            </a>
                            <?php else: ?>
                            <a class="red" href="javascript:;" onclick="return stateyes('<?php echo $v['ad_id']; ?>');" title="已禁用">
                                <div id="zt<?php echo $v['ad_id']; ?>">
                                    <button class="layui-btn layui-btn-danger layui-btn-mini">状态禁用</button>
                                </div>
                            </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo url('edit',['ad_id'=>$v['ad_id']]); ?>" class="layui-btn layui-btn-mini"><?php echo lang('edit'); ?></a>
                            <a href="javascript:;" onclick="return del('<?php echo $v['ad_id']; ?>')" class="layui-btn layui-btn-mini layui-btn-danger"><?php echo lang('del'); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
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
            }else{
                layer.msg(data.msg,{time:1000,icon:2});
                return false;
            }
        });
        return false;
    }
    function del(id) {
        layer.confirm('你确定要删除吗？', {icon: 3}, function (index) {
            layer.close(index);
            window.location.href = "<?php echo url('del'); ?>?ad_id=" + id;
        });
    }
    //排序提交
    layui.use(['form', 'layer'], function() {
        var form = layui.form(),layer = layui.layer;
        form.on('submit(sort)', function(data){
            $.post("<?php echo url('adOrder'); ?>",data.field,function(res){
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