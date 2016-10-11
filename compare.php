<!doctype html>
<html>
<head>
<meta charset="windows-1251">
<title>Список сравнения</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery-2.0.3.min.js"></script>

<script>

$(document).ready(function() {
	var show_line=0;
	
	$(".show_line").click(function() {
		if (show_line==0) {$(".noredline").fadeOut(); show_line=1;} else {$(".noredline").fadeIn(); show_line=0;}
	});
});

</script>

</head>
<? @include("blocks/db.php"); ?>
<body style="background-color:#FFF; line-height:20px">

<div style="font-size:22px; text-align:center; padding:25px; color:#656565; font-weight:bold; border-bottom:1px dotted #656565; margin-bottom:25px">СРАВНЕНИЕ ТОВАРОВ</div>

<table width="100%" border="0">
  <tr>
    <td style="vertical-align:top; width:25%; text-align:center; padding:5px; border-right:1px dotted #CCCCCC; position:relative">
 
		<?
		
		if (isset($_COOKIE[sravnenie1]))
		{
			$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie1]'");
			$myrow = mysql_fetch_assoc($result); 
			if ($myrow[img]!='')
			{
				$img = "/cms/modul/katalog/upload/img/$myrow[img]";
			}
			else
			{
				$img = "/img/no_img_big.png";
			}
			
			if ($myrow[sale]>0 && $myrow[sale]!='') {$price = $myrow[price1]-($myrow[price1]*$myrow[sale]/100);} else {$price = $myrow[price1];}
			
			$result_cur = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
			$myrow_cur = mysql_fetch_assoc($result_cur);
			
			$m_link = explode("/",$myrow[m_link]);
			$m_link = $m_link[(count($m_link)-1)];
					
			echo "<b>$myrow[name]</b><br>
			<img src='$img' width='180' style='max-height:553px'><br>
			Актикул: <u>$myrow[art]</u><br>
			$price $myrow_cur[name]<br>
			<a href='/goods/$myrow[id]/$m_link/' style='font-size:13px; color:#1572db' target='_blank'>перейти на товар</a>";
			
			echo "<a href='/cookie.php?del_compare&type=sravnenie1' style='color:red; text-decoration:none; position:absolute; top:5px; right:10px; font-size:12px'>убрать</a>";
		}
        ?>
    
    </td>
    <td style="vertical-align:top; width:25%; text-align:center; padding:5px; border-right:1px dotted #CCCCCC; position:relative">
		<?
		
		if (isset($_COOKIE[sravnenie2]))
		{
			$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie2]'");
			$myrow = mysql_fetch_assoc($result); 
			if ($myrow[img]!='')
			{
				$img = "/cms/modul/katalog/upload/img/$myrow[img]";
			}
			else
			{
				$img = "/img/no_img_big.png";
			}
			
			if ($myrow[sale]>0 && $myrow[sale]!='') {$price = $myrow[price1]-($myrow[price1]*$myrow[sale]/100);} else {$price = $myrow[price1];}
			
			$result_cur = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
			$myrow_cur = mysql_fetch_assoc($result_cur);
			
			$m_link = explode("/",$myrow[m_link]);
			$m_link = $m_link[(count($m_link)-1)];			
			
			echo "<b>$myrow[name]</b><br>
			<img src='$img' width='180' style='max-height:553px'><br>
			Актикул: <u>$myrow[art]</u><br>
			$price $myrow_cur[name]<br>
			<a href='/goods/$myrow[id]/$m_link/' style='font-size:13px; color:#1572db' target='_blank'>перейти на товар</a>";
			
			echo "<a href='/cookie.php?del_compare&type=sravnenie2' style='color:red; text-decoration:none; position:absolute; top:5px; right:10px; font-size:12px'>убрать</a>";
		}
        ?>    
    </td>
    <td style="vertical-align:top; width:25%; text-align:center; padding:5px; border-right:1px dotted #CCCCCC; position:relative">
		<?
		
		if (isset($_COOKIE[sravnenie3]))
		{
			$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie3]'");
			$myrow = mysql_fetch_assoc($result); 
			if ($myrow[img]!='')
			{
				$img = "/cms/modul/katalog/upload/img/$myrow[img]";
			}
			else
			{
				$img = "/img/no_img_big.png";
			}
			
			if ($myrow[sale]>0 && $myrow[sale]!='') {$price = $myrow[price1]-($myrow[price1]*$myrow[sale]/100);} else {$price = $myrow[price1];}
			
			$result_cur = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
			$myrow_cur = mysql_fetch_assoc($result_cur);
			
			$m_link = explode("/",$myrow[m_link]);
			$m_link = $m_link[(count($m_link)-1)];			
			
			echo "<b>$myrow[name]</b><br>
			<img src='$img' width='180' style='max-height:553px'><br>
			Актикул: <u>$myrow[art]</u><br>
			$price $myrow_cur[name]<br>
			<a href='/goods/$myrow[id]/$m_link/' style='font-size:13px; color:#1572db' target='_blank'>перейти на товар</a>";
			
			echo "<a href='/cookie.php?del_compare&type=sravnenie3' style='color:red; text-decoration:none; position:absolute; top:5px; right:10px; font-size:12px'>убрать</a>";
		}
        ?>    
    </td>
    <td style="vertical-align:top; width:25%; text-align:center; padding:5px; position:relative">
 		<?
		
		if (isset($_COOKIE[sravnenie4]))
		{
			$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie4]'");
			$myrow = mysql_fetch_assoc($result); 
			if ($myrow[img]!='')
			{
				$img = "/cms/modul/katalog/upload/img/$myrow[img]";
			}
			else
			{
				$img = "/img/no_img_big.png";
			}
			
			if ($myrow[sale]>0 && $myrow[sale]!='') {$price = $myrow[price1]-($myrow[price1]*$myrow[sale]/100);} else {$price = $myrow[price1];}
			
			$result_cur = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
			$myrow_cur = mysql_fetch_assoc($result_cur);
			
			$m_link = explode("/",$myrow[m_link]);
			$m_link = $m_link[(count($m_link)-1)];			
			
			echo "<b>$myrow[name]</b><br>
			<img src='$img' width='180' style='max-height:553px'><br>
			Актикул: <u>$myrow[art]</u><br>
			$price $myrow_cur[name]<br>
			<a href='/goods/$myrow[id]/$m_link/' style='font-size:13px; color:#1572db' target='_blank'>перейти на товар</a>";
			
			echo "<a href='/cookie.php?del_compare&type=sravnenie4' style='color:red; text-decoration:none; position:absolute; top:5px; right:10px; font-size:12px'>убрать</a>";
		}
        ?>   
    </td>
  </tr>
  <tr>
    <td style="padding:5px">
    	<?
			if (isset($_COOKIE[sravnenie1]))
			{
				$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie1]'");
				$myrow = mysql_fetch_assoc($result); 
				$id_goods = $_COOKIE[sravnenie1];
				include("blocks/goods_har_compare.php");	
				$ARRZN1=$ARRZN;
			}
        ?>
    </td>
    <td style="padding:5px">
    	<?
			if (isset($_COOKIE[sravnenie2]))
			{
				$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie2]'");
				$myrow = mysql_fetch_assoc($result); 
				$id_goods = $_COOKIE[sravnenie2];
				include("blocks/goods_har_compare.php");	
				$ARRZN2=$ARRZN;
			}
        ?>    
    </td>
    <td style="padding:5px">
    	<?
			if (isset($_COOKIE[sravnenie3]))
			{
				$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie3]'");
				$myrow = mysql_fetch_assoc($result); 
				$id_goods = $_COOKIE[sravnenie3];
				include("blocks/goods_har_compare.php");	
				$ARRZN3=$ARRZN;
			}
        ?>    
    </td>
    <td style="padding:5px">
    	<?
			if (isset($_COOKIE[sravnenie4]))
			{
				$result = mysql_query("SELECT * FROM goods WHERE id='$_COOKIE[sravnenie4]'");
				$myrow = mysql_fetch_assoc($result); 
				$id_goods = $_COOKIE[sravnenie4];
				include("blocks/goods_har_compare.php");
				$ARRZN4=$ARRZN;	
			}
        ?>    
    </td>
  </tr>
