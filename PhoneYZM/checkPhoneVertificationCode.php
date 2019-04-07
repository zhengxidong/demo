<?php  
    session_start();  
//    echo $_SESSION['vertiCodeS'];  
    if($_SESSION['vertiCodeS']==$_POST["inputVertiCode"]){   
      $list=array("result"=>"validate!");  
    }  
    else{  
      $list=array("result"=>"notValidate!");  
    }                   
     echo json_encode($list);  
?> 