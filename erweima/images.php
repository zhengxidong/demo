<?php 
 /**
  * [create_erweima 在线生成二维码]
  * @param  [type] $content [内容]
  * @param  string $size    [大小]
  * @param  string $lev     [等级]
  * @param  string $margin  [description]
  * @return [type]          [description]
  */
 function create_erweima($content, $size = '100', $lev = 'L', $margin= '0') 
 {    
     $content = urlencode($content);
 
     $image = '<img src="http://chart.apis.google.com/chart?chs='.$size.'x'.$size.'&amp;cht=qr&chld='.$lev.'|'.$margin.'&amp;chl='.$content.'"  widht="'.$size.'" height="'.$size.'" />';
 
     return $image;
 
 }
 

 echo create_erweima($content);
 
 $url="http://www.zxdphp.site";
 echo create_erweima($url);


?>