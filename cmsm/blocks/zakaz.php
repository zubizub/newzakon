<?
	$result = mysql_query("SELECT * FROM zakaz");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=goods_zakaz' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='на обработке'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab11 = mysql_num_rows($result);

	$result = mysql_query("SELECT * FROM zakaz WHERE status='отгружен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab12 = mysql_num_rows($result);
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='отправлен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab13 = mysql_num_rows($result);
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='исполнен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab14 = mysql_num_rows($result);
	

	
	echo "	<div class='inf_block'>
			<div>Сегодня: <span>$num_rows_now</span></div>
			<div>На обработке: <span>$num_rows_enab11</span></div>
			<div>Отгруженых: <span>$num_rows_enab12</span></div>
			<div>Отправленых: <span>$num_rows_enab13</span></div>
			<div>Исполненых: <span>$num_rows_enab14</span></div>
			<div>Всего: <span>$num_rows</span></div>
			</div><br><br>
	";
		



$result = mysql_query("SELECT * FROM zakaz ORDER BY id DESC LIMIT 30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
//echo $num_rows;
$i=1;
$j=1;

if ($num_rows!=0)
{
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
			Заказа №$myrow[id] $oplata<br>
			<b>$fio</b> $kupon
			$dostavka $myrow[address]<br>
			Телефон: $myrow[phone]<br>
			E-mail: $myrow[mail]<br>
			Дата: $myrow[date]<br>
			Сумма заказа: <b>$myrow[price] руб.</b><br>
			<br>
			<a href='?page=inf_zakaz&id=$myrow[id]' class='box_inf_zakaz_list-btn'>смотреть заказ</a><br><br>
			<div style='border:1px dotted #999; margin-bottom:4px'></div>
			</div><br>	
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "Заказов нет";	
}

?>

