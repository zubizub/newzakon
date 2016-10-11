<?

// вывод альбомов галереи

?>

<br>
<?
//запрос к базе
$result = mysql_query("SELECT * FROM galery_cat ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{	
	do
	{
		if ($myrow[img]!='' && file_exists("cms/modul/galery/upload/cat/$myrow[img]")) 
		{$img="/cms/modul/galery/upload/cat/mini_$myrow[img]";} else {$img = "/img/no_img2.png";}
		
		echo "<div class='galery_block'>
		<a href='/galery/$myrow[id]/'><img src='$img' height='130' style='max-width:190px'></a>
		<a href='/galery/$myrow[id]/' class='cat_galery'>
		$myrow[name]
		</a>
		</div>";
	}while($myrow = mysql_fetch_assoc($result));
}

?>