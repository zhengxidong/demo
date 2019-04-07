<?php  
    session_start();  
    //生成4位随机验证码，并存入缓存  
    function getRandomString($len, $chars=null)  
    {  
        if (is_null($chars)){  
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
        }   
        mt_srand(10000000*(double)microtime());  
        for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++){  
            $str .= $chars[mt_rand(0, $lc)];   
        }  
        return $str;  
    }  
    $vertiCode=getRandomString(4);  
    $_SESSION['vertiCodeS']=$vertiCode;//给session中的vertiCodeS变量赋值  
      
    //调用阿里大于短信验证码服务，给用户发随机验证码,$userName,$phone,$vertiCode为输入的参数，电话号码时必须的，  
    //其他两个参数是因为我在阿里大于短信模板中设置的参数  
    function sendSMS($userName,$phone,$vertiCode){  
    include "./alidayu_sdk/TopSdk.php";   
    $c = new TopClient;  
    $c->appkey ="";//你自己的appkey，需要在阿里大于创建应用(随便什么应用都行)，以获取appkey  
    $c->secretKey ="";//你自己的secretKey  
    $req = new AlibabaAliqinFcSmsNumSendRequest;  
    $req->setSmsType("normal");  
    $req->setSmsFreeSignName("大盈若冲");  
    $req->setSmsParam("{\"userName\":\"$userName\",\"vertificationCode\":\"$vertiCode\"}");  
    $req->setRecNum("$phone");  
    $req->setSmsTemplateCode("");  
    $resp = $c->execute($req);  
    echo $resp;  
    var_dump($resp);  
    //if($resp->result->success){echo true;}  
    //else{echo false;}  
    }  
    sendSMS($_POST[username],$_POST[phone],$vertiCode);  
?>