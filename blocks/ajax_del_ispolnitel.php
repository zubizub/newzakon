<?

//обработчик заказа обратного звонка

include("db.php");
include("f_data.php");
include("mailto.php");

$idz = f_data ($_POST[idz], 'text', 0);
$ido = f_data ($_POST[ido], 'text', 0);
$uid = f_data ($_COOKIE[uid], 'text', 0);
$date = date("H:m d.m.Y");
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


$result_edit = mysql_query("UPDATE zadaniy SET ispolnitel='',inWork='0' WHERE id='$idz' && uid='$uid'", $db);
$result_edit = mysql_query("UPDATE otklik SET ispolnitel='0' WHERE idz='$idz' && id='$ido'", $db);

/*
$text = "<b>Уведомляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
Попросили перезвонить на тел. $phone";

mailto($text,"Уведомление с сайта",$myrow[mail_admin]);
*/


?>