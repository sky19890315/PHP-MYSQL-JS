<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Examples</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="" rel="stylesheet">
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="http://lib.sinaapp.com/js/jquery/2.0.2/jquery-2.0.2.min.js">
</script>
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>

</head>
<body>
<div class="container">
<nav class="navbar navbar-default">留言板</nav>
<div class="jumbotron">
  <div class="container">
    <div class="cos-sm-8">
    标题内容
    </div>
    <div class="cos-sm-8">
    正文内容
    </div>
    <div class="cos-sm-8">
    留言者姓名
    </div>
  </div>
</div>
<div class="content">
    <form id="msg">
  <div class="form-group">
    <label for="title">标题</label>
    <input type="text" name='title' class="form-control" id="title" placeholder="请输入标题">
  </div>
  <div class="form-group">
    <label for="content">正文</label><br/>
    <textarea name="content" id='content' style="width: 500px;height: 240px"></textarea>
  </div>
  <div class="form-group">
    <label> 用户名<br/>
    <input type="text" name="username" value="">
    </label>
  </div>
  <button type="submit" class="btn btn-default">提交</button>
</form>
</div>
</div>
</body>
<script>
$('#msg').submit(function(){
    var postData = {};
    $.each($(this).serializeArray(),function(i,n){
        postData[n.name] = n.value;//入栈
    });
    $.ajax({
        url:'getdata.php',
        type:'POST',
        dataType:'json',
        data:postData,
        success:function(){

        },
    });
    return false;
});



</script>
</html>
