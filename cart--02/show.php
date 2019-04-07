<?php 
session_start();
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
          <?php
         /* header("Content-type:text/html;charset=utf8;");*/
          
          require 'connect.php';
          require './lib/Page.php';
           $sum = count($_SESSION['shopcar']);
           /*var_dump($sum);
           exit;*/
            /*$total = $recordData['total'];*/
             $total = $sum;
            $show = 2;
            $page =new Page($total,$show);
         if(empty($_SESSION['shopcar'])){ ?>
            购物车暂无数据！<a href="index.php">继续购物</a>
           <?php    } 
          else { ?>
          <a href="index.php">继续购物</a>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>id</th>
                <th>图片</th>
                <th>价格</th>
                <th>名称</th>
                <th>数量</th>
                <th>小计</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $total = 0; 
              foreach($_SESSION['shopcar'] as $key => $value) { ?>
                <tr>

                <th style="font-size:1.25em;padding-top:2.5em;" ><?php echo $value['id'];?></th>
                <td ><img src="<?php echo $value['img'];?>" width="100" height="100"/></td>
                <td style="font-size:1.25em;padding-top:2.5em;"><?php echo $value['price'];?></td>
                <td style="font-size:1.25em;padding-top:2.5em;"><?php echo $value['name'];?></td>
                <td style="font-size:1.25em;padding-top:2.5em;"><?php echo $value['num'];?></td>
                <td style="font-size:1.25em;padding-top:2.5em;">
                <?php 
                echo $value['price']*$value['num'];
                $total+=$value['price']*$value['num'];

                ?>
                </td>
                <td style="font-size:1.25em;padding-top:2.5em;"><a href="javascript:void(0)" onclick="deletex(<?php echo $value['id'];?>)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
              </tr>
             
              <?php } ?>
              
               <tr>
              <td colspan="4" style="font-size:1.25em;"> 一共<?php echo $total;?>元</td>
              </tr>
            </tbody>
          </table>
         <?php  } ?>
         <div>
           <p>
            <ul class="pagination">
              <?php echo $page->showPage(); ?>
             </ul>
            </p>
         </div>


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