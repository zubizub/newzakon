<?
function send_sms($msg,$phone)
{
	$phone = str_replace("-","",$phone);
	$phone = str_replace(" ","",$phone);

	//$login = 'antibuger@bk.ru';         //Ваш логин на этом сайте
	$login = 'sunkey86@mail.ru';         //Ваш логин на этом сайте
	//$password = '14885009';                 //Ваш пароль на этом сайте
	$password = 'Megafon123';                 //Ваш пароль на этом сайте
	$from = 'MOYZAKON';                         //От кого
	$msg = urlencode($msg);
	$checksumm = md5($login.md5($password).$phone); //Контрольная сумма
	$res = file_get_contents("http://sms48.ru/send_sms.php?login=$login&to=$phone&msg=$msg&from=$from&check2=$checksumm");
	
}

?>