<?
	if (isset($_POST[key]))
	{

		$result_edit = mysql_query("UPDATE settings SET license_key='$_POST[key]'", $db);	
		echo "<script>window.location.href = '?page=license&msg=Новый ключ сохранен!'</script>";
	}	
?>


<form action="" method="post" enctype="multipart/form-data">
Введите ключ: <input name="key" type="text" style="padding:5px; width:340px; background-image:url(img/key.png); background-repeat:no-repeat; background-position:right" value="<? echo $SETTINGS[license_key]; ?>">
<input name="button" type="submit" value="сохранить" class="button_save">    
</form>  

<br><br>
Ключ уникальный и будет работать только на домене на котором зарегистрирован сайт. При переносе сайта на другой домен необходимо связаться с разработчиками. 