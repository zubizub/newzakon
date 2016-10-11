<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

if (isset($_POST[status]))
{
	set_logs("Каталог","Изменение статуса заказа");
	if ($_POST[status]==1) {$status="на обработке";}
	if ($_POST[status]==2) {$status="отгружен";}
	if ($_POST[status]==3) {$status="отправлен";}
	if ($_POST[status]==4) {$status="исполнен";}
	$id = f_data ($_POST[id], 'text', 0);
	
	$result_edit = mysql_query("UPDATE zakaz SET status='$status' WHERE id='$id'", $db);
}

if (isset($_POST[editcount]))
{
	
	$id = f_data ($_POST[id], 'text', 0);
	$id_zakaz = f_data ($_POST[id_zakaz], 'text', 0);
	
	$result = mysql_query("SELECT * FROM zakaz_goods WHERE id='$id'");
	$myrow = mysql_fetch_assoc($result); 
	$old_price = $myrow[price]*$myrow[count];	
	set_logs("Каталог","Изменение количества товаров в заказе",$myrow[name_goods]);
	
	
	$result_edit = mysql_query("UPDATE zakaz_goods SET count='$_POST[count]' WHERE id='$id'", $db);
	$result = mysql_query("SELECT * FROM zakaz_goods WHERE id='$id'");
	$myrow = mysql_fetch_assoc($result); 
	$summ=$myrow[price]*$myrow[count];
	
	$result = mysql_query("SELECT * FROM zakaz WHERE id='$id_zakaz'");
	$myrow = mysql_fetch_assoc($result);	
	$itog=$myrow[price]-$old_price+$summ;
	$result_edit = mysql_query("UPDATE zakaz SET price='$itog' WHERE id='$id_zakaz'", $db);
	
	echo $summ;	
}



if (isset($_POST[get_main_price]))
{
	$id_zakaz = f_data ($_POST[id_zakaz], 'text', 0);
	$result = mysql_query("SELECT * FROM zakaz WHERE id='$id_zakaz'");
	$myrow = mysql_fetch_assoc($result);	
	echo $myrow[price];	
}
?>