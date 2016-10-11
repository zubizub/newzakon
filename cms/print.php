<? include("blocks/db.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
		<title>печать чека</title>
    	<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

  <script>  
  $(document).ready(function() {
	print();
  });
  </script>
	</head>
<body>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">

<br>
<div style="width:1000px; margin:auto">

<div style="margin-bottom:30px; margin-top:50px; text-align:center; font-size:30px;">ЗАКАЗ №<? echo $_GET[id]; ?></div>
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="text-align:center; width:30px">№</th>
    <th style="text-align:left; width:350px">ФИО</th>
    <th style="width:90px">телефон</th>
    <th style="width:100px">e-mail</th>
    <th style="width:100px">дата</th>
    <th style="width:50px">стоимость</th>
  </tr>
  
<?

$result = mysql_query("SELECT * FROM zakaz WHERE id='$_GET[id]'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['status']; 
		
		$status = "
		<select name='status' class='status$myrow[id]'>";
			if ($enabled=="на обработке") {$status .=  "<option selected value='1'>на обработке</option>";} else  {$status .=  "<option value='1'>на обработке</option>";}
			if ($enabled=="отгружен") {$status .=  "<option selected value='2'>отгружен</option>";} else  {$status .=  "<option value='2'>отгружен</option>";}
			if ($enabled=="отправлен") {$status .=  "<option selected value='3'>отправлен</option>";} else  {$status .=  "<option value='3'>отправлен</option>";}
			if ($enabled=="исполнен") {$status .=  "<option selected value='4'>исполнен</option>";} else  {$status .=  "<option value='4'>исполнен</option>";}
		$status .=  "</select>
		<input name='button' type='button' value='ok' onClick='statusEdit($myrow[id])'>";
		
		
		if ($myrow[oplata]==1) {$oplata = "<span style='color:red'> [не оплачен]</span>";} else {$oplata = "<span style='color:green'> [оплачен]</span>";}
		if ($myrow[dostavka]==1) {$dostavka = "<span style='color:red'>Необходимо доставить</span> | ";} else {$dostavka = "";}
		if ($myrow[kupon]!="") {$kupon = "<span style='color:#333'>купон: <b>$myrow[kupon]</b></span>";} else {$kupon = "";}
		if ($myrow[uid]!="") {$fio = "<a href='?page=user_inf&id=129' target='_blank'>$myrow[fio]</a>";} else {$fio = $myrow[fio];}
		
		echo "
		  <tr>
			<td style='text-align:center'>$myrow[id]</td>
			<td>$fio $oplata $kupon<br>
			$dostavka $myrow[address]</td>
			<td>$myrow[phone]</td>
			<td>$myrow[mail]</td>
			<td>$myrow[date]</td>
			<td><b><span class='main_price'>$myrow[price]</b></span></td>
		  </tr>  		
		";	
		$price = $myrow[price];
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

<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px; text-align:center">id</th>
    <th>Товар</th>
    <th style="text-align:left; width:50px">артикул</th>
    <th style="width:60px">стоимость</th>
    <th style="width:30px; text-align:center">количество</th>
    <th style="width:80px">сумма</th>
  </tr>
<?

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
		if (mysql_num_rows($result_goods)!=0) {$name_goods="$myrow[name_goods]";} 
		else {$name_goods=$myrow[name_goods];}
		
		echo "<tr>
			<td style='text-align:center'>$myrow[id_goods]</td>
			<td><b>$name_goods</b></td>
			<td>$myrow[articul]</td>
			<td>$myrow[price]</td>
			<td style='text-align:center'>$myrow[count]</td>
			<td><span class='summ_$myrow[id]'>$summ</span></td>		
		</tr>";
	}while($myrow = mysql_fetch_assoc($result));
}



?>

</table>
<br><Br>
<?

$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

?>
<div style="font-size:20px; font-weight:bold">Итого к оплате: <? echo $price.' рублей ';  if ($dostavka!='' && $price<$myrow[price_dostavka_null]) {echo " + доставка: $myrow[price_dostavka] рублей";} else {echo " + бесплатная доставка!";} ?></div>
<br><i><? echo nl2br($myrow[organization]); ?></i><br><br>

<br><br>
<div style="text-align:right; font-size:18px">
Отпустил_________________________________<br><br>
Получил__________________________________
</div>


</div>

</body>
</html>