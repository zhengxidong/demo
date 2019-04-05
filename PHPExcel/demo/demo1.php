<?php
set_time_limit (0); //设置脚本最大执行时间，单位为秒，设置为0，则没有时间限制
#使用轻量级的excel操作库PHP_XLSXWriter
$timeStart = microtime(true);
require_once __DIR__."/../PHP_XLSXWriter/vendor/autoload.php";

$writer = new XLSXWriter();
$sheetHeader = [
    '商品id'=>'string',
    '库存量'=>'string',
    '单价'=>'string',
    '名称'=>'string',
    '卖家联系电话'=>'string'//设置为string，避免变成科学计数法
];

$writer->writeSheetHeader('Sheet1',  $sheetHeader);//输出列名
for($i=0; $i<1000000; $i++)
{
    $s1 = $i+1;
    $s2 = mt_rand(0,1000);
    $s3 = mt_rand(100,999)/10;
    $s4 = "商品".$s1;
    $s5 = "13713147601";//随便输入的
    $writer->writeSheetRow('Sheet1', array($s1, $s2, $s3, $s4, $s5) );
}
$writer->writeToFile('goods_info.xlsx');
echo floor((memory_get_peak_usage())/1024/1024)."MB";
echo "\n";
echo microtime(true) -$timeStart;