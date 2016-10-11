<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<a href='index.php?page=harakteristik' title='назад' id='back'></a><br>

<?
	$result_h = mysql_query("SELECT * FROM goods_harakteristiki WHERE id='$_GET[cat]'");
	$myrow_h = mysql_fetch_array($result_h); 
	$name_h = $myrow_h[name];
?>

’арактеристики дл€ категории <b><? echo $myrow_h[name] ?></b>:</b><br><br>
<div style="display:inline-block; width:183px; padding-left:1px; margin-bottom:7px;">название</div>
<div style="display:inline-block; width:150px; margin-bottom:7px">измерение(кг, шт)</div><br>

<?
	@$result_har = mysql_query("SELECT * FROM har_$_GET[cat] WHERE id='1'");
	
	if (@mysql_num_rows($result_har)!=0) 
	{
		$myrow_har = mysql_fetch_assoc($result_har); 
	
		$i=1;
		
		foreach($myrow_har as $key=>$val)
		{
			if ($key!='id' && $key!='id_goods') {$_ARR_VAL[$i] = $val; $_ARR_KEYARRAY[$i]=$key; $i++; }	
		}
		
		
		$result_har = mysql_query("SELECT * FROM har_$_GET[cat] WHERE id='2'");
		$myrow_har = mysql_fetch_assoc($result_har); 
	
		$i=1;
		
		foreach($myrow_har as $key=>$val)
		{
			if ($key!='id' && $key!='id_goods') {$_ARR_KEY[$i] = $val; $i++;}
		}	
		
		$edit=1;
	}
?>



<form action="modul/katalog/obr_harakter_all.php" method="post" class="haraktiristik">
    <input name="name_har_1" type="text" value="<? echo $_ARR_VAL[1]; ?>"> = <input name="val_har_1" type="text" value="<? echo $_ARR_KEY[1]; ?>"> 
    <? if ($_ARR_VAL[1]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[1]&cat=$_GET[cat]' class='link_del'>X</a> 
	<input type='hidden' name='key_1' value='$_ARR_KEYARRAY[1]'>"; }?><br>
    <input name="name_har_2" type="text" value="<? echo $_ARR_VAL[2]; ?>"> = <input name="val_har_2" type="text" value="<? echo $_ARR_KEY[2]; ?>">
    <? if ($_ARR_VAL[2]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[2]&cat=$_GET[cat]' class='link_del'>X</a>
	<input type='hidden' name='key_2' value='$_ARR_KEYARRAY[2]'>"; }?><br>
    <input name="name_har_3" type="text" value="<? echo $_ARR_VAL[3]; ?>"> = <input name="val_har_3" type="text" value="<? echo $_ARR_KEY[3]; ?>">
    <? if ($_ARR_VAL[3]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[3]&cat=$_GET[cat]' class='link_del'>X</a>
	<input type='hidden' name='key_3' value='$_ARR_KEYARRAY[3]'>"; }?><br>
    <input name="name_har_4" type="text" value="<? echo $_ARR_VAL[4]; ?>"> = <input name="val_har_4" type="text" value="<? echo $_ARR_KEY[4]; ?>">
    <? if ($_ARR_VAL[4]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[4]&cat=$_GET[cat]' class='link_del'>X</a>
	<input type='hidden' name='key_4' value='$_ARR_KEYARRAY[4]'>"; }?><br>  
    <div style="<? if ($_ARR_VAL[5]=='') {echo "display:none";} ?>" class="har2">
        <input name="name_har_5" type="text" value="<? echo $_ARR_VAL[5]; ?>"> = <input name="val_har_5" type="text" value="<? echo $_ARR_KEY[5]; ?>">
        <? if ($_ARR_VAL[5]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[5]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_5' value='$_ARR_KEYARRAY[5]'>"; }?><br>
        <input name="name_har_6" type="text" value="<? echo $_ARR_VAL[6]; ?>"> = <input name="val_har_6" type="text" value="<? echo $_ARR_KEY[6]; ?>">
        <? if ($_ARR_VAL[6]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[6]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_6' value='$_ARR_KEYARRAY[6]'>"; }?><br>
        <input name="name_har_7" type="text" value="<? echo $_ARR_VAL[7]; ?>"> = <input name="val_har_7" type="text" value="<? echo $_ARR_KEY[7]; ?>">
        <? if ($_ARR_VAL[7]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[7]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_7' value='$_ARR_KEYARRAY[7]'>"; }?><br>
        <input name="name_har_8" type="text" value="<? echo $_ARR_VAL[8]; ?>"> = <input name="val_har_8" type="text" value="<? echo $_ARR_KEY[8]; ?>">
        <? if ($_ARR_VAL[8]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[8]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_8' value='$_ARR_KEYARRAY[8]'>"; }?><br>  
    </div>  
    <div style="<? if ($_ARR_VAL[9]=='') {echo "display:none";} ?>" class="har3">
        <input name="name_har_9" type="text" value="<? echo $_ARR_VAL[9]; ?>"> = <input name="val_har_9" type="text" value="<? echo $_ARR_KEY[9]; ?>">
        <? if ($_ARR_VAL[9]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[9]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_9' value='$_ARR_KEYARRAY[9]'>"; }?><br>
        <input name="name_har_10" type="text" value="<? echo $_ARR_VAL[10]; ?>"> = <input name="val_har_10" type="text" value="<? echo $_ARR_KEY[10]; ?>">
        <? if ($_ARR_VAL[10]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[10]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_10' value='$_ARR_KEYARRAY[10]'>"; } ?> <br>
        <input name="name_har_11" type="text" value="<? echo $_ARR_VAL[11]; ?>"> = <input name="val_har_11" type="text" value="<? echo $_ARR_KEY[11]; ?>">
        <? if ($_ARR_VAL[11]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[11]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_11' value='$_ARR_KEYARRAY[11]'>"; }?><br>
        <input name="name_har_12" type="text" value="<? echo $_ARR_VAL[12]; ?>"> = <input name="val_har_12" type="text" value="<? echo $_ARR_KEY[12]; ?>">
        <? if ($_ARR_VAL[12]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[12]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_12' value='$_ARR_KEYARRAY[12]'>"; }?><br>
    </div>
    <div style="<? if ($_ARR_VAL[13]=='') {echo "display:none";} ?>" class="har4">
        <input name="name_har_13" type="text" value="<? echo $_ARR_VAL[13]; ?>"> = <input name="val_har_13" type="text" value="<? echo $_ARR_KEY[13]; ?>">
        <? if ($_ARR_VAL[13]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[13]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_13' value='$_ARR_KEYARRAY[13]'>"; }?><br>
        <input name="name_har_14" type="text" value="<? echo $_ARR_VAL[14]; ?>"> = <input name="val_har_14" type="text" value="<? echo $_ARR_KEY[14]; ?>">
        <? if ($_ARR_VAL[14]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[14]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_14' value='$_ARR_KEYARRAY[14]'>"; }?><br>
        <input name="name_har_15" type="text" value="<? echo $_ARR_VAL[15]; ?>"> = <input name="val_har_15" type="text" value="<? echo $_ARR_KEY[15]; ?>">
        <? if ($_ARR_VAL[15]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[15]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_15' value='$_ARR_KEYARRAY[15]'>"; }?><br>
        <input name="name_har_16" type="text" value="<? echo $_ARR_VAL[16]; ?>"> = <input name="val_har_16" type="text" value="<? echo $_ARR_KEY[16]; ?>">
        <? if ($_ARR_VAL[16]!='') {echo "<a href='modul/katalog/obr_harakter_all.php?id=$_ARR_KEYARRAY[16]&cat=$_GET[cat]' class='link_del'>X</a>
		<input type='hidden' name='key_16' value='$_ARR_KEYARRAY[16]'>"; }?><br>  
    </div>    
    <br>
    <div style="display:inline-block; width:143px; padding-left:1px; margin-bottom:7px;"><a href="#" class="popup" style="color:#333; font-size:12px" onClick="add_strok()">добавить €чеек</a></div>
    <div style="text-align:right; width:200px; display:inline-block"><input name="button" type="submit" value="сохрать" class="button_save" style="width:140px;"></div>
    
    <input type="hidden" value="<? echo $_GET[cat]; ?>" name="cat">
    <? if ($edit==1) {echo "<input type='hidden' value='$_GET[cat]' name='edit'>";} ?>
</form>

<script>

	function add_strok()
	{
		var break_funct;
		
		if ($(".har2").css('display')=='none')
		{
			$(".har2").fadeIn();
			break_funct = 1;
		}
		
		if ($(".har3").css('display')=='none' && break_funct!=1)
		{
			$(".har3").fadeIn();
			break_funct = 1;
		}
		
		if ($(".har4").css('display')=='none' && break_funct!=1)
		{
			$(".har4").fadeIn();
			break_funct = 1;
		}		
				
	}

</script>