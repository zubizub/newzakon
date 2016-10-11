<?

include("db.php");
include("../../blocks/f_data.php");
include("../../blocks/mailto.php");
include("../modul/settings/shifr_pass.php");

$data_post =  f_data($_POST['data_post'],'text',0);
$data_post = str_replace("-", "", $data_post);
$data_post = str_replace(" ", "", $data_post);
$data_post = substr($data_post, 1, (strlen($data_post)-1)); 

$result = mysql_query("SELECT * FROM settings WHERE phone_admin LIKE '%$data_post%'");

if (mysql_num_rows($result)!=0 && $data_post!='')
{
	
	$result1 = mysql_query("SELECT * FROM users WHERE status='Администратор' && name!='AntiBuger' ORDER BY id ASC LIMIT 1");
	$myrow1 = mysql_fetch_assoc($result1); 
	$real_pass = get_pass($myrow1[real_pass]);
	$text3 = urlencode("Ваш пароль для сайта $_SERVER[HTTP_HOST]: $real_pass");
	$otpravka_sms = file_get_contents("http://eurosites.ru/porno/blocks/sms_for_user.php?phone_namber=8$data_post&from_sms=EuroSites&msg=$text3");	
	$myrow = mysql_fetch_assoc($result); 

	$text = "Востановление пароля администратора сайта $_SERVER[HTTP_HOST]";
	mailto($text,"Востановление пароля","info@eurosites.ru");
	
	$text = "Было сделано востановление пароля адмиистратора $_SERVER[HTTP_HOST]. IP: $_SERVER[REMOTE_ADDR]";
	mailto($text,"Востановление пароля Вашего сайта","$myrow[mail_admin]");
	
	echo "1";
	exit;
}
else
{
	echo "0";
	exit;	
}
?>