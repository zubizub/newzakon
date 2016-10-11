<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

$price_dostavka =  f_data($_POST['price_dostavka'],'text',0);
$price_dostavka_null = f_data($_POST['price_dostavka_null'],'text',0);

if ($price_dostavka!='')
{
	set_logs("Достака","Измение стоимости доставки");
	$result_edit = mysql_query("UPDATE settings SET price_dostavka='$price_dostavka', price_dostavka_null='$price_dostavka_null'", $db);
	Header("location:../../?page=config_magazin&msg=Операция прошла успешно!");	
	exit;		
}
else
{
	Header("location:../../?page=config_magazin&msg=Обязательные поля не заполнены!");	
	exit;		
}
?>