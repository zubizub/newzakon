<?php

$now_url = $_SERVER['REQUEST_URI'];
$result = mysql_query("SELECT * FROM url WHERE url='$now_url'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	$description_type = $myrow[type];
    $include_type = $myrow[type];
}



?>