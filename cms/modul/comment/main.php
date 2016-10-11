<link rel="stylesheet" type="text/css" href="modul/comment/css.css">
<script type="text/javascript" src="modul/comment/js.js"></script>

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
		$sql_search = "WHERE name LIKE '%$search%' || text LIKE '%$search%' || mail LIKE '%$search%'";	
		echo "<a href='?page=comment' style='color:#60a6ee'>Вернуться к комментариям</a> | Вы искали: <b>$search</b><br><br>";
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
    <th style="width:30px">Актив</th>
    <th style="text-align:center; width:30px"><a href="?page=<? echo $_GET[page].$search_url; ?>&sort=<? echo $n_sort; ?>" style="color:inherit">№</a></th>
    <th style="text-align:left"><a href="?page=<? echo $_GET[page].$search_url; ?>&sort=<? echo $fio_sort; ?>" style="color:inherit">ФИО</a></th>
    <th style="width:150px">e-mail</th>
    <th style="width:100px">дата</th>
    <th style="width:100px">добавил</th>
    <th style="width:150px"><a href="?page=<? echo $_GET[page].$search_url; ?>&sort=<? echo $type_sort; ?>" style="color:inherit">источник</a></th>
    <th style="width:55px"></th>
  </tr>
  
<?
//запрос к базе
if (isset($_GET[sort]) && $_GET[sort]=='fio_up') {$sort="name ASC";}
elseif (isset($_GET[sort]) && $_GET[sort]=='fio_down') {$sort="name DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='type_up') {$sort="name_obj ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='type_down') {$sort="name_obj DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_up') {$sort="id  ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_down') {$sort="id DESC";} 
else {$sort="id DESC";}

if (isset($_GET[pages])) {$pages=$_GET[pages]*30;} else {$pages=0;}
$result = mysql_query("SELECT * FROM comment $sql_search ORDER BY $sort LIMIT $pages,30");
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
		if ($myrow[uid]!='') 
		{
			$result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
			$myrow_u = mysql_fetch_assoc($result_u); 			
			$user_post="<a href='?page=user_inf&id=$myrow_u[id]' style='font-size:11px'>информация о пользователе</a>";
		} 
		else {$user_post="Гость";}
		
		echo "
		  <tr>
			<td style='text-align:center'>$enabled</td>
			<td style='text-align:center'>$myrow[id]</td>
			<td>$myrow[name]<br><span style='font-size:11px'>$myrow[text]</span></td>
			<td>$myrow[mail]</td>
			<td>$myrow[date]</td>
			<td>$user_post</td>
			<td><a href='$myrow[page_url]' target='_blank'>$myrow[name_obj]</a></td>
			<td style='text-align:center'><a href='#' class='del_zayvki1 popop del_link' num='$myrow[id]'>удалить</a></td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "
		  <tr>
			<th colspan='8'>Комментариев нет</th>
		  </tr>  		
		";	
}

?>

</table>
<br>
<?
	$result = mysql_query("SELECT * FROM comment");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=comment",30);
?>

<br><br>
<div class="oboznach">
	<img src="img/disabled.png" height="12">  Комментарий неактивен <img src="img/enabled.png" height="12">  Комментарий активен
</div>