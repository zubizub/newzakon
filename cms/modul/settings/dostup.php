<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>


<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:70px">IP</th>
    <th>ФИО</th>
    <th style="width:50px">время</th>
    <th style="width:80px">дата</th>
  </tr>
  
<?
//запрос к базе
$result = mysql_query("SELECT * FROM control_dostup WHERE user!='' && user!='Морозов Андрей Николаевич' ORDER BY id DESC LIMIT 20");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

include("shifr_pass.php");

if ($num_rows!=0)
{
	do
	{
		echo "
		  <tr>
			<td style='width:70px'>$myrow[ip]</td>
			<td style='text-align:left'>$myrow[user]</td>
			<td style='width:50px'>$myrow[time]</td>
			<td style='width:80px'>$myrow[date]</td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
	
}
else
{
		echo "
		  <tr>
			<th colspan='4'>Событий нет</th>
		  </tr>  		
		";	
}

?>

</table>