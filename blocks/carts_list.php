<?

//вывод товаров в корзине

$myrow = mysql_fetch_assoc($result); 

do
{
	$id_carts = $myrow[id];
	
	$result_g = mysql_query("SELECT * FROM goods WHERE id='$myrow[id_g]'");
	$myrow_g = mysql_fetch_assoc($result_g); 
	$m_link = explode("/",$myrow_g[m_link]);
	$m_link = $m_link[(count($m_link)-1)];

	$name = "<a href='/goods/$myrow_g[id]/$m_link/' target='_blank'>$myrow_g[name]</a>";
	if ($myrow_g[img]!='') {$img="/cms/modul/katalog/upload/img/$myrow_g[img]";} else {$img = "/img/no_img2.png";}
	
	$price = $myrow[price];
	$price = price_convert($price);
	
	$summa = ($myrow[count]*$myrow[price])."";
	$summa_zakaz = $summa_zakaz+($myrow[count]*$myrow[price]);
	$summa = price_convert($summa);
	
	if ($myrow[skidka]!=0) 
	{
		$skidka=($myrow[count]*$myrow_g[price1]); 
		$skidka=$skidka/100*$myrow[skidka];
		$skidka = price_convert($skidka."");
		$skidka = "<div title='скидка'>- $skidka руб.</div>";
	} 
	else 
	{
		$skidka="";
	}
?>

<div class="box_carts_list box_carts_list_<? echo $id_carts; ?>">
	<table>
		<tr>
			<td class="carts_list_img">
				<? echo "<a href='/goods/$myrow_g[id]/$m_link/' target='_blank'><img src='$img' width='60' style='max-height:88px'></a>"; ?>
			</td>
			<td class="carts_list_name"><? echo $name; ?> </td>
			<td class="carts_list_price carts_list_price_<? echo $id_carts; ?>"><span><? echo $price; ?></span> руб.</td>
			<td class="carts_list_count">
				<div>
					<input type="text" value="<? echo $myrow[count]; ?>" class="count_carts count_carts_<? echo $id_carts; ?>" readonly/>
					<a href="#" class="count_min popup" num="<? echo $id_carts; ?>"></a>
					<a href="#" class="count_max popup" num="<? echo $id_carts; ?>"></a>
					<input type="hidden" class="id_g id_g_<? echo $id_carts; ?>" value="<? echo $myrow[id_g]; ?>">
				</div>
			</td>
			<td class="carts_list_summa carts_list_summa_<? echo $id_carts; ?>"><span><? echo $summa; ?></span> руб. <? echo "<Br>$skidka"; ?></td>
			<td class="carts_list_del"><a href="#" class="popup del_carts" num="<? echo $id_carts; ?>" title="удалить"></a></td>
		</tr>
	</table>
</div>

<?
}while($myrow = mysql_fetch_assoc($result));
?>