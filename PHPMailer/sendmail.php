<?php
/**
 * Created by PhpStorm.
 * User: Dong
 * Date: 2017/2/26
 * Time: 21:46
 */
require_once('class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.163.com";
$mail->Port = 25;
$mail->SMTPAuth = true;

$mail->CharSet = "UTF-8";
$mail->Encoding = "base64";

$mail->Username = "541410829@qq.com";
$mail->Password = "Zheng123.13";
$mail->Subject = "你好";

$mail->Prom ="541410829@qq.com";
$mail->FromName ="一路上";

$address ="1042445384@qq.com";
$mail->AddAddress($address,"亲");

$mail->AddAttachment('xx.xls','我的附件.xls');
$mail->IsHTML(true);
$mail->AddEmbeddedImage("logo.jpg","my-attach","logo.jpg");
$mail->Body = '你好, <b>朋友</b>! <br/>这是一封来自<a href="//www.yilushang.net"
target="_blank">yilushang.net</a>的邮件！<br/>
<img alt="yilushang" src="cid:my-attach">'; //邮件主体内容

if(!$mail->Send()){
    echo "Mailer Error:".$mail->ErrorInfo;
}
else{
    echo "Message sent!";
}