<?php
include_once("connect.php");
include_once("smtp.class.php");

$username = stripslashes(trim($_POST['username']));
$query = mysql_query("select id from t_user where username='$username'");
$num = mysql_num_rows($query);
if($num==1)
{
	echo "用户名已存在，请换个其他的用户名";
	exit;
}
$password = md5(trim($_POST['password']));
$email =trim($_POST['email']);
$regtime = time();

$token = md5($username.$password.$regtime);
$token_exptime = time()+60*60*24;

$sql = "insert into `t_user` (`username`,`password`,`email`,`token`,`token_exptime`,`regtime`)  
values ('$username','$password','$email','$token','$token_exptime','$regtime')";

mysql_query($sql);

if(mysql_insert_id()){
	include_once("smtp.class.php");
	$smtpserver = "smtp.163.com";
	$smtpserverport = 25;
	$smtpusermail ="";
	$smtpuser ="";
	$smtppass ="";
	$smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
	$emailtype ="HTML";
	$smtpemailto = $email;
	$smtpemailfrom = $smtpusermail;
	$emailsubject = "用户账号激活";
	$emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://www.helloweba.com/demo/register/active.php?verify=".$token."' target='_blank'>http://www.helloweba.com/demo/register/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Hellwoeba.com 敬上</p>";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
    if($rs==1){
    	$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';	
    }
    else
    {
    	$msg = $rs;
    }
    echo $msg;
}