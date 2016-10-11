<link rel="stylesheet" type="text/css" href="modul/zayvki/css.css">
<script type="text/javascript" src="modul/zayvki/js.js"></script>

<table width="100%" border="0">
  <tr>
    <td>
    	
    </td>
    <td style="text-align:right;">
    	<form action="" method="get">
        	<input type="hidden" name="page" value="<? echo $_GET[page]; ?>">
            <input name="search" type="text" class="text_pole" value="поиск..."> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>

<?
	if (isset($_GET[search]))
	{
		$search = trim($_GET[search]);
		$sql_search = "WHERE fio LIKE '%$search%' || phone LIKE '%$search%' || mail LIKE '%$search%' || text LIKE '%$search%' || address LIKE '%$search%'";	
		echo "<a href='?page=zayvki' style='color:#60a6ee'>Вернуться к заявкам</a> | Вы искали: <b>$search</b><br><br>";
		$search_url="&search=$search";
	}
	else
	{
		$sql_search = "";
	}
	
	if ($_GET[sort]!="fio_up") {$fio_sort="fio_up";} else {$fio_sort="fio_down";}
	if ($_GET[sort]!="type_up")  {$type_sort="type_up";} else {$type_sort="type_down";}
	if ($_GET[sort]!="n_up")  {$n_sort="n_up";} else {$n_sort="n_down";}
?>

<br>
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px"></th>
    <th style="text-align:center; width:30px"><a href="?page=<? echo $_GET[page].$search_url; ?>&sort=<? echo $n_sort; ?>" style="color:inherit">№</a></th>
    <th style="text-align:left"><a href="?page=<? echo $_GET[page].$search_url; ?>&sort=<? echo $fio_sort; ?>" style="color:inherit">ФИО</a></th>
    <th style="width:90px">телефон</th>
    <th style="width:150px">e-mail</th>
    <th style="width:100px">источник</th>
    <th style="width:100px">дата</th>
    <th style="width:150px"><a href="?page=<? echo $_GET[page].$search_url; ?>&sort=<? echo $type_sort; ?>" style="color:inherit">источник</a></th>
    <th style="width:65px"></th>
  </tr>
  
<?
//запрос к базе
if (isset($_GET[sort]) && $_GET[sort]=='fio_up') {$sort="fio ASC";}
elseif (isset($_GET[sort]) && $_GET[sort]=='fio_down') {$sort="fio DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='type_up') {$sort="type ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='type_down') {$sort="type DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_up') {$sort="id  ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_down') {$sort="id DESC";} 
else {$sort="id DESC";}

if (isset($_GET[pages])) {$pages=$_GET[pages]*30;} else {$pages=0;}
$result = mysql_query("SELECT * FROM zayvki $sql_search ORDER BY $sort LIMIT $pages,30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['enabled']; //активность новости
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]'>";}
		
		echo "
		  <tr>
			<td style='text-align:center; width:30px'>$enabled</td>
			<td style='text-align:center; width:30px'>$myrow[id]</td>
			<td><a href='?page=zayvka_inf&id=$myrow[id]' style='color:#333'>$myrow[fio]</a></td>
			<td style='width:90px'>$myrow[phone]</td>
			<td style='width:150px'>$myrow[mail]</td>
			<td style='width:100px'>$myrow[advert]</td>
			<td style='width:100px'>$myrow[date]</td>
			<td style='width:155px'><i>$myrow[type]</i></td>
			<td style='text-align:center; width:55px'><a href='#' class='del_zayvki1 popop del_link' num='$myrow[id]'>удалить</a></td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "
		  <tr>
			<th colspan='9'>Заявок нет</th>
		  </tr>  		
		";	
}

?>

</table>
<br>
<?
	$result = mysql_query("SELECT * FROM zayvki");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=zayvki",30);
?>

<br><br>
<div class="oboznach">
	<img src="img/disabled.png" height="12">  Заявка невыполнена <img src="img/enabled.png" height="12">  Заявка выполнена
</div>