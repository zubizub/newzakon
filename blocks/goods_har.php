<?

// вывод динамических характеристик товара и их значений


$one=1;

$url = $myrow[url];
if (isset($url))
{
		if (substr_count($url,"/")==0)
		{
			$id=$url;
		}
		else
		{
			$id = explode("/", $url);
			$id = $id[count($id)-1];
	
		}
		
		$result_p = mysql_query("SELECT * FROM katalog WHERE id='$id'");
		$myrow_p = mysql_fetch_array($result_p);
		$tbl = "har_".$myrow_p[har];
}   


if (mysql_num_rows($result_p)!=0)
{

		$result_har = mysql_query("SELECT * FROM $tbl");
		
		if (@mysql_num_rows($result_har)!=0)
		{
			if ($one==1) 
			{
				echo "<td style='width:310px; vertical-align:top; background-color:#f7f7f7; border:1px solid #e3e3e3'>
				<br><div class='tovar_har'>
				<div style='text-align:center'><b>Характеристики товара</b></div>";
				$one++;
			}
			$myrow_har = mysql_fetch_assoc($result_har); 
			$i=1;	
					
			foreach($myrow_har as $key=>$val)
			{
				if ($key!='id' && $key!='id_goods') {$_ARR_VAL[$i] = $val; $_ARR_KEYARRAY[$i]=$key; $i++;} //получаем имена характеристик	
			}		
		}
		
		$result_har = mysql_query("SELECT * FROM $tbl WHERE id='2'"); 
		
		if (@mysql_num_rows($result_har)!=0)
		{		
			$myrow_har = mysql_fetch_assoc($result_har); 
			$i=1;
			
			foreach($myrow_har as $key=>$val)
			{
				if ($key!='id' && $key!='id_goods') {$_ARR_KEY[$i] = $val; $i++;} //получаем значение (измерение) характеристик	(шт., кг., Гг.)
			}
		}


		//при изменении товара 
		if (isset($_GET[id]))
		{
			$result_har = mysql_query("SELECT * FROM $tbl WHERE id_goods='$id_g'"); 
			if (@mysql_num_rows($result_har)!=0)
			{
				$myrow_har = mysql_fetch_assoc($result_har); 
				$i=1;
				
				foreach($myrow_har as $key=>$val)
				{
					if ($key!='id' && $key!='id_goods') {$_ARR_ZNACHENIE[$i] = $val; $i++;} //получаем значение (измерение) характеристик	(шт., кг., Гг.)
				}	
			}
			else
			{
				$_ARR_ZNACHENIE='';
			}
		}


		$result_har_name = mysql_query("SELECT * FROM goods_harakteristiki WHERE id='$ARR_HAR[$j]'");
		$myrow_har_name = mysql_fetch_assoc($result_har_name); 
		
		echo "<br><div style='margin-bottom:5px;'><b>$myrow_har_name[name]</b></div>"; //выводим имя категории характеристики
		//выводим все полученные характеристики
		for ($z=1; $z<$i;$z++)
		{
			if ($_ARR_ZNACHENIE[$z]!='')
			{
				echo "<div class='line_har_goods'>
				<div style='width:220px; display:inline-block'>$_ARR_VAL[$z]</div> 
				$_ARR_ZNACHENIE[$z] <b>$_ARR_KEY[$z]</b></div>";
			}
		} 
		
		echo "</div></td>";
	}
	
	

?>