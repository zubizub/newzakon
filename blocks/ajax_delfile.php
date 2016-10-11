<?

//обработчик заказа обратного звонка

include("db.php");
include("f_data.php");
include("mailto.php");

$uid = f_data ($_COOKIE[uid], 'text', 0);

$result = mysql_query("SELECT * FROM users WHERE uid='$uid'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows==0)
{
	exit;
}

//удалить
if (isset($_POST[file]))
{
    $secretcod = f_data ($_POST[file], 'text', 0);
	
	$result = mysql_query("SELECT * FROM doc WHERE secretcod='$secretcod'");
	$myrow = mysql_fetch_assoc($result); 
    @unlink("../doc/".$myrow[file]);
    
	$del = mysql_query ("DELETE FROM doc WHERE id = '$myrow[id]' && uid='$uid'",$db);
	exit;
}

?>