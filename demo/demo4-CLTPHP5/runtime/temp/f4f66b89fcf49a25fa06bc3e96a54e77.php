<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/plugin/login.html";i:1501485394;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainHead.html";i:1500516746;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/admin/view/common/mainFoot.html";i:1500448110;}*/ ?>
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
        <legend>登录插件</legend>
        <div class="layui-field-box table-responsive">
            <table class="layui-table table-hover">
                <thead>
                <tr>
                    <th>插件名称</th>
                    <th>图片</th>
                    <th>插件描述</th>
                    <th>操作</th>
                </tr>
                </thead>
                <!--内容容器-->
                <tbody id="con">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td><?php echo $v['name']; ?></td>
                    <td>
                        <i class="fa fa-picture-o" onmouseover="layer.tips('<img src=/plugins/<?php echo ACTION_NAME; ?>/<?php echo $v['code']; ?>/<?php echo $v['icon']; ?>>',this,{tips: [1, '#fff']});" onmouseout="layer.closeAll();"></i>
                    </td>
                    <td><?php echo $v['desc']; ?></td>
                    <td>
                        <?php if($v['status'] == 0): ?>
                        <a onclick="installPlugin('<?php echo $v['type']; ?>','<?php echo $v['code']; ?>',1)" href="#" class="layui-btn layui-btn-mini">一键安装</a>
                        <?php else: ?>
                        <a class="layui-btn layui-btn-mini"  href="<?php echo url('loginSet',['type'=>$v['type'],'code'=>$v['code']]); ?>" title="配置">
                            配置
                        </a>
                        <a class="layui-btn layui-btn-mini layui-btn-danger" href="#" onclick="installPlugin('<?php echo $v['type']; ?>','<?php echo $v['code']; ?>',0);" title="卸载">
                            卸载
                        </a>
                        <?php endif; ?>
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
    layui.use(['layer'], function() {
        var layer = layui.layer;
    });
    //插件安装(卸载)
    function installPlugin(type,code,type2){
        var url = '<?php echo url("install"); ?>?&type='+type+'&code='+code+'&install='+type2;
        $.get(url,function(data){
            if(data.code == 1){
                layer.alert(data.msg, {icon: 6},function(){
                    window.location.href="<?php echo url(ACTION_NAME); ?>";
                });
            }else{
                layer.alert(data.msg, {icon: 5});
            }
        })
    }

</script>