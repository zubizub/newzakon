<?

	if (isset($_POST[del_img]))
	{
		$file = iconv("utf-8", "windows-1251", $_POST[num]);
		unlink ("upload/img/".$file);
		unlink ("upload/img/mini_".$file);
		include("../../blocks/db.php");
		//редактирование
		$result_edit = mysql_query("UPDATE news SET img='' WHERE img='$file'", $db);		
	}
	else
	{
		$file = iconv("utf-8", "windows-1251", $_POST[file_url]);
		unlink ($file);
	}

?>