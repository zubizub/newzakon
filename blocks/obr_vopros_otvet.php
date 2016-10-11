<?

// обработчик формы для вопрос-ответа

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$name = f_data ($_POST[name], 'text', 0);
$phone = f_data ($_POST[phone], 'text', 0);
$mail = f_data ($_POST[mail], 'text', 0);
$text = f_data ($_POST[text], 'text', 0);
$date = date("H:m d.m.Y");

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


if ($name == false || $mail == false)
{
	Header("location:/vopros_otvet/?name=$name&phone=$phone&mail=$mail&text=$text&msg=Не заполнены обязательные поля!");
	exit;
}

if ($capcha == false)
{
	Header("location:/vopros_otvet/?name=$name&phone=$phone&mail=$mail&text=$text&msg=Неправильно решили пример!");	
	exit;	
}

$result = mysql_query("SELECT * FROM vopros_otvet WHERE ip='$ip' && time!='' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
    if ((time()-$myrow[time])<=100)
    {
       Header("location:/vopros_otvet/?msg=Еще не прошло минуты с последнего вопроса!");
	   exit; 
    }
}

//добавление
$result_add = mysql_query ("INSERT INTO vopros_otvet (name,text,date,mail,ip,time) VALUES ('$name','$text','$date','$mail','$ip','$time')");	

$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$text = "<b>Уведобляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
От $name, тел. $phone, e-mail: $mail,<br>
Был получен вопрос:<br>
$text
";

mailto($text,"Уведомление с сайта о вопросе",$myrow[mail_admin]);

	
Header("location:/vopros_otvet/?msg=Спасибо. Сообщение отправлено!");	
exit;
?>