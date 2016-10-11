<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>
<a href="?page=users" style="color:#999; text-decoration:none">< пользователи</a>

<?
$id_g = f_data ($_GET[id], 'text', 0);
$result = mysql_query("SELECT * FROM users WHERE id='$id_g' || uid='$id_g'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
?>

<form action="modul/settings/obr_add_user.php" method="post" enctype="multipart/form-data">
    <div class="form_users">
        <p><div>Логин</div> <input name="name" type="text" value="<? if (!isset($_GET[name])) {echo $myrow[name];} else echo $_GET[name] ?>" class="input_fio"></p>
        <p><div>Пароль</div> <input name="pass" type="text" value="" class="input_key"> <? if ($num_rows!=0) {echo "<span style='color:red; font-size:10px'>Оставьте поле пустым если Вы не хотите менять пароль!</span>";} ?></p>
        <p><div>ФИО</div> <input name="fio" type="text" value="<? if (!isset($_GET[name])) {echo $myrow[fio];} else echo $_GET[fio] ?>" class="input_fio"></p>
        <p><div>Дата рождения</div> <input name="data_rojden" type="text" value="<?  if (!isset($_GET[name])) {echo $myrow[data_rojden];} else {echo $_GET[data_rojden];} ?>" class="input_date" style="width:130px"></p>
        <p><div>Телефон</div> <input name="phone" type="text" value="<?  if (!isset($_GET[name])) {echo $myrow[phone];} else echo $_GET[phone] ?>" class="input_phone" style="width:130px"></p>
        <p><div>E-mail</div> <input name="mail" type="text" value="<?  if (!isset($_GET[name])) {echo $myrow[mail];} else echo $_GET[mail] ?>" class="input_mail" style="width:190px"></p>
        <p><div>Статус:</div> 
        <select name="status">
        	<option value="Пользователь" <? if ($myrow[status]=="Пользователь" || $_GET[status]=='Пользователь') {echo "selected";} ?>>Пользователь</option>
            <option value="Модератор" <? if ($myrow[status]=="Модератор" || $_GET[status]=='Модератор') {echo "selected";} ?>>Модератор</option>
            <option value="Модератор" <? if ($myrow[status]=="Специалист" || $_GET[status]=='Специалист') {echo "selected";} ?>>Специалист</option>
            <option value="Администратор" <? if ($myrow[status]=="Администратор" || $_GET[status]=='Администратор') {echo "selected";} ?>>Администратор</option>
        </select>
        </p>
        <br><span style="font-size:12px; font-weight:bold">Дополнительная информация</span><br>
        <textarea name="text" style="width:500px" rows="10"><?  if (!isset($_GET[name])) {echo $myrow[text];} else echo $_GET[text] ?></textarea><br>
        <br><span style="font-size:12px; font-weight:bold">Мини-изображение: <input name="img" type="file"></span> <? if ($num_rows!=0) {echo "<span style='color:red; font-size:10px'>Оставьте поле пустым если Вы не хотите менять изображение!</span>";} ?><br>
        <input name="button" type="submit" value="сохранить" class="button_save"> 
        
        <?
        	if (isset($_GET[id]))
			{
				echo "<input type='hidden' name='edit' value='$id_g'>";	
			}
		?>
    </div>
</form>