<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/8
 * Time: 11:02
 */
include "config/config.php";
include "libs/global.php";
session_start();

$email = trim($_POST['email']);
$password = trim($_POST['password']);
if(empty($email)||empty($password)){
    echoMessageAndRefresh("email and password can not be empty","/login.php");
    exit();
    //die("email and password can not be empty");
}

$mysqli_stmt = $mysqli->prepare("select id,password,salt from user where email=?");
$mysqli_stmt->bind_param("s",$email);
$mysqli_stmt->execute();
$mysqli_stmt->store_result();
if($mysqli_stmt->num_rows() === 0){
    echoMessageAndRefresh("error email or password","/login.php");
    exit();
    //die("error email or password");
}
$mysqli_stmt->bind_result($id, $password_md5, $salt);
$mysqli_stmt->fetch();
if(md5($salt.$password) === $password_md5){
    $_SESSION['login'] = true;
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $email;
    // echo "login success";
    if(isset($_GET['next'])){
        echoMessageAndRefresh("success",urldecode($_GET['next']));
    }else{
        echoMessageAndRefresh("success","/profile");
    }

}else{
    echoMessageAndRefresh("error email or password","/login.php");
}




$mysqli_stmt->close();
$mysqli->close();


