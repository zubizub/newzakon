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
			$id = $id[count($id)];
	
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
				echo "<br><br><div class='tovar_har'><b>Характеристики товара</b>";
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

			$result_har = mysql_query("SELECT * FROM $tbl WHERE id_goods='$id_goods'"); 
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



		$result_har_name = mysql_query("SELECT * FROM goods_harakteristiki WHERE id='$ARR_HAR[$j]'");
		$myrow_har_name = mysql_fetch_assoc($result_har_name); 
		unset($ARRZN);
		
		echo "<br><div style='margin-bottom:5px;'><b>$myrow_har_name[name]</b></div>"; //выводим имя категории характеристики
		for ($z=1; $z<$i;$z++)
		{//выводим все полученные характеристики
			echo "<div style='padding:5px; margin-bottom:2px' class='line_$z noredline'><div style='border-bottom:1px dotted #666666; width:220px; display:inline-block'>$_ARR_VAL[$z]</div> 
			$_ARR_ZNACHENIE[$z] <b>$_ARR_KEY[$z]</b></div>";
			$ARRZN[$z]=$_ARR_ZNACHENIE[$z];
		} 
			
	}
	
	echo "</div>";

?>