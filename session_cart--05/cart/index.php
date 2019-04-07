<?php
header("Content-type:text/html;charset=utf8;");
 require 'connect.php';
?>

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
<ul>

<?php foreach($arrData as $value):?>	
<li>
	<p><img src="<?php echo $value['img']; ?>"/></p>
	<p><?php echo $value['name']; ?></p>
	<p><?php echo $value['price']; ?></p>
	<p><a href="deal.php?id=<?php echo $value['id'];?>">加入购物车</a></p>
</li>
<?php endforeach;?>

</ul>