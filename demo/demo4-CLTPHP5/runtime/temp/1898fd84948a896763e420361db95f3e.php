<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/database/restore.html";i:1500443030;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
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
    <fieldset class="layui-elem-field">
        <legend>备份文件列表</legend>
        <div class="layui-field-box table-responsive">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>文件名称</th>
                    <th>文件大小</th>
                    <th>备份时间</th>
                    <th>卷号</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($vlist) || $vlist instanceof \think\Collection || $vlist instanceof \think\Paginator): if( count($vlist)==0 ) : echo "" ;else: foreach($vlist as $k=>$vo): ?>
                <tr>
                    <td><?php echo $vo['name']; ?></td>
                    <td><?php echo byte_format($vo['size']); ?></td>
                    <td><?php echo toDate($vo['time']); ?></td>
                    <td><?php echo $vo['number']; ?></td>
                    <td>
                        <a href="javascript:;" onclick="return recover('<?php echo $vo['name']; ?>');" class="layui-btn layui-btn-normal layui-btn-mini">恢复</a>
                        <a href="<?php echo url('downFile',array('type'=>'sql','file'=>$vo['name'])); ?>" class="layui-btn layui-btn-mini">下载</a>
                        <a href="javascript:;" onclick="return del('<?php echo $vo['name']; ?>');" class="layui-btn layui-btn-danger layui-btn-mini">删除</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

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
    layui.use('layer', function() {
        var layer = parent.layer === undefined ? layui.layer : parent.layer;
    });
    function recover(name) {
        layer.confirm('确认要导入数据吗？',{icon: 0}, function () {
            $.post("<?php echo url('restoreData'); ?>",{sqlfilepre:name},function(data){
                if(data.code==1){
                    layer.msg(data.msg, {time: 1800});
                }else{
                    layer.msg(data.msg,{time: 1800});
                }
            });
        });
    }
    function del(name) {
        layer.confirm('确认要删除该备份文件吗？', {icon: 3}, function () {
            $.post('<?php echo url("delSqlFiles"); ?>',{sqlfilename: name}, function (data) {
                if (data.code == 1) {
                    layer.msg(data.msg, {time: 1800}, function(){
                        window.location.href=data.url;
                    });
                }else{
                    layer.msg(data.info,{time: 1800});
                }
            });
        });
    }
</script>