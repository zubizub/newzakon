<?
// страница контактов
?>


<a href="/print_contact.php" style="display:block; position:absolute; top:34px; right:2px" target="_blank" rel="nofollow">
<img src="/img/print.png" width="27" height="22" border="0">
</a>
<?

//запрос к базе
$result = mysql_query("SELECT * FROM pages WHERE id=3");
$myrow = mysql_fetch_assoc($result); 

if ($myrow[form_position]=='up') {show_gen_form($myrow[form]);}

echo $myrow[text];

if ($myrow[form_position]=='down') {show_gen_form($myrow[form]);}


$folder_img = "cms/modul/materials/upload/files/3/";
@$dir    = "cms/modul/materials/upload/files/3/";
@$files_img = scandir($dir);    
$j=0;
$ok=0;

for ($i=0;$i<=30;$i++)
{
	if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
	{
		if ($ok==0) {echo "<br><br><b>Файлы для загрузки</b><br>";}
		echo "<div>
		<a href='/cms/modul/news/upload/files/3/$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>$files_img[$i]</a></div>";	
		$ok=1;	
	}
} 

?>  

<br>
<?  include("blocks/maps.php"); ?>

<br><br>

<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="link" 
        data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div> 
        
        
<Br><br>

 
