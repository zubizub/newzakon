<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");


$num = f_data ($_POST[num], 'text', 0);
$id = f_data ($_POST[id], 'text', 0);

$result_edit = mysql_query("UPDATE users SET podtverjdenie='$num' WHERE id='$id'", $db);
echo "$num";
?>