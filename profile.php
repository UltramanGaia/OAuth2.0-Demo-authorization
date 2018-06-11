<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/8
 * Time: 11:05
 */
include "config/config.php";
session_start();

if(!$_SESSION['login']){
    header("location: login.php");
    exit;
}

$id = $_SESSION['id'];
$email = $_SESSION['email'];

$mysqli_stmt = $mysqli->prepare("select firstName,lastName from user where Id=?");
$mysqli_stmt->bind_param("i",$id);
$mysqli_stmt->execute();
$mysqli_stmt->bind_result($firstName, $lastName);
$mysqli_stmt->fetch();

echo "Your id is $id</br>";
echo "Your first name is $firstName</br>";
echo "Your lastName is $lastName</br>";
echo "Your email is $email</br>";










