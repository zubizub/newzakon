<?

include("../../blocks/db.php");

//��������������
$result_edit = mysql_query("UPDATE news SET enabled='$_POST[num]' WHERE id='$_POST[id]'", $db);
echo "$_POST[num]";
?>