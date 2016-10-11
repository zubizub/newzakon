<?

	// вывод категорий каталога
	
	if (isset($_GET[url])) 
	{
		$history = $_GET[url];
		$history = f_data($history,'text',0);
		$url = str_replace("-", "/", "$history");
		$url_g = str_replace("-", "/", "$history");
		$where_url = "WHERE enabled='1' && url='$url'";
		if (substr_count($history,"-")>0)
		{
			$history = explode("-",$history);
			
			for ($i=0; $i<count($history); $i++)
			{
				$result = mysql_query("SELECT * FROM katalog WHERE id='$history[$i]'");
				$myrow = mysql_fetch_assoc($result); 	
				if ($myrow[url]!="") {$new_url1 = str_replace("/", "-", "$myrow[url]") ; $back_url = "$new_url1-$myrow[id]";} 
				else {$back_url = "$myrow[id]";}
					
				$new_history .= "<a href='/katalog/$back_url/' rel='nofollow'>$myrow[name]</a> > ";
					
			}
			
			$new_history = substr($new_history,0,-2);
			$history = "<a href='/katalog/'  rel='nofollow' style='margin-left:-6px'>Главная категория</a> > $new_history";		
			$text_katalog = $myrow[text];	
		}
		else
		{
			$result = mysql_query("SELECT * FROM katalog WHERE id='$history'");
			$myrow = mysql_fetch_assoc($result); 
			$history = "<a href='/katalog/' rel='nofollow' style='margin-left:-6px'>Главная категория</a> > $myrow[name]";	
			$text_katalog = $myrow[text];				
		}
	}
	else
	{
		$where_url = "WHERE url='' && enabled='1'";
	}
	

if (!isset($_GET[search])) {	
	
	//echo "<div class='history'>$history</div>";


//запрос к базе
$result = mysql_query("SELECT * FROM katalog $where_url ORDER BY id ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$history = f_data($_GET[url],'text',0);

if ($num_rows!=0)
{
	echo "<br><div class='row'>";
	
	do
	{
		if ($myrow[url]!="") {
			$url = str_replace("/", "-", "$history");
			$url=$url."-$myrow[id]/";
		} 
		else {$url="$myrow[id]/";}
		
		if ($myrow[img]!='') {$img="/cms/modul/katalog/upload/img/$myrow[img]";} else {$img = "/img/no_img2.png";}
		echo "<div class='katalog_block col-lg-3 col-md-3 col-sm-3 col-xs-4'>
		<a href='/katalog/$url' class='img_cat' style='background-image: url($img)'></a>
		<a href='/katalog/$url' class='cat_katalog'>
		$myrow[name]
		</a>
		</div>";
		
	}while($myrow = mysql_fetch_assoc($result));
	
		echo '</div>';
	
	
	if ($SETTINGS[goods_in_cat_katalog]==1)
	{
		$result = mysql_query("SELECT * FROM goods WHERE enabled='1' && (url LIKE '%$url_g%' || url_any LIKE '%,$url_g%') ORDER BY rand() LIMIT 9");
		@$num_rows = mysql_num_rows($result);
		$myrow = mysql_fetch_assoc($result); 
		
		if ($num_rows!=0)
		{
            echo "<br><div class='row'>";
			do
			{
				include("blocks/tovar.php");
			}while($myrow = mysql_fetch_assoc($result));
            echo "</div>";		
		}
	}

}


	if (!isset($_GET[url])) 
	{
		$result = mysql_query("SELECT * FROM pages WHERE id='21'");
		$myrow = mysql_fetch_assoc($result); 	
		echo "<Br><div class='content_page'>".$myrow[text]."</div>";	
	}
}
?>


<br>
<?
if (isset($_GET[url]))
{
//товары
$url_get = f_data($_GET[url],'text',0);
$url = str_replace("-", "/", "$url_get");

$url_get_where = explode("/",$url_get);

$result_cat = mysql_query("SELECT * FROM katalog WHERE id='".$url_get_where[count($url_get_where)-1]."' ORDER BY id ASC");
$myrow_cat = mysql_fetch_assoc($result_cat); 
$name_cat = $myrow_cat[name];

$pages = f_data($_GET[pages],'text',0);
if (!isset($_GET[pages])) {$pages=0;} else {$pages=($pages-1)*27;}
if (!isset($_GET[sort])) {$sort = "number ASC";}
else
{
	if ($_GET[sort]=='down_price')  {$sort = "price1 DESC";}
	if ($_GET[sort]=='up_price')  {$sort = "price1 ASC";}
	if ($_GET[sort]=='down_name')  {$sort = "name DESC";}
	if ($_GET[sort]=='up_name')  {$sort = "name ASC";}
}

$result = mysql_query("SELECT * FROM goods WHERE enabled='1' && (url='$url' || url_any LIKE '%,$url_g%') ORDER BY $sort LIMIT $pages, 27");
@$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	$url = f_data ($_GET[url], 'text', 0);
	
	if (!isset($_GET[sort]))
	{
		$sort_price = "<a href='/katalog/$url/?sort=up_price' style='color:#333; font-size:12px' rel='nofollow'>цена (дешевле)</a>"; 
		$sort_name = "<a href='/katalog/$url/?sort=up_name' style='color:#333; font-size:12px' rel='nofollow'>имени (А-Я)</a>";	
	}
	else
	{
		if ($_GET[sort]=='down_price') 
		{
			$sort_price = "<a href='/katalog/$url/?sort=up_price' rel='nofollow'>цена (дешевле)</a>"; 
		}
		else
		{
			$sort_price = "<a href='/katalog/$url/?sort=down_price' rel='nofollow'>цена (дороже)</a>"; 
		}
		
		if ($_GET[sort]=='down_name')
		{
			$sort_name = "<a href='/katalog/$url/?sort=up_name' rel='nofollow'>имени (А-Я)</a>";
		}
		else
		{
			$sort_name = "<a href='/katalog/$url/?sort=down_name'  rel='nofollow'>имени (Я-А)</a>";
		}
	}
	

	echo "
		<div class='div_sort_katalog'>
			Сортировать по: <a href='/katalog/$url/'>без сортировки</a> | $sort_price | $sort_name
		</div>";
        
	echo "<div class='row'>";	

	$myrow = mysql_fetch_assoc($result); 
	
	do
	{
		include("blocks/tovar.php");
	}while($myrow = mysql_fetch_assoc($result));
	
	
	echo "</div><br><Br>";
	

	$result = mysql_query("SELECT * FROM goods WHERE enabled='1' && url='$url' ORDER BY number ASC");

	
	$j=1;
	if (mysql_num_rows($result)>27)
	{
		$sort = f_data ($_GET[sort], 'text', 0);
		if (isset($_GET[sort])) {$sort_url = "?sort=$sort";} else {$sort_url = "";}
		$num_rows = mysql_num_rows($result);
		include("blocks/number_pages.php");
		pages_number($num_rows,"/katalog/$url_get/$sort_url",27);	
	}
	
}
else
{
	//echo "<b>К сожалению товаров в данном разделе еще нет, но они скоро появятся!</b>";	
}

}

?>

<br><br>

<div style="font-size:12px">
<? if ($text_katalog!='' && !isset($_GET[pages])) {echo '<div style="border-bottom:1px solid #CCC; margin-top:16px; margin-bottom:16px;"></div>'.$text_katalog;} ?>
</div>
