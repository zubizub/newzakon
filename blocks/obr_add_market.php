<?

// обработчик формы изменения данных пользователя

include("db.php");
include("f_data.php");


print_r($_POST);

$usluga = f_data($_POST['usluga'],'text',0);
//$opisanie = f_data($_POST['opisanie'],'text',0);
$opisanie = $_POST['opisanie'];
$cena = f_data($_POST['cena'],'text',0);

if (!$cena || $cena == '0')
{
	Header("location:/cabinet/?msg=Некорректно введены данные!");
	exit;
}

$result1 = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
$myrow = mysql_fetch_array($result1); 

$query = "INSERT INTO `market` (`uid`, `usluga`, `opisanie`, `cena`,`moderation`) VALUES ($myrow[id], '$usluga', '$opisanie', '$cena', 0)";

//print_r($query);

$addRecord = mysql_query($query);

$text = "Новая задача с юридического маркета на модерацию";

if (mail('info@moyzakon.com,zubizubwork@gmail.com', $text, $usluga, "From: info@zakon.zubformat.ru", "-finfo@zakon.zubformat.ru")) {

	print_r('ok');
}



Header("location:/cabinet/?msg=Заявка будет размещена после прохождения процедуры модерации.");

exit;



?>