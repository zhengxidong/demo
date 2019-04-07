<?php
session_start();

if(!empty($_GET['id'])){
    require 'connect.php';
    $arrDatax = array();
    foreach ($arrData as $key => $value) {
    	if($value['id']==$_GET['id']){
              $arrDatax = $arrData[$key];
    	}
    }
    //判断
    if(empty($_SESSION['shopcar'])){
    //第一次购物
             $_SESSION['shopcar'][] = $arrDatax;
		    header("Location:show.php");
    }else
    {
        //第一次购物之后的购物
          /*$arrDataz = $_SESSION['chopcar'][];*/
        //判断是否买过相同产品
        $id = $_GET['id'];
        if(!checkItem($id)){
			    $_SESSION['shopcar'][] =$arrDatax;
				header("Location:show.php");
        }
        else{
				header("Location:show.php");
        }
       
    } 

}


//检查是否买过相同产品
/*function checkItem($arrDatax,$id){
    if(in_array($id, $_SESSION['shopcar'])){
         $_SESSION['shopcar'][$key]['num'] +=1;
           return true;
           break;
    }
    	   return false;
    
}*/
function checkItem($id){
    foreach($_SESSION['shopcar'] as $key =>$value){
        if($value['id']==$id)
        {
            $_SESSION['shopcar'][$key]['num'] +=1;
           return true;
           break;
        }
    }
    return false;
}

