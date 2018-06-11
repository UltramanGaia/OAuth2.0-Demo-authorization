<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/11
 * Time: 10:50
 */

/*   POST /token HTTP/1.1
     Host: server.example.com
     Authorization: Basic czZCaGRSa3F0MzpnWDFmQmF0M2JW
     Content-Type: application/x-www-form-urlencoded;charset=UTF-8

     grant_type=authorization_code&code=SplxlOBeZQQYbYS6WxSbIA
     &redirect_uri=https%3A%2F%2Fclient%2Eexample%2Ecom%2Fcb
*/
include "../libs/global.php";
include "../config/config.php";

// 注意，这里需要验证下client 服务器的身份，可以选择
// 为了方便，我们这里直接验证一个secret_code
if($_POST['secret_code']!=='adHexbgtxHGtcMoh13'){
    die("error secret code");
}

if($_POST['grant_type']!=='authorization_code'){
   die("Only support authorization_code") ;
}
$auth_code = $_POST['code'];
$redirect_uri = $_POST['redirect_uri'];

$sql = "select userId from auth where authorCode = ? and now()<createTime + 3600";
$mysqli_stmt = $mysqli->prepare($sql);
$mysqli_stmt->bind_param("s",$auth_code);
$mysqli_stmt->store_result();
$res = $mysqli_stmt->execute();
if(!$res){
    die("mysql error");
}
$mysqli_stmt->bind_result($userId, $createTime);
if($mysqli_stmt->num_rows()===0){
    die("error authorization code");
}
$mysqli_stmt->fetch();
$mysqli_stmt->close();

// 是否超时
if(time()-$createTime > 3600){
   // 删除数据，提示超时

}


$accessToken = getRandStr(16);
$refreshToken = getRandStr(16);

$sql = "insert into access(accessToken, refreshToken, createTime, userId) values(?,?,now(),?);";
$mysqli_stmt = $mysqli->prepare($sql);
$mysqli_stmt->bind_param('ssi', $accessToken, $refreshToken, $userId);
$res = $mysqli_stmt->execute();
if(!$res){
    die("insert into table error");
}
$mysqli_stmt->close();
$mysqli->close();

$email = $_SESSION['email'];

echo "{
       \"access_token\":\"$accessToken\",
       \"token_type\":\"example\",
       \"expires_in\":3600,
       \"refresh_token\":\"$refreshToken\",
       \"email\":\"$email\"
     }
";





