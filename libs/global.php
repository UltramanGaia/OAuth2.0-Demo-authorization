<?php
/**
 * Created by PhpStorm.
 * User: GaiaA
 * Date: 2018/6/8
 * Time: 15:49
 */
function getRandStr($length) {
    $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randString = '';
    $len = strlen($str)-1;
    for($i = 0;$i < $length;$i ++){
        $num = mt_rand(0, $len);
        $randString .= $str[$num];
    }
    return $randString ;
}

function echoMessageAndRefresh($message, $page = "javascript:window.history.back(-1);", $waitTime = 3){
    echo "<!DOCTYPE html>
<html>
    <head>
    <title></title>
    <script language=\"javascript\" type=\"text/javascript\">
        var time = $waitTime;
    function tiaozhuan()
    {
        if(time==0)
            window.location=\"$page\";
        time--;
    }
    setInterval(\"tiaozhuan()\",1000);
    </script>
    </head>
    <body>
        <p>$message</p>
    </body>
</html>";
}



