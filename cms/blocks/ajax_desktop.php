<?

$type = $_POST[type];

include("db.php");


$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

$num = $myrow["desc_".$type];
if ($num==1) {$num=0;} else {$num=1;}

$result_edit = mysql_query("UPDATE settings SET desc_$type='$num'", $db);

;
?>