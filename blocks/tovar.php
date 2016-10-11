<?

	//вывод товаров в краткой форме (для плитки товаров)

	$result_c = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
	$myrow_c = mysql_fetch_assoc($result_c); 		
	if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}	
	
	if ($myrow[img]!='') {$img="/cms/modul/katalog/upload/img/mimi_$myrow[img]";} else {$img = "/img/no_img2.png";}
	
	$m_link = explode("/",$myrow[m_link]);
	$m_link = $m_link[(count($m_link)-1)];
	
	if ($myrow[sale]==0) 
	{
		$price = $myrow[price1]; 
		$sale = ""; 
		$real_price = $myrow[price1]; 
		$real_price = str_replace(' ','',$real_price);
		$skidka_num = 0;
		$price = price_convert($price);
	} 
	else 
	{
		$real_price  = floor($myrow[price1]-(($myrow[price1]*$myrow[sale])/100));
		$skidka_num = $myrow[sale];
		$sale="<div class='sale_goods'> - $myrow[sale]%</div>";  $real_price = str_replace(' ','',$real_price);
		$price_old = price_convert($myrow[price1]);
		$price = price_convert($real_price)."<div class='old_price' title='старая цена'>$price_old руб.</div>";
	}
	
	
	if ($myrow[stamp]==0) {$stamp="";} else 
	{
		if ($myrow[sale]==0) {
			$stamp="<div class='stamp_goods'>ОСОБЫЙ</div>";
		}
		else {
			$stamp="<div class='stamp_goods2'>ОСОБЫЙ</div>";
		}
	}
	
	if ($myrow[presence]==0)
	{$bnt_zakaz = "<a href='#' rel='nofollow' class='popup btn button_zakaz' num='$real_price' numskidka='$skidka_num' numid='$myrow[id]'>в корзину</a>";} 
	elseif ($myrow[presence]==1) {$bnt_zakaz="<a href='/podzakaz/$myrow[id]/' rel='nofollow' class='btn btn_podzakaz_small'>Под заказ</a>";}
	else {$bnt_zakaz="";}
	

	echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-6'>
        <div class='goods_block'>
		$sale $stamp
		<a href='/goods/$myrow[id]/$m_link/' rel='nofollow' style='background-image: url($img)'  class='img_goods'></a>
		
		<a href='/goods/$myrow[id]/$m_link/' class='tovar_name'>
		$myrow[name]
		</a>
		
		<div class='name_podcat'>$name_cat</div>

        <div class='row'>
            <div class='col-xs-6'>
                <div class='price_tovar'>$price <img src='/img/r.png' alt='рублей' height='12'/></div>
            </div>
            <div class='col-xs-6'>
                <div class='div_btn_zakaz'>$bnt_zakaz</div>
            </div>
        </div>
        
       </div> 
	</div>";	
	
	$n++;
?>