------------------------
Log format for each tools:
------------------------
title: 22-MySQL_data_transfer 
Description:MySQL���ݲ�ѯ�Ͱ�Ǩ��

keywords: cache
pros&cons: 
	pros: �������ò���MySQL�Ľű���
	cons:

version: v1.0.0
mod_time:[]
add_time:[10:19 2017/01/01]
auther: Dawn
Email: jimmymall@live.com

Files&Functions:
==================================================
�ļ��ṹ��
modify_mysql_user.php #����ֱ���á�
log_reader.php #��ȡ��־�ļ���

�����ǵ�ҳ��Ӧ�ýű���


�����ǻ�����ģ�
utils/db/MysqlHelper.class.php ������
index.php �����ļ�
==================================================
Databases: think_user��
show create table think_user;

CREATE TABLE `think_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) DEFAULT NULL,
  `passwd` char(35) DEFAULT 'e10adc3949ba59abbe56e057f20f883e',
  `email` varchar(100) DEFAULT NULL,
  `add_time` varchar(30) DEFAULT NULL,
  `modi_time` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8

*/

//todo: file_put_contents()����__destruct�м�¼ʧ�ܣ�why?











------------------------
Log format for each tools:
------------------------
title: 22-MySQL_data_transfer 
Description:����PDO��MySQL�����ࡣ

keywords: cache
pros&cons: 
	pros: ��������MySQL������
	cons:

version: v1.0.0
mod_time:[]
add_time:[10:19 2017/01/01]
auther: Dawn
Email: jimmymall@live.com

Files&Functions:
==================================================
�ļ��ṹ��
util/db/PDOHelper.class.php 
index2.php 


==================================================
Databases: think_user��
Features:
	Well tested code.
	Secured against SQL injections by using PHP Data Objects(PDO) and Prepared Statements.
	Always returns objects which you can directly use to inform the user.
	Includes proper error handling and information broadcast.

The Framework:
Mainly in SQL database we use the following 4 operations to manage our data (DML Operations)
	C �C Create
	R �C Read
	U �C Update
	D �C Delete



