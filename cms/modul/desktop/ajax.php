<?
include("../../blocks/db.php");


//для режима отладки на localhost
$local = 1;
if ($local!=1 && $_SERVER["REMOTE_ADDR"]!='127.0.0.1') {$enkod_to = "utf-8";} else {$enkod_to = "windows-1251";}

if ($_POST[type]=='zayvki')
{
	$result = mysql_query("SELECT * FROM zayvki");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM zayvki WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=zayvki' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM zayvki WHERE enabled='1'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enabl = mysql_num_rows($result);
	
	$result = mysql_query("SELECT * FROM zayvki ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$text = "
	<span>От <b>$myrow[fio]</b> (<i>$myrow[type]</i>)</span><br>
	<span>Телефон <b>$myrow[phone]</b> | $myrow[mail]</span><br>
	<span>Дата <b>$myrow[date]</b></span><br>
	<a href='?page=zayvki' style='color:#6eafe5'>смотреть все</a>";	
	
	 echo iconv("windows-1251", "$enkod_to", " 
			<td style='font-size:14px; text-align:left'>Заявки</td>
			<td>$num_rows_now</td>
			<td>$num_rows_enabl</td>
			<td>$num_rows</td>
			<td style='font-size:11px; line-height:14px; text-align:left; width:300px'>$text</td>");
}



if ($_POST[type]=='obr_svyz')
{
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


	$result = mysql_query("SELECT * FROM obr_svyz ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	
	$text = "
	<span>От <b>$myrow[fio]</b> (<i>$myrow[type]</i>)</span><br>
	<span>Телефон <b>$myrow[phone]</b> | $myrow[mail]</span><br>
	<span>Дата <b>$myrow[date]</b></span><br>
	<a href='?page=obr_svyz' style='color:#6eafe5'>смотреть все</a>";
	
	 echo iconv("windows-1251", "$enkod_to", " 
			<td style='font-size:14px; text-align:left'>Обратная связь</td>
			<td>$num_rows_now</td>
			<td>$num_rows_enabl</td>
			<td>$num_rows</td>
			<td style='font-size:11px; line-height:14px; text-align:left; width:300px'>$text</td>");
}




if ($_POST[type]=='zakaz')
{
	$result = mysql_query("SELECT * FROM zakaz");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM zakaz WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=goods_zakaz' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='на обработке'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab11 = mysql_num_rows($result);

	$result = mysql_query("SELECT * FROM zakaz WHERE status='отгружен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab12 = mysql_num_rows($result);
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='отправлен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab13 = mysql_num_rows($result);
	
	$result = mysql_query("SELECT * FROM zakaz WHERE status='исполнен'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enab14 = mysql_num_rows($result);
	
	
	$result = mysql_query("SELECT * FROM zakaz ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);	
				
	$text =  "
	<span>От <b>$myrow[fio]</b> (<i>$myrow[status]</i>)</span><br>
	<span>Телефон <b>$myrow[phone]</b> | $myrow[mail]</span><br>
	<span>Стоимоть <b>$myrow[price]</b> рублей</span><br>
	<span>Дата <b>$myrow[date]</b></span><br>
	<a href='?page=goods_zakaz' style='color:#6eafe5'>смотреть все</a>
	";	
	
	echo iconv("windows-1251", "$enkod_to", "
		<table width='100%' border='0' style='max-width:700px' class='tbl_desktop'>
		  <tr>
			<th>Модуль</th>
			<th style='width:65px'>За сегодня</th>
			<th style='width:85px'>На обработке</th>
			<th>Отгруженых</th>
			<th>Отправленых</th>
			<th>Исполненых</th>
			<th>Всего</th>
			<th style='width:160px'>Последний</th>
		  </tr>		  
		  <tr>
			<td style='font-size:14px; text-align:left'>Заказы</td>
			<td>$num_rows_now</td>
			<td>$num_rows_enab11</td>
			<td>$num_rows_enab12</td>
			<td>$num_rows_enab13</td>
			<td>$num_rows_enab14</td>
			<td>$num_rows</td>
			<td style='font-size:11px; line-height:14px; text-align:left; width:160px'>$text</td>
		  </tr>
		</table>	
	");
	
}

if ($_POST[type]=='comment')
{
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
	
	$text = substr($myrow[text],0,90)."...";
	$text = "
	<span>От <b>$myrow[name]</b> (<i>$myrow[mail]</i>)</span><br>
	<span style='font-size:11px'>$text</span><br>
	<span>Дата <b>$myrow[date]</b></span><br>
	<a href='?page=comment' style='color:#6eafe5'>смотреть все</a>";		
	
	 echo iconv("windows-1251", "$enkod_to", " 
			<td style='font-size:14px; text-align:left'>Комментарии</td>
			<td>$num_rows_now</td>
			<td>$num_rows_enabl</td>
			<td>$num_rows</td>
			<td style='font-size:11px; line-height:14px; text-align:left; width:300px'>$text</td>");
}


if ($_POST[type]=='vopros_otvet')
{
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
	
	$result = mysql_query("SELECT * FROM vopros_otvet ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	
	$text = substr($myrow[text],0,90)."...";
	$text = "
	<span>От <b>$myrow[name]</b> (<i>$myrow[mail]</i>)</span><br>
	<span style='font-size:11px'>$text</span><br>
	<span>Дата <b>$myrow[date]</b></span><br>
	<a href='?page=vopros_otvet' style='color:#6eafe5'>смотреть все</a>";

	 echo iconv("windows-1251", "$enkod_to", " 
			<td style='font-size:14px; text-align:left'>Вопрос-ответ</td>
			<td>$num_rows_now</td>
			<td>$num_rows_enabl</td>
			<td>$num_rows</td>
			<td style='font-size:11px; line-height:14px; text-align:left; width:300px'>$text</td>");
}



if ($_POST[type]=='otziv')
{
	$result = mysql_query("SELECT * FROM otziv");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$date = date("d.m.Y");
	
	$result = mysql_query("SELECT * FROM otziv WHERE date LIKE '%$date%'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_now = mysql_num_rows($result);
	if ($num_rows_now!=0) {$num_rows_now="<a href='?page=otziv' style='color:red'>$num_rows_now</a>";}
	
	$result = mysql_query("SELECT * FROM otziv WHERE enabled='1'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows_enabl = mysql_num_rows($result);


	$result = mysql_query("SELECT * FROM otziv ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	
	$text = substr($myrow[text],0,90)."...";
	$text =  "
	<span>От <b>$myrow[name]</b> (<i>$myrow[mail]</i>)</span><br>
	<span style='font-size:11px'>$text</span><br>
	<span>Дата <b>$myrow[date]</b></span><br>
	<a href='?page=otziv' style='color:#6eafe5'>смотреть все</a>";
	
	 echo iconv("windows-1251", "$enkod_to", " 
			<td style='font-size:14px; text-align:left'>Отзыв</td>
			<td>$num_rows_now</td>
			<td>$num_rows_enabl</td>
			<td>$num_rows</td>
			<td style='font-size:11px; line-height:14px; text-align:left; width:300px'>$text</td>");
}




?>