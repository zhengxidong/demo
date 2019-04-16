<?php
/**=============================================
 * MyConfig Class
 *
 * 配置文件操作类
 * 类名时驼峰法，方法名是下划线法。
 *
 * @version		v1.0.1
 * @revise		2015.12.15
 * @date		2015.12.15
 * @author		Dawn
 * @email		JimmyMall@live.com
 * @link		https://github.com/DawnEve/DawnPHPTools
 =============================================*/

class MyConfig{
	private $config_file='';//配置文件位置
	function __construct($config_file='config.php'){
		$this->config_file=$config_file;
	}
	
	//读取配置
	function get($key){
		$set = include($this->config_file);
		//如果没有设置，则返回null
		if(isset($set[$key])){
			return $set[$key];
		}else{
			return null;
		}
	}
	
	//修改/新增配置
	function set($key,$value){
		$set = include($this->config_file);
		var_dump($set);
		
		if($set[$key]==$value){
			return;
		}
		$set[$key]=$value;
		self::array2config($set,$this->config_file);
	}
	
	//静态方法：数组写入配制文件
	static function array2config($arr,$file='config.php'){
		$str='<?php'.PHP_EOL.'return '.var_export($arr,TRUE).';';
		file_put_contents($file, $str);
	}
}
?>