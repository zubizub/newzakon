<?php

include("blocks/db.php");
include("blocks/f_data.php");

$file = f_data ($_GET[file], 'text', 0);

if ($file!='')
{

    $result_d = mysql_query("SELECT * FROM doc WHERE secretcod='$file' ORDER BY name ASC");
    $myrow_d = mysql_fetch_assoc($result_d); 
    $num_rows_d = mysql_num_rows($result_d);

    if ($num_rows_d!=0 && $myrow_d[price]==0)
    {
        $filename="$myrow_d[file]";
        $ext = substr($filename, 1 + strrpos($filename, "."));
        $filename0="$myrow_d[name].$ext";
    }


    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$filename0\"");
    readfile("http://$_SERVER[HTTP_HOST]/doc/$filename");
    
}
else
{
    echo "Файл не найден";
}
?>