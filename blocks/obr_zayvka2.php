<?

// дополнительный обработчик формы

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$name = f_data ($_POST[fio], 'text', 0);
$phone = f_data ($_POST[phone], 'text', 0);
$address = f_data ($_POST[address], 'text', 0);
$mail = f_data ($_POST[mail], 'text', 0);
$text = f_data ($_POST[text], 'text', 0);
$date = date("H:m d.m.Y");

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

if ($name == false || $mail == false)
{
	Header("location:/zayvka/?name=$name&phone=$phone&mail=$mail&text=$text&address=$address&msg=Не заполнены обязательные поля!");
	exit;
}

if ($capcha == false)
{
	Header("location:/zayvka/?name=$name&phone=$phone&mail=$mail&text=$text&address=$address&msg=Неправильно решили пример!");	
	exit;	
}

//добавление
$result_add = mysql_query ("INSERT INTO zayvki (fio,phone,mail,address,text,date,type,ip,time) VALUES ('$name','$phone','$mail','$address','$text','$date','Заявка','$ip','$time')");	

$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$text = "<b>Уведомляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
От $name, тел. $phone, e-mail: $mail,<br>
Была получена заявка:<br>
$text
";

mailto($text,"Уведомление с сайта",$myrow[mail_admin]);

	
Header("location:/zayvka/?msg=Спасибо. Заявка отправлена!");	
exit;
	
?>