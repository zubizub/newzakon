<?
include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");


$name = f_data ($_POST[name], 'text', 0);
$name = iconv('utf-8','windows-1251', $name);

$text = "<option>Не знаю</option>";

$result_f = mysql_query("SELECT * FROM folder_materials WHERE name='$name' ORDER BY name ASC");
$myrow_f = mysql_fetch_assoc($result_f); 
$num_rows_f = mysql_num_rows($result_f); 
$result_type = mysql_query("SELECT * FROM pages WHERE url='85/$myrow_f[id]' ORDER BY name ASC");
$myrow_type = mysql_fetch_assoc($result_type); 
$num_rows_type = mysql_num_rows($result_type);

if ($num_rows_type!=0)
{
    do
    {
        if ($myrow[type]==$myrow_type[name]) {$sel='selected';} else {$sel='';}
    	$text .= "<option $sel>$myrow_type[name]</option>";
    }while($myrow_type = mysql_fetch_assoc($result_type));
}

 
echo $text;
?>