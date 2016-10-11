<?

	// вывод рекомендуемого товара

	$result_c = mysql_query("SELECT * FROM curent WHERE id='$myrow_item[curent]'");
	$myrow_item_c = mysql_fetch_assoc($result_c); 		
	if ($myrow_item[url]!="") {$url=$myrow_item[url]."";} else {$url="";}	
	
	if ($myrow_item[img]!='') {$img="/cms/modul/katalog/upload/img/mimi_$myrow_item[img]";} else {$img = "/img/no_img2.png";}
	
	$m_link = explode("/",$myrow_item[m_link]);
	$m_link = $m_link[(count($m_link)-1)];
	
	if ($myrow_item[sale]==0) 
	{
		$price = $myrow_item[price1]; 
		$sale = ""; 
		$real_price = $myrow_item[price1]; 
		$real_price = str_replace(' ','',$real_price);
		$skidka_num = 0;
		$price = price_convert($price);
	} 
	else 
	{
		$real_price  = floor($myrow_item[price1]-(($myrow_item[price1]*$myrow_item[sale])/100));
		$skidka_num = $myrow_item[sale];
		$sale="<div class='sale_goods'> - $myrow_item[sale]%</div>";  $real_price = str_replace(' ','',$real_price);
		$price_old = price_convert($myrow_item[price1]);
		$price = price_convert($real_price)."<div class='old_price' title='старая цена'>$price_old руб.</div>";
	}
	
	
	if ($myrow_item[stamp]==0) {$stamp="";} else 
	{
		if ($myrow_item[sale]==0) {
			$stamp="<div class='stamp_goods'>ОСОБЫЙ</div>";
		}
		else {
			$stamp="<div class='stamp_goods2'>ОСОБЫЙ</div>";
		}
	}
	
	if ($myrow_item[presence]==0)
	{$bnt_zakaz = "<a href='#' rel='nofollow' class='popup btn_zakaz button_zakaz' num='$real_price' numskidka='$skidka_num' numid='$myrow_item[id]'>в корзину</a>";} 
	elseif ($myrow_item[presence]==1) {$bnt_zakaz="<a href='/podzakaz/$myrow_item[id]/' rel='nofollow' class='btn_zakaz'>Под заказ</a>";}
	else {$bnt_zakaz="";}
	
	
	echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-6'>
        <div class='goods_block'>
		$sale $stamp
		<a href='/goods/$myrow[id]/$m_link/' rel='nofollow' style='background-image: url($img)'  class='img_goods_recomend'></a>
		
		<a href='/goods/$myrow_item[id]/$m_link/' class='tovar_name'>
		$myrow_item[name]
		</a>
		
		<div class='name_podcat'>$name_cat</div>
		
		<div class='dop_inf_tovar'>
			<div class='price_tovar'>$price <img src='/img/r.png' alt='рублей' height='14'/></div>	
			<div class='div_btn_zakaz'>$bnt_zakaz</div>
		</div>
		
		</div>
	</div>";	
	
	$n++;
?>