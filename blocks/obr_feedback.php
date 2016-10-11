<?

// обработчик обратной связи

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$name = f_data ($_POST[fio], 'text', 0);
$phone = f_data ($_POST[phone], 'text', 0);
$mail = f_data ($_POST[mail], 'text', 0);
$text = f_data ($_POST[text], 'text', 0);
$date = date("H:m d.m.Y");

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();

if ($name == false || $mail == false)
{
	Header("location:/feedback/?name=$name&phone=$phone&mail=$mail&text=$text&msg=Не заполнены обязательные поля!");
	exit;
}

$result = mysql_query("SELECT * FROM obr_svyz WHERE ip='$ip' && time!='' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
    if ((time()-$myrow[time])<=100)
    {
       Header("location:/feedback/?msg=Еще не прошло минуты с последней Вашей заявики!");
	   exit; 
    }
}

//добавление
$result_add = mysql_query ("INSERT INTO obr_svyz (fio,phone,mail,text,date,type,ip,time) VALUES ('$name','$phone','$mail','$text','$date','Обратная связь','$ip','$time')");	

$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$text = "<b>Уведомляем Вас что на сайте $_SERVER[HTTP_HOST]</b><br>
От $name, тел. $phone, e-mail: $mail,<br>
Поступил запрос:<br>
$text
";

mailto($text,"Уведомление с сайта",$myrow[mail_admin]);
	
Header("location:/feedback/?msg=Спасибо. Сообщение отправлено!");	
exit;
	
?>