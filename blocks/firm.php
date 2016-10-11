<?

// производитель товара

?>

<a href="<? echo $_SERVER[HTTP_REFERER]; ?>" class="back" rel="nofollow">< назад</a><br><br>

<?
$id = f_data($_GET[id],'text',0);
$result = mysql_query("SELECT * FROM firms WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	if ($myrow['img']=="")
	{
		$img = "/img/no_img2.png";
	}
	else
	{
		$img = "/cms/modul/katalog/upload/img/img_proizvoditel/".$myrow['img'];
	}	
	
	
	echo "<img src='$img' height='160' align='left' style='margin-right:10px; margin-bottom:10px'>
	<b>$myrow[name]</b><br><br>
	$myrow[description]";
}


?>