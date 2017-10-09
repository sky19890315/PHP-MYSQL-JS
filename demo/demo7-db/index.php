<?php
@session_start();
$_SESSION['admin'] = 1;
?>
<form action="" method="get">
    <input type="text" name="username">
    <input type="text" name="food1">
    <input type="text" name="food2">
    <input type="text" name="food3">
    <input type="submit" value="提交">
</form>

<?php
$username = trim( $_GET['username'] );
$food1 = trim( $_GET['food1'] ); 
$food2 = trim( $_GET['food2'] ); 
$food3 = trim( $_GET['food3'] );
$today = date('Y-m-d');
// phpinfo();    
try{
    $db = new PDO('mysql:host=localhost;dbname=book','root','root');
    
    $db->exec('set names utf8');
    
    // echo "<pre>";
    // var_dump($db);die;
    // 查询管理员登录
    // $admin = mysqli_real_escape_string($_POST['admin']);
    // if ( ! $db->exec(" SELECT * FROM `admin` WHERE username = '${admin}' ") ) {
    //     die('请使用管理员账号登录!');
    // }
    // 判断是否已经点餐过
    if (!empty($username) ) {

        if ( $db->exec(" SELECT * FROM `users` WHERE username = '${username}' 
            AND today >= '${today}' ") ) {
            die('请勿重复点餐');
        } else {
            $q = " INSERT INTO `users` (username, food1, food2, food3, today) VALUES 
                ('${username}', '${food1}', '${food2}', '${food3}', '${today}' )";
                // var_dump($q);die;
            $rst = $db->exec($q);
            // var_dump($rst);die;
            if ($rst) {
                die('点餐成功!');
            }else {
                die('点餐失败,请重试!');
            }
        }
    }
} catch ( PDOException $e ) {
    if ($_SESSION['admin']) {
        echo "连接失败:".$e->getMessage();
        exit;
    }
    die('系统维护中');
}

