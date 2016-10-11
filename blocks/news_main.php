<?

//новости на главной странице, в зависимости от переменной $news_main новсоти показываются либо в левой части эрана, либо посередине

$result = mysql_query("SELECT * FROM news ORDER BY number DESC LIMIT 3");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($news_main == "left")
{ 
	if ($num_rows!=0)
	{
		do
		{		
			$text = mb_substr($myrow[text],0,110,"utf-8")."...";
			$date = explode(" ", $myrow[date]);
			$date = $date[1];
			//$date = mb_substr($date,0,5, "utf-8").date_str(substr($date,6,10));
			$m_link = explode("/",$myrow[m_link]);
			$m_link = $m_link[(count($m_link)-1)];
			
			if ($myrow[img]!='')
			{
				$img = "<img src='/cms/modul/news/upload/img/$myrow[img]' alt='$myrow[name]' />";
			}
			else
			{
				$img = "";
			}
					
			echo "
			<div class='news_main'>
				$img
				<a href='/news_inf/$myrow[id]/$m_link/' style='color:#333'>$myrow[name]</a>
				<div>$text</div>
				<p>$date</p>
			</div>";	
		}while($myrow = mysql_fetch_assoc($result));	
	}
}
else
{
	if ($num_rows!=0)
	{
		echo '<div style="border-bottom:1px solid #d8dadb; margin-top:13px; margin-bottom:13px"></div>';
		
		do
		{		
			$text = mb_substr(strip_tags($myrow[text]),0,210, "utf-8")."...";
			$date = explode(" ", $myrow[date]);
			$date = $date[1];
			//$date = mb_substr($date,0,5, "utf-8").date_str(substr($date,6,10));
			$m_link = explode("/",$myrow[m_link]);
			$m_link = $m_link[(count($m_link)-1)];		
						
			echo "
			<div class='news_main'>
				<a href='/news_inf/$myrow[id]/$m_link/' style='color:#333'>$myrow[name]</a>
				<div>$text</div>
				<p>$date</p>
			</div>";	
		}while($myrow = mysql_fetch_assoc($result));	
	}	
}
?>