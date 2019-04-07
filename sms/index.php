<?php 
   session_start();
    $captcha_code = "";
  //7>生成随机数字
  for($i=0;$i<6;$i++){
    //设置数字
    $fontcontent = rand(0,9);
    $captcha_code .= $fontcontent;  
  }
  $_SESSION['authcode'] = $captcha_code;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="test_sms.php" method="post">
		手机号码：<input type="text" name="mobile">
		           <input type="hidden" name="message" value="<?php echo $_SESSION['authcode'] ?>">
		<input type="submit" name="submit" value="获取验证码">
	</form>
</body>
</html>