<?php
namespace Home\Controller;
use Think\Controller;
class ExportController extends Controller{
    function index(){
        $this->display();
    }

    /**
     * 
     * 导出数据(xls格式)
     */
    function exportExcel(){

        //表头
        $header = [['订单编号','金额','类型']];
        //数据
        $orderInfo = [
            [1,'30','衣服'],
            [1,'30','衣服'],
            [1,'30','衣服'],
        ];
        $fileName = date('Ymd').'_example';
        xlsExport($header,$orderInfo,$fileName);
    }

    /**
     * 
     * 导出数据(csv格式)
     */
    function exportCsv(){
        $header = ['订单编号','金额','类型'];
        $orderInfo = [
            [1,30,'衣服'],
            [1,30,'衣服'],
            [1,30,'衣服'],
        ];
        $fileName = date('Ymd').'_example';
        csvExport($header,$orderInfo,$fileName);
    }

    /**
     * 
     * 导出数据(csv格式) - 未测试
     * 将数据分割保存在多个csv文件中，并且最后压缩成zip文件提供下载
     */
    function putCsv(){
        $header = ['订单编号','金额','类型'];
        $orderInfo = [
            [1,30,'衣服'],
            [1,30,'衣服'],
            [1,30,'衣服'],
        ];
        $fileName = 'example';
        putCsv($header,$orderInfo,$fileName);
    }

    /**
     * 分批查询数据库导出 - 未测试
     *
     * @return void
     */
    function getExportCsv(){
        
        $header = ['订单编号','金额','类型'];
        $orderInfo = [
            [1,30,'衣服'],
            [1,30,'衣服'],
            [1,30,'衣服'],
        ];
        $fileName = 'example';
        getExportCsv($header,$orderInfo,$fileName);
    }
}