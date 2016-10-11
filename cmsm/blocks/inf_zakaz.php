<a href="?page=zakaz" style="font-size:18px; color:#666">< назад к заказам</a><br><br>

<?
$result = mysql_query("SELECT * FROM zakaz WHERE id='$_GET[id]'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

	do
	{
		$enabled = $myrow['status']; 		
		if ($myrow[oplata]!=1) {$oplata = "<span style='color:red'> [не оплачен]</span>";} else {$oplata = "<span style='color:green'> [оплачен]</span>";}
		if ($myrow[dostavka]==1) {$dostavka = "<span style='color:red'>Необходимо доставить</span> <br> ";} else {$dostavka = "";}
		if ($myrow[kupon]!="") {
			$result_k = mysql_query("SELECT * FROM kupon WHERE name='$myrow[kupon]'");
			if (mysql_num_rows($result_k)!=0) {$ok_kupon='<img src="/cms/img/enabled.png" width="8" height="8">';} 
			else {$ok_kupon='<img src="/cms/img/disabled.png" width="8" height="8">';}
			$kupon = "<br><span style='color:#333'>купон: <b>$myrow[kupon]</b> $ok_kupon</span>";
		} else {$kupon = "";}
		$fio = $myrow[fio];
		
		echo "<div class='box_inf_zakaz_list'>
			$status заказа №$myrow[id] $oplata<br>
			<b>$fio</b> $kupon
			$dostavka $myrow[address]<br>
			Телефон: $myrow[phone]<br>
			E-mail: $myrow[mail]<br>
			Дата: $myrow[date]<br>
			Сумма заказа: <b>$myrow[price]</b><br><br>
			<div style='border:1px dotted #999; margin-bottom:4px'></div>
			</div><br>
		";	
	}while($myrow = mysql_fetch_assoc($result));




$result = mysql_query("SELECT * FROM zakaz_goods WHERE id_zakaz='$_GET[id]'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		$summ=$myrow[price]*$myrow[count];
		$result_goods = mysql_query("SELECT * FROM goods WHERE id='$myrow[id_goods]'");
		@$myrow_goods = mysql_fetch_assoc($result_goods); 
		@$url=$myrow_goods[url];
		if (mysql_num_rows($result_goods)!=0) {$name_goods="<a href='?page=add_goods&url=$url&id=$myrow[id_goods]' target='_blank' style='color:#333'>$myrow[name_goods]</a>";} 
		else {$name_goods=$myrow[name_goods];}
		
		if ($myrow[articul]!='') {$articul="[$myrow[articul]]";} else {$articul="";}
		
		echo "<div class='line_goods_zakaz'><b>$articul $name_goods</b> | 
		$myrow[price] руб. | $myrow[count] шт =  $summ руб.</div>
		";
		
		$all_summ=$all_summ+$summ;
	}while($myrow = mysql_fetch_assoc($result));
}
?>
<div style='border:1px dotted #999; margin-bottom:4px; margin-top:10px;'></div>
<b>Общая сумма заказа <? echo $all_summ; ?> рублей</b><br><Br>

