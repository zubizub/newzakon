<? 

// информационная страница


//запрос к базе
$id = f_data ($_GET[id], 'text', 0);
$page = f_data ($_GET[page], 'text', 0);
$result = mysql_query("SELECT * FROM pages WHERE id='$id' || m_link='$page'");
$myrow = mysql_fetch_assoc($result); 
$id_page = $myrow[id];
$url = $myrow[url];
$name_usl = $myrow[name];


if ($myrow[form_position]=='up') {show_gen_form($myrow[form]);}


//Если страница блога
if ($myrow[url]=="2")
{
	if ($myrow[img]!='') {
			$img_page = "<img src='/cms/modul/materials/upload/img/$myrow[img]' class='box_blog-img'/>";
	} else {$img_page = "";}
	
	echo "<div class='box_blog-date'>Дата: $myrow[date]</div>
	$img_page";
}

echo "<div class='content_page'>".$myrow[text]."</div>";

if ($url==81)
{
    echo "<a href='/new_zadanie/?usluga=$name_usl' class='btnZakazUslugi'>Заказать услугу у специалиста</a>";
}

?>

<br><br>

<div align="right">
<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"></div>
</div>



<? if ($myrow[form_position]=='down') {show_gen_form($myrow[form]);} ?>

<br><br>


<?

	$folder_img = "cms/modul/materials/upload/files/$id_page/";
	@$dir    = "cms/modul/materials/upload/files/$id_page/";
	@$files_img = scandir($dir);    
	$j=0;
	$ok=0;
	
	for ($i=0;$i<=30;$i++)
	{
		if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
		{
			if ($ok==0) {echo "<b>Файлы для загрузки</b><br>";}
			echo "<div>
			<a href='/cms/modul/materials/upload/files/$id_page/$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>$files_img[$i]</a></div>";	
			$ok=1;	
		}
	} 

?>  

<br><br>