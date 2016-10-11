<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
include("shifr_pass.php");

$mrh_login =  f_data($_POST['mrh_login'],'text',0);
$mrh_pass1 = f_data($_POST['mrh_pass1'],'text',0);
$mrh_pass2 = f_data($_POST['mrh_pass2'],'text',0);

$mrh_login = creat_pass($mrh_login);
$mrh_pass1 = creat_pass($mrh_pass1);
$mrh_pass2 = creat_pass($mrh_pass2);

if ($mrh_login!='' || $mrh_pass1!='' || $mrh_pass2!='')
{
	set_logs("Робокасса","Измение данных");
	$result_edit = mysql_query("UPDATE settings SET mrh_login='$mrh_login', mrh_pass1='$mrh_pass1',mrh_pass2='$mrh_pass2'", $db);
	Header("location:../../?page=config_magazin&msg=Операция прошла успешно!");	
	exit;		
}
else
{
	Header("location:../../?page=config_magazin&msg=Обязательные поля не заполнены!");	
	exit;		
}
?>