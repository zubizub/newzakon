<?
//ini_set('display_errors','On');
//error_reporting('E_ALL');


ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
include("../../blocks/send_sms.php");


//удаление
if (isset($_GET[del]))
{
	//запрос к базе
	$del_g = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM zadaniy WHERE id='$del_g'");
	$myrow = mysql_fetch_assoc($result); 
	
    $text_sms = "Здравствуйте. Ваше задание уделено с портала MOYZAKON.COM";
    
    $result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
    $myrow_us = mysql_fetch_assoc($result_us);
    sendSms($myrow_us[phone],$text_sms);
    
	set_logs("Новости","Удаление новости",$myrow[name]);

	$del = mysql_query ("DELETE FROM zadaniy WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=zadaniy&msg=Задание удалено!");	
	exit;	
	
}



$enabled =  f_data($_POST['enabled'],'text',0);
$name = $_POST['name'];
$text = $_POST['text'];
$date_do = f_data($_POST['date_do'],'text',0);
$bujet = f_data($_POST['bujet'],'text',0);

$city =  $_POST['city'];
$cat =  $_POST['cat'];
$fakeName =  $_POST['fakeName'];



//запрос к базе, - задание номера товара
$edit_g =  f_data($_POST['edit'],'text',0);
$result = mysql_query("SELECT * FROM zadaniy WHERE id='$edit_g'");
$myrow = mysql_fetch_assoc($result);
$enabled_old = $myrow[enabled];

if ($enabled_old!=$enabled)
{
    $result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
    $myrow_us = mysql_fetch_assoc($result_us);
    
    if ($enabled==1)
    {
        $text_sms = "Здравствуйте! Ваше задание опубликовано на сайте! Спасибо, что Вы с нами!";
    }
    else
    {
        $text_sms = "Здравствуйте! Ваше задание снято с публикации! Спасибо, что Вы с нами!";
    }
    
    sendSms($myrow_us[phone],$text_sms);
}


set_logs("Задание","Редактирование задания",$myrow[name]);


//редактирование

//print_r($cat);
$query = "UPDATE zadaniy SET enabled='$enabled', name='$name',`text`='$text',date1='$date_do',bujet='$bujet', city='$city',cat='$cat', fakeName='$fakeName'
WHERE id='$edit_g'";

$result_edit = mysql_query($query, $db);

Header("location:../../?page=zadaniy_inf&id=$edit_g&msg=Операция прошла успешно!");
exit;		
	

ob_flush();	
?>