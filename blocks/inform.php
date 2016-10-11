<? 

include("f_data.php");
$url = f_data($_GET[url],'text',0);

$result = mysql_query("SELECT * FROM pages WHERE url='$url' ORDER BY number ASC");


@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{
	//запрос к базе
	$myrow = mysql_fetch_assoc($result); 
	
	do
	{
		if ($myrow[url]!="") {$url=$myrow[url]."";} else {$url="";}
		
		$m_link = explode("/",$myrow[m_link]);
		$m_link = $m_link[(count($m_link)-1)];	
		$url = "<a href='/pages/$myrow[id]/$m_link/' style='color:#0193d4'>$myrow[name]</a>";
		
		$text = strip_tags($myrow[text]);
		$text = "<div style='font-size:12px; color:#7d7d7d; margin-top:3px;'>".substr($text,0,200)."... <a href='/pages/$myrow[id]/$m_link/' class='read_next'>читать полностью</a></div>";
							
		echo "<div class='inform_div'>
					$url $text
					<div style='text-align:right; color:#7d7d7d; font-size:10px'>$myrow[date]</div>		  
			  </div>";
	}while($myrow = mysql_fetch_assoc($result));
}


?>


