<?


if (!isset($_COOKIE['uid']))
{
	ob_start();
	Header("location:/?msg=������ �����������!");			
	exit;
}
else
{
	$result = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
	if (mysql_num_rows($result)==0)
	{
		ob_start();
		Header("location:/?msg=������ �����������!");			
		exit;ob_end_flush();			
	}

}


?>