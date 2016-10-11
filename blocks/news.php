<?
	
// вывод всех новостей

if (isset($_GET[search]))
{
	$search = trim($_GET[search]);
	$sql_search = "WHERE name LIKE '%$search%' || text LIKE '%$search%'";	
	echo "<a href='?page=news' style='color:#60a6ee'>Вернуться к новостям</a> | Вы искали: <b>$search</b><br><br>";
}
else
{
	$sql_search = "";
}


//запрос к базе
$result = mysql_query("SELECT * FROM news $sql_search ORDER BY number ASC LIMIT 100");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{		
		//кто из пользователей добавил
		@$result1 = mysql_query("SELECT * FROM users WHERE uid='$myrow[user]'");
		@$myrow1 = mysql_fetch_assoc($result1); 
		@$num_rows1 = mysql_num_rows($result1);
		if ($num_rows1==0) {$user = "Администратор";} else {$user = $myrow1[fio];}
		
		if ($i>$SETTINGS[num_rows]) {$display="style='display:none' class='fide_rows'";} else {$display="";}
		$m_link = explode("/",$myrow[m_link]);
		$m_link = $m_link[(count($m_link)-1)];	
		
		if (strlen(strip_tags($myrow[text]))>250) 
		{$text = mb_substr(strip_tags($myrow[text]),0,250, "utf-8")."<noindex>... <a href='/news_inf/$myrow[id]/$m_link/' style='color:#333; text-decoration:none' rel='nofollow'>>></a></noindex>";} 
		else {$text = strip_tags($myrow[text]);}

		echo "
		<table width='100%' border='0'>
		  <tr>
			<td style='width:120px; padding-right:10px; text-align:center; vertical-align:middle; font-weight:bold; line-height:22px; font-size:16px'>
				$myrow[date]
			</td>
			<td>
				  <div class='div_news'>
				  <a href='/news_inf/$myrow[id]/$m_link/' style='color:#333'>$myrow[name]</a><br>
				  <div class='text_news'>$text</div>
				  </div>  			
			</td>
		  </tr>
		</table>";
			  		
		$i++;
		$j++;		
	}while($myrow = mysql_fetch_assoc($result));

}
else
{
		echo "Новостей нет";	
}

?>

<br>