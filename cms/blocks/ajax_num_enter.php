<?

	$ip = $_SERVER['REMOTE_ADDR'];
	if (@fopen("../logs/$ip.txt", "r")) {$fp = fopen("../logs/$ip.txt", "r"); $kol_enter = 5-fgets($fp, 1024);fclose($fp);} 
	else {$kol_enter = 5;}
	echo $kol_enter;

?>