<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/8
 * Time: 11:07
 */

include "../config/config.php";

// 注意，这里需要验证下client 服务器的身份，可以选择
// 为了方便，我们这里直接验证一个secret_code
if($_POST['secret_code']!=='adHexbgtxHGtcMoh13'){
    die("error secret code");
}

if(!isset($_POST['access_token'])){
    die("error, access_token is required");
}
$accessToken = $_POST['access_token'];

$sql = "select userId from access where accessToken = ? and now()<createTime + 3600";
$mysqli_stmt = $mysqli->prepare($sql);
$mysqli_stmt->bind_param("s", $accessToken);
$mysqli_stmt->execute();
if($mysqli_stmt->num_rows()===0){
    die("error accessToken or accessToken out-of-date");
}
$mysqli_stmt->bind_result($userId);
$mysqli_stmt->fetch();
$mysqli_stmt->close();

$sql = "select firstName, lastName from user where id = ? ";
$mysqli_stmt = $mysqli->prepare($sql);
$mysqli_stmt->bind_param("i",$userId);
$mysqli_stmt->execute();
$mysqli_stmt->bind_result($firstName, $lastName);
$mysqli_stmt->fetch();
$mysqli_stmt->close();

$mysqli->close();

echo "{
\"firstname\":$firstName,
\"lastname\":$lastName
}";











