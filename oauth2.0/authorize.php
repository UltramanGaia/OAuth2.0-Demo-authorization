<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/8
 * Time: 11:04
 */
// 授权码模式
include "../config/config.php";
include "../libs/global.php";
session_start();

/*
GET /authorize?response_type=code&client_id=s6BhdRkqt3&state=xyz
  &redirect_uri=https%3A%2F%2Fclient%2Eexample%2Ecom%2Fcb HTTP/1.1
Host: server.example.com
*/

if($_GET['response_type']!='code'){
    die('Only support Authorization Code Grant');
}

$client_id = intval($_GET['client_id']);
$redirect_uri = urlencode($_GET['redirect_uri']);
if($_GET['scope']!='read'){
    echoMessageAndRefresh("scope should be set. (We only support 'read' now ");
    exit();
    //die('scope should be set. (We only support \'read\' now )');
}
if(!isset($_GET['state'])){
    echoMessageAndRefresh("parameter state should be set to protect csrf attack ");
    exit();
    //die('parameter state should be set to protect csrf attack');
}
$state = $_GET['state'];
$query_uri = $_SERVER['REQUEST_URI'];

if($_SESSION['login']){//已经登录

    if(!isset($_SESSION['confirm_auth'])||$_SESSION['confirm_auth']!==$_GET['confirm_auth']){
        $confirm_auth = getRandStr(16);
        $_SESSION['confirm_auth'] = $confirm_auth;
        // 提示确认授权登录
        echo "<!DOCTYPE html>
<html>
    <head>
    <title>确认授权登录</title>
    <script>function concatUri(){
        window.location.href = \"/oauth2.0/authorize.php?response_type=code&client_id=$client_id&scope=read&state=$state&confirm_auth=$confirm_auth&redirect_uri=$redirect_uri\";
    }</script>
    </head>
    <body>
        <h1>确认授权登录</h1>
        <form action=\"javascript:;\" method=\"get\">
          <button type=\"submit\" class=\"button button-block\" onClick='concatUri()'/>Log In</button>
        </form>
    </body>
</html>";
        exit();
    }

   $authorization_code = getRandStr(16);
   $sql  = 'insert into auth(userId, authorCode,createTime) values(?,?,?)';
   $mysqli_stmt = $mysqli->prepare($sql);
   $mysqli_stmt->bind_param('isi', $_SESSION['id'], $authorization_code,time());
   $res = $mysqli_stmt->execute();
   if(!$res){
       echo "insert into table error";
       exit();
   }
   $mysqli_stmt->close();
   $mysqli->close();
    header("location: ".urldecode($redirect_uri)."&code=$authorization_code&state=$state");
    exit();

}else{
    $callback_url =  'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $callback_url =  urlencode($callback_url);
    header("location: /index.php?next=$callback_url");
    exit();
}




