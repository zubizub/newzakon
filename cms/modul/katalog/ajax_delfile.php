<?
	include("../../blocks/db.php");
	include("../../blocks/chek_user.php");
	include("../../blocks/f_data.php");
	include("../../blocks/logs.php");
	
	if (isset($_POST[del_img]))
	{
		$num = f_data ($_POST[num], 'text', 0);
		$file = iconv("utf-8", "windows-1251", $num);
		@unlink ("upload/img/".$file);
		@unlink ("upload/img/mini_".$file);
		//редактирование
		$result_edit = mysql_query("UPDATE folder_materials SET img='' WHERE img='$file'", $db);		
	}
	else
	{
		$file = iconv("utf-8", "windows-1251", $_POST[file_url]);
		$file2 = iconv("utf-8", "windows-1251", $_POST[file_url2]);
		
		@unlink ($file);
		if ($file2!='') {@unlink ($file2);}
	}

?>