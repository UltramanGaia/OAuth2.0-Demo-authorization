<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/8
 * Time: 11:07
 */

include "libs/global.php";
include "config/config.php";

session_start();

$firstName = trim($_POST['first_name']);
$lastName = trim($_POST['last_name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);

if(empty($email)||empty($password)){
    die("email and password can not be empty");
}

$mysqli_stmt = $mysqli->prepare("select * from user where email=?");
$mysqli_stmt->bind_param('s', $email);
$res = $mysqli_stmt->execute();
$mysqli_stmt->store_result();
if(!$res){
    die("select error");
}
$row = $mysqli_stmt->num_rows ;
$mysqli_stmt->close();
if($row != 0) { //email exists
    echo "email exists";
    exit;
}else{
    $mysqli_stmt = $mysqli->prepare("insert into user(firstName, lastName, email, password, salt) values(?,?,?,?,?)");
    $salt = getRandStr(4);
    $password = md5($salt.$password);
    $mysqli_stmt->bind_param("sssss",$firstName, $lastName, $email, $password, $salt);
    $res = $mysqli_stmt->execute();
    $mysqli_stmt->store_result();
    if(!$res){
        echo "insert into table error";
        exit;
    } else{
        echo "success";
    }
    $mysqli_stmt->close();
}
$mysqli->close();

