<?

function drag($start_e, $end_e)
{
	include("../../blocks/db.php");
	
	//запрос к базе, получаем
	$result1 = mysql_query("SELECT * FROM news WHERE number='$start_e'");
	$myrow1 = mysql_fetch_assoc($result1); 
	$start_e_id = $myrow1[id];
	
	//запрос к базе, получаем следующий объект
	$result2 = mysql_query("SELECT * FROM news WHERE number='$end_e'");
	$myrow2 = mysql_fetch_assoc($result2);
	$end_e_id = $myrow2[id];
	
	//перетаскивание вниз
	if ($start_e < $end_e)
	{	
		$start = $start_e;
		$end = $end_e;
		//echo "number>'$start' && number<'$end'";
		$result4 = mysql_query("SELECT * FROM news WHERE number>'$start' && number<='$end' ORDER BY number ASC");
		$myrow4 = mysql_fetch_assoc($result4); 
	
		do
		{
			if ($myrow4[id]!=$start_e_id)
			{
				
				$number = ($myrow4[number]-1); 
				//редактирование
				$result_edit = mysql_query("UPDATE news SET number='$number' WHERE id='$myrow4[id]'", $db);		
			}
		}while($myrow4 = mysql_fetch_assoc($result4));
		
		//редактирование
		$result_edit = mysql_query("UPDATE news SET number='$end_e' WHERE id='$start_e_id'", $db);		
	}
	else
	{
		$start = $start_e;
		$end = $end_e;
		
		$result4 = mysql_query("SELECT * FROM news WHERE number>='$end' && number<'$start' ORDER BY number ASC");
		$myrow4 = mysql_fetch_assoc($result4); 

		do
		{
			if ($myrow4[id]!=$start_e_id)
			{
				
				$number = ($myrow4[number]+1); 
				//редактирование
				$result_edit = mysql_query("UPDATE news SET number='$number' WHERE id='$myrow4[id]'", $db);	
			}
		}while($myrow4 = mysql_fetch_assoc($result4));
		
		//редактирование
		$result_edit = mysql_query("UPDATE news SET number='$end_e' WHERE id='$start_e_id'", $db);		
	}
}

?>