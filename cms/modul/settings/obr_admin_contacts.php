<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

$fio_admin =  f_data($_POST['fio_admin'],'text',0);
$phone_admin = f_data($_POST['phone_admin'],'text',0);
$mail_admin = f_data($_POST['mail_admin'],'text',0);
$organization = f_data($_POST['organization'],'text',0);
$address_admin = f_data($_POST['address_admin'],'text',0);
$address_admin_office = f_data($_POST['address_admin_office'],'text',0);
$company_name = f_data($_POST['company_name'],'text',0);
$desabl_site = f_data($_POST['desabl_site'],'text',0);

if ($fio_admin!='' && $phone_admin!='' && $mail_admin!='')
{
	set_logs("Контакты администратора","Редактирование контактов");
	$result_edit = mysql_query("UPDATE settings SET fio_admin='$fio_admin', phone_admin='$phone_admin', mail_admin='$mail_admin', organization='$organization',address_admin='$address_admin',address_admin_office='$address_admin_office',company_name='$company_name', desabl_site='$desabl_site'", $db);
	Header("location:../../?page=admin_contacts&msg=Операция прошла успешно!");	
	exit;		
}
else
{
	Header("location:../../?page=admin_contacts&msg=Обязательные поля не заполнены!");	
	exit;		
}
?>