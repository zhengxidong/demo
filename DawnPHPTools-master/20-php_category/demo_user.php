<?php
session_start();

include('dawnPHP/mylib.php');



/*
$_SESSION['uid'] = 2;
$_SESSION['username'] = '';
$_SESSION['lastlogin'] = ;
$_SESSION['usergroup'] = 2;
$_SESSION['lastBrowseTime'] = ;

function p($s,$isBR=true){ 
	echo $s;
	if($isBR) echo '<br >';
}


echo '<pre>';
p( session_name() . ' = ' , 0);
p( session_id() );

print_r($_SESSION);

*/
$_SESSION['user']=null;
$user=array(
	'uid'=>'2',
	'username'=>'',
	'lastlogin'=>'',
	'usergroup'=>'2',
	'lastBrowseTime'=>'',
);
$_SESSION['user'] = $user;





if($_SESSION['user']){
	echo $_SESSION['user']['username'] . ' 已经登陆。<a href="index.php">回到首页</a>';
}else{
	echo '登陆正在开发中。请联系管理员。<a href="index.php">回到首页</a>';
}

echo '<pre>';
print_r($_SESSION);
echo sha1(123456);
