<?

// обработчик формы отзывов

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
	Header("location:/otziv/?name=$name&phone=$phone&mail=$mail&text=$text&msg=Не заполнены обязательные поля!");
	exit;
}

if ($capcha == false)
{
	Header("location:/otziv/?name=$name&phone=$phone&mail=$mail&text=$text&msg=Неправильно решили пример!");	
	exit;	
}

$result = mysql_query("SELECT * FROM otziv WHERE ip='$ip' && time!='' ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
    if ((time()-$myrow[time])<=100)
    {
       Header("location:/otziv/?msg=Еще не прошло минуты с последнего отзыва!");
	   exit; 
    }
}


$img_name = "";

if (f_data ($_FILES["img"] ["name"], 'img', "200") != false)
{ 
    if ($_FILES['img']['size']<=300000)
    {
        $ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
        $img_name = md5($name.$date.rand(111111,999999)).".$ext";
        copy($_FILES["img"]["tmp_name"], "../img/otziv/$img_name"); 
    }
    else
    {
        Header("location:/otziv/?msg=Фото должно быть менее 300Кб!");	
	    exit;
    }
	
}

//добавление
$result_add = mysql_query ("INSERT INTO otziv (name,text,date,mail,ip,time,img) VALUES ('$name','$text','$date','$mail','$ip','$time','$img_name')");	

$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$text = "<b>Уведомляем Вас что на сайте $_SERVER[HTTP_HOST]</b><br>
От $name, тел. $phone, e-mail: $mail,<br>
Был оставлен отзыв:<br>
$text<Br>

<a href='$_SERVER[HTTP_HOST]/img/otziv/$img_name'>Фото: $_SERVER[HTTP_HOST]/img/otziv/$img_name</a>
";

mailto($text,"Уведомление с сайта об отзыве",$myrow[mail_admin]);

	
Header("location:/otziv/?msg=Спасибо. Ваш отзыв принят! Как только его проверит администратор, то его опубликуют.");	
exit;
?>