<?

//обработчик заказа обратного звонка

include("db.php");
include("f_data.php");
include("mailto.php");

$phone = f_data ($_POST[phone], 'text', 0);
if (isset($_COOKIE[advert])) {$advert=$_COOKIE[advert];} else {$advert="";}
$date = date("H:m d.m.Y");
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


if ($phone != false)
{
    $result = mysql_query("SELECT * FROM zayvki WHERE ip='$ip' && time!='' ORDER BY id DESC");
    $myrow = mysql_fetch_assoc($result); 
    $num_rows = mysql_num_rows($result);

    if ($num_rows!=0)
    {
        if ((time()-$myrow[time])<=100)
        {
    	   exit; 
        }
    }


	$result_add = mysql_query ("INSERT INTO zayvki (fio,phone,mail,text,date,type,advert,ip,time) 
	VALUES ('Пользователь','$phone','нет','Перезвоните мне, пожалуйтса','$date','Перезвонить','$advert','$ip','$time')");		
	echo "ok";
	
	$result = mysql_query("SELECT * FROM settings");
	$myrow = mysql_fetch_assoc($result); 

	$text = "<b>Уведомляем Вас, что на сайте $_SERVER[HTTP_HOST]</b><br>
	Попросили перезвонить на тел. $phone";

	mailto($text,"Уведомление с сайта",$myrow[mail_admin]);


}

?>