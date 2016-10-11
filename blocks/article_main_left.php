<?

//страницы выводящиеся в левом меню

$id = f_data($_GET[id],'text',0);
$result = mysql_query("SELECT * FROM pages WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 

$url_page = explode("/",$myrow[url]);
$url_page = $url_page[(count($url_page)-1)];	

if (mysql_num_rows($result)!=0)
{		
	if ($myrow[url]!='1' && $myrow[url]!='2' && $myrow[url]!='3')
	{
		echo "<div style='margin-bottom:6px'><b>Смотрите также</b></div>";
		$result = mysql_query("SELECT * FROM pages WHERE url='$url_page'");
		$myrow = mysql_fetch_assoc($result); 
		$num_rows = mysql_num_rows($result);
		
		if ($num_rows!=0)
		{
			do
			{
				$m_link = explode("/",$myrow[m_link]);
				$m_link = $m_link[(count($m_link)-1)];		
				if (strlen($myrow[name])>23) {$name_art = substr($myrow[name],0,23)."...";} else {$name_art = $myrow[name];}		
				echo "<a href='/pages/$myrow[id]/$m_link/' class='title_artical_main_left' title='$myrow[name]'>$name_art</a>";
			}while($myrow = mysql_fetch_assoc($result));
		}	
		
		echo "<br><Br>";	
	}
}
?>

