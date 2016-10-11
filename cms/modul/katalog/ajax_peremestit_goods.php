<?php

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

if ($_POST[url_goods])
{
	set_logs("Каталог","Перемещение товара");
	$url_goods = $_POST[url_goods];
	$urlfolder_to = $_POST[urlfolder_to];
	$url_goods = f_data ($url_goods, 'text', 0);
	$urlfolder_to = f_data ($urlfolder_to, 'text', 0);
	
	$url_goods = explode(",",$url_goods);
	
	for ($i=0;$i<count($url_goods);$i++)
	{
		$where_sql .= "id='$url_goods[$i]' || ";
	}
	
	$where_sql = substr($where_sql,0,-4);
	
	
	$result = mysql_query("SELECT * FROM goods WHERE $where_sql");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);

	if ($num_rows!=0)
	{
		do
		{
			$result_edit = mysql_query("UPDATE goods SET url='$urlfolder_to' WHERE id='$myrow[id]'", $db);
		}while($myrow = mysql_fetch_assoc($result));
	}
	
}




?>