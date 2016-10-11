<?

include("../../blocks/db.php");
include("../../blocks/logs.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");

//запрос к базе, получаем предыдущий объект
$url = f_data ($_POST[url], 'text', 0);
$last_e = f_data ($_POST[last_e], 'text', 0);
$result1 = mysql_query("SELECT * FROM goods WHERE url='$url' && id='$last_e'");
$myrow1 = mysql_fetch_assoc($result1); 
$last_e = $myrow1[number];
if ($last_e=='') {$last_e=0;}


//запрос к базе, получаем следующий объект
$next_e = f_data ($_POST[next_e], 'text', 0);
$result2 = mysql_query("SELECT * FROM goods WHERE url='$url' && id='$next_e'");
$myrow2 = mysql_fetch_assoc($result2);
$next_e = $myrow2[number];
if ($next_e=='') {$next_e=0;}

//запрос к базе, получаем главный объект
$this_e = f_data ($_POST[this_e], 'text', 0);
$result3 = mysql_query("SELECT * FROM goods WHERE url='$url' && id='$this_e'");
$myrow3 = mysql_fetch_assoc($result3);
$this_e = $myrow3[id];

set_logs(" аталог","»зменение пор€дка товара",$myrow3[name]);

//если на строку просто нажали и не перетаскивали
if ($next_e == ($myrow3[number]+1) || $myrow1[number] == ($myrow3[number]-1))
{
	exit;
}


//перетаскивание вниз
if ($myrow3[number]<$next_e)
{
	$url = f_data ($_POST[url], 'text', 0);
	$start = $myrow3[number];
	$end = $myrow1[number]+1;
	$result4 = mysql_query("SELECT * FROM goods WHERE url='$url' && number>'$start' && number<'$end' ORDER BY number ASC");
	$myrow4 = mysql_fetch_assoc($result4); 
	
	do
	{
		if ($myrow4[id]!=$this_e)
		{
			
			$number = ($myrow4[number]-1); 
			//редактирование
			$result_edit = mysql_query("UPDATE goods SET number='$number' WHERE id='$myrow4[id]'", $db);		
		}
	}while($myrow4 = mysql_fetch_assoc($result4));
	
	//редактирование
	$result_edit = mysql_query("UPDATE goods SET number='".($end-1)."' WHERE id='$this_e'", $db);		
}


//перетаскивание в самый конец
if ($_POST[max_elem]==0)
{
	$url = f_data ($_POST[url], 'text', 0);
	$start = $myrow3[number];
	$end = $myrow1[number]+1;
	$result4 = mysql_query("SELECT * FROM goods WHERE url='$url' && number>'$start' ORDER BY number ASC");
	$myrow4 = mysql_fetch_assoc($result4); 
	

	do
	{
		if ($myrow4[id]!=$this_e)
		{
			
			$number = ($myrow4[number]-1); 
			//редактирование
			$result_edit = mysql_query("UPDATE goods SET number='$number' WHERE id='$myrow4[id]'", $db);		
			$number_last = $myrow4[number]; 
		}
	}while($myrow4 = mysql_fetch_assoc($result4));
	
	//редактирование
	$result_edit = mysql_query("UPDATE goods SET number='".($number_last)."' WHERE id='$this_e'", $db);		
}



//перетаскивание вверх
if ($myrow3[number]>$next_e)
{
	$url = f_data ($_POST[url], 'text', 0);
	$start = $myrow3[number]+1;
	$end = $myrow1[number];
	$result4 = mysql_query("SELECT * FROM goods WHERE url='$url' && number<'$start' && number>'".($end)."' ORDER BY number ASC");
	$myrow4 = mysql_fetch_assoc($result4); 


	do
	{
		if ($myrow4[id]!=$this_e)
		{
			
			$number = ($myrow4[number]+1); 
			//редактирование
			$result_edit = mysql_query("UPDATE goods SET number='$number' WHERE id='$myrow4[id]'", $db);		
		}
	}while($myrow4 = mysql_fetch_assoc($result4));
	
	//редактирование
	$result_edit = mysql_query("UPDATE goods SET number='".($end+1)."' WHERE id='$this_e'", $db);		
}



//перетаскивание в самый конец
if ($_POST[max_elem]==1)
{
	$url = f_data ($_POST[url], 'text', 0);
	$start = $myrow3[number];
	$end = $myrow1[number]+1;
	$result4 = mysql_query("SELECT * FROM goods WHERE url='$url' && number>'$start' ORDER BY number ASC");
	$myrow4 = mysql_fetch_assoc($result4); 
	

	do
	{
		if ($myrow4[id]!=$this_e)
		{
			
			$number = ($myrow4[number]-1); 
			//редактирование
			$result_edit = mysql_query("UPDATE goods SET number='$number' WHERE id='$myrow4[id]'", $db);		
			$number_last = $myrow4[number]; 
		}
	}while($myrow4 = mysql_fetch_assoc($result4));
	
	//редактирование
	$result_edit = mysql_query("UPDATE goods SET number='".($number_last)."' WHERE id='$this_e'", $db);		
}
?>