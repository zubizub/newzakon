<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

if ($_POST[type]==1)
{
	$fp = fopen($_SERVER[DOCUMENT_ROOT]."/".$_POST[url], "r"); // ��������� ���� � ������ ������
	if ($fp) 
	{
		while (!feof($fp))
	{
	$mytext = fgets($fp, 999);
	echo $mytext;
	}
	}
	else echo "������ ��� �������� �����";
	fclose($fp);
}

if ($_POST[type]==2)
{
	$fp = fopen($_SERVER[DOCUMENT_ROOT]."/".$_POST[url], "w"); // ��������� ���� � ������ ������ 
 	$mytext = iconv("utf-8", "windows-1251", $_POST[text_file]); // �������� ������
 	$test = fwrite($fp, $mytext); // ������ � ����
}
?>