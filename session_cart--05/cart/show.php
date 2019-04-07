<?php
header("Content-type:text/html;charset=utf8;");
session_start();
require 'connect.php';

if(!empty($_SESSION['shopcar'])){
     if(empty($_SESSION['shopcar'])){
        exit("购物车暂无数据！<a href=\"index.php\">继续购物</a>");
     }
?>

<table width="800" align="center">
	<tr>
		<td>ID</td>
		<td>图片</td>
		<td>价格</td>
		<td>名称</td>
		<td>数量</td>
		<td>小计</td>
		<td>操作</td>
	</tr>
<?php 
  $total = 0; 
  foreach ($_SESSION['shopcar'] as $key => $value) :?>
		<tr>
			<td><?php echo $value['id'];?></td>
			<td><img src='<?php echo $value['img'];?>' width=100 height=100 /></td>
			<td><?php echo $value['price'];?></td>
			<td><?php echo $value['name'];?></td>
			<td><?php echo $value['num'];?></td>
			<td><?php 
                echo $value['price']*$value['num'];
			    $total+=$value['price']*$value['num'];

			?></td>
			<td><a href="javascript:void(0)" onclick="deletex(<?php echo $value['id'];?>)">删除</a></td>
		</tr>
<?php endforeach;?>
   <tr>
   	<td colspan="4"><a href="index.php">继续购物</a> 一共<?php echo $total;?></td>
   </tr>
</table>
<?php     
}else
{
	echo "购物车暂无数据！<a href=\"index.php\">继续购物</a>";
}
?>
<script type="text/javascript">
	 function deletex(data){
          if(confirm('确认要删除吗？')){
              location.href ="delete.php?id="+data;
          }
	 }
</script>