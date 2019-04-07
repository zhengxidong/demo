<?php
  

   session_start();

   $im = imagecreatetruecolor(100, 30);

   $bg = imagecolorallocate($im,rand(200,240),rand(0,200),rand(0,200));

   $txtColor = imagecolorallocate($im,rand(0,160),rand(0,160),rand(0,160));

   $random = '';

   for($i=0;$i<4;$i++){ $random.= dechex(mt_rand(1,15)); }

   $_SESSION['verification'] = $random;

   imagefill($im,0,0,$bg);

   imagestring($im,10,30,8,$random,$txtColor);

   header("content-type:image/png");

   imagepng($im);

   imagedestroy();

?>