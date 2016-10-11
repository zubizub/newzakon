<?

include("db.php");
include("f_data.php");

$licens =  f_data($_POST['licens'],'text',0);


$result_edit = mysql_query("UPDATE settings SET license_key='$licens'", $db);	

Header("location:../");	
exit;

?>