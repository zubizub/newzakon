<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

if ($_POST[type]==1)
{
	$fp = fopen($_SERVER[DOCUMENT_ROOT]."/".$_POST[url], "r"); // Открываем файл в режиме чтения
	if ($fp) 
	{
		while (!feof($fp))
	{
	$mytext = fgets($fp, 999);
	echo $mytext;
	}
	}
	else echo "Ошибка при открытии файла";
	fclose($fp);
}

if ($_POST[type]==2)
{
	$fp = fopen($_SERVER[DOCUMENT_ROOT]."/".$_POST[url], "w"); // Открываем файл в режиме записи 
 	$mytext = iconv("utf-8", "windows-1251", $_POST[text_file]); // Исходная строка
 	$test = fwrite($fp, $mytext); // Запись в файл
}
?>