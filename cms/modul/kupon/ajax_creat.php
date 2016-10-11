<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

//запрос к базе, получаем предыдущий объект
$result = mysql_query("SELECT * FROM kupon");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if (mysql_num_rows($result)!=0)
{
	set_logs("Купоны","Создание CSV файла купонов");
	$fp = fopen('upload/file.csv', 'w');
	$fields = array("Купон", "Фирма", "Дата окончания", "Активность");
	fputcsv($fp, $fields, ';');
	
	do
	{
		if ($myrow[enabled]==1) {$enabled = "Активен";} else {$enabled = "Не активен";}
		$fields = array($myrow[name], $myrow[firm], $myrow[date_end], $enabled);
		fputcsv($fp, $fields, ';');
	}while($myrow = mysql_fetch_assoc($result));

	fclose($fp);
}

?>