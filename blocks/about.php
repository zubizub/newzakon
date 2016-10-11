<?

//информация о компании

$result = mysql_query("SELECT * FROM pages WHERE id='2'");
$myrow = mysql_fetch_assoc($result); 

if ($myrow[form_position]=='up') {show_gen_form($myrow[form]);}

echo $myrow[text]."<Br><Br>";

if ($myrow[form_position]=='down') {show_gen_form($myrow[form]);}
?>

<br><br>


<?

$folder_img = "cms/modul/materials/upload/files/2/";
@$dir    = "cms/modul/materials/upload/files/2/";
@$files_img = scandir($dir);    
$j=0;
$ok=0;

for ($i=0;$i<=30;$i++)
{
	if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
	{
		if ($ok==0) {echo "<b>Файлы для загрузки</b><br>";}
		echo "<div>
		<a href='/cms/modul/news/upload/files/$_GET[id]/$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>$files_img[$i]</a></div>";	
		$ok=1;	
	}
} 

?>  

<br><br>
