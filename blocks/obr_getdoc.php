<?

// обработчик заявки

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$mail = f_data ($_POST[mail], 'text', 0);
$text = f_data ($_POST['formSendOtziv-text'], 'text', 0);
$fileDoc = f_data ($_POST[fileDoc], 'text', 0);


$date = date("H:m d.m.Y");
if (isset($_COOKIE[advert])) {$advert=$_COOKIE[advert];} else {$advert="";}

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


if ($mail == false)
{
	Header("location:/docs/?msg=Не заполнены обязательные поля!");
	exit;
}


$result = mysql_query("SELECT * FROM doc WHERE secretcod='$fileDoc'");
$myrow = mysql_fetch_assoc($result); 

$result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
$myrow_u = mysql_fetch_assoc($result_u); 
$mail_admin = $myrow_u[mail];


$text = "<b>Уведомляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
Пользователь с e-mail: $mail хочет купить документ:
э$myrow[name]э за $myrow[price] руб.<br>
Просим связаться с пользователем и обсудить сделку.<br><br>

$text
";

mailto($text,"Хотят купить документ",$mail_admin);


Header("location:/docs/?msg=Спасибо. Заявка отправлена!");	
exit;
	
?>