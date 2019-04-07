<?php


$con = mysql_connect("localhost","root","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("test", $con);



$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();
$query = mysql_query("select id ,token_exptime from  t_user where status=0 and token ='$verify'");
$row = mysql_fetch_array($query);
if($row){
    if($nowtime>$row['token_exptime']){ //30min
        echo "您的激活有效期已过，请登录您的帐号重新发送激活邮件";
    }else{
        mysql_query("update user set status=1 where id=".$row['id']);
        echo "激活成功";

    }
}else{
    echo "系统繁忙";
}

?>