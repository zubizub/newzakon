<?

//показываются товары на главной странице, те товары которые отмечены как "выделенные" через систему управления

$result = mysql_query("SELECT * FROM goods WHERE enabled='1' && stamp='1' ORDER BY id DESC LIMIT 4");
@$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	echo '<div style="border-bottom:1px solid #d8dadb; margin-top:13px; margin-bottom:13px"></div>';
	$myrow = mysql_fetch_assoc($result); 
	
	do
	{		
		include("blocks/tovar.php");	
	}while($myrow = mysql_fetch_assoc($result));
}

?>