<?

include("../../blocks/db.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");

if (isset($_GET[delgoods]))
{
	
	$del = f_data ($_GET[del], 'text', 0);
	$zakaz = f_data ($_GET[zakaz], 'text', 0);
	
	$result = mysql_query("SELECT * FROM zakaz_goods WHERE id = '$del'");
	$myrow = mysql_fetch_assoc($result); 	
	$summ=$myrow[price]*$myrow[count];
	$id_zakaz = $myrow[id_zakaz];
	
	set_logs("Каталог","Удаление товара из заказа",$id_zakaz." $summ руб.");
	
	$del = mysql_query ("DELETE FROM zakaz_goods WHERE id = '$del'",$db);
	
	$result_edit = mysql_query("UPDATE zakaz SET price=price-$summ WHERE id='$id_zakaz'", $db);
	Header("location:../../?page=inf_zakaz&id=$zakaz$url&msg=Информация удалена!");	
	exit;		
}


if (isset($_GET[delzakaz]))
{
	$del_z = f_data($_GET[del], 'text', 0);
	set_logs("Каталог","Удаление заказа","#$del_z");
	$del = mysql_query ("DELETE FROM zakaz WHERE id = '$del_z'",$db);
	$del = mysql_query ("DELETE FROM zakaz_goods WHERE id_zakaz = '$del_z'",$db);
	Header("location:../../?page=goods_zakaz$url&msg=Информация удалена!");	
	exit;		
}
?>