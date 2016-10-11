<?
	// вывод информации о заказе пользователя
?>

<a href="/cabinet/?num=3" style="color:#999; text-decoration:none" class="back">< заказы</a>
<br><br>

<table width="100%" border="0" class="tbl_obj">
  <tr>
    <th style="width:150px; text-align:center; vertical-align:middle">Статус заказа</th>
    <th style="text-align:center; width:30px">№</th>
    <th style="text-align:left; ">На кого</th>
    <th style="width:90px">телефон</th>
    <th style="width:100px">дата</th>
    <th style="width:50px">стоимость</th>
  </tr>
  
<?
$id = f_data ($_GET[id], 'text', 0);

$result = mysql_query("SELECT * FROM zakaz WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		$status = $myrow['status']; 
		$text = $myrow[text];
	
		if ($myrow[oplata]!=1) {$oplata = "<a href='/pay_old_zakaz/?zakaz_id=$myrow[id]' class='btn_pay_cab'>[не оплачен]</a>";} else {$oplata = "<span style='color:green'> [оплачен]</span>";}
		if ($myrow[dostavka]==1) {$dostavka = "<span style='color:#c67a2f'>Необходимо доставить</span> | ";} else {$dostavka = "";}
		if ($myrow[kupon]!="") {
			$result_k = mysql_query("SELECT * FROM kupon WHERE name='$myrow[kupon]'");
			if (mysql_num_rows($result_k)!=0) {$ok_kupon='<img src="/cms/img/enabled.png" width="8" height="8">';} 
			else {$ok_kupon='<img src="/cms/img/disabled.png" width="8" height="8">';}
			$kupon = "<span style='color:#333'>купон: <b>$myrow[kupon]</b> $ok_kupon</span>";
		} else {$kupon = "";}
		
		$fio = $myrow[fio];
		
		echo "
		  <tr>
			<td style='text-align:center; vertical-align:middle; width:150px; '>
			$status
			</td>
			<td style='text-align:center'>
				$myrow[id]<br>
			</td>
			<td style='color:#585858'><b>$fio</b> $oplata<br>
			$dostavka $myrow[address]</td>
			<td>$myrow[phone]</td>
			<td>$myrow[date]</td>
			<td><b><span class='main_price'>".price_convert($myrow[price])." Р</b></span></td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "
		  <tr>
			<th colspan='8'>Заказов нет</th>
		  </tr>  		
		";	
}

?>

</table>

<br>
<?

if ($text!='')
{
	echo "<div class='box_comment_zakaz'><div>Комментарий к заказу</div>$text<br></div><br>";	
}

?>

<table width="100%" border="0" class="tbl_obj">
  <tr>
    <th style="width:30px; text-align:center">id</th>
    <th>Товар</th>
    <th style="text-align:center; width:50px">скидка</th>
    <th style="text-align:center; width:60px">под заказ</th>
    <th style="text-align:left; width:50px">артикул</th>
    <th style="width:60px">стоимость</th>
    <th style="width:30px; text-align:center">количество</th>
    <th style="width:80px">сумма</th>
  </tr>
<?

$result = mysql_query("SELECT * FROM zakaz_goods WHERE id_zakaz='$id'");
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
		if (mysql_num_rows($result_goods)!=0) 
		{$name_goods="<a href='/goods/$myrow_goods[id]/$myrow_goods[m_link]/' target='_blank' style='color:#585858'>$myrow[name_goods]</a>";} 
		else {$name_goods=$myrow[name_goods];}
		
		if ($myrow[podzakaz]==1) {$podzakaz="<span style='color:red'>да</span>";} else {$podzakaz='нет';}
		
		echo "<tr>
			<td style='text-align:center'>$myrow[id_goods]</td>
			<td><b>$name_goods</b></td>
			<td style='text-align:center'>$myrow[skidka]%</td>
			<td style='text-align:center'>$podzakaz</td>
			<td>$myrow[articul]</td>
			<td>".price_convert($myrow[price])." Р</td>
			<td style='text-align:center'>$myrow[count]</td>
			<td><span class='summ_$myrow[id]'>".price_convert($summ)."</span> Р</td>		
		</tr>";
	}while($myrow = mysql_fetch_assoc($result));
}
?>

</table>
