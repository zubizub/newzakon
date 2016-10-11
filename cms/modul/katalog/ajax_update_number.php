<?php

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$url = f_data ($_POST[url], 'text', 0);

$i=1;
$result = mysql_query("SELECT * FROM goods WHERE url='$url' ORDER BY number ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		
		$result_edit = mysql_query("UPDATE goods SET number='$i' WHERE id='$myrow[id]'", $db);
		$i++;
	}while($myrow = mysql_fetch_assoc($result));
}		

?>