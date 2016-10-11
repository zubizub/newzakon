<?php

$where_list = "";

$result_list = mysql_query("SELECT * FROM katalog WHERE url='$where_list' ORDER BY name ASC");
$myrow_list = mysql_fetch_assoc($result_list); 
$num_rows_list = mysql_num_rows($result_list);

if ($num_rows_list!=0)
{
	echo "<select class='list_kategory'>";
	do
	{
		$where_list2 = $myrow_list[id];
		echo "<option value='$where_list2'>$myrow_list[name]</option>";
		$result_list2 = mysql_query("SELECT * FROM katalog WHERE url='$where_list2' ORDER BY name ASC");
		$myrow_list2 = mysql_fetch_assoc($result_list2); 
		$num_rows_list2 = mysql_num_rows($result_list2);

		if ($num_rows_list2!=0)
		{
			do
			{
				$where_list3 = "$myrow_list[id]/$myrow_list2[id]";
				$nbsp = "&nbsp;&nbsp;";
				echo "<option value='$where_list3'>$nbsp$myrow_list2[name]</option>";
				$result_list3 = mysql_query("SELECT * FROM katalog WHERE url='$where_list3' ORDER BY name ASC");
				$myrow_list3 = mysql_fetch_assoc($result_list3); 
				$num_rows_list3 = mysql_num_rows($result_list3);

				if ($num_rows_list3!=0)
				{
					do
					{
						$where_list4 = "$myrow_list[id]/$myrow_list2[id]/$myrow_list3[id]";
						$nbsp = "&nbsp;&nbsp;&nbsp;&nbsp;";
						echo "<option value='$where_list4'>$nbsp$myrow_list3[name]</option>";
						$result_list4 = mysql_query("SELECT * FROM katalog WHERE url='$where_list4' ORDER BY name ASC");
						$myrow_list4 = mysql_fetch_assoc($result_list4); 
						$num_rows_list4 = mysql_num_rows($result_list4);

						if ($num_rows_list4!=0)
						{
							do
							{
								$where_list5 = "$myrow_list[id]/$myrow_list2[id]/$myrow_list3[id]/$myrow_list4[id]";
								$nbsp = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								echo "<option value='$where_list5'>$nbsp$myrow_list4[name]</option>";								
							}while($myrow_list4 = mysql_fetch_assoc($result_list4));
						}
					}while($myrow_list3 = mysql_fetch_assoc($result_list3));
				}				
			}while($myrow_list2 = mysql_fetch_assoc($result_list2));
		}		
	}while($myrow_list = mysql_fetch_assoc($result_list));
	
	echo "</select>";
}


?>