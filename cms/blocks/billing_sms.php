<?
function send_sms($msg,$phone)
{
	$phone = str_replace("-","",$phone);
	$phone = str_replace(" ","",$phone);

	//$login = 'antibuger@bk.ru';         //��� ����� �� ���� �����
	$login = 'sunkey86@mail.ru';         //��� ����� �� ���� �����
	//$password = '14885009';                 //��� ������ �� ���� �����
	$password = 'Megafon123';                 //��� ������ �� ���� �����
	$from = 'MOYZAKON';                         //�� ����
	$msg = urlencode($msg);
	$checksumm = md5($login.md5($password).$phone); //����������� �����
	$res = file_get_contents("http://sms48.ru/send_sms.php?login=$login&to=$phone&msg=$msg&from=$from&check2=$checksumm");
	
}

?>