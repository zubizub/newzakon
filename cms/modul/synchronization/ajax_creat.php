<?

include("../../blocks/db.php");

//запрос к базе, получаем предыдущий объект
if ($_POST[export_cat]!=0) {$export_cat=" WHERE url='$_POST[export_cat]' ";} else {$export_cat='';}
$result = mysql_query("SELECT * FROM goods $export_cat ORDER BY url ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$name_cat = "";

if (mysql_num_rows($result)!=0)
{
	
	$fp = fopen('upload/file.csv', 'w');
	$fields = array("Артикул", "Название", "Цена (руб)", "Описание");
	fputcsv($fp, $fields, ';');
	
	do
	{
		if ($name_cat!=$myrow[url]) 
		{
			$name_cat=$myrow[url];
			$name_cat_ar = "";
			
			if (substr_count($name_cat, "/")!=0) {
				$ps = explode("/", $name_cat); 
				
				for ($i=0;$i<count($ps);$i++)
				{
					$result2 = mysql_query("SELECT * FROM katalog WHERE id='$ps[$i]'");
					$myrow2 = mysql_fetch_assoc($result2); 
					$name_cat_ar .=	$myrow2[name]." / ";
				}
				
				$name_cat_ar = substr($name_cat_ar,0,-3);
				//$name_cat_w = array_pop($ps);
			}
			else
			{
				$result2 = mysql_query("SELECT * FROM katalog WHERE id='$name_cat'");
				$myrow2 = mysql_fetch_assoc($result2); 	
				$name_cat_ar .=	$myrow2[name];
			}
			
				
			$fields = array($name_cat_ar);
			fputcsv($fp, $fields, ';');		 
		}
		
		$fields = array($myrow[art], $myrow[name], $myrow[price1], strip_tags($myrow[text]));
		fputcsv($fp, $fields, ';');
	}while($myrow = mysql_fetch_assoc($result));

	fclose($fp);
}

?>