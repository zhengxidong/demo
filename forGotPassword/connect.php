<?php
   $server = "localhost";
   $user ="root";
   $pw = "";
   $link = mysql_connect($server,$user,$pw);
   mysql_db_name("test",$link);
/*   mysql_set_charset("charset=utf8");
   $row = mysql_query("select * from test");
    
    $arr = array();
    while ($arrda = mysql_fetch_assoc($row)) {
    	$arr[] = $arrda;
    }*/