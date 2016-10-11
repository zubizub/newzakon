<?
include("db.php");
include("../../blocks/f_data.php");

function popitki_enter2()
{
	$ip = $_SERVER['REMOTE_ADDR'];
	if (@fopen("../logs/$ip.txt", "r")) {$fp = fopen("../logs/$ip.txt", "r"); $kol_enter = 5-fgets($fp, 1024);fclose($fp);} 
	else {$kol_enter = 5;}
	return $kol_enter-1;
	
}
	
	
function popitki_enter()
{
	$ip = $_SERVER['REMOTE_ADDR'];
	if (@file_exists("../logs/$ip.txt")) 
	{$fp = fopen("../logs/$ip.txt", "r+"); $kol_enter =  (fgets($fp, 1024)*1)+1; $fp = fopen("../logs/$ip.txt", "w+"); fputs($fp, $kol_enter);} 
	else {$fp = fopen("../logs/$ip.txt", "w+"); fputs($fp, "1");}	
	fclose($fp);
}	
	
$kol_enter = popitki_enter2();

if ($kol_enter != 0)
{
	//кросдоменное обращение, ошибка 771
	$referer=getenv("HTTP_REFERER"); 
	if (substr_count($referer,$_SERVER['HTTP_HOST'])==0)
	{ 
		popitki_enter();
		Header("location:../admin.php?msg=100");
		exit;
	}

	$mail =  f_data($_POST['name'],'text',0);
	$pass = md5(md5(f_data($_POST['pass'],'text',0)));
	$url_back = f_data($_POST[url_back],'text',0);
	if ($_POST[zapomnit]=="on") {$zapomnit=1;} else {$zapomnit=0;}

	$result = mysql_query("SELECT * FROM users WHERE (name='$mail' || mail='$mail') && pass='$pass' && status='Администратор'");
	
	if (mysql_num_rows($result)!=0)
	{
		$myrow = mysql_fetch_assoc($result); 
		
		$token = md5(rand(11111,99999).date("d.m.Y"));
		$result_edit = mysql_query("UPDATE users SET token='$token' WHERE uid='$myrow[uid]'", $db); //присваеваем одноразовый токен
	
		Header("location:../../cookie.php?url_back=$url_back&token=$token&u=".$myrow[uid]."-".$zapomnit);
		exit;
	}
	else
	{
		popitki_enter();
		Header("location:../admin.php?msg=101");
		exit;
	}

}
else
{
	Header("location:../admin.php?msg=102");
}
	
	
?>