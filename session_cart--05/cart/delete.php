<?php
session_start();
if(!empty($_GET['id']))
{
	foreach($_SESSION['shopcar'] as $key =>$value)
	{
		if($value['id']==$_GET['id'])
		{
			unset($_SESSION['shopcar'][$key]);
			header("Location:show.php");
		}
	}

}


