<?php
error_reporting(E_ALL^E_NOTICE);
require('conn.php');
$id = (int)$_GET['id'];

if(!isset($id) || $id==0) die('参数错误!');
$query = mysql_query("select * from downloads where id='$id'");
$row = mysql_fetch_array($query);
if(!$row) exit;
$filename = iconv('UTF-8','GBK',$row['filename']);//中文名称注意转换编码
$savename = $row['savename']; //实际在服务器上的保存名称
$myfile = 'file/'.$savename;
if(file_exists($myfile)){//
	mysql_query("update downloads set downloads=downloads+1 where id='$id'");
	$file = @ fopen($myfile, "r");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=" .$filename );
	while (!feof($file)) {
		echo fread($file, 50000);
	}
	fclose($file);
	exit;
}else{
	echo '文件不存在！';
}
?>