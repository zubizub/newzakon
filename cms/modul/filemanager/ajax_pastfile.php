<?
$copy_to = iconv("utf-8", "windows-1251",$_POST[copy_to]);
$name_file = explode('/',$_COOKIE[copy_file]);
$name_file = $name_file[count($name_file)-1];
@copy($_SERVER[DOCUMENT_ROOT]."/".$_COOKIE[copy_file],$copy_to.$name_file);

?>