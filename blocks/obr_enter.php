<?

// обработчик формы входа пользователя

include("db.php");
include("f_data.php");

$mail =  f_data($_POST['name'],'text',0);
$pass = md5(md5(f_data($_POST['mail'],'text',0)));
//if ($_POST[zapomnit]==true) {$zapomnit=1;} else {$zapomnit=0;}

$result = mysql_query("SELECT * FROM users WHERE (name='$mail' || mail='$mail') && pass='$pass' && podtverjdenie='1'");

if (mysql_num_rows($result)!=0)
{
	$myrow = mysql_fetch_assoc($result); 	
	
	if (isset($_COOKIE[uid]) && $_COOKIE[uid]==$myrow[uid])
	{
		$token = $myrow[token];
	}
	else
	{
		$token = md5(rand(11111,99999).date("d.m.Y"));
	}
	
	$result_edit = mysql_query("UPDATE users SET token='$token' WHERE (name='$mail' || mail='$mail') && pass='$pass' && podtverjdenie='1'", $db);
			
	Header("location:/cookie.php?uid=$myrow[uid]&token=$token");	
	exit;
}
else
{
	Header("location:/enter/?msg=Неправильный логин или пароль или регистрация не подтверждена!");	
	exit;
}

?>