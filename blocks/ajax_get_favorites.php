<?php


//получает информацию о количестве товаров в избранном

include("db.php");
include("f_data.php");

$date = date("d.m.Y H:i");

if (isset($_COOKIE[uid])) {$uid=$_COOKIE[uid]; $guest=0;} 
else 
{
	$uid = $_COOKIE[uid_cart];
	$guest=1;
}

$result = mysql_query("SELECT * FROM favorites WHERE uid='$uid'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

echo $num_rows;


?>