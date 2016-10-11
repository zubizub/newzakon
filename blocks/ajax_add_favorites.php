<?php

//ajax_add_favorites. Добавление товара в избранное

include("db.php");
include("f_data.php");

$urist = f_data ($_POST[urist], 'text', 0);
$uid = f_data ($_COOKIE[uid], 'text', 0);
$type = f_data ($_POST[typeD], 'text', 0);
$date = date("d.m.Y H:i");


if ($type==0)
{
	$del = mysql_query ("DELETE FROM favorites WHERE uid='$uid' && urist='$urist' ",$db);
	exit;
}
else
{

    $result = mysql_query("SELECT * FROM favorites WHERE uid='$uid' && urist='$urist'");
    $myrow = mysql_fetch_assoc($result); 
    $num_rows = mysql_num_rows($result);

    if ($num_rows==0)
    {
    	$result_add = mysql_query ("INSERT INTO favorites (urist,uid,date) VALUES ('$urist','$uid','$date')");
    }
    exit;
}

?>