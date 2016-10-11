<?

// обработчик заявки

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$text = f_data ($_POST['frmSendMsg-text'], 'text', 0);
$uid_to = f_data ($_POST[uid_from], 'text', 0);
$uid_from = f_data ($_COOKIE[uid], 'text', 0);
$date = date("H:m d.m.Y");

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

$result = mysql_query("SELECT * FROM users WHERE uid='$uid_from'");
$num_rows = mysql_num_rows($result);

if ($text == false || $uid_from=='' || $num_rows==0)
{
	Header("location:/im/?from=$uid_to&msg=Не заполнены обязательные поля!");
	exit;
}


$result_add = mysql_query ("INSERT INTO sms_user (uid_to,uid_from,date,text) VALUES ('$uid_to','$uid_from','$date','$text')");		


Header("location:/im/?from=$uid_to");	
exit;
	
?>