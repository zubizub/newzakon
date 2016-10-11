<?
	// вывод похожих товаров
?>


<div class="pohoj_tovar_title">Похожие товары</div>
<div class="pohoj_tovar_box">
<?
	$result = mysql_query("SELECT * FROM goods WHERE enabled='1' && url='$url_g' ORDER BY rand() LIMIT 4");
	$myrow = mysql_fetch_assoc($result); 
	
	do
	{		
		include("blocks/tovar.php");
	}while($myrow = mysql_fetch_assoc($result));
?>
</div>