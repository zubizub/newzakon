<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

$search = f_data ($_POST[str_name_kat], 'text', 0);
$search = iconv('utf-8','windows-1251',$search);
$result = mysql_query("SELECT * FROM katalog WHERE name LIKE '%$search%' ORDER BY name DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		echo "<a href='#' class='popup name_cat_search' num='$myrow[id]'>$myrow[name]</a>";
	}while($myrow = mysql_fetch_assoc($result));
}
?>