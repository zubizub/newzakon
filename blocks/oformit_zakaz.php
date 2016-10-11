<?

// форма для оформления заказа

?>

<div class="box_frm_zakaz_one_clik">
<form action="/blocks/obr_zakaz.php" method="post" class="form_zakaz">
<div>Ваше имя:</div><input name="name" type="text" required <? if ($user_enter==1) {echo "value='$USER[1]'";} ?>><br>
<div>Телефон:</div><input name="phone" class="phone" type="text" required <? if ($user_enter==1) {echo "value='$USER[3]'"; } ?>><br>
<div>E-mail:</div><input name="mail" type="email" <? if ($user_enter==1) {echo "value='$USER[2]'";} ?>><br>
<div>Номер купона:</div><input name="kupon" type="text"><br>
<div>Адрес:</div><input name="address" type="text"><br>
<div>Доставка:</div><select name="dostavka" style="width:70px; border:1px solid #CCC; border-radius:4px 4px 4px 4px; padding:6px; margin-bottom:6px;">
	<option value="0">нет</option>
    <option value="1">да</option>
</select>
<br>

<div style="border-bottom:0px; width:300px; font-size:12px; margin-top:4px; padding-left:0px">Комментарии к заказу:</div><br>
<textarea name="text" style="width:97%; height:80px; border-radius: 4px"></textarea><br>
<input name="button" type="submit" value="отправить заказ" class="btn_oformit_zakaz">
</form>
</div>