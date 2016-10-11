<?
include("db.php");
include("f_data.php");
print_r($_POST);
$id = $_POST['marketId'];
$query = "DELETE FROM market WHERE id ='$id'";
//print_r($query);
mysql_query($query);
Header("location:/cabinet/?msg=Услуга удалена!&num=10");

exit;



?>