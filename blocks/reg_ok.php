<?

// подтверждение регистрации пользователем (по ссылки присланной в e-mail)

$id_user = f_data($_GET['uid'],'text',0);

$result_u = mysql_query("SELECT * FROM users WHERE uid='$id_user'");

if (mysql_num_rows($result_u)!=0)
{
	$result_edit = mysql_query("UPDATE users SET podtverjdenie='1' WHERE uid='$id_user'", $db);
	echo "<div  style='color:#149d0e; font-size:24px'>Регистрация подтверждена</div>";	
}
else
{
	echo "<div style='color:red; font-size:24px'>Неверная ссылка! <a href='/'>ПЕРЕЙТИ НА ГЛАВНУЮ</a></div>";	
}


?>