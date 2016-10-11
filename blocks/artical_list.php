<?

// $url_razdel - раздел статей
if ($limit_art=='') {$limit_art=100;}

$result = mysql_query("SELECT * FROM pages WHERE url='$url_razdel' ORDER BY name ASC LIMIT $limit_art");
@$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	$myrow = mysql_fetch_assoc($result); 
	
	do
	{
		echo "<a href='/$myrow[m_link]/' class='title_artical'>$myrow[name]</a>";
	}while($myrow = mysql_fetch_assoc($result));
}


?>