</table>

<?
$c=0; ;
if (count($ARRZN1)!=0) {$end=count($ARRZN1); $c++;}
elseif (count($ARRZN2)!=0) {$end=count($ARRZN2); $c++;}
elseif (count($ARRZN3)!=0) {$end=count($ARRZN3); $c++;}
else {$end=count($ARRZN4); $c++;}




if ($c!=0)
{
	for ($i=1; $i<=$end; $i++)
	{
		$sr1 = 0; $sr2 = 0; $sr3 = 0; $sr4 = 0; 
		if (isset($_COOKIE[sravnenie1])) {$sr1=$ARRZN1[$i];}
		if (isset($_COOKIE[sravnenie2])) {$sr2=$ARRZN2[$i];}
		if (isset($_COOKIE[sravnenie3])) {$sr3=$ARRZN3[$i];}
		if (isset($_COOKIE[sravnenie4])) {$sr4=$ARRZN4[$i];}
		if ($sr1==0) {
			if ($sr2!=0) {$sr1=$sr2;}
			if ($sr3!=0) {$sr1=$sr3;}
			if ($sr4!=0) {$sr1=$sr4;}
		}

		if ($sr2==0) {
			if ($sr1!=0) {$sr2=$sr1;}
			if ($sr3!=0) {$sr2=$sr3;}
			if ($sr4!=0) {$sr2=$sr4;}
		}	
		
		if ($sr3==0) {
			if ($sr1!=0) {$sr3=$sr1;}
			if ($sr2!=0) {$sr3=$sr2;}
			if ($sr4!=0) {$sr3=$sr4;}
		}	

		if ($sr4==0) {
			if ($sr1!=0) {$sr3=$sr1;}
			if ($sr2!=0) {$sr3=$sr2;}
			if ($sr3!=0) {$sr4=$sr3;}
		}
					
		if ($sr1==$sr2 && $sr3==$sr4 && $sr2==$sr4 && $sr1==$sr4) {} else { ?>
        
        <script>$(".line_<? echo $i; ?>").css("background-color","#ffd0d9"); $(".line_<? echo $i; ?>").removeClass("noredline");</script>
        
        <? }
	}
}
?>

<br><br>

<img style="width:22px; height:22px; background-color:#ffd0d9; margin-left:5px"> - разные характеристики товара 
<label style="margin-left:15px;"><input name="show_line" type="checkbox" value="" class="show_line">  показать только разные характеристики</label>
</body>
</html>