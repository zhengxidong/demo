<?php
/**
 * Undocumented function
 *
 * @param [type] $header
 * @param [type] $fileName
 * @param [type] $data
 * @return void
 */
function exportXls($fileName,$data){
    ini_set('max_execution_time','0');
    Vendor('PHPExcel.PHPExcel');

    $fileName = str_replace('.xls','',$fileName).'.xls';

    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
    //点击右键文件属性显示的信息
    ->setCreator('itellyou.site') //作者
    ->setLastModifiedBy('itellyou.site') //最后保存者
    ->setTitle('excel') //标题
    ->setSubject('excel') //主题
    ->setDescription('excel') //描述
    ->setKeywords('excel php') //标记
    ->setCategory('result file'); //类别

    $phpexcel->getActiveSheet()->fromArray($data);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setactiveSheetIndex(0);

    //设置header头
    header('Content-Type:application/vnd.ms-excel');
    header('Content-Disposition:attachment;filename=$fileName');
    header('Cache-Control:max-age=0');
    header('Cache-Control:max-age=1');
    header('Expires:Mon,26 jul 1997 05:00:00 GMT');
    header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
    header('Cache-Control:cache,must-revalidate');
    header('Pragma:public');

    $objWriter = PHPExcel_IOFactory::createWriter($phpexcel,'Excel5');
    $objWriter->save('php://output');
    exit;
}