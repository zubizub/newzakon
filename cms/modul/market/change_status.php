<?php

include("../../blocks/db.php");

$id = $_POST['id'];
$status = $_POST['moderation'];
$query = "UPDATE market SET moderation='$status' WHERE id='$id';";

print_r($query);

$query = mysql_query($query);
if (!$query){
die('updating error'. mysql_error());
}


Header("location:/cms/?page=market_moderation");
exit;


?>