<form action="#" method="get" class="frm_search_thema">
            <input type="text" name="search" value="" placeholder="Поиск по услугам">
            <input type="submit" value="поиск">
        </form>

<table class="tbl_file">
        <tbody>

<? if (!empty($_REQUEST['search'])) { ?>

Результат поиска

	<? 
	$searchString = $_REQUEST['search'];
	$query = "SELECT * FROM market WHERE  `usluga` LIKE  '%$searchString%'OR  `opisanie` LIKE  '%$searchString%'";
	$result = mysql_query($query);
	$myrow_r = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);

	if ($num_rows!=0)
	{
		do
		{
			include("blocks/urmarketRow.php");
		}while($myrow_r = mysql_fetch_assoc($result));
	}

	else {

		echo "Ничего не найдено.";
	}

	?>



<? } else { ?>


    
<?

$result = mysql_query("SELECT * FROM market");
$myrow_r = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		include("blocks/urmarketRow.php");
	}while($myrow_r = mysql_fetch_assoc($result));
}


?>

<? } ?>


</tbody>
</table>
