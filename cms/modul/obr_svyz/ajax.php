<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

set_logs("�������� �����","������� ������� ��������� �������� �����");

$num = f_data ($_POST[num], 'text', 0);
$id = f_data ($_POST[id], 'text', 0);

//��������������
$result_edit = mysql_query("UPDATE obr_svyz SET enabled='$num' WHERE id='$id'", $db);
echo "$num";

?>