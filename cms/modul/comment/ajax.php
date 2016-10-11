<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$num = f_data ($_POST[num], 'text', 0);
$id = f_data ($_POST[id], 'text', 0);

//редактирование
$result_edit = mysql_query("UPDATE comment SET enabled='$num' WHERE id='$id'", $db);
set_logs("Комментарии","Изменение статуса");
echo "$num";

?>