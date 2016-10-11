<?

// обработчик заявки

include("db.php");
include("f_data.php");
include("obr_capcha.php");
include("mailto.php");
include("send_sms.php");


$text = f_data ($_POST[text], 'text', 0);
$uid = f_data ($_COOKIE[uid], 'text', 0);
$idz = f_data ($_POST[zadanie], 'text', 0);
$date = date("H:m d.m.Y");
if (isset($_COOKIE[advert])) {$advert=$_COOKIE[advert];} else {$advert="";}

$ip = $_SERVER['REMOTE_ADDR'];
$time = time();


if ($text == false || $uid == false)
{
	Header("location:/zadaniy_inf/?id=$idz&msg=Не заполнены обязательные поля!");
	exit;
}


$result = mysql_query("SELECT * FROM otklik WHERE idz='$idz' && uid='$uid'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows==0)
{
   $result_add = mysql_query ("INSERT INTO otklik (idz,uid,date,text) VALUES ('$idz','$uid','$date','$text')");	
   $result_edit = mysql_query("UPDATE zadaniy SET otklik=otklik+1 WHERE id='$idz'", $db);
   
   $result = mysql_query("SELECT * FROM zadaniy WHERE id='$idz'");
   $myrow = mysql_fetch_assoc($result); 
   $uid = $myrow[uid];
   
   $result = mysql_query("SELECT * FROM users WHERE uid='$uid'");
   $myrow = mysql_fetch_assoc($result); 
   $phone = $myrow[phone];
    
    if ($phone!='')
    {
        $text = "Получен новый отклик на Ваше задание!";
        $result_user = mysql_query("SELECT * FROM users WHERE phone='$phone'");
        $myrow_user = mysql_fetch_assoc($result_user); 
        
        if ($myrow_user['mail_enabl2']=='1')
        {
            sendSms($phone,$text);
        }
        
    }
   

}
else
{
    Header("location:/zadaniy_inf/?id=$idz&msg=Вы уже откликались на задание!");
	exit;
}



//mailto($text,"Уведомление с сайта",$myrow[mail_admin]);


Header("location:/zadaniy_inf/?id=$idz&msg=Спасибо. Заявка отправлена!");	
exit;
	
?>