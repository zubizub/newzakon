<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>


<?

	if (isset($_POST[cat]) && trim($_POST[procent])!='')
	{
		if ($_POST[cat]=="0") {$sql='';} else {$sql=" WHERE url='$_POST[cat]' ";}
		
		//запрос к базе
		$result = mysql_query("SELECT * FROM goods $sql");
		$myrow = mysql_fetch_assoc($result); 
		$num_rows = mysql_num_rows($result);
		
		if ($num_rows!=0)
		{
			do
			{
				$new_price = floor($myrow[price1]+(floor($myrow[price1]*$_POST[procent])/100)); 
				$result_edit = mysql_query("UPDATE goods SET price1='$new_price' WHERE id='$myrow[id]'", $db);	
			}while($myrow = mysql_fetch_assoc($result));
		}		
		
			
		echo "<script>window.location.href = '?page=goods_newprice&msg=Стоимость товаров увеличена на $_POST[procent] процентов!'</script>";
	}	

?>


<form action="" method="post">
Установить наценку на 
	<select name="cat">
    	<option value="0">все категории</option>
		<?
        
        //запрос к базе
        $result = mysql_query("SELECT * FROM katalog ORDER BY id ASC");
        $myrow = mysql_fetch_assoc($result); 
        $num_rows = mysql_num_rows($result);
        
        do
        {
			if ($myrow[url]!="") {$url='$myrow[url]/';} else {$url="";}
            echo "<option value='$url$myrow[id]'>$myrow[name]</option>";
        }while($myrow = mysql_fetch_assoc($result));
        
        ?>        
    </select>
	
    товаров, 
    в размере <input name="procent" type="text" size="10"> %
    
    <input name="button" type="submit" value="применить" class="button_save">
</form>
<br><br>

При подтверждении наценки стоимость товаров определенной категории или всех категорий будет увеличена на процент, который Вы укажите, при дробном результате стоимость будет округлена до целого значения в большую сторону.