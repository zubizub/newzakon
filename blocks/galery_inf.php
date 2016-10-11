<? 

// вывод фотографий определенного альбома

?>

<a href="/galery/" class="back" rel="nofollow">< назад к альбомам</a>
<br><br>

<?
$id = f_data($_GET[id],'text',0);
//запрос к базе
$result = mysql_query("SELECT * FROM galery_cat WHERE id=$id");
$myrow = mysql_fetch_assoc($result); 
$text = "<div style='font-size:12px'>".$myrow[text]."</div>";
$id=$myrow[id];

if ($myrow[form_position]=='up') {show_gen_form($myrow[form]);}

?>



<?
$pages = f_data($_GET[pages],'text',0);
if (isset($_GET[pages])) {$pages=ceil(($pages-1)*28);} else {$pages=0;}

//запрос к базе
$result = mysql_query("SELECT * FROM galery_img WHERE cat='$id' ORDER BY id DESC LIMIT $pages,28");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{	
	do
	{
		echo "<div class='galery_block_img'>
		<a href='/cms/modul/galery/upload/img/$myrow[url]' rel='example_group' class='popup fancybox' title='$myrow[description]'><img src='/cms/modul/galery/upload/img/mini_$myrow[url]' height='130' style='max-width:190px' alt='$myrow[description]' title='$myrow[description]'></a>
		</div>";
	}while($myrow = mysql_fetch_assoc($result));
}

?>
<br><br>
<div>
<?
	$result = mysql_query("SELECT * FROM galery_img WHERE cat='$id'");
	
	if (mysql_num_rows($result)>28)
	{
		$num_rows = mysql_num_rows($result);
		include("blocks/number_pages.php");
		pages_number($num_rows,"/galery/$id/",28);
	}
?>
</div>
<br>
<div align="right">
<? echo "Всего изображений <b>$num_rows</b>"; ?>
</div>
<br>


<?

if (!isset($_GET[pages]))
{
   echo $text; 
}

?>

<br><br>

<?
$result = mysql_query("SELECT * FROM galery_cat WHERE id=$id");
$myrow = mysql_fetch_assoc($result); 
$id=$myrow[id];

if ($myrow[form_position]=='down') {show_gen_form($myrow[form]);}

?>

<br><br>

<?

$folder_img = "cms/modul/galery/upload/files/$id/";
@$dir    = "cms/modul/galery/upload/files/$id/";
$files_img = @scandir($dir);    
$j=0;
$ok=0;

for ($i=0;$i<=30;$i++)
{
	if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
	{
		if ($ok==0) {echo "<b>Файлы для загрузки</b><br>";}
		echo "<div>
		<a href='/cms/modul/galery/upload/files/$id/$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>$files_img[$i]</a></div>";	
		$ok=1;	
	}
} 

?>  

<br><br>
