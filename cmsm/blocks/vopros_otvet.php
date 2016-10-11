<?


	$result = mysql_query("SELECT * FROM vopros_otvet");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM vopros_otvet WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=vopros_otvet' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM vopros_otvet WHERE enabled='1'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enabl = mysql_num_rows($result);



	echo "	<div class='inf_block'>
			<div>Сегодня: <span>$num_rows_now</span></div>
			<div>Неактивных: <span>$num_rows_enabl</span></div>
			<div>Всего: <span>$num_rows</span></div>
			</div><br><br>
	";
		



$result = mysql_query("SELECT * FROM vopros_otvet ORDER BY id DESC LIMIT 30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		if ($myrow[otvet]=='') 
		{$otvet_button = "<a href='#' class='popup' style='color:#4f7ee8' onClick='open_otvet($myrow[id])'>ответить</a>";} 
		else {$otvet_button="<b>- $myrow[otvet]</b>";}
		
		echo "
				<b>$myrow[name]</b><br>
				<div style='font-size:11px'><i>$myrow[text]</i></div>
				$otvet_button<br>
				<div class='otvet_$myrow[id] otvet_div' style='display:none'>
					<form action='modul/vopros_otvet/obr_zayvki.php' method='post'>
						<textarea name='text' cols='65' rows='10'></textarea>
						<div style='margin-top:10px'>
							<input name='button' type='button' value='отменить' onClick='close_otvet()' class='button_cancel'>
							<input name='button' type='submit' value='сохранить' style='margin-left:10px' class='button_save'>
						</div>
						<input type='hidden' name='id' value='$myrow[id]'>
					</form>
				</div>
			<br>
			e-mail: $myrow[mail]<br>
			Дата: $myrow[date]<br>
			<div style='border:1px dotted #999; margin-bottom:10px; margin-top:10px'></div>  	
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "Записей нет";	
}


?>