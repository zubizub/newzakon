<?
	//запрос к базе для получения программного кода счетчиков и т.п.
	$result = mysql_query("SELECT * FROM settings");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	if ($num_rows!=0)
	{
		do
		{
			echo "";
		}while($myrow = mysql_fetch_assoc($result));
	}
?>