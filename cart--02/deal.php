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
    
  }
    //判断
    $id = $_GET['id'];
    require './lib/cart.php';
   $cart = new Cart($id,$arrDatax);
    $cart->checkCart();
    ?>