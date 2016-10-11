<?

	$result = mysql_query("SELECT * FROM obr_svyz");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM obr_svyz WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=obr_svyz' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM obr_svyz WHERE enabled='1'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enabl = mysql_num_rows($result);
	
	echo "	<div class='inf_block'>
			<div>Сегодня: <span>$num_rows_now</span></div>
			<div>Неактивных: <span>$num_rows_enabl</span></div>
			<div>Всего: <span>$num_rows</span></div>
			</div><br><br>
	";
		
	

$result = mysql_query("SELECT * FROM obr_svyz ORDER BY id DESC LIMIT 30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['enabled']; //активность новости
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]'>";}
		
		echo "
		  	<b>$myrow[fio]</b>
			тел: $myrow[phone]<br>
			e-mail: $myrow[mail]<br>
			Дата: <b>$myrow[date]</b><br>
			<i>$myrow[type]</i>
		    <div style='border:1px dotted #999; margin-bottom:10px; margin-top:10px'></div>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "Сообщений нет";	
}

?>