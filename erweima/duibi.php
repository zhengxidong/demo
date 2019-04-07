<?php
//$_mysqli = new mysqli('192.168.0.150','root','root','parking_meter');

$dbms='mysql';//数据库类型
$dbName='parking_meter';//使用的数据库
$user='root';//数据库连接用户名
$pwd='root';//数据库连接密码
$host='192.168.0.150';//数据库主机名
$dsn="$dbms:host=$host;port=3306;dbname=$dbName";
try{
$pdo=new PDO($dsn,$user,$pwd);//初始化一个PDO对象，就是创建了数据库连接对象$pdo

//结果1
$query="select * from `parking_price_ta`";//需要执行的sql语句
$res=$pdo->prepare($query);//准备查询语句
$res->execute();
$result=$res->fetchAll(PDO::FETCH_ASSOC);

//结果2
$query2="select * from `parking_price_table`";//需要执行的sql语句
$res2=$pdo->prepare($query2);//准备查询语句
$res2->execute();
$result2=$res2->fetchAll(PDO::FETCH_ASSOC);



//print_r($result);
}catch(Exception $e){
die("Error!:".$e->getMessage().'<br>');
}


foreach ($result as $key => $value) {
	foreach ($result2 as $key => $va) {
		if($value[''] != $va[''])
	}
	//echo $value['parking_tariff_range_rule_id']."\n";
}