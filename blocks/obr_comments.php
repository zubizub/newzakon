<?

// обработчик комментариев

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");

$name = f_data ($_POST[name], 'text', 0);
$mail = f_data ($_POST[mail], 'text', 0);
$text = f_data ($_POST[text], 'text', 0);
$url = f_data ($_POST[url], 'text', 0);
$name_obj = f_data ($_POST[name_obj], 'text', 0);
$id_obj = f_data ($_POST[id_obj], 'text', 0);
$uid = $_POST[uid];
$date = date("H:m d.m.Y");

if ($name == false || $mail == false)
{
	Header("location:$url?name=$name&phone=$phone&mail=$mail&text=$text&msg=Не заполнены обязательные поля!");
	exit;
}

if ($capcha == false)
{
	Header("location:$url?name=$name&phone=$phone&mail=$mail&text=$text&msg=Неправильно решили пример!");	
	exit;	
}


//добавление
$result_add = mysql_query ("INSERT INTO comment (name,mail,text,date,page_url,name_obj,uid,id_obj) VALUES ('$name','$mail','$text','$date','$url','$name_obj','$uid','$id_obj')");		

$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$text = "<b>Комментарий на сайте $_SERVER[HTTP_HOST]</b><br>
От $name, e-mail: $mail, $name_obj<br>
$text
";

mailto($text,"Был оставлен комментарий на сайте",$myrow[mail_admin]);

Header("location:$url?msg=Спасибо. Ваш отзыв отправлен на модерацию!");	
exit;
	
?>