<?
//ini_set('display_errors','On');
//error_reporting('E_ALL');


ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
include("../../blocks/mailto.php");


//удаление
if (isset($_GET[del]))
{
	//запрос к базе
	$del_g = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM vopros WHERE id='$del_g'");
	$myrow = mysql_fetch_assoc($result); 
	
    $text_sms = "Здравствуйте. Ваш вопрос уделен с портала MOYZAKON.COM";
    
    $result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
    $myrow_us = mysql_fetch_assoc($result_us);
    //sendSms($myrow_us[phone],$text_sms);
    mailto($text_sms,"Удаление вопроса",$myrow_us[mail]);
	set_logs("Вопросы","Удаление вопроса",$myrow[name]);

	$del = mysql_query ("DELETE FROM vopros WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=vopros&msg=Вопрос удален!");	
	exit;	
	
}

/*$enabled =  f_data($_POST['enabled'],'text',0);
$name = f_data($_POST['name'],'text',0);
$type = f_data($_POST['type'],'text',0);*/

$enabled =  $_POST['enabled'];
$name = $_POST['name'];
$type = $_POST['type'];
$text = $_POST['text'];
$fakeName = $_POST['fakeName'];

/*$city =  f_data($_POST['city'],'text',0);
$cat =  f_data($_POST['cat'],'text',0);*/

$city =  $_POST['city'];
$cat =  $_POST['cat'];


//запрос к базе, - задание номера товара
$edit_g =  f_data($_POST['edit'],'text',0);
$result = mysql_query("SELECT * FROM vopros WHERE id='$edit_g'");
$myrow = mysql_fetch_assoc($result);
$enabled_old = $myrow[enabled];

if ($enabled_old!=$enabled)
{
    $result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
    $myrow_us = mysql_fetch_assoc($result_us);
    
    if ($enabled==1)
    {
        //$text_sms = "Здравствуйте! Ваш вопрос опубликован на сайте! Спасибо, что Вы с нами!";
        $text_sms =  "Здравствуйте!<Br>
    Ваш вопрос подтвержден. Спасибо Вам! Вопрос находится по адресу:<Br>
    <a href='https://moyzakon.com/question/$myrow[name_m]/'>https://moyzakon.com/question/$myrow[name_m]/</a>";
    }
    else
    {
        $text_sms = "Здравствуйте! Ваше вопрос снят с публикации! Спасибо, что Вы с нами!";
    }
    
    mailto($text_sms,"Вопрос на MOYZAKON.COM",$myrow_us[mail]);
    
    //sendSms($myrow_us[phone],$text_sms);
}


set_logs("Вопрос","Редактирование вопроса",$myrow[name]);

$vopsosId = $_REQUEST['vopsosId'];

if (!empty($vopsosId)) {

$edit_g = $vopsosId;
$query = "UPDATE vopros SET enabled='1', name='$name',text='$text', city='$city',cat='$cat',type='$type', podtverdit='1', fakeName='$fakeName' WHERE id='$vopsosId'";
}

else {

    $query = "UPDATE vopros SET enabled='$enabled', name='$name',text='$text', city='$city',cat='$cat',type='$type', fakeName='$fakeName' WHERE id='$edit_g'";
}
print_r($query);

//редактирование
$result_edit = mysql_query($query, $db);

Header("location:../../?page=vopros_inf&id=$edit_g&msg=Операция прошла успешно!");	
exit;		
	

ob_flush();	
?>