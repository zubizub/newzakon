<?php

//меню которое показывается только на мобильниках

?>



<noindex>
<?
	// информация о количестве товаров в корзине

	$i=0;
	$price=0;
	$count=0;
	
	$result = mysql_query("SELECT * FROM carts WHERE uid='$uid'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);

	if ($num_rows!=0)
	{
		do
		{
			$i++;
			$price = $price + $myrow[price];	
			$count = $count + $myrow[count];
		}while($myrow = mysql_fetch_assoc($result));
	}

?> 
<div class="box_inf_carts_mob">
	В корзине: <span class="main_count"><? echo $count; ?></span> товара /
	<a href="/carts/">в корзину</a>
</div>



<?

// вывод категорий товаров в левом меню сайта

?>

<div class="box_left_katalog_mob">
<?			
	//запрос к базе
	$result = mysql_query("SELECT * FROM katalog WHERE url='' && enabled='1' ORDER BY id ASC LIMIT 30");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	if (isset($_GET[url])) {$now_url = $_GET[url];} else {$now_url = $goods_url;}
	
	if ($num_rows!=0)
	{
		do
		{
			if ($myrow[url]!="") {
				if (isset($_GET[url])) {$url = str_replace("/", "-", "$now_url");} else {$url = str_replace("-", "/", "$now_url");}
				$url=$url."-$myrow[id]/";
			} 
			else {$url="$myrow[id]/";}
			
			if (substr_count($now_url, "$myrow[id]")=="1") {$b="left_cat_katalog_h";} else {$b='';}	
			echo "<a href='/katalog/$url' class='left_cat_katalog $b'>$myrow[name]</a>";
		
			$result2 = mysql_query("SELECT * FROM katalog WHERE url='$myrow[id]' && enabled='1' ORDER BY id ASC LIMIT 10");
			$myrow2 = mysql_fetch_assoc($result2); 
			$num_rows2 = mysql_num_rows($result2);
			if ($num_rows2!=0)
			{
				do
				{	
					if (substr_count($now_url, "$myrow[id]-$myrow2[id]")=="1") {$b="left_podcat_katalog_h";} else {$b='';}				
					echo "<a href='/katalog/$myrow[id]-$myrow2[id]/' class='left_podcat_katalog $b' style='padding-left:15px'>$myrow2[name]</a>";					
				}while($myrow2 = mysql_fetch_assoc($result2));
			}
		}while($myrow = mysql_fetch_assoc($result));
	}

?>

</div>
<div class="btn_show_inf_carts_mob">показать каталог</div>

</noindex>