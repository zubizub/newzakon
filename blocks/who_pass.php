<? 

// восстановление пароля пользователя

if (isset($_POST[new_pass]) && $_POST[new_pass]!='' && strlen($_POST[new_pass])>5)
{
	$new_pass = f_data ($_POST[new_pass], 'text', 0);
	$uid = f_data ($_POST[uid], 'text', 0);
	$edit_pass = f_data ($_POST[edit_pass], 'text', 0);
	$pass = md5(md5($new_pass));
	$real_pass = creat_pass($new_pass);
	$result_edit = mysql_query("UPDATE users SET pass='$pass',real_pass='$real_pass' WHERE uid='$uid' && edit_pass='$edit_pass'", $db);
	echo "<div style='color:red'>ПАРОЛЬ ИЗМЕНЕН!</div>";
}


if (isset($_POST[new_pass]) && ($_POST[new_pass]=='' || strlen($_POST[new_pass])<5))
{
	echo "<div style='color:red'>ОШИБКА! Неверно задан пароль!</div>";
}

if (!isset($_GET[id]) || $_GET[id]=='') {?>

<div style="border:1px dotted #666666; padding:15px;">Для восстановления пароля, введите свой электронный адрес, и нажмите кнопку "восстановить", далее проверьте электронный ящик, Вам придёт письмо с ссылкой для восстановления пароля.</div><br>


<div class="other_form1">
<div style="padding:4px; background-color:#FFF; border-bottom:0px; max-width:550px !important; width: 100%">E-mail или телефон: 
<input name="email" type="text" size="30" class="pole_pass"> <input name="button" type="button" value="восстановить" class="who_pass button_enter"></div>
<div style="color:#d41515; font-weight:bold; width:400px; display:none; border-bottom: 0px" class="msg_pass">Письмо со ссылкой Вам отправлено!</div>
</div>

<script>
	$(document).ready(function() {
		$(".who_pass").click(function() {
            var mainUser = $(".pole_pass").val();
            mainUser = trim(mainUser);
            
            if (mainUser!='')
            {
               	$(this).val("ждите...");
        		$.post("/blocks/ajax_whopass.php",  {mail: mainUser}, onAjaxSuccess2);
        	 
        			function onAjaxSuccess2(data)
        			{
        			  if (data=='0') alert('Неверный e-mail!'); else {$(".msg_pass").fadeIn();}
        			  $('.who_pass').val("восстановить");
        			}		
            }
        });    
            

	});
</script>



<? } else { 
$get_id = htmlspecialchars($_GET[id], ENT_QUOTES);
$id_user = @substr($get_id,10,32);
$id = @substr($get_id,42,strlen($get_id)-42);
$edit_pass = f_data ($_GET[edit_pass], 'text', 0);

$result_user = mysql_query("SELECT * FROM users WHERE uid='$id_user' && id='$id' && edit_pass='$edit_pass'");

if (mysql_num_rows($result_user)!=0) 
{
	$myrow_user = mysql_fetch_array($result_user);
	
	echo "<form action='' method='post'>
	Введите новый пароль <input name='new_pass' type='text' size='40' class='pole_pass inpt'> 
	<input type='hidden' name='uid' value='$id_user'>
	<input type='hidden' name='edit_pass' value='$edit_pass'>
	<input name='button' type='submit' value='сохранить' class='who_pass btn'>
	</form>";
}

?>


<? } ?>