<?php
include_once('connect.php');
//查询区域统计
$sql = "select province,count(*) as total from online group by province order by total desc";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result)) {
	$list[] = array('province'=>$row['province'],$total=>$row['total']);
}
echo json_encode($list);//以json格式输出