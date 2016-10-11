<?php
$ROOT_DIR = __DIR__;
session_start();
//echo $ROOT_DIR;
include("$ROOT_DIR/db.php");
include("$ROOT_DIR/f_data.php");
include("$ROOT_DIR/../../class/Session.php");
include("$ROOT_DIR/resizeimg.php");
include("$ROOT_DIR/chek_user.php");
include("$ROOT_DIR/logs.php");
?>