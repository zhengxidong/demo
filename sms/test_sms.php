<?php
session_start();
if(!empty($_POST['mobile'])){
  require 'sms.php';
  $mobile = $_POST['mobile'];
  $message = $_POST['message'];

//api key可在后台查看 短信->触发发送下面查看
$sms = new Sms( array('api_key' => '08ea34fa1faf3596de3c414000bb4e98' , 'use_ssl' => FALSE ) );

$mobile = $_POST['mobile'];
$message = $_POST['message'];
//send 单发接口，签名需在后台报备
$res = $sms->send($mobile, '验证码：'.$message.'【铁壳测试】');
if( $res ){
            if( isset( $res['error'] ) &&  $res['error'] == 0 ){
                echo 'success';
            }
            else{
                echo 'failed,code:'.$res['error'].',msg:'.$res['msg'];
            }
         }
        else{
            var_dump( $sms->last_error() );
        }
exit;  
}


//deposit 余额查询
/*$res = $sms->get_deposit();
if( $res ){
    if( isset( $res['error'] ) &&  $res['error'] == 0 ){
        echo 'desposit:'.$res['deposit'];
    }else{
        echo 'failed,code:'.$res['error'].',msg:'.$res['msg'];
    }
}else{
    var_dump( $sms->last_error() );
}
exit;*/









