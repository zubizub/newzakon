<?

$php = "en - - dbit";
$hit = "sssss";
$ma = "111-3";
$url_host = str_ireplace("www.", "", $_SERVER['HTTP_HOST']);
$name_user = md5(urlencode($url_host));
$result_mr = mysql_query("SELECT * FROM settings");
$myr_l = mysql_fetch_assoc($result_mr); 
$date_license = $myr_l[date_license];
/*
if ((time()-$date_license)>86400)
{
	$dostup_server = @file_get_contents("https://eurosites.ru/dostup/license_key.php?id_user=$SETTINGS[license_key]&domen=$_SERVER[HTTP_HOST]&name_user=$name_user&newcms");
	
	if ($dostup_server!="1" && $_SERVER['REMOTE_ADDR']!='127.0.0.1')
	{
		//echo "<Br><Br>Проверка: $dostup_server<Br><Br>";
		
		$dostup_server = @file_get_contents("https://eurosites.ru/dostup/license_key.php?id_user=$SETTINGS[license_key]&domen=$_SERVER[HTTP_HOST]&name_user=$name_user&newcms");
		
		if ($dostup_server!="1" && $_SERVER['REMOTE_ADDR']!='127.0.0.1')
		{
			$text = "Ошибка лицензии $SETTINGS[license_key], обращение с домена $_SERVER[HTTP_HOST]";
			mailto($text,"Ошибка лицензии","info@eurosites.ru");	

			echo base64_decode("PGRpdiBjbGFzcz0nYmdfbCcgc3R5bGU9J3Bvc2l0aW9uOmZpeGVkOyB0b3A6MHB4OyBsZWZ0OjBweDsgdGV4dC1hbGlnbjpjZW50ZXI7IGJhY2tncm91bmQtY29sb3I6cmdiYSgyNTUsMjU1LDI1NSwwLjUpJz48YnI+PGJyPjxicj48YnI+PGZvcm0gYWN0aW9uPSdibG9ja3Mvb2JyX2xpY2Vucy5waHAnIG1ldGhvZD0ncG9zdCc+PGlucHV0IG5hbWU9J2xpY2VucycgdHlwZT0ndGV4dCcgcGxhY2Vob2xkZXI9J8Li5eTo8uUg8eLu/iDr6Pbl7efo/iDt4CDv8O7k8+ryIScgcmVxdWlyZWQgc3R5bGU9J3dpZHRoOjQ0MHB4OyBwYWRkaW5nOjEwcHg7IGZvbnQtc2l6ZToyMnB4Oyc+IDxpbnB1dCBuYW1lPSdidXR0b24nIHR5cGU9J3N1Ym1pdCcgdmFsdWU9J/Hu9fDg7ejy/Ccgc3R5bGU9J3BhZGRpbmc6MTBweDsgZm9udC1zaXplOjIycHg7Jz48L2Zvcm0+PC9kaXY+");
		}
		
	}
	$result_edit = mysql_query("UPDATE settings SET date_license='".time()."' WHERE id='1'", $db);
}

*/
?>