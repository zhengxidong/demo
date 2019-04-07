<?php
  
   header("Content-type:text/html;charset=utf-8");
   session_start();

?>
<!doctype html>
<html>
<head>
<script src="jquery-2.1.1.min.js"></script>
<script>
$(function(){
  $("input").focus();
  $("button").click(function(){
    var veri = $("input").val();
 if(veri == ''){$("#empty").html("请输入验证码"); $("input").focus(); return false; }
 $.ajax({
 	type:"POST",
 	url:"deal.php?"+Math.random(),
 	data:"veri="+veri,success:function(response){
 if(response == '' || isNaN(response)){ 
 	window.alert("发生错误"); 
 	return false;
 }else
 if(response == '2'){ 
  $("img").attr("src","code.php?"+Math.random());
  $("input").val('').focus(); $("#empty").html("输入错误，请重新输入"); 
 }else
 if(response == '1'){ window.alert("通过了！"); }
 }});
  });
});
</script>
</head>
<body style="text-align:center;">
<p style="margin:80px auto;width:200px;height:40px;">
  <img src="code.php" onclick="this.src='code.php?'+Math.random()" style="cursor:pointer">
</p>
<p>刷新验证码请直接点击图像</P>
<p style="margin:40px auto;width:200px;height:40px;">
  <input type="text">
</p>
<p id="empty"> </p>
<button>提交</button>
</body>
</html>