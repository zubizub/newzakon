<?

// обработчик заявки

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$text = f_data ($_POST['formSendOtziv-text'], 'text', 0);
$idz = f_data ($_POST[idz], 'text', 0);
$uid_from = f_data ($_COOKIE[uid], 'text', 0);
$uid_zakazchik = $uid_from;
$bal = f_data ($_POST[bal], 'text', 0);
$date = date("H:m d.m.Y");

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

$result = mysql_query("SELECT * FROM users WHERE uid='$uid_from'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$bal_user = $myrow['karma']+$bal;


if ($text == false || $uid_from=='' || $num_rows==0)
{
	Header("location:/zadaniy_inf/?id=$idz&msg=Не заполнены обязательные поля!");
	exit;
}

$result = mysql_query("SELECT * FROM zadaniy WHERE id='$idz'");
$myrow = mysql_fetch_assoc($result); 
$uid_ispolnit = $myrow[ispolnitel];

$result_edit = mysql_query("UPDATE users SET karma='$bal_user' WHERE uid='$uid_ispolnit'", $db);


$result_add = mysql_query ("INSERT INTO otziv (text,date,enabled,uid_zakazchik,uid_ispolnit,bal,idz) VALUES ('$text','$date','1','$uid_zakazchik','$uid_ispolnit','$bal','$idz')");		

$result_edit = mysql_query("UPDATE zadaniy SET endzayvka='1' WHERE id='$idz'", $db);


Header("location:/zadaniy_inf/?id=$idz");	
exit;
	
?>