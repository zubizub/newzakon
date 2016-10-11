<link rel="stylesheet" type="text/css" href="modul/doc/css.css">
<script type="text/javascript" src="modul/doc/js.js"></script>

<? $page_g = f_data ($_GET[page], 'text', 0); ?>

<table width="100%" border="0">
  <tr>
    <td>
    	<a href="?page=add_news" class="button_save">Добавить новость</a>
    </td>
    <td style="text-align:right;">
    	<form action="" method="get">
        	<input type="hidden" name="page" value="<? echo $page_g; ?>">
            <input name="search" type="text" class="text_pole" value="поиск..."> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>


<br>
<?
	if (isset($_GET[search]))
	{
		$search = trim($_GET[search]);
		$search = f_data ($search, 'text', 0);
		
		$sql_search = "WHERE name LIKE '%$search%' || text LIKE '%$search%'";	
		echo "<a href='?page=doc' style='color:#60a6ee'>Вернуться к документам</a> | Вы искали: <b>$search</b><br><br>";
	}
	else
	{
		$sql_search = "";
	}
?>

<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="text-align:left; width:30px">№</th>
    <th style="text-align:left">Название</th>
    <th style="width:220px">Владелец</th>
    <th style="width:100px">Дата</th>
    <th style="width:100px">Цена</th>
    <th style="width:100px">Загрузок</th>
    <th style="width:65px"></th>
  </tr>
  
<?
//запрос к базе
$result = mysql_query("SELECT * FROM doc $sql_search ORDER BY id ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
        if ($myrow[price]=='')
        {

            $price = "бесплатно";
        }
        else
        {
            $price = $myrow[price];
            $price = "$price руб";
        }
            
		//кто из пользователей добавил
		@$result1 = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
		@$myrow1 = mysql_fetch_assoc($result1); 
		@$num_rows1 = mysql_num_rows($result1);
		if ($num_rows1!=0)
        {
           $nameUser="<a href='?page=user_inf&id=$myrow1[id]' target='_blank' class='nameUserDoc'>$myrow1[fio]</a>"; 
        }
		
		echo "
		  <tr num='$myrow[number]' id='$myrow[id]' >
			<td style='text-align:center'>$myrow[id]</td>
			<td><a href='/doc/$myrow[file]' download>$myrow[name]</a></td>
			<td>$nameUser</td>
			<td>$myrow[date]</td>
            <td>$price</td>
            <td>$myrow[download]</td>
			<td style='text-align:center'><a href='#' style='color:red' class='del_doc popop' num='$myrow[id]'>удалить</a></td>
		  </tr>  		
		";
		
		$i++;
		$j++;		
	}while($myrow = mysql_fetch_assoc($result));

}
else
{

}

?>

</table>
