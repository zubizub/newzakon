<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

//������ � ����, �������� ���������� ������
$result = mysql_query("SELECT * FROM kupon");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if (mysql_num_rows($result)!=0)
{
	set_logs("������","�������� CSV ����� �������");
	$fp = fopen('upload/file.csv', 'w');
	$fields = array("�����", "�����", "���� ���������", "����������");
	fputcsv($fp, $fields, ';');
	
	do
	{
		if ($myrow[enabled]==1) {$enabled = "�������";} else {$enabled = "�� �������";}
		$fields = array($myrow[name], $myrow[firm], $myrow[date_end], $enabled);
		fputcsv($fp, $fields, ';');
	}while($myrow = mysql_fetch_assoc($result));

	fclose($fp);
}

?>