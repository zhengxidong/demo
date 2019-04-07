<?php
/**
 * Created by PhpStorm.
 * User: dan.zheng
 * Date: 2017/7/31 0031
 * Time: 上午 10:16
 */
include_once './phpqrcode.php';
//header('Content-type:image/png');
/**
 * 直接输出二维码图片
 */
QRcode::png(
    '{http://www.zxdphp.site,mailto:freemouse@email.com,tel:13955555555}',
    false,
    QR_ECLEVEL_L,
    8,
    4
);


/**
 * 保存二维码到本地文件夹
 * 存放在temp文件夹下面，并且重新命名
 */
   /* $PNG_TEMP_DIR = dirname(__FILE__).'/temp/';
    if(!file_exists($PNG_TEMP_DIR))
    {
        mkdir($PNG_TEMP_DIR);
    }
    $file_name = $PNG_TEMP_DIR.time().'.png';
    QRcode::png(
        'http://www.zxdphp.site',
        $file_name,
        QR_ECLEVEL_L,
        16,
        4
    );*/

/**
 * 生成下载二维码
 */
/*try{
    $PNG_TEMP_DIR = dirname(__FILE__).'\temp\\';

    $file_name = $PNG_TEMP_DIR.time().'.png';
    $download_file_name = 'qq.png';
    QRcode::png(
        'http://www.zxdphp.site',
        $file_name,
        QR_ECLEVEL_L,
        16,
        4
    );
    if(file_exists($file_name))
    {
        $file = fopen($file_name,"r");
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Accept-Length:".filesize($file_name));
        header("Content-Disposition:attachment;filename=".$download_file_name);

        //输出文件内容
        echo fread($file,filesize($file_name));

        fclose($file);

        unlink($file);
    }
}
catch(Exception $e){
    echo "无法下载图片\n";
    echo $e->getMessage();
}*/

/**
 * 二维码中加入图片logo
 */
/*$value = 'iphone';//二位码内容
$errorCorrenctionLevel = '1';//容错级别
$matrixPointSize = 6;//二维码图片大小
QRcode::png($value,'qrcode.png',$errorCorrenctionLevel,$matrixPointSize);
//图片logo加入二维码
$logo ='1.png';
$qrcode = 'qrcode.png';
$logo = imagecreatefromstring(file_get_contents($logo));
$qrcode = imagecreatefromstring(file_get_contents($qrcode));
$QR_width = imagesx($qrcode);//二维码图片宽度
$QR_height = imagesy($qrcode);//二位图片高度
$logo_width = imagesx($logo);//logo图片宽度
$logo_height = imagesy($logo);//logo图片高度
$logo_qr_width = $QR_width/5;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;
$from_width = ($QR_width-$logo_qr_width)/2;
//重新组合图片并调整大小
imagecopyresampled($qrcode,$logo,$from_width,$from_width,0,0,$logo_qr_width,$logo_qr_height,$logo_width,$logo_height);

imagepng($qrcode,'helloweixin.png');
echo '<img src="helloweixin.png">';*/

/*function image()
{
    $data = 'www.baidu.com';
    $level = 'L';
// 纠错级别：L、M、Q、H
    $size = 6;// 点的大小：1到10,用于手机端4就可以了

    ob_start();
    QRcode::png($data,false,$level,$size);
    $imageString = base64_encode(ob_get_contents());
    ob_end_clean();
    //$path=ROOT_PATH.'public/static/images/qrcode/';
    //$QRcode->png($data,$path.$fileName,$level,$size);
    // 生成本地图片
    return $imageString;
}
echo image();*/