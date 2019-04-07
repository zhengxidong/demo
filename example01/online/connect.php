<?php
/*mysql_connect("localhost","zjwdb_6113975","1234567Php") or die ("连接数据库服务器失败！");*/
mysql_connect("localhost","root","") or die ("连接数据库服务器失败！");
/*mysql_select_db("zjwdb_6113975") or die ("没有指定数据库！");*/
mysql_select_db("db_tem") or die ("没有指定数据库！");
mysql_query("set names utf8");