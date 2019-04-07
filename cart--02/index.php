 <?php
session_start();
require 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="docs/favicon.ico">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/offcanvas.css">
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<title>Bootstrap-Home</title>
</head>
<body>
<!--  自写 --> 
<nav class="navbar navbar-fixed-top navbar-inverse">
  <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">
           <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
           主页
           </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="">About</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">wei</a></li>
          </ul>
        </div>
  </div>    
</nav>
<!-- 自写 -->
<div class="container">
  <div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-9">
      <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         
          <style type="text/css">
  
          ul{
            margin:0px;
            padding: 0px;
            list-style: none;
          }
          ul li{
            float:left;
            margin-left: 50px;
          }
        </style>
        <?php 
        require './lib/cart.php';
        
        ?>
          <ul>
          <?php foreach($arrData as $value):?>  
          <li>
            <p><img src="<?php echo $value['img']; ?>" width="150" height="150"/></p>
            <p><?php echo $value['name']; ?></p>
            <p><?php echo $value['price']; ?></p>
            <p><a href="deal.php?id=<?php echo $value['id'];?>">加入购物车</a></p>
           
          </li>
          <?php endforeach;?>
          </ul>
            
<script type="text/javascript">
   function deletex(data){
          if(confirm('确认要删除吗？')){
              location.href ="delete.php?id="+data;
          }
   }
</script>
     <!--  <div class="jumbotron">
       <h1>Hello,world!</h1>
       <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
     </div> -->
      <div class="row">
        <div class="col-xs-6 col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="" role="button">View details »</a></p>
        </div>
        <div class="col-xs-6 col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="" role="button">View details »</a></p>
        </div>
        <div class="col-xs-6 col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="" role="button">View details »</a></p>
        </div>
        <div class="col-xs-6 col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="" role="button">View details »</a></p>
        </div>
        <div class="col-xs-6 col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="" role="button">View details »</a></p>
        </div>
        <div class="col-xs-6 col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="" role="button">View details »</a></p>
        </div>
      </div>
    </div>
    <div id="sidebar" class="col-xs-6 col-sm-3 sidebar-offcanvas">
      <div class="list-group">
        <a class="list-group-item active" href="http://www.zxdphp.site/zxd">详情页</a>
        <a class="list-group-item" href="http://www.zxdphp.site/zxd">TEM企业站</a>
        <a class="list-group-item" href="">Link</a>
        <a class="list-group-item" href="">Link</a>
        <a class="list-group-item" href="">Link</a>
        <a class="list-group-item" href="">Link</a>
        <a class="list-group-item" href="">Link</a>
        <a class="list-group-item" href="">Link</a>
        <a class="list-group-item" href="">Link</a>
        <a class="list-group-item" href="">Link</a>
      </div>
    </div>
  </div>
</div>


</body>
</html>