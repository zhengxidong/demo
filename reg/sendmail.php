<?php
header("Content-type:text/html;charset=utf-8");
require_once "email.class.php";

//**************数据库配置****************
$con = mysql_connect("localhost","root","");   //修改为自己的数据库账号密码
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("test", $con);        //修改为自己的数据库



$username = stripslashes(trim($_POST['username']));
$password = md5(trim($_POST['password']));
$email = trim($_POST['email']);
$regtime = time();
$token = md5($username.$password.$regtime); //创建用于激活识别码
$token_exptime = time()+60*60*24;//过期时间为24小时后

$query=mysql_query("select username from t_user where username='$username'  ");
if($row=mysql_fetch_array($query)){
    echo "用户名存在";
    return 0;
}

//插入用户信息
$sql="INSERT INTO t_user (username, password, email,regtime,token,token_exptime)
VALUES('$username','$password','$email','$regtime','$token','$token_exptime')";

if (!mysql_query($sql,$con))
{
    die('Error: ' . mysql_error());
}

//若注册成发送邮件


//********************配置邮箱信息 ********************************
$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "541410829@qq.com";//SMTP服务器的用户邮箱,即你的邮箱,若使用qq邮箱等其他邮箱，SMTP服务器也改为smtp.qq.com等
$smtpemailto = $_POST['email'];//发送给谁
$smtpuser = "541410829@qq.com";//SMTP服务器的用户帐号,你的邮箱账号，对应上面的邮箱
$smtppass = "Zheng123.13";//SMTP服务器的用户密码,你的邮箱密码
$mailtitle = "激活账号";//邮件主题
$mailcontent = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://activity.appgame.com/reg/active.php?verify=".$token."' target='_blank'>http://activity.appgame.com/reg/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- ***敬上</p>";

$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************发送邮件****************************
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//是否显示发送的调试信息
$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

echo "<div style='width:300px; margin:36px auto;'>";
if($state==""){
    echo "系统繁忙";
    echo $state->smtp_error();
    echo "<a href='index.html'>点此返回</a>";
    exit();
}
echo "恭喜！注册成功，已经发送邮箱到你的邮箱，请尽快激活！！";
echo "<a href='index.html'>点此返回</a>";
echo "</div>";





?>