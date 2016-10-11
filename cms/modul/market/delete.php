<?php
include("../../blocks/db.php");

$id = $_GET['id'];
$query = "DELETE FROM market WHERE id='$id'";

print_r($query);

//header("Location: http://www.example.com/");

if (mysql_query($query)) {

Header("location:/cms/?page=market_moderation&msg=Удалено");

}
else {

print_r($query);
//Header("location:/cms/?page=market_moderation&msg=Ошибка почему-то!");
}

?>