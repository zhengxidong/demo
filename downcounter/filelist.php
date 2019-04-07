<?php
require 'conn.php';

$result = mysql_query("SELECT * FROM downloads");

if(mysql_num_rows($result)){
	while($row=mysql_fetch_assoc($result)){
		$data[] = array(
			'id' => $row['id'],
			'file' => $row['filename'],
			'downloads'=> $row['downloads']
		);
	}
	echo json_encode($data);
}
?>