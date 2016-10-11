<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>

<form action="modul/settings/obr_admin_contacts.php" method="post" enctype="multipart/form-data" class="form_admin_contacts">
<div>ФИО</div> <input name="fio_admin" type="text" value="<? echo $SETTINGS[fio_admin]; ?>" class="input_fio"><br><br>
<div>Телефон</div> <input name="phone_admin" type="text" value="<? echo $SETTINGS[phone_admin]; ?>" class="input_phone"><br><br>
<div>E-mail</div> <input name="mail_admin" type="text" value="<? echo $SETTINGS[mail_admin]; ?>" class="input_mail"><br><br>
<div>Адрес</div> <input name="address_admin" type="text" value="<? echo $SETTINGS[address_admin]; ?>" placeholder="<? if ($SETTINGS[address_admin]=='') {echo "г. Ростов-на-Дону, ул. Обороны 49";} ?>"><br><br>
<div>Офис</div> <input name="address_admin_office" type="text" value="<? echo $SETTINGS[address_admin_office]; ?>" placeholder="<? if ($SETTINGS[address_admin_office]=='') {echo "нет";} ?>"><br><br>
<div>Компания</div> <input name="company_name" type="text" value="<? echo $SETTINGS[company_name]; ?>" placeholder="<? if ($SETTINGS[company_name]=='') {echo "НАША КОМПАНИЯ";} ?>"><br><br>

Данные организации<br>
<textarea name="organization" style="width:500px" rows="5">
<? echo $SETTINGS[organization]; ?>
</textarea><br><br>

Сообщение если выключен сайт<br>
<textarea name="desabl_site" style="width:500px" rows="5">
<? echo $SETTINGS[desabl_site]; ?>
</textarea><br><br>
<input name="button" type="submit" value="сохранить" class="button_save">    
</form> 