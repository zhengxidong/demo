<?php
/**
 * Created by PhpStorm.
 * User: Dong
 * Date: 2017/3/2
 * Time: 15:36
 */
class Verify{
    public  $config = array(
        'width'=>80,
        'height'=>40,
        'size'=>20,
        'startx'=>10,
        'starty'=>30,
        'font'=>'./font/simfang.ttf'
    );

    /**初始化
     * @param null $arr
     */
    public function __construct($arr=null){
        if(is_array($arr)){
            foreach($arr as $key=>$value){
                if(array_key_exists($key,$this->config)){
                    $this->config[$key] = $value;
                }
            }
        }
    }

    /**
     * 字母加数字
     * 输出验证码
     */
    public function show(){
        header("content-type:image/png");
        //创建画布
        $resData = imagecreate($this->config['width'],$this->config['height']);
        //给画布分配颜色
        imagecolorallocate($resData,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
        $color = imagecolorallocate($resData,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
        $pixelcolor = imagecolorallocate($resData,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
        $linecolor = imagecolorallocate($resData,mt_rand(100,200),mt_rand(100,200),mt_rand(100,200));
        for($j=0;$j<100;$j++) {
            imagesetpixel($resData, mt_rand(0, $this->config['width']), mt_rand(0, $this->config['height']), $pixelcolor);
            if($j<4) {
                //画线
                imageline($resData, mt_rand(0, $this->config['width']/ 5), mt_rand(0, $this->config['height']), mt_rand($this->config['width'] / 2, $this->config['width']), mt_rand(0, $this->config['height']), $linecolor);
            }
        }
        imagettftext($resData,$this->config['size'],0,$this->config['startx'],$this->config['starty'],$color,$this->config['font'],$this->getRandData());
        //输出画布
        imagepng($resData);
    }

    /**
     * 返回随机验证码
     * @return string
     */
    public function getRandData(){
        $arr1 = range('A','Z');
        $arr2 = range(1,9);
        $arr3 = range('a','z');
        $arr4 = array_merge($arr1,$arr2,$arr3);
        $strData ="";
        for($i=0;$i<4;$i++){
            $index = array_rand($arr4);
            $strData.=$arr4[$index];
        }
        $_SESSION['yzm'] = $strData; //输出的验证码保存到session当中，与登录输入的验证码进行比对
        return $strData;
    }
    public function showhanzi(){
        //1>设置验证码图片大小的函数
        $image = imagecreatetruecolor(200,80);
        //5>设置验证码颜色 imagecolorallocate(int im, int red, int green, int blue);
        $bgcolor = imagecolorallocate($image,255,255,255);
        //6>区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
        imagefill($image,0,0,$bgcolor);
        $fontface = BASE."/public/font/simfang.ttf";

        $str ='天地不仁以万物为刍狗圣人不仁以百姓为刍狗这句经常出现在控诉暴君暴政上地残暴不仁把万物都当成低贱的猪狗来看待而那些高高在上的所谓圣人们也没两样还不是把我们老百姓也当成猪狗不如的东西但实在正取的解读是地不情感用事对万物一视同仁圣人不情感用事对百姓一视同仁执子之手与子偕老当男女主人公含情脉脉看着对方说了句执子之手与子偕老女方泪眼朦胧含羞地回一句讨厌啦这样的情节我们是不是见过很多但是我们来看看这句的原句死生契阔与子成说执子之手与子偕老于嗟阔兮不我活兮于嗟洵兮不我信兮意思是说战士之间的约定说要一起死现在和我约定的人都走了我怎么活啊赤裸裸的兄弟江湖战友友谊啊形容好基友的基情比男女之间的爱情要合适很多吧';
        $strdb = str_split($str,3);
        $captcha_code ='';
        for($i=0;$i<4;$i++){
            $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));      //0-120深颜色
            //随机选取中文
            $in = rand(0,count($strdb));
            $cn = $strdb[$in];
            //将中文记录到将保存到session的字符串中
            $captcha_code .= $cn;
            /*imagettftext (resource $image ,float $size ,float $angle ,int $x ,int $y,int $color,
            string $fontfile ,string $text ) 幕布 ，尺寸，角度，坐标，颜色，字体路径，文本字符串
            mt_rand()生成更好的随机数,比rand()快四倍*/
            imagettftext($image, mt_rand(20,24),mt_rand(-60,60),(40*$i+20),mt_rand(30,35),$fontcolor,$fontface,$cn);
        }
        //11>存到session
        $_SESSION['yzm'] = $captcha_code;
        //9>增加干扰元素，设置点
        for($i=0;$i<200;$i++){
            //设置点的颜色，50-200颜色比数字浅，不干扰阅读
            $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));
            //imagesetpixel — 画一个单一像素
            imagesetpixel($image, rand(1,199), rand(1,59), $pointcolor);
        }
        //10>增加干扰元素，设置线
        for($i=0;$i<4;$i++){
            //设置线的颜色
            $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
            //设置线，两点一线
            imageline($image,rand(1,199), rand(1,59),rand(1,199), rand(1,59),$linecolor);
        }

        //2>设置头部，image/png
        header('Content-Type: image/png');
        //3>imagepng() 建立png图形函数
        imagepng($image);
        //4>imagedestroy() 结束图形函数 销毁$image
        imagedestroy($image);
        }
    public function showshuzi(){
        $image = imagecreatetruecolor(100, 30);    //1>设置验证码图片大小的函数
  //5>设置验证码颜色 imagecolorallocate(int im, int red, int green, int blue);
  $bgcolor = imagecolorallocate($image,255,255,255); //#ffffff
  //6>区域填充 int imagefill(int im, int x, int y, int col) (x,y) 所在的区域着色,col 表示欲涂上的颜色
  imagefill($image, 0, 0, $bgcolor);
  //10>设置变量
  $captcha_code = "";
  //7>生成随机数字
  for($i=0;$i<4;$i++){
    //设置字体大小
    $fontsize = 6;    
    //设置字体颜色，随机颜色
    $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));      //0-120深颜色
    //设置数字
    $fontcontent = rand(0,9);
    //10>.=连续定义变量
    $captcha_code .= $fontcontent;  
    //设置坐标
    $x = ($i*100/4)+rand(5,10);
    $y = rand(5,10);
    imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
  }
  //10>存到session
  $_SESSION['authcode'] = $captcha_code;

  //8>增加干扰元素，设置雪花点
  for($i=0;$i<200;$i++){
    //设置点的颜色，50-200颜色比数字浅，不干扰阅读
    $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));    
    //imagesetpixel — 画一个单一像素
    imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
  }
  //9>增加干扰元素，设置横线
  for($i=0;$i<4;$i++){
    //设置线的颜色
    $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
    //设置线，两点一线
    imageline($image,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$linecolor);
  }
 
  //2>设置头部，image/png
  header('Content-Type: image/png');
  //3>imagepng() 建立png图形函数
  imagepng($image);
  //4>imagedestroy() 结束图形函数 销毁$image
  imagedestroy($image);
    }

}