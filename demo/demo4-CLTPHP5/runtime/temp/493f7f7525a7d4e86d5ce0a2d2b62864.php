<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:81:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/database/database.html";i:1500442982;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
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
       数据库中共有<?php echo $tableNum; ?>张表，共计<?php echo $total; ?>
        <a href="javascript:void(0)" onclick="gobackup(this)" class="layui-btn layui-btn-small pull-right">备份</a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据列表</legend>
        <div class="layui-field-box table-responsive">
            <table class="layui-table table-hover">
                <thead>
                <tr>
                    <th><input type="checkbox" id="selected-all" onclick="$('input[name*=\'backs\']').prop('checked', this.checked);"></th>
                    <th>数据库表</th>
                    <th>记录条数</th>
                    <th>占用空间</th>
                    <th>类型</th>
                    <th>编码</th>
                    <th>创建时间</th>
                    <th>说明</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($dataList) || $dataList instanceof \think\Collection || $dataList instanceof \think\Paginator): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><input type="checkbox" name="backs[]" value="<?php echo $v['Name']; ?>"></td>
                    <td><?php echo $v['Name']; ?></td>
                    <td><?php echo $v['Rows']; ?></td>
                    <td><?php echo format_bytes($v['Data_length']); ?></td>
                    <td><?php echo $v['Engine']; ?></td>
                    <td><?php echo $v['Collation']; ?></td>
                    <td><?php echo $v['Create_time']; ?></td>
                    <td><?php echo $v['Comment']; ?></td>
                    <td>
                        <a href="javascript:;" onclick="return optimize('<?php echo $v['Name']; ?>');" class="layui-btn layui-btn-normal layui-btn-mini">优化</a>
                        <a href="javascript:;" onclick="return repair('<?php echo $v['Name']; ?>');" class="layui-btn layui-btn-mini">修复</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

        </div>
    </fieldset>
</div>
<script type="text/javascript" src="__ADMIN__/plugins/layui/layui.js"></script>
<script src="__STATIC__/js/jquery.2.1.1.min.js"></script>

<script>
    layui.config({
        base: '__ADMIN__/plugins/layui/modules/'
    });
    layui.use(['icheck','layer'], function() {
        var $ = layui.jquery, layer = parent.layer === undefined ? layui.layer : parent.layer;

        $('#selected-all').on('ifChanged', function(event) {
            var $input = $('.layui-table tbody tr td').find('input');
            $input.iCheck(event.currentTarget.checked ? 'check' : 'uncheck');
        });
    });
    function gobackup(obj){
        var a = [];
        $('input[name*=backs]').each(function(i,o){
            if($(o).is(':checked')){
                a.push($(o).val());
            }
        });

        $(obj).addClass('disabled');
        $(obj).html('备份进行中...');
        $.post("<?php echo url('database/backup'); ?>",{tables:a},function(data){
            data = eval('('+data+')');
            if(data.code==1){
                $(obj).removeClass('disabled');
                $(obj).html('备份');
                layer.msg(data.msg,{time:500});
            }else{
                layer.msg(data.msg,{time:1800});
            }
        });
    }
    function optimize(name) {
        $.post("<?php echo url('database/optimize'); ?>",{tableName:name},function(res){
            if(res.code > 0){
                layer.msg(res.msg,{time:1800},function(){
                    window.location.href = res.url;
                });
            }else{
                layer.msg(res.msg,{time:1800});
            }
        });
    }
    function repair(name) {
        $.post("<?php echo url('database/repair'); ?>",{tableName:name},function(data){
            if(data.code>0){
                layer.msg(data.msg,{time:1800}, function(){
                    window.location.href = data.url;
                });
            }else{
                layer.msg(data.msg,{time:1800});
            }
        });
    }
</script>