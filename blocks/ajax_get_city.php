<?

//получение информации о количестве товаров в корзине

include("db.php");
include("f_data.php");

$city = f_data ($_POST[city], 'text', 0);

$result = mysql_query("SELECT * FROM city WHERE name LIKE '%$city%' LIMIT 5");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
echo "<a href='#' num='любой' class='popup'>любой</a>";

if ($num_rows!=0)
{
	do
	{
		echo "<a href='#' num='$myrow[name]' num2='$myrow[id]' class='popup'>$myrow[name]</a>";
	}while($myrow = mysql_fetch_assoc($result));
}

?>