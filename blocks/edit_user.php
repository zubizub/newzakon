<?
//изменение информации о пользователе
?>

<div class="menu_cabinet">
    <a href="/cabinet/" style="margin-left:0px;">КАБИНЕТ</a>
    <a href="/msg/">СООБЩЕНИЯ</a>
    <a href="/zakaz/">ЗАКАЗЫ</a>
    <a href="/favotite/">ИЗБРАННОЕ</a>
    <a href="/history/">ИСТОРИЯ</a>
</div>

<br>

<div id="history_cabinet">
<a href="?page=cabinet">Кабинет</a> > Редактирование личных данных
</div>

<?
$uid = f_data($_COOKIE[uid],'text',0);
$result_u = mysql_query("SELECT * FROM users WHERE uid='$uid'");
$myrow_u = mysql_fetch_array($result_u);

?>
<br><br>
<div style="line-height:10px; font-size:13px; position:relative">
 <form action="/blocks/obr_edit_user.php" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td style="vertical-align:top;">
   
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Имя пользователя:
        <span style="color:#F00">*</span></div> <input name="fio" type="text" size="50" value="<? echo $myrow_u[fio]; ?>" required>
        <br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>E-mail:
        <span style="color:#F00">*</span></div> <input name="mail" type="text" size="50" value="<? echo $myrow_u[mail]; ?>" required><br><br>
 		<div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Телефон:
        <span style="color:#F00">*</span></div> <input name="phone" class='phone' type="text" size="50" value="<? echo $myrow_u[phone]; ?>" required><br><br>        
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Пароль:</div> <input name="pass" type="text" size="50" value="" placeholder="Если Вы не хотите менять пароль, то не заполняйте"><br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Повтор пароля:</div> <input name="pass2" type="text" size="50" value="" placeholder="Если Вы не хотите менять пароль, то не заполняйте"><br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>skype:</div>  <input name="skype" type="text" size="50" value="<? echo $myrow_u[skype]; ?>"><br><br>
        <div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>icq:</div>  <input name="icq" type="text" size="50" value="<? echo $myrow_u[icq]; ?>"><br><br>      
       
    </td>
    <td style="vertical-align:top; width:150px; text-align:center">
    <input name="img" type="file" style="display: block; width: 150px; height: 185px; position: absolute; top: 7px; right: 2px;filter:alpha(opacity=0);background:none;"  accept="image/jpeg,image/png,image/jpg" class="file_img">
   
		<?
        
                $url_ava = "cms/img/users/$myrow_u[img]";
        
                if (@fopen($url_ava, "r")) 
                {
                    $ava = "<img src='/cms/img/users/$myrow_u[img]' style='border: 2px solid #dbdad7; width:150px; background-color:#ffffff; padding:4px' class='main_img'>";
                }
                else
                {
                    $ava = "<img src='/img/not_photo.png' style='border: 2px solid #dbdad7; width:150px; background-color:#ffffff; padding:4px' class='main_img'>";
                }
                
                echo $ava;
        ?>    
    </td>
  </tr>
</table>
<br>
<div style='display:inline-block; width:140px; border-bottom:1px dotted #CCCCCC'>Информация:</div><br><br>
<textarea name="text" style="width:99%" rows="5"><? echo $myrow_u[text]; ?></textarea><br><br>
<div style="text-align:right; margin-top:5px"><input name="button" type="submit" value="сохранить" style="padding:6px; padding-left:20px; padding-right:20px"></div>
</form> 
</div>


<div style="font-size:12px">
    <span style="color:#F00">*</span> - обязательное поле для заполнения<br>
    <span style="color:#F00">!</span> - пароль не должен быть короче 6 символов
</div>

<script>
	$(document).ready(function() {	
		$(".file_img").change(function() {		
			$(".main_img").attr("src","img/not_photo2.png");
		});
	});
	
</script>