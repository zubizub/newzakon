<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$num = f_data ($_POST[num], 'text', 0);
$id = f_data ($_POST[id], 'text', 0);

set_logs("Вопрос-ответ","Измение статуса сообщения");
$result_edit = mysql_query("UPDATE vopros_otvet SET enabled='$num' WHERE id='$id'", $db);
echo "$num";

?>