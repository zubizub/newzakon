<?
 include("../../blocks/db.php");
 include("../../blocks/logs.php");
 set_logs("Настройки","Создание карты сайта","sitemap.xml");
 $i=5;
 $fp = fopen("../../../sitemap.xml", "w"); // Открываем файл в режиме записи 

$mytext = '<?xml version="1.0" encoding="UTF-8" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/about/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/contacts/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/katalog/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/galery/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>	
	'; 
	
$result = mysql_query("SELECT * FROM pages WHERE url!='1' && enabled=1");
@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{	
	$myrow = mysql_fetch_assoc($result); 	 
	
	do
	{
		$i++;
		$m_link = explode("/",$myrow[m_link]);
		$m_link = $m_link[(count($m_link)-1)];			
$mytext.= '
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/pages/'.$myrow[id].'/'.$m_link.'/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>'; 		
	}while($myrow = mysql_fetch_assoc($result));
}


$result = mysql_query("SELECT * FROM news WHERE enabled='1'");
@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{	
	$myrow = mysql_fetch_assoc($result); 	 
	
	do
	{
		$i++;
		$m_link = explode("/",$myrow[m_link]);
		$m_link = $m_link[(count($m_link)-1)];			
$mytext.= '
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/news_inf/'.$myrow[id].'/'.$m_link.'/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>'; 		
	}while($myrow = mysql_fetch_assoc($result));
}


$result = mysql_query("SELECT * FROM galery_cat WHERE enabled='1'");
@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{	
	$myrow = mysql_fetch_assoc($result); 	 
	
	do
	{
	$i++;		
$mytext.= '
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/galery/'.$myrow[id].'/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>'; 		
	}while($myrow = mysql_fetch_assoc($result));
}


$result = mysql_query("SELECT * FROM katalog WHERE enabled='1'");
@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{	
	$myrow = mysql_fetch_assoc($result); 	 
	
	do
	{
	$i++;		
	if ($myrow[url]=='') {$url_cat="$myrow[id]";}	
	else
	{
		$url_cat = str_replace("/", "-", $myrow[url]);
		$url_cat.="-$myrow[id]";
	}
	
$mytext.= '
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/katalog/'.$url_cat.'/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>'; 	
	}while($myrow = mysql_fetch_assoc($result));
}	


$result = mysql_query("SELECT * FROM goods WHERE enabled='1'");
@$num_rows = mysql_num_rows($result);
if ($num_rows!=0)
{	
	$myrow = mysql_fetch_assoc($result); 	 
	
	do
	{
	$i++;	
		$m_link = explode("/",$myrow[m_link]);
		$m_link = $m_link[(count($m_link)-1)];		
$mytext.= '
	<url>
		<loc>http://'.$_SERVER[HTTP_HOST].'/goods/'.$myrow[id].'/'.$m_link.'/</loc>
		<lastmod>'.date("Y-m-d").'</lastmod>
	</url>'; 		
	}while($myrow = mysql_fetch_assoc($result));
}
	
	 $mytext .= "
</urlset>";
	 $test = fwrite($fp, $mytext); // Запись в файл
 fclose($fp); //Закрытие файла		
	echo $i;
?>