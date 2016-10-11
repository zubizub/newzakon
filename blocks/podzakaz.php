<?
	// форма заявки для оформление товара, который ПОДЗАКАЗ
?>


<Br>
<?
$id = f_data($_GET[id],'text',0);

$result = mysql_query("SELECT * FROM goods WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
if ($myrow[sale]>0 && $myrow[sale]!='') {$price = floor($myrow[price1]-($myrow[price1]*$myrow[sale]/100));} else {$price = $myrow[price1];}
$price = price_convert($price);

$result_cur = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
$myrow_cur = mysql_fetch_assoc($result_cur);

if ($myrow[img]!=''){$img = "/cms/modul/katalog/upload/img/$myrow[img]";}else{$img = "/img/no_img_big.png";}   			
$m_link = explode("/",$myrow[m_link]);
$m_link = $m_link[(count($m_link)-1)];
						
echo "
<div class='box_buy_one_click'>
	<table width='100%' border='0'>
	  <tr>
	    <td style='width:150px; text-align:center'><img src='$img' height='150' style='max-width:153px;'></td>
	    <td style='padding-left:25px'>
			<div><a href='/goods/$myrow[id]/$m_link/' style='color:#333; font-size:20px;' target='_blank'><b>$myrow[name]</b></a></div><br>
			Стоимость: <b>$price</b> $myrow_cur[name] за 1 $myrow[razmer]<br>
			<div style='margin-top:10px;'>Артикул: <b>$myrow[art]</b></div>
		</td>
	  </tr>
	</table>
	
	<div class='box_buy_one_click_msg'>Предзаказ на товар!</div>
</div>
";


?>

<br><br>

<div class="box_frm_zakaz_one_clik">
	<div style="padding-left:5px; color:#333; font-size:16px; font-weight:bold">Чтобы оформить заказ заполните форму:</div>
	<br>
	<form action="/blocks/obr_podzakaz.php" method="post" class="form_zakaz">
	<div>Ваше имя:</div><input name="name" type="text" required <? if ($user_enter==1) {echo "value='$USER[1]'";} ?>><br>
	<div>Телефон:</div><input name="phone" class="phone" type="text" required <? if ($user_enter==1) {echo "value='$USER[3]'"; } ?>><br>
	<div>E-mail:</div><input name="mail" type="email" <? if ($user_enter==1) {echo "value='$USER[2]'";} ?>><br>
	<div>Адрес:</div><input name="address" type="text"><br>
	<div>Номер купона:</div><input name="kupon" type="text"><br>
	<div>Доставка:</div><select name="dostavka" style="width:70px; border:1px solid #CCC; border-radius:4px 4px 4px 4px; padding:6px; margin-bottom:6px;">
		<option value="0">нет</option>
	    <option value="1">да</option>
	</select>
	<span style="font-size:11px; padding-top:5px"><br>

	<div style="border-bottom:0px; width:300px; font-size:12px; margin-top:4px; padding-left:0px">Комментарии к заказу:</div><br>
	<textarea name="text" style="width:380px; height:120px"></textarea><br>
	<input name="button" type="submit" value="отправить заказ" class="btn_main">
	<input type="hidden" name="one_click" value="<? echo $id; ?>">
	<input type="hidden" name="podzakaz" value="1">
	</form>
</div>