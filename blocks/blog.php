<?
// блог
?>


<br>

<? 

$result = mysql_query("SELECT * FROM pages WHERE url='2' ORDER BY id DESC");
@$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	$myrow = mysql_fetch_assoc($result); 
	
	do
	{
		$m_link = explode("/",$myrow[m_link]);
		$m_link = $m_link[(count($m_link)-1)];	

		$url_page = explode("/",$myrow[url]);
		$url_page = $url_page[(count($url_page)-1)];
		$url = "<a href='/$myrow[m_link]/' class='box_blog-title'>$myrow[name]</a>";
		
		if ($myrow[img]!='') {
			$img_page = "<a href='/$myrow[m_link]/' class='blogImg'><img src='/cms/modul/materials/upload/img/$myrow[img]' /></a>";
		} else {$img_page = "";}
		
		
		$text = $myrow[text];
		if (strlen($text)>450)
		{
			$text = substr(strip_tags($myrow[text]),0,450);
			$text_replace = explode(" ",$text);
			$text_replace = $text_replace[count($text_replace)-1];

			$text = str_replace($text_replace,"",$text);
			$text = $text."...";
		}
		
							
		echo "<div class='box_blog'>
			$url
			<div class='box_blog-date'>Дата: $myrow[date]</div>
			$img_page
			<div class='box_blog-text'>$text</div>
			<div align='right'><a href='/$myrow[m_link]/' rel='nofollow' class='box_blog-read_more'>Читать подробнее</a></div>
		</div>";
	}while($myrow = mysql_fetch_assoc($result));
}


?>

