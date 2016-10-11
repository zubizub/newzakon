<?
	$result = mysql_query("SELECT * FROM comment");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM comment WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=comment' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM comment WHERE enabled='1'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enabl = mysql_num_rows($result);


	echo "	<div class='inf_block'>
			<div>Сегодня: <span>$num_rows_now</span></div>
			<div>Неактивных: <span>$num_rows_enabl</span></div>
			<div>Всего: <span>$num_rows</span></div>
			</div><br><br>
	";
		
		
		
		
$result = mysql_query("SELECT * FROM comment ORDER BY id DESC LIMIT 30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		if ($myrow[uid]!='') 
		{
			$result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
			$myrow_u = mysql_fetch_assoc($result_u); 			
			$user_post="Пользователь $myrow_u[name]";
		} 
		else {$user_post="Гость";}
		
		echo "
		  $myrow[name]<br><span style='font-size:11px'>$myrow[text]</span><br>
			e-mail: $myrow[mail]<br>
			Дата: <b>$myrow[date]</b><br>
			Добавил: $user_post<br>
			Комментарий на:<i>$myrow[name_obj]</i><br>
			<div style='border:1px dotted #999; margin-bottom:10px; margin-top:10px'></div>  
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "Комментариев нет";	
}

?>