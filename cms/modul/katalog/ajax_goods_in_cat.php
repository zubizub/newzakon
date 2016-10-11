<?php

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$goods_in_cat_katalog = f_data ($_POST[goods_in_cat_katalog], 'text', 0);

$result_edit = mysql_query("UPDATE settings SET goods_in_cat_katalog='$goods_in_cat_katalog'", $db);

?>