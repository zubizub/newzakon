<div class='row boxArtical'>
<? 

//статьи нужного раздела
if (isset($_GET[url]))
{
    $url_w = f_data($_GET[url],'text',0);
    $url_w = "url='$url_w'";
}


if (isset($_GET[page]))
{
    $url_w = f_data($_GET[page],'text',0);
}

$pages = f_data($_GET[pages],'text',0);
$url_w = f_data($_GET[url],'text',0);


if (!isset($_GET[pages])) {$pages=0;} else {$pages=($pages-1)*20;}

$result = mysql_query("SELECT * FROM pages WHERE url='$url_w' && enabled='1' ORDER BY name ASC LIMIT $pages, 20");
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
		$url = "<a href='/$myrow[m_link]/' class='title_artical'>$myrow[name]</a>";
		
		if ($myrow[img]!='') {
			$img_page = "/cms/modul/materials/upload/img/$myrow[img]";
            $img_page = "<a href='/$myrow[m_link]/' class='img_art_list' style='background-image: url($img_page)'></a>";
		} 
        else 
        {
            $img_page = "/img/no_img2.png";
            $img_page = "<a href='/$myrow[m_link]/' class='img_art_list' style='background-image: url($img_page)'></a>";
        }
		
		$text = $myrow[text];
		if (strlen($text)>200)
		{
			$text = mb_substr(strip_tags($myrow[text]),0,200, "utf-8");
			$text_replace = explode(" ",$text);
			$text_replace = $text_replace[count($text_replace)-1];

			$text = str_replace($text_replace,"",$text);
			$text = $text."...";
		}
		
		
        echo "
        
            <div class='col-lg-1 col-md-1 col-sm-2 hidden-xs'>
                <div class='box_img_art_list'>
                    $img_page
                </div>
            </div>
        
            <div class='col-lg-5 col-md-5 col-sm-4 col-xs-12'>
                <div class='text_list_artical'>
                    $url<br><br>
					<span class='text_artical'>$text</span>
                </div>
            </div>
        
        ";
        
	}while($myrow = mysql_fetch_assoc($result));
}


?>

</div>

<?
	$result = mysql_query("SELECT * FROM pages WHERE url='$url_w' ORDER BY id DESC");

	
	$j=1;
	if (mysql_num_rows($result)>20)
	{
		$sort = f_data ($_GET[sort], 'text', 0);
		if (isset($_GET[sort])) {$sort_url = "?sort=$sort";} else {$sort_url = "";}
		$num_rows = mysql_num_rows($result);
		include("blocks/number_pages.php");
		pages_number($num_rows,"/article/$url_w/$sort_url",20);	
	}

?>

