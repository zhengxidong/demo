<?php
//���������
function random_text($count,$rm_similar=false){
	$chars=array_flip(array_merge(range(0,9),range('A','Z'))); 
	if($rm_similar){
		unset($chars[0],$chars[1],$chars[2],$chars[5],$chars[8],$chars['B'],$chars['I'],$chars['O'],$chars['Q'],$chars['S'],$chars['V'],$chars['Z']); 
	}
	for($i=0,$text='';$i<$count;$i++){
		$text.=array_rand($chars); 
	}
	return $text;
}

//�ų�����
function debug($s,$isDie=true){
	echo '<hr><pre>';
	print_r($s);
	echo '</pre><hr>';
	if($isDie){
		die();
	}
}

