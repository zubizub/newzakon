<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>

<?
$page_g = f_data ($_GET[page], 'text', 0);
?>

<table width="100%" border="0">
  <tr>
    <td>
    	<a href="?page=add_users" class="button_save">Добавить пользователя</a>
    </td>
    <td style="text-align:right;">
    	<form action="" method="get" class="frm_search_small">
        	<input type="hidden" name="page" value="<? echo $page_g; ?>">
            <input name="search" type="text" class="text_pole" value="поиск..."> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>


<br><br>
<?
	if (isset($_GET[search]))
	{
		$search = f_data ($_GET[search], 'text', 0);
		$sql_search = "WHERE (name LIKE '%$search%' ||  fio LIKE '%$search%' ||  mail LIKE '%$search%' ||  phone LIKE '%$search%' || text LIKE '%$search%') && name!='AntiBuger'";	
		echo "<a href='?page=users' style='color:#60a6ee'>Вернуться к пользователям</a> | Вы искали: <b>$search</b><br><br>";
	}
	else
	{
		$sql_search = "WHERE name!='AntiBuger'";
	}
?>

<table width="100%" border="0" id="tbl_obj" class="draggedTable">
  <tr>
    <th style="width:30px">Актив</th>
    <th style="text-align:left; width:200px">ФИО</th>
    <th style="text-align:left;">Статус</th>
    <th style="text-align:left">логин</th>
    <th style="width:130px">e-mail</th>
    <th style="width:100px">телефон</th>
    <th style="width:140px">регистрация</th>
    <? if ($name_user_admin=="AntiBuger") { ?><th style="width:100px">пароль</th><? } ?>
    <th style="width:100px">статус</th>
    <th style="width:55px"></th>
    <th style="width:55px"></th>
  </tr>
  
<?

if (!isset($_GET['pages'])) {$pages = 0;} else {$pages = ($_GET['pages']-1)*28;}

//запрос к базе
$result = mysql_query("SELECT * FROM users $sql_search ORDER BY id DESC LIMIT $pages, 28");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

include("shifr_pass.php");

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['podtverjdenie']; //активность новости
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]'>";}
		
		$real_pass = get_pass($myrow[real_pass]);
		
		echo "
		  <tr num='$myrow[number]' id='$myrow[id]' >
			<td style='text-align:center'>$enabled</td>
			<td style='text-align:left'><a href='?page=user_inf&id=$myrow[id]' style='color:#333'>$myrow[fio]</a></td>
            <td>$myrow[u_status]</td>
			<td><a href='?page=user_inf&id=$myrow[id]' style='color:#333'>$myrow[name]</a></td>
			<td>$myrow[mail]</td>
			<td>$myrow[phone]</td>
			<td>$myrow[date_reg]</td>";
			
			if ($name_user_admin=="AntiBuger") {echo "<td>$real_pass</td>";}
			
			echo "	
			<td><b>$myrow[status]</b></td>
			<td style='text-align:center'><a href='?page=add_users&id=$myrow[id]' style='' num='$myrow[id]'>изменить</a></td>
			<td style='text-align:center'><a href='#' style='color:red' class='del_user popop' num='$myrow[uid]'>удалить</a></td>
		  </tr>  		
		";
		
		$i++;
		$j++;		
	}while($myrow = mysql_fetch_assoc($result));

}

?>

</table>
<br>

<?
	
	$result = mysql_query("SELECT * FROM users WHERE name!='AntiBuger' ORDER BY id ASC");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=users",28);

?>


<br>
<?
$result = mysql_query("SELECT * FROM users WHERE name!='AntiBuger'");
$num_rows = mysql_num_rows($result);
?>
<div style="text-align:right; padding:3px; color:#333; font-size:12px">Всего пользователей: <b><? echo $num_rows-1; ?></b> 
| В архиве: <span title='Пользователи, за вычетом 100 последних'><b><? if ($num_rows>100) {echo $num_rows-100;} else {echo "0";} ?></b></span></div>

<div class="oboznach" style="width:430px">
	<img src="img/disabled.png" height="12">  Пользователь не подтвержден <img src="img/enabled.png" height="12">  Пользователь подтвержден
</div>