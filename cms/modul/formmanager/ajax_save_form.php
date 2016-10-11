<?
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/logs.php");
include("../../blocks/chek_user.php");

$forma =  iconv("utf-8", "CP1251", $_POST['forma']);
$palitra = iconv("utf-8", "windows-1251", $_POST['palitra']);
$f_mail = iconv("utf-8", "windows-1251", $_POST['f_mail']);
$f_title = iconv("utf-8", "CP1251", $_POST['f_title']); 
if (isset($_POST[capcha])) {$capcha=1;} else {$capcha=0;}
$date = date("H:m d.m.Y");



if ($_POST[edit]==0)
{
	set_logs("Формы","Создание новой формы");
	$result_add = mysql_query ("INSERT INTO forms (forma,palitra,f_mail,f_title,capcha,date) VALUES ('$forma','$palitra','$f_mail','$f_title','$capcha','$date')");
}
else
{
	set_logs("Формы","Изменение формы");
	$result_edit = mysql_query("UPDATE forms SET forma='$forma', palitra='$palitra',f_mail='$f_mail',f_title='$f_title',capcha='$capcha' WHERE id='$_POST[edit]'", $db);
}
?>