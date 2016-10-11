<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$num = f_data ($_POST[num], 'text', 0);
$id = f_data ($_POST[id], 'text', 0);

if ($_POST[type]=='goods')
{
	set_logs("Каталог","Изменение статуса товара");
//редактирование
$result_edit = mysql_query("UPDATE goods SET enabled='$num' WHERE id='$id'", $db);
echo "$num";		
}
else
{
	set_logs("Каталог","Изменение статуса папки");
//редактирование
$result_edit = mysql_query("UPDATE katalog SET enabled='$num' WHERE id='$id'", $db);
echo "$num";	
}

?>