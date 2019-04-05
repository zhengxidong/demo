<?php
/**
 * 导出xls格式
 *
 * @param [array] $header 表头
 * @param [type] $data 数据
 * @param string $fileName 文件名，默认example
 * @return void
 */
function xlsExport($header,$data,$fileName = 'example'){

    if(!empty($header)){
        $initData = array_merge($header,$data);
    }

    $fileName = $fileName.'.xls';

    set_time_limit(0);  //设置执行时间
    Vendor('PHPExcel.PHPExcel');

    $phpexcel = new PHPExcel();
    $phpexcel->getProperties()
    //点击右键文件属性显示的信息
    ->setCreator('itellyou.site')        //作者
    ->setLastModifiedBy('itellyou.site') //最后保存者
    ->setTitle('excel')                  //标题
    ->setSubject('excel')                //主题
    ->setDescription('示例文件')           //描述
    ->setKeywords('excel php')           //标记
    ->setCategory('result file');        //类别

    //写入数据
    $phpexcel->getActiveSheet()->fromArray($initData);
    $phpexcel->getActiveSheet()->setTitle('Sheet1');
    $phpexcel->setactiveSheetIndex(0);

    //设置header头
    header('Content-Type:application/vnd.ms-excel');
    header('Content-Disposition:attachment;filename='.$fileName);
    header('Cache-Control:max-age=0');
    header('Cache-Control:max-age=1');
    header('Expires:Mon,26 jul 1997 05:00:00 GMT');
    header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
    header('Cache-Control:cache,must-revalidate');
    header('Pragma:public');

    //输出到浏览器
    $objWriter = PHPExcel_IOFactory::createWriter($phpexcel,'Excel5');
    $objWriter->save('php://output');
    exit;
}

/**
 * 导出excel(csv)
 * @data 导出数据
 * @header 第一行,列名
 * @fileName 输出csv文件名,默认example
 */
function csvExport($header = [],$data = [],$fileName = 'example') {

    header("Content-type:text/csv;charset=utf-8");
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0,max-age=0');
    header('Expires:0');
    header('Pragma:public');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$fileName.'.csv"');
    //header('Cache-Control: max-age=0');
    //header("Last-Modified: {$now} GMT");

    //打开PHP文件句柄,php://output 表示直接输出到浏览器
    $fp = fopen('php://output', 'a');
    //输出Excel列名信息
    foreach ($header as $key => $value) {
        //CSV的Excel支持GBK编码，一定要转换，否则乱码
        $header[$key] = iconv('utf-8', 'gbk', $value);
    }
    //将数据通过fputcsv写到文件句柄
    fputcsv($fp, $header);
    //计数器
    $num = 0;
    //每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
    $limit = 100000;
    //逐行取出数据，不浪费内存
    $count = count($data);
    for ($i = 0; $i < $count; $i++) {
        $num++;
        //刷新一下输出buffer，防止由于数据过多造成问题
        if ($limit == $num) {
            ob_flush();
            flush();
            $num = 0;
        }
        $row = $data[$i];
        foreach ($row as $key => $value) {
            $row[$key] = iconv('utf-8', 'gbk', $value);
        }
        fputcsv($fp, $row);
    }
}

//未测试
//导出说明:因为EXCEL单表只能显示104W数据，同时使用PHPEXCEL容易因为数据量太大而导致占用内存过大，
//因此，数据的输出用csv文件的格式输出，但是csv文件用EXCEL软件读取同样会存在只能显示104W的情况，
//所以将数据分割保存在多个csv文件中，并且最后压缩成zip文件提供下载
function putCsv(array $head, $data, $mark = 'attack_ip_info', $fileName = "test.csv")
{
    set_time_limit(0);
    $sqlCount = $data->count();
    // 输出Excel文件头，可把user.csv换成你要的文件名
    header('Content-Type: application/vnd.ms-excel;charset=utf-8');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    $sqlLimit = 100000;//每次只从数据库取100000条以防变量缓存太大
    // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
    $limit = 100000;
    // buffer计数器
    $cnt = 0;
    $fileNameArr = array();
    // 逐行取出数据，不浪费内存
    for ($i = 0; $i < ceil($sqlCount / $sqlLimit); $i++) {
        $fp = fopen($mark . '_' . $i . '.csv', 'w'); //生成临时文件
  //     chmod('attack_ip_info_' . $i . '.csv',777);//修改可执行权限
        $fileNameArr[] = $mark . '_' .  $i . '.csv';
    // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);
        $dataArr = $data->offset($i * $sqlLimit)->limit($sqlLimit)->get()->toArray();
        foreach ($dataArr as $a) {
            $cnt++;
            if ($limit == $cnt) {
                //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            fputcsv($fp, $a);
        }
        fclose($fp);  //每生成一个文件关闭
    }
    //进行多个文件压缩
    $zip = new ZipArchive();
    $filename = $mark . ".zip";
    $zip->open($filename, ZipArchive::CREATE);   //打开压缩包
    foreach ($fileNameArr as $file) {
        $zip->addFile($file, basename($file));   //向压缩包中添加文件
    }
    $zip->close();  //关闭压缩包
    foreach ($fileNameArr as $file) {
        unlink($file); //删除csv临时文件
    }
    //输出压缩文件提供下载
    header("Cache-Control: max-age=0");
    header("Content-Description: File Transfer");
    header('Content-disposition: attachment; filename=' . basename($filename)); // 文件名
    header("Content-Type: application/zip"); // zip格式的
    header("Content-Transfer-Encoding: binary"); //
    header('Content-Length: ' . filesize($filename)); //
    @readfile($filename);//输出文件;
    unlink($filename); //删除压缩包临时文件
}

/**
 * 未测试
 * 下载的文件通常很大, 所以先设置csv相关的Header头, 然后打开
 * PHP output流, 渐进式的往output流中写入数据, 写到一定量后将系统缓冲冲刷到响应中
 * 避免缓冲溢出
 */
function getExportCsv($timeStart, $timeEnd){

    set_time_limit(0);
    $columns = [
        '文章ID','文章标题',
    ];
    
    $csvFileName = '用户日志' . $timeStart .'_'. $timeEnd . '.xlsx';
    //设置好告诉浏览器要下载excel文件的headers
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="'. $fileName .'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    $fp = fopen('php://output', 'a');//打开output流
    mb_convert_variables('GBK', 'UTF-8', $columns);
    fputcsv($fp, $columns);//将数据格式化为CSV格式并写入到output流中
    $accessNum = '1000000'//从数据库获取总量，假设是一百万
    $perSize = 1000;//每次查询的条数
    $pages   = ceil($accessNum / $perSize);
    $lastId  = 0;
    for($i = 1; $i <= $pages; $i++) {
        $accessLog = $logService->getArticleAccessLog($timeStart, $timeEnd, $lastId, $perSize);
        foreach($accessLog as $access) {
            $rowData = [
                //每一行的数据
            ];
            mb_convert_variables('GBK', 'UTF-8', $rowData);
            fputcsv($fp, $rowData);
            $lastId = $access->id;
        }
        unset($accessLog);//释放变量的内存
        //刷新输出缓冲到浏览器
        ob_flush();
        flush();//必须同时使用 ob_flush() 和flush() 函数来刷新输出缓冲。
    }
    fclose($fp);
    exit();
}