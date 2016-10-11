<?

function set_logs($razdel,$action,$who_edit)
{
	// $who_edit - что редактируем или добавляем
	 
	$result = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
	$myrow = mysql_fetch_assoc($result); 
	$user = $myrow[fio];
	if ($user=="Морозов Андрей Николаевич") {$user='Администратор';}
	$date = date("H:i d.m.Y");
	$ip_user = $_SERVER["REMOTE_ADDR"];
	
	$result_add = mysql_query ("INSERT INTO logs (razdel,action,date,user,uid,ip,who_edit) 
	VALUES ('$razdel','$action','$date','$user','$_COOKIE[uid]','$ip_user','$who_edit')");	
	
	$result = mysql_query("SELECT * FROM logs ORDER BY id DESC LIMIT 220");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);

	if ($num_rows>219)
	{
		$del = mysql_query ("DELETE FROM logs WHERE id<'$myrow[id]'");
	}
	
}

?>