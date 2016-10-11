<?

include("../../blocks/db.php");
include("../../blocks/logs.php");

if ($_POST[type]=='pages')
{
//редактирование
set_logs("Страницы","Изменение статуса страницы");
$result_edit = mysql_query("UPDATE pages SET enabled='$_POST[num]' WHERE id='$_POST[id]'", $db);
echo "$_POST[num]";		
}
else
{
//редактирование
set_logs("Страницы","Изменение статуса папки");
$result_edit = mysql_query("UPDATE folder_materials SET enabled='$_POST[num]' WHERE id='$_POST[id]'", $db);
echo "$_POST[num]";	
}

?>