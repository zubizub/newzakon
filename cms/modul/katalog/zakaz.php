<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>

<?
$page = f_data ($_GET[page], 'text', 0);
?>

<form action="" method="get" style="display:block; position:absolute; right:15px; top:30px">
    <input type="hidden" name="page" value="<? echo $page; ?>">
    <input name="search" type="text" class="text_pole" value="поиск..."> 
    <input name="button" type="submit" value="найти">
</form>

<?
	if (isset($_GET[search]))
	{
		$search = f_data ($_GET[search], 'text', 0);
		$sql_search = "WHERE fio LIKE '%$search%' || phone LIKE '%$search%' || mail LIKE '%$search%' || id LIKE '%$search%' || address LIKE '%$search%'";	
		echo "<a href='?page=goods_zakaz' style='color:#60a6ee'>Вернуться к заказам</a> | Вы искали: <b>$search</b><br><br>";
		$search_url="&search=$search";
	}
	else
	{
		$sql_search = "";
	}
	
	if ($_GET[sort]!="fio_up") {$fio_sort="fio_up";} else {$fio_sort="fio_down";}
	if ($_GET[sort]!="price_up")  {$type_sort="price_up";} else {$type_sort="price_down";}
	if ($_GET[sort]!="n_up")  {$n_sort="n_up";} else {$n_sort="n_down";}
?>


<table id="tbl_obj">
  <tr>
    <th style="width:150px; text-align:center">Статус заказа</th>
    <th style="text-align:center; width:30px"><a href="?page=<? echo $page.$search_url; ?>&sort=<? echo $n_sort; ?>" style="color:inherit">№</a></th>
    <th style="text-align:left;"><a href="?page=<? echo $page.$search_url; ?>&sort=<? echo $fio_sort; ?>" style="color:inherit">ФИО</a></th>
    <th style="width:90px">источник</th>
    <th style="width:90px">телефон</th>
    <th style="width:70px">e-mail</th>
    <th style="width:70px">дата</th>
    <th style="width:50px"><a href="?page=<? echo $page.$search_url; ?>&sort=<? echo $type_sort; ?>" style="color:inherit">стоимость</a></th>
    <th style="width:55px"></th>
  </tr>
  
<?
//запрос к базе
if (isset($_GET[sort]) && $_GET[sort]=='fio_up') {$sort="fio ASC";}
elseif (isset($_GET[sort]) && $_GET[sort]=='fio_down') {$sort="fio DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='price_up') {$sort="price ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='price_down') {$sort="price DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_up') {$sort="id  ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_down') {$sort="id DESC";} 
else {$sort="id DESC";}

$pages_g = f_data ($_GET[pages], 'text', 0);
if (isset($_GET[pages])) {$pages=($pages_g-1)*30;} else {$pages=0;}

$result = mysql_query("SELECT * FROM zakaz $sql_search ORDER BY $sort LIMIT $pages,30");
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
			if ($enabled=="на обработке") 
			{$status .=  "<option selected value='1'>на обработке</option>";} else  {$status .=  "<option value='1'>на обработке</option>";}
			
			if ($enabled=="отгружен") 
			{$status .=  "<option selected value='2'>отгружен</option>";} else  {$status .=  "<option value='2'>отгружен</option>";}
			
			if ($enabled=="отправлен") 
			{$status .=  "<option selected value='3'>отправлен</option>";} else  {$status .=  "<option value='3'>отправлен</option>";}
			
			if ($enabled=="исполнен") 
			{$status .=  "<option selected value='4'>исполнен</option>";} else  {$status .=  "<option value='4'>исполнен</option>";}
			
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
			<td style='text-align:center; vertical-align:middle;'>
			$status
			<br><a href='?page=inf_zakaz&id=$myrow[id]' style='font-size:12px; color:#333'><b>смотреть заказ</b></a>
			</td>
			<td style='text-align:center'>
			$myrow[id]<br>
			<a href='print.php?id=$myrow[id]'><img src='img/print.png' height='19' target='_blank'></a>
			</td>
			<td>$fio $oplata $kupon<br>
			$dostavka $myrow[address]</td>
			<td>$myrow[advert]</td>
			<td>$myrow[phone]</td>
			<td>$myrow[mail]</td>
			<td>$myrow[date]</td>
			<td><b>$myrow[price] руб</b></td>
			<td style='text-align:center; vertical-align:middle'><a href='#' style='color:red' class='del_zakaz popop' num='$myrow[id]'>удалить</a></td>
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
	$result = mysql_query("SELECT * FROM zakaz");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=goods_zakaz",30);
?>

<br><br>
