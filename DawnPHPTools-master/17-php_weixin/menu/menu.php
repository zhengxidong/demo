<?php
define("BathPath","D:/xampp/htdocs/php/DawnPHPTools/17-php_weixin/DawnPHP/");
include('../dawnPHP/mylib.php');

//============================
// 1.��Ӳ˵����ɹ�ʱ�������config.txt�ļ������ԡ�
// 2.����ӵĲ˵�24Сʱ��Żῴ��Ч�������ٸ��½���ķ�ʽ��ȡ����ע�������¹�ע��
//============================

//ִ��΢�Ų˵�����ӡ�ɾ����û��ʵ�֣�����
//�˵�����
include 'menu_data.php';

//��ȡACC_TOKEN
$ACC_TOKEN=ACC_TOKEN::get();
print_r( $ACC_TOKEN );
echo '<hr>';

//��Ӳ˵�
$info=Menu::add($ACC_TOKEN,$data);
print_r( $info );

/*Array
(
    [access_token] => 9lIBRRkLUPB9xG5urYWcs-_wAHA8mtqriMHzH1f0syOw2Tp3KyhQjCIkpwU9DaXtpr1FI6Ubc2d8awtfwlSQnhkwJbPZZyR8NYlLqxcvgr8UGBfAFAGSN
    [expires_in] => 7200
)
9lIBRRkLUPB9xG5urYWcs-_wAHA8mtqriMHzH1f0syOw2Tp3KyhQjCIkpwU9DaXtpr1FI6Ubc2d8awtfwlSQnhkwJbPZZyR8NYlLqxcvgr8UGBfAFAGSN
{"errcode":48001,"errmsg":"api unauthorized hint: [tjhB70411vr21]"}
*/

//��Ϊû�л�300Ԫ��֤������û�в˵�Ȩ�ޡ�
//{"errcode":48001,"errmsg":"api unauthorized hint: [96DoGa0987vr22]"}