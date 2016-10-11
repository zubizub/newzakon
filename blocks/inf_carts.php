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
<div class="left_block_inf_cart">
	В корзине: <span class="main_count"><? echo $count; ?></span> товара /
	<a href="/carts/" style="font-size:12px">в корзину</a></div>
<br>