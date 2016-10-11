<link rel="stylesheet" type="text/css" href="modul/kupon/css.css">
<script type="text/javascript" src="modul/kupon/js.js"></script>

<table width="100%" border="0">
  <tr>
    <td>
    	<a href="?page=add_kupon" class="button_save">Добавить купон</a>
    </td>
    <td style="text-align:right;">
    	<form action="" method="get">
    		<? $page_g = f_data ($_GET[page], 'text', 0); ?>
        	<input type="hidden" name="page" value="<? echo $page_g; ?>">
            <input name="search" type="text" class="text_pole" value="поиск..."> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>



<a href="#" class="link_del button_cancel" style="display:none">Удалить выбраные</a><br><br>
<?
	if (isset($_GET[search]))
	{
		$search = f_data ($_GET[search], 'text', 0);
		$sql_search = "WHERE name LIKE '%$search%' || firm LIKE '%$search%'";	
		echo "<a href='?page=kupon' style='color:#60a6ee'>Вернуться к купонам</a> | Вы искали: <b>$search</b><br><br>";
	}
	else
	{
		$sql_search = "";
	}
?>

<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px">Актив</th>
    <th style="text-align:left">Номер</th>
    <th style="text-align:left; width:100px">Фирма</th>
    <th style="width:100px">Дата окончания</th>
    <th style="width:100px">Дата</th>
    <th style="width:65px"></th>
    <th style="width:25px"><input name="all_chek" id="all_chek" type="checkbox" value=""></th>
  </tr>
  
<?
//запрос к базе
$result = mysql_query("SELECT * FROM kupon $sql_search ORDER BY id ASC LIMIT 100");
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
		
		//кто из пользователей добавил
		@$result1 = mysql_query("SELECT * FROM users WHERE uid='$myrow[user]'");
		@$myrow1 = mysql_fetch_assoc($result1); 
		@$num_rows1 = mysql_num_rows($result1);
		if ($num_rows1==0) {$user = "Администратор";} else {$user = $myrow1[fio];}
		
		if ($i>$SETTINGS[num_rows]) {$display="style='display:none' class='fide_rows'";} else {$display="";}
		
		echo "
		  <tr $display num='$myrow[number]' id='$myrow[id]' >
			<td style='text-align:center'>$enabled</td>
			<td>$myrow[name]</td>
			<td>$myrow[firm]</td>
			<td>$myrow[date_end]</td>
			<td>$myrow[date]</td>
			<td style='text-align:center'><a href='#' style='color:red' class='del_news1 popop del_link' num='$myrow[id]'>удалить</a></td>
			<td><input name='obj_chek[]' class='obj_chek' type='checkbox' value='$myrow[id]'></td>
		  </tr>  		
		";
		
		$i++;
		$j++;		
	}while($myrow = mysql_fetch_assoc($result));
	
	if ($num_rows>$SETTINGS[num_rows])
	{
		echo "
		  <tr>
			<th colspan='6'><a href='#' class='popup fadein_news'>Показать все купоны</a></th>
		  </tr>  		
		";			
	}
}
else
{
		echo "
		  <tr>
			<th colspan='6'>Купонов нет</th>
		  </tr>  		
		";	
}

?>

</table>


<a href="#" class="link_del button_cancel" style="display:none">Удалить выбраные</a>
<br>
<?
$result = mysql_query("SELECT * FROM kupon");
$num_rows = mysql_num_rows($result);
?>
<div style="text-align:right; padding:3px; color:#333; font-size:12px">
<a href="#" class="popup creat_csv">Сформировать csv</a> | Всего купонов: <b><? echo $num_rows; ?></b> 
| В архиве: <span title='Купонов, за вычетом 100 последних'><b><? if ($num_rows>100) {echo $num_rows-100;} else {echo "0";} ?></b></span> </div>

<div class="oboznach" style="width:255px">
	<img src="img/disabled.png" height="12">  Купон неактивен <img src="img/enabled.png" height="12">  Купон активен
</div>