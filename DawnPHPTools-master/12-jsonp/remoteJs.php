<?php
//��������
$callback=$_GET['callback'];
$code=$_GET['code'];

//��ѯ����ȡ����(����ͨ�����ݿ��ѯ�������)
switch($code){
	case 'CA1998':
		$price=1200;
		$tickets=20;
		break;
	case 'CA1999':
		$price=4500;
		$tickets=2;
		break;
}

//ƴ������
$data="{
	'code':'" . $code . "',
	'price':$price,
	'tickets':$tickets
}";
		
//���ؽ��
echo $callback . '('. $data .')';
?>