<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$id = f_data ($_POST[id], 'text', 0);
if ($_POST[ch]==1) $ch=0; else $ch=1;

$result_edit = mysql_query("UPDATE moduls SET enabled='$ch' WHERE id='$id'", $db);

?>