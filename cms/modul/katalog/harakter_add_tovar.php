<?
// на 81 и 91 заменен $j на "0" в массиве

if (isset($_GET[url]))
{
	if (substr_count($_GET[url],"/")==0)
	{
		$id=$_GET[url];
	}
	else
	{
		$id = explode("/", $_GET[url]);
		$id = $id[count($id)-1];

	}
	
	$result_p = mysql_query("SELECT * FROM katalog WHERE id='$id'");
	$myrow_p = mysql_fetch_array($result_p);
	$tbl = "har_".$myrow_p[har];
}


//echo $myrow_p[har];



$ARR_HAR = explode(",", $myrow_p[har]); // парсим и получаем id характеристик
if ($myrow_p[har]!='' && $ARR_HAR=='') {$ARR_HAR[0]=$myrow_p[har];}

if ($myrow_p[har]!=0)
{
	echo "<div class='tovar_har'><b>’арактеристики товара</b>";
	
		$result_har = mysql_query("SELECT * FROM $tbl");
		
		if (@mysql_num_rows($result_har)!=0)
		{
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
				if ($key!='id' && $key!='id_goods') {$_ARR_KEY[$i] = $val; $i++;} //получаем значение (измерение) характеристик	(шт., кг., √г.)
			}
		}


		//при изменении товара 
		if (isset($_GET[id]))
		{
			$result_har = mysql_query("SELECT * FROM $tbl WHERE id_goods='$_GET[id]'"); 
			if (@mysql_num_rows($result_har)!=0)
			{
				$myrow_har = mysql_fetch_assoc($result_har); 
				$i=1;
				
				foreach($myrow_har as $key=>$val)
				{
					if ($key!='id' && $key!='id_goods') {$_ARR_ZNACHENIE[$i] = $val; $i++;} //получаем значение (измерение) характеристик	(шт., кг., √г.)
				}	
			}
			else
			{
				$_ARR_ZNACHENIE='';
			}
		}


		$result_har_name = mysql_query("SELECT * FROM goods_harakteristiki WHERE id='$ARR_HAR[0]'");
		$myrow_har_name = mysql_fetch_assoc($result_har_name); 
		//echo "$j";
		if ($myrow_har_name!="")
		{
			
			echo "<br><div style='margin-bottom:5px;'><b>$myrow_har_name[name]</b></div>"; //выводим им€ категории характеристики
			for ($z=1; $z<$i;$z++)
			{//выводим все полученные характеристики
				echo "<div style='border-bottom:1px dotted #666666; width:220px; display:inline-block'>$_ARR_VAL[$z]</div> 
				<input name='$_ARR_KEYARRAY[$z]-har_' type='text' value='$_ARR_ZNACHENIE[$z]' style='margin-bottom:5px'> $_ARR_KEY[$z]<br>";
			} 
		
		}
			
			?>
            
            <input type="hidden" name="table" value="<? echo $tbl; ?>">
            
            <?
		
		echo "</div>";
	}
	


?>

<br><br>
 
     