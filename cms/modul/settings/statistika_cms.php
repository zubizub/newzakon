<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="text-align:left; width:120px">Дата</th>
    <th style="text-align:left; width:120px">Раздел</th>
    <th style="text-align:left; width:120px">Объект</th>
    <th style="">Что редактировали</th>
    <th style="text-align:right; width:180px">Пользователь</th>
  </tr>


<?

//запрос к базе
$result = mysql_query("SELECT * FROM logs ORDER BY id DESC LIMIT 220");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		echo "
		  <tr>
			<td>$myrow[date]</td>
			<td>$myrow[razdel]</td>
			<td>$myrow[who_edit]</td>
			<td>$myrow[action]</td>
			<td style='text-align:right'>$myrow[user]</td>
		  </tr>		
		";
	}while($myrow = mysql_fetch_assoc($result));
}

?>

</table>

<br>
<div style="font-size:12px; font-weight:bold">Система отображает последних 220 действий в системе управления.</div>