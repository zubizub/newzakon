<?

	$result = mysql_query("SELECT * FROM zayvki");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$zayvki = "<div class='dopinf_zayvki'>($num_rows)</div>";

////////////////////////////////////////////

	$result = mysql_query("SELECT * FROM obr_svyz");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$obr_svyz = "<div class='dopinf_zayvki'>($num_rows)</div>";
	
	
////////////////////////////////////////////////


	$result = mysql_query("SELECT * FROM zakaz");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
		
	$zakaz = "<div class='dopinf_zayvki'>($num_rows)</div>";

//////////////////////////////////////////////////////////

	$result = mysql_query("SELECT * FROM otziv");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	$otziv ="<div class='dopinf_zayvki'>($num_rows)</div>";


/////////////////////////////////////

	$result = mysql_query("SELECT * FROM comment");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	
	$comment = "<div class='dopinf_zayvki'>($num_rows)</div>";	

//////////////////////////////////////

	$result = mysql_query("SELECT * FROM vopros_otvet");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	$vopros_otvet = "<div class='dopinf_zayvki'>($num_rows)</div>";
?>


<div class="main_menu">
        <? if ($SETTINGS[desc_1]==1) { ?><a href="?page=zakaz">������ <? echo $zakaz; ?></a><? } ?>
        <? if ($SETTINGS[desc_2]==1) { ?><a href="?page=zayvki">������ <? echo $zayvki; ?></a><? } ?>
        <? if ($SETTINGS[desc_3]==1) { ?><a href="?page=obr_svyz">�������� ����� <? echo $obr_svyz; ?></a><? } ?>
        <? if ($SETTINGS[desc_4]==1) { ?><a href="?page=comments">����������� <? echo $comment; ?></a><? } ?>
        <? if ($SETTINGS[desc_5]==1) { ?><a href="?page=vopros_otvet">������ ����� <? echo $vopros_otvet; ?></a><? } ?>
        <? if ($SETTINGS[desc_6]==1) { ?><a href="?page=otziv">������ <? echo $otziv; ?></a><? } ?>
</div>