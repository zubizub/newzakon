<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

	if (isset($_POST[del_img]) && $_POST[del_img]==1)
	{
		$num = f_data ($_POST[num], 'text', 0);
		$file = iconv("utf-8", "windows-1251", $num);
		unlink ("upload/img/".$file);
		unlink ("upload/img/mini_".$file);
		//��������������
		$result_edit = mysql_query("UPDATE folder_materials SET img='' WHERE img='$file'", $db);		
	}
	elseif (isset($_POST[del_img]) && $_POST[del_img]==2)
	{
		$num = f_data ($_POST[num], 'text', 0);
		$file = iconv("utf-8", "windows-1251", $num);
		unlink ("upload/img/".$file);
		unlink ("upload/img/mini_".$file);
		//��������������
		$result_edit = mysql_query("UPDATE pages SET img='' WHERE img='$file'", $db);		
	}
	else
	{
		$file = iconv("utf-8", "windows-1251", $_POST[file_url]);
		unlink ($file);
	}

?>