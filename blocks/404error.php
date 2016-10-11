<?php

//проверка на сужествование страницы

$page = $_GET['page'];

if ($page == 'galery' && isset($_GET[id])) 
{
	$id = f_data($_GET[id],'text',0);
	$result_m = mysql_query("SELECT * FROM galery_cat WHERE id='$id'");
	$num_m = mysql_num_rows($result_m);
	
	if ($num_m==0)
	{
		header("HTTP/1.0 404 Not Found");
		header('Status: 404 Not Found');
		include("error404.php");
		exit;	
	}
}


if ($page == 'news_inf') 
{
	$id = f_data($_GET[id],'text',0);
	$result_m = mysql_query("SELECT * FROM news WHERE id='$id'");
	$num_m = mysql_num_rows($result_m);
	
	if ($num_m==0)
	{
		header("HTTP/1.0 404 Not Found");
		header('Status: 404 Not Found');
		include("error404.php");
		exit;	
	}
}
		
		
		
if ($page == 'goods') 
{
	$id = f_data($_GET[id],'text',0);
	$result_m = mysql_query("SELECT * FROM goods WHERE id='$id'");
	$num_m = mysql_num_rows($result_m);
	
	if ($num_m==0)
	{
		header("HTTP/1.0 404 Not Found");
		header('Status: 404 Not Found');
		include("error404.php");
		exit;	
	}
}		
		

?>