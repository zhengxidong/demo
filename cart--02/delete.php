<?php
session_start();
$id = $_GET['id'];
require './lib/cart.php';
$cart = new Cart();
$cart->del($id);


