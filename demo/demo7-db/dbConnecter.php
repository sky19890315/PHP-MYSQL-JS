<?php
@session_start();
$username = trim( $_GET['username'] );
$food1 = trim( $_GET['food1'] ); 
$food2 = trim( $_GET['food2'] ); 
$food3 = trim( $_GET['food3'] );
$today = date('Y-m-d');    
try{
    $db = new PDO('mysql:localhost;dbname=order','root','root');
    $db->exec('set namespace utf8');
    // 查询管理员登录
    $admin = mysqli_real_escape_string($_POST['admin']);
    if ( ! $db->exec(" SELECT * FROM `admin` WHERE username = '${admin}' ") ) {
        die('请使用管理员账号登录!');
    }
    // 判断是否已经点餐过
    if ( $db->exec(" SELECT * FROM `users` WHERE username = '${username}' 
        AND time >= '${today}' ") ) {
        die('请勿重复点餐');
    } else {
        $rst = $db->exec(" INSERT INTO `users` ('food1', 'food2', 'food3', 'today') VALUES 
            ('${food1}', '${food2}', '${food3}', '${today}' ) WHERE username = '${username}' ");
        if ($rst) {
            die('点餐成功!');
        }else {
            die('点餐失败,请重试!');
        }
    }
} catch ( PDOException $e ) {
    if ($_SESSION['admin']) {
        echo "连接失败:".$e->getMessage();
        exit;
    }
    die('系统维护中');
}

