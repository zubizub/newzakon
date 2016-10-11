<?php 
	if (isset($_GET['page']) && trim($_GET['page']) != "")
	{
		$page = $_GET['page'];
		if ($page == 'news') {include("blocks/news.php"); $ok = 1;}
		if ($page == 'inf_zakaz') {include("blocks/inf_zakaz.php"); $ok = 1;}
		if ($page == 'zakaz') {include("blocks/zakaz.php"); $ok = 1;}
		if ($page == 'zayvki' && !isset($_GET[id])) {include("blocks/zayvki.php"); $ok = 1;}
		if ($page == 'obr_svyz') {include("blocks/obr_svyz.php"); $ok = 1;}
		if ($page == 'comments') {include("blocks/comments.php"); $ok = 1;}
		if ($page == 'vopros_otvet') {include("blocks/vopros_otvet.php"); $ok = 1;}
		if ($page == 'otziv') {include("blocks/otziv.php"); $ok = 1;}
	}
	else
	{
		include("blocks/main.php");
		
	}
?>
