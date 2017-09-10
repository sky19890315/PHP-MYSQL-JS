<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/index/index.html";i:1502416414;s:79:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/common/loginHead.html";i:1502412326;s:76:"/Users/sunkeyi/www/learn/demo/demo4-CLTPHP5/app/user/view/common/footer.html";i:1502250394;}*/ ?>
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
<div class="fly-home" style="background-image: url();">
    <?php if($userInfo['head_pic']): ?>
    <img src="<?php echo imgUrl($userInfo['head_pic']); ?>" alt="<?php echo $userInfo['username']; ?>">
    <?php else: ?>
    <img src="__STATIC__/user/images/avatar/default.png" alt="<?php echo $userInfo['username']; ?>">
    <?php endif; ?>
    <h1>
        <?php echo $userInfo['nickname']; if($userInfo['sex'] == 1): ?>
        <i class="iconfont icon-nan"></i>
        <?php else: ?>
        <i class="iconfont icon-nv"></i>
        <?php endif; ?>
    </h1>
    <p class="fly-home-info">
        <i class="iconfont icon-shijian"></i><span><?php echo toDate($userInfo['reg_time'],'Y-m-d'); ?> 加入</span>
        <?php if($userInfo['city']): ?>
        <i class="iconfont icon-chengshi"></i><span><?php echo toCity($userInfo['city']); ?></span>
        <?php endif; ?>
    </p>
    <?php if($userInfo['motto']): ?>
    <p class="fly-home-sign">（ <?php echo $userInfo['motto']; ?>）</p>
    <?php endif; ?>
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



</body>
</html>