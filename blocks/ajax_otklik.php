<?

//обработчик заказа обратного звонка

include("db.php");
include("f_data.php");
include("mailto.php");

$id = f_data ($_POST[id], 'text', 0);
$uid = f_data ($_COOKIE[uid], 'text', 0);
$date = date("H:m d.m.Y");


if ($id != false && $uid!='')
{
    $result_edit = mysql_query("UPDATE zadaniy SET ispolnitel='$uid', inwork='1', otklik=otklik+1 WHERE id='$id'", $db);
}

?>