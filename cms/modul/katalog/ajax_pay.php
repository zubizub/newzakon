<?php

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$id = f_data ($_POST[id], 'text', 0);
$type_pay = f_data ($_POST[type_pay], 'text', 0);;
$result_edit = mysql_query("UPDATE zakaz SET oplata='$type_pay' WHERE id='$id'", $db);


?>