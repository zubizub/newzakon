<?
//удеаление формы

include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

$del = f_data($_GET[del],'text',0);
$del = mysql_query ("DELETE FROM forms WHERE id = '$del'",$db);
set_logs("Формы","Удаление формы");

Header("location:../../?page=formmanager&msg=Операция прошла успешно!");	
exit;

?>