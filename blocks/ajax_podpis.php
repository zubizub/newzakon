<?

//пользователь подписался на рассылку

include("db.php");
include("f_data.php");

$email = f_data ($_POST[email], 'text', 0);
$date = date("H:m d.m.Y");

if ($email != false)
{
	if (!isset($_COOKIE[uid])) {$name="Пользователь";} 
	else {
		$result = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
		$myrow = mysql_fetch_assoc($result); 
		$name=$myrow[fio];
	}
	
	$result_add = mysql_query ("INSERT INTO rassilka (name,mail,date) VALUES ('$name','$email','$date')");		
	echo "ok";
}
else
{
	echo "false";	
}



?>