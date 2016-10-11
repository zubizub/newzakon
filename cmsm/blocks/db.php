<?php 
include("../cms/settings.php");

if ($host_db=='') {@include("../cms/settings.php");}
if ($host_db=='') {@include("../../cms/settings.php");}
if ($host_db=='') {@include("../../../cms/settings.php");}
$db = mysql_connect($host_db,$login_db,$pass_db);
mysql_select_db($db_name,$db);
mysql_query ("SET NAMES CP1251");
?>