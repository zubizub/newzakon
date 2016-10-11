<?php 

// подключение к базе
$ROOT_DIR = __DIR__;
@include("$ROOT_DIR/../cms/settings.php");
if ($host_db=='') {@include("$ROOT_DIR/cms/settings.php");} 
$db = mysql_connect($host_db,$login_db,$pass_db);
mysql_select_db($db_name,$db);
//mysql_query ("SET NAMES CP1251");
mysql_query("set names utf8");

?>