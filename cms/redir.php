<?php

ob_start();
include("blocks/f_data.php");

$url = f_data($_GET[url], 'text', 0);
//$url = urldecode($url);
//echo "���������� 1 ".$url."<Br>";

$url = str_replace("&amp;","&",$url);
//echo "���������� 2 "."/cms/$url";
Header("location:/cms/$url");	
exit;
    
ob_flush();	    
?>