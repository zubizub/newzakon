<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$id = f_data ($_POST[id], 'text', 0);
$del = mysql_query ("DELETE FROM pereadresat WHERE id='$id'",$db);

?>