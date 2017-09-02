<?php
//if ('POST' === $_SERVER['REQUEST_METHOD']) {
$tmp = $_POST;
$data = [];
$data['title'] = trim($_POST['title']);
$data['content'] = trim($_POST['content']);
$data['username'] = trim($_POST['username']);
die(json_encode($_POST));
//}
