<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/login/reg.html";i:1505016439;s:74:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/common/head.html";i:1502248502;s:76:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/common/footer.html";i:1502250394;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="<?php echo $title; ?>">
    <meta name="description" content="<?php echo $title; ?>">
    <link rel="stylesheet" href="__STATIC__/user/layui/css/layui.css">
    <link rel="stylesheet" href="__STATIC__/user/css/global.css">
</head>

<body>
<div class="header">
    <div class="main">
        <a class="logo" href="<?php echo url('index/index'); ?>" title="CLTPHP">CLTPHP</a>
        <div class="nav-user">
        </div>
    </div>
</div>

<div class="main layui-clear">

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li><a href="<?php echo url('index'); ?>">登入</a></li>
                <li class="layui-this">注册</li>
            </ul>
            <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
                <div class="layui-tab-item layui-show">
                    <div class="layui-form layui-form-pane">
                        <form method="post">
                            <div class="layui-form-item">
                                <label for="L_email" class="layui-form-label">帐　　号</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_email" name="email" lay-verify="required" placeholder="请输入邮箱或者手机号" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_nickname" class="layui-form-label">昵　　称</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_nickname" name="nickname" lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_qq" class="layui-form-label">qq</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_qq" name="qq" lay-verify="required" placeholder="请输入qq" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_pass" class="layui-form-label">密　　码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_pass" name="password" lay-verify="required"  placeholder="6到16个字符" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_repass" class="layui-form-label">确认密码</label>
                                <div class="layui-input-inline">
                                    <input type="password" id="L_repass" name="password2" lay-verify="required" placeholder="请输入确认密码" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="L_vercode" class="layui-form-label">验  证  码</label>
                                <div class="layui-input-inline">
                                    <input type="text" id="L_vercode" name="vercode" lay-verify="required"  placeholder="请输入验证码" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid captcha">
                                    <img src="<?php echo captcha_src(); ?>" alt="captcha" onclick="this.src=this.src+'?'+'id='+Math.random()"/>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <button type="button" class="layui-btn" lay-filter="sub" lay-submit>立即注册</button>
                            </div>
                            <div class="layui-form-item fly-form-app">
                                <span>或者直接使用社交账号快捷注册</span>
                                <?php if(is_array($plugin) || $plugin instanceof \think\Collection || $plugin instanceof \think\Paginator): $i = 0; $__LIST__ = $plugin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;if($v['code'] == 'qq' AND is_qq() != 1): ?>
                                <a href="<?php echo url('loginApi/login',array('oauth'=>'qq')); ?>" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-qq" title="QQ登入"></a>
                                <?php endif; ?>
                                <!--<?php if($v['code'] == 'weixin' AND is_weixin() != 1): ?>
                                <a href="<?php echo url('loginApi/login',array('oauth'=>'weixin')); ?>" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="微博登入"></a>
                                <?php endif; ?>-->
                                <?php if($v['code'] == 'alipay' AND is_alipay() != 1): ?>
                                <a href="<?php echo url('loginApi/login',array('oauth'=>'alipay')); ?>" onclick="layer.msg('正在通过支付宝登入', {icon:16, shade: 0.1, time:0})" class="iconfont icon-weibo" title="支付宝登入"></a>
                                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p><a href="http://www.cltphp.com/">CLTPHP</a> 2017 &copy; <a href="http://www.cltphp.com/">cltphp.com</a></p>
    <p>
        <a href="<?php echo url('home/services/index',array('catId'=>34)); ?>" target="_blank">产品服务</a>
        <a href="<?php echo url('home/system/index',array('catId'=>33)); ?>" target="_blank">系统操作</a>
        <a href="<?php echo url('home/news/index',array('catId'=>49)); ?>" target="_blank">CLTPHP动态</a>
    </p>
</div>
<script src="__HOME__/js/jquery.min.js"></script>
<script src="__STATIC__/user/layui/layui.js"></script>



<script>
    layui.use(['form', 'layer'], function () {
        var form = layui.form(),layer = layui.layer;
        // 登录提交监听
        form.on('submit(sub)', function (data) {
            // 提交到方法 默认为本身
            $.post("<?php echo url('reg'); ?>",data.field,function(res){
                if(res.code > 0){
                    layer.msg(res.msg,{time:1800},function(){
                        location.href = "<?php echo url('index/index'); ?>";
                    });
                }else{
                    layer.msg(res.msg,{time:1800});
                }
            });
        })
    })
</script>
</body>
</html>