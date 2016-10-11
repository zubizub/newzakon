<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

	if (isset($_POST[del_img]))
	{
		$num = f_data ($_POST[num], 'text', 0);
		$file = iconv("utf-8", "windows-1251", $num);
		unlink ("../../".$file);		
	}
	else
	{
		$file_url = f_data ($_POST[file_url], 'text', 0);
		$file = iconv("utf-8", "windows-1251", $file_url);
		unlink ("../../".$file);
	}

?>