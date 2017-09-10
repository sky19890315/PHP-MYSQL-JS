<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/set/index.html";i:1502412326;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/common/loginHead.html";i:1502412326;s:76:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/common/footer.html";i:1502250394;}*/ ?>
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
        <a class="logo" href="/" title="CLTPHP">CLTPHP</a>
        <div class="nav-user">
            <a class="avatar" href="<?php echo url('index/index'); ?>">
                <?php if($userInfo['head_pic']): ?>
                <img src="<?php echo imgUrl($userInfo['head_pic']); ?>" alt="<?php echo $userInfo['username']; ?>">
                <?php else: ?>
                <img src="__STATIC__/user/images/avatar/default.png" alt="<?php echo $userInfo['username']; ?>">
                <?php endif; ?>
                <cite><?php echo $userInfo['nickname']; ?></cite>
                <i><?php echo $userInfo['level_name']; ?></i>
            </a>
            <div class="nav">
                <a href="<?php echo url('set/index'); ?>"><i class="iconfont icon-shezhi"></i>设置</a>
                <a href="<?php echo url('index/logout'); ?>"><i class="iconfont icon-tuichu" style="top: 0; font-size: 22px;"></i>退了</a>
            </div>

        </div>
    </div>
</div>
<div class="main fly-user-main layui-clear">
    <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
        <li class="layui-nav-item">
            <a href="<?php echo url('index/index'); ?>">
                <i class="layui-icon">&#xe609;</i>
                我的主页
            </a>
        </li>
        <li class="layui-nav-item layui-this">
            <a href="set.html">
                <i class="layui-icon">&#xe620;</i>
                基本设置
            </a>
        </li>
    </ul>

    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>

    <div class="fly-panel fly-panel-user" pad20>
        <div class="layui-tab layui-tab-brief" lay-filter="user">
            <ul class="layui-tab-title" id="LAY_mine">
                <li class="layui-this" lay-id="info">我的资料</li>
                <li lay-id="avatar">头像</li>
                <li lay-id="pass">密码</li>
                <li lay-id="bind">帐号绑定</li>
            </ul>
            <div class="layui-tab-content" style="padding: 20px 0;">
                <div class="layui-form layui-form-pane layui-tab-item layui-show">
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?php echo $userInfo['user_id']; ?>">
                        <div class="layui-form-item">
                            <label for="L_email" class="layui-form-label">邮箱</label>
                            <div class="layui-input-inline">
                                <input type="text" id="L_email" name="email" lay-verify="email" value="<?php echo $userInfo['email']; ?>" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">如果您在邮箱已激活的情况下，变更了邮箱，需<a href="activate.html" style="font-size: 12px; color: #4f99cf;">重新验证邮箱</a>。</div>
                        </div>
                        <div class="layui-form-item">
                            <label for="L_mobile" class="layui-form-label">手机号</label>
                            <div class="layui-input-inline">
                                <input type="text" id="L_mobile" name="mobile" lay-verify="mobile" value="<?php echo $userInfo['mobile']; ?>" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label for="L_username" class="layui-form-label">昵称</label>
                            <div class="layui-input-inline">
                                <input type="text" id="L_username" name="username" lay-verify="required" value="<?php echo $userInfo['nickname']; ?>" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">性别</label>
                            <div class="layui-input-inline">
                                <input type="radio" name="sex" value="1" <?php if($userInfo['sex'] == 1): ?>checked<?php endif; ?> title="男">
                                <input type="radio" name="sex" value="0" <?php if($userInfo['sex'] == 0): ?>checked<?php endif; ?> title="女">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">地址</label>
                            <div class="layui-input-inline">
                                <select name="province" lay-filter="province">
                                    <option value="">请选择省</option>
                                    <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>" <?php if($userInfo['province'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="layui-input-inline">
                                <select name="city" lay-filter="city" id="city">
                                    <option value="">请选择市</option>
                                    <?php if(is_array($city) || $city instanceof \think\Collection || $city instanceof \think\Paginator): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>" <?php if($userInfo['city'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="layui-input-inline">
                                <select name="district" id="district">
                                    <option value="">请选择县/区</option>
                                    <?php if(is_array($district) || $district instanceof \think\Collection || $district instanceof \think\Paginator): $i = 0; $__LIST__ = $district;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>" <?php if($userInfo['district'] == $vo['id']): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item layui-form-text">
                            <label for="L_motto" class="layui-form-label">格言</label>
                            <div class="layui-input-block">
                                <textarea placeholder="随便写些什么刷下存在感" id="L_motto"  name="motto" class="layui-textarea" style="height: 80px;"><?php echo $userInfo['motto']; ?></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn" key="set-mine" lay-filter="*" lay-submit>确认修改</button>
                        </div>
                    </form>
                </div>

                <div class="layui-form layui-form-pane layui-tab-item">
                    <div class="layui-form-item">
                        <div class="avatar-add">
                            <p>建议尺寸168*168，支持jpg、png、gif，最大不能超过30KB</p>
                            <div class="upload-img">
                                <input type="file" name="head_pic" id="LAY-file" lay-title="上传头像">
                            </div>
                            <?php if($userInfo['head_pic']): ?>
                            <img src="<?php echo imgUrl($userInfo['head_pic']); ?>" alt="<?php echo $userInfo['username']; ?>">
                            <?php else: ?>
                            <img src="__STATIC__/user/images/avatar/default.png" alt="<?php echo $userInfo['username']; ?>">
                            <?php endif; ?>
                            <span class="loading"></span>
                        </div>
                    </div>
                </div>

                <div class="layui-form layui-form-pane layui-tab-item">
                    <form action="<?php echo url('repass'); ?>" method="post">
                        <div class="layui-form-item">
                            <label for="L_nowpass" class="layui-form-label">当前密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="L_nowpass" name="nowpass" lay-verify="required" placeholder="当前密码" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label for="L_pass" class="layui-form-label">新密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="L_pass" name="pass" lay-verify="required" placeholder="6到16个字符" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label for="L_repass" class="layui-form-label">确认密码</label>
                            <div class="layui-input-inline">
                                <input type="password" id="L_repass" name="repass" lay-verify="required" placeholder="确认密码" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <button class="layui-btn" key="repass" lay-filter="*" lay-submit>确认修改</button>
                        </div>
                    </form>
                </div>

                <div class="layui-form layui-form-pane layui-tab-item">
                    <ul class="app-bind">
                        <li class="fly-msg app-havebind">
                            <i class="iconfont icon-qq"></i>
                            <?php if($userInfo['oauth'] == qq): ?>
                            <span>已成功绑定，您可以使用QQ帐号直接登录Fly社区，当然，您也可以</span>
                            <a href="javascript:;" class="acc-unbind" type="qq_id">解除绑定</a>
                            <?php else: ?>
                            <a href="<?php echo url('loginApi/login',array('oauth'=>'qq')); ?>" onclick="layer.msg('正在绑定QQ', {icon:16, shade: 0.1, time:0})" class="acc-bind" type="qq_id">立即绑定</a>
                            <span>，即可使用QQ帐号登录CLTPHP</span>
                            <?php endif; ?>
                        </li>
                    </ul>
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
        var form = layui.form(), layer = layui.layer;
        form.on('select(province)', function (data) {
            var pid = data.value;
            $.get("<?php echo url('getRegion'); ?>?pid=" + pid, function (data) {
                var html = '<option value="">请选择市</option>';
                $.each(data, function (i, value) {
                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                $('#city').html(html);
                $('#district').html('<option value="">请选择县/区</option>');
                form.render()
            });
        });
        form.on('select(city)', function(data) {
            var pid = data.value;
            $.get("<?php echo url('getRegion'); ?>?pid=" + pid, function (data) {
                var html='<option value="">请选择县/区</option>';
                $.each(data, function (i, value) {
                    html += '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('#district').html(html);
                form.render()
            });
        });
    });

    layui.cache.page = 'user';
    layui.cache.user = {
        username: '游客'
        ,uid: -1
        ,avatar: '../../res/images/avatar/00.jpg'
        ,experience: 83
        ,sex: '男'
    };
    layui.config({
        version: "2.0.0"
        ,base: '__STATIC__/user/mods/'
    }).extend({
        fly: 'index'
    }).use('fly');
</script>

</body>
</html>