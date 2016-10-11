<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>
<br>
<a href="?page=goods_zakaz" style="color:#999; text-decoration:none" class="back">< заказы</a>
<br><br>

<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:150px; text-align:center; vertical-align:middle">Статус заказа</th>
    <th style="text-align:center; width:30px">№</th>
    <th style="text-align:left;">ФИО</th>
    <th style="width:90px">источник</th>
    <th style="width:90px">телефон</th>
    <th style="width:100px">e-mail</th>
    <th style="width:100px">дата</th>
    <th style="width:50px">стоимость</th>
    <th style="width:55px; vertical-align:middle"></th>
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
		$enabled = $myrow['status']; 
		$text = $myrow[text];
		$status = "
		<select name='status' class='status$myrow[id]'>";
			if ($enabled=="на обработке") {$status .=  "<option selected value='1'>на обработке</option>";} else  {$status .=  "<option value='1'>на обработке</option>";}
			if ($enabled=="отгружен") {$status .=  "<option selected value='2'>отгружен</option>";} else  {$status .=  "<option value='2'>отгружен</option>";}
			if ($enabled=="отправлен") {$status .=  "<option selected value='3'>отправлен</option>";} else  {$status .=  "<option value='3'>отправлен</option>";}
			if ($enabled=="исполнен") {$status .=  "<option selected value='4'>исполнен</option>";} else  {$status .=  "<option value='4'>исполнен</option>";}
		$status .=  "</select>
		<input name='button' type='button' value='ok' onClick='statusEdit($myrow[id])'>";
		
		if ($myrow[oplata]!=1) 
		{
			$pay_ok = "<a href='#' class='popup img_pay img_pay_ok' title='Оплатить' num='$myrow[id]' num2='1'></a>";
			$oplata = "<span style='color:#d41515' class='msg_pay msg_pay_$myrow[id]'> [не оплачен]</span> $pay_ok";
		} 
		else 
		{
			$pay_ok = "<a href='#' class='popup img_pay img_pay_cancel' title='Отменить оплату' num='$myrow[id]' num2='0'></a>";
			$oplata = "<span style='color:#36c922' class='msg_pay msg_pay_$myrow[id]'> [оплачен]</span> $pay_ok";
		}
		
		if ($myrow[dostavka]==1) {$dostavka = "<span style='color:#c67a2f'>Необходимо доставить</span> | ";} else {$dostavka = "";}
		if ($myrow[kupon]!="") {
			$result_k = mysql_query("SELECT * FROM kupon WHERE name='$myrow[kupon]'");
			if (mysql_num_rows($result_k)!=0) {$ok_kupon='<img src="/cms/img/enabled.png" width="8" height="8">';} 
			else {$ok_kupon='<img src="/cms/img/disabled.png" width="8" height="8">';}
			$kupon = "<span style='color:#333'>купон: <b>$myrow[kupon]</b> $ok_kupon</span>";
		} else {$kupon = "";}
		
		if ($myrow[uid]!="" && $myrow[uid]!='QwN8P9HSeQK9PnyQWtUxF6ED3') 
		{
			$result_user_id = mysql_query("SELECT id,uid FROM users WHERE uid='$myrow[uid]'");
			$myrow_user_id = mysql_fetch_assoc($result_user_id); 
			$num_rows_user_id = mysql_num_rows($result_user_id);
			if ($num_rows_user_id!=0)
			{
				$fio = "<a href='?page=user_inf&id=$myrow_user_id[id]' target='_blank' style='color:#4274ab'><b>$myrow[fio]</b></a>";
			}
			else
			{
				$fio = $myrow[fio];
			}
		} 
		else {$fio = $myrow[fio];}
		
		echo "
		  <tr>
			<td style='text-align:center; vertical-align:middle; width:150px; '>
			$status
			</td>
			<td style='text-align:center'>
				$myrow[id]<br>
				<a href='print.php?id=$myrow[id]' target='_blank'><img src='img/print.png' height='19' target='_blank'></a>
			</td>
			<td>$fio $oplata $kupon<br>
			$dostavka $myrow[address]</td>
			<td>$myrow[advert]</td>
			<td>$myrow[phone]</td>
			<td>$myrow[mail]</td>
			<td>$myrow[date]</td>
			<td><b><span class='main_price'>$myrow[price] Р</b></span></td>
			<td style='text-align:center; vertical-align:middle'>
				<a href='#' style='color:red !important' class='del_zakaz popop' num='$myrow[id]'>удалить</a>
			</td>
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

<br><br>
<?

if ($text!='')
{
	echo "<div class='box_comment_zakaz'><div>Комментарий к заказу</div><br>$text<br></div><br>";	
}

?>

<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px; text-align:center">id</th>
    <th>Товар</th>
    <th style="text-align:center; width:50px">скидка</th>
    <th style="text-align:center; width:60px">под заказ</th>
    <th style="text-align:left; width:50px">артикул</th>
    <th style="width:60px">стоимость</th>
    <th style="width:30px; text-align:center">количество</th>
    <th style="width:80px">сумма</th>
    <th style="width:55px"></th>
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
		{$name_goods="<a href='?page=add_goods&url=$url&id=$myrow[id_goods]' target='_blank' style='color:#333'>$myrow[name_goods]</a>";} 
		else {$name_goods=$myrow[name_goods];}
		
		if ($myrow[podzakaz]==1) {$podzakaz="<span style='color:red'>да</span>";} else {$podzakaz='нет';}
		
		echo "<tr>
			<td style='text-align:center'>$myrow[id_goods]</td>
			<td><b>$name_goods</b></td>
			<td style='text-align:center'>$myrow[skidka]%</td>
			<td style='text-align:center'>$podzakaz</td>
			<td>$myrow[articul]</td>
			<td>$myrow[price] Р</td>
			<td style='text-align:center'>
				<input name='num_goods' class='num_goods num_goods_$myrow[id]' num='$myrow[id]' num2='$myrow[id_zakaz]' type='text' value='$myrow[count]' style='padding:3px; width:30px; border-radius:4px 4px 4px 4px; font-weight:bold; text-align:center' onKeyUp='pereschetCount($myrow[id])'>
			</td>
			<td><span class='summ_$myrow[id]'>$summ</span> Р</td>
			<td><a href='#' style='color:red !important' class='del_zakaz_goods popop' num='$myrow[id]'>удалить</a></td>		
		</tr>";
	}while($myrow = mysql_fetch_assoc($result));
}
?>

</table>

<input type="hidden" name="zakaz" class="zakaz" value="<? echo $id; ?>">