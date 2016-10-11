<? 

// вывод новости

?>

<a href="/news/" class="back" rel="nofollow">< назад</a>

<?
//запрос к базе
$id = f_data ($_GET[id], 'text', 0);
$result = mysql_query("SELECT * FROM news WHERE id=$id");
$myrow = mysql_fetch_assoc($result); 

if ($myrow[form_position]=='up') {show_gen_form($myrow[form]);}


echo $myrow[text]."<br><div style='text-align:right; font-size:12px'>$myrow[date]</div>";

?>

<br><br>

<?
if ($myrow[form_position]=='down') {show_gen_form($myrow[form]);}

?>

<br><br>

<?
		$id = f_data ($_GET[id], 'text', 0);
		$folder_img = "cms/modul/news/upload/files/$id/";
		@$dir    = "cms/modul/news/upload/files/$id/";
		@$files_img = scandir($dir);    
		$j=0;
		$ok=0;
		
		for ($i=0;$i<=30;$i++)
		{
			if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
			{
				if ($ok==0) {echo "<b>Файлы для загрузки</b><br>";}
				echo "<div>
				<a href='/cms/modul/news/upload/files/$id/$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>$files_img[$i]</a></div>";	
				$ok=1;	
			}
		} 

?>  

<br><br>