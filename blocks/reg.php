<?
// форма регистрации пользователя
?>

<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<? if (!isset($_GET[reg_ok]) && !isset($_GET[podtverdil_ok])) { ?>
<div class="other_form frmReg">
	<form action="/blocks/obr_reg.php" method="post">
         <div>Статус</div>
         <select name="u_status">
             <option>Юрист</option>
             <option>Адвокат</option>
         </select>
         <br><br>
    	 <div>ФИО<span style="color:red"> *</span></div> <input name="u_fio" type="text" value="" required><br><br>
         <div>E-mail<span style="color:red"> *</span></div> <input name="u_mail" type="email" value="" required><br><br>
         <div>Город<span style="color:red"> *</span></div> <input name="u_city" type="text" required /><br><br>
         <div>Телефон<span style="color:red"> *</span></div> <input name="u_phone" class="phone" type="text" value="" required/><br><br>
         <div>Сайт</div> <input name="u_site" type="text" value=""/><br><br>
         <label class="labelreg">
         <input type="checkbox" required /> 
         <a href='/licenzionnoe-soglashenie_4886/' target="_blank">Я согласен с пользовательским соглашением</a>
         </label><br><br>
         
        <span align="left" style="text-align:left !important; padding-bottom:0px; margin-right:15px; padding-top:7px;">
            <? include('blocks/capcha.php'); ?>
            <? echo $primer; ?>
            <input name="otvet_user" type="text" id="otvet" size="3" style="width:45px !important" required/>
            <input type="hidden" name="otvet_comp" value="<? echo $summa_number; ?>">        
        </span>         
         <input name="button" type="submit" class="button_enter" value="Регистрация">
    </form> 
    <img src="/img/men_reg.jpg" class="menReg hidden-xs" />
  
</div>
  

<? 
}
elseif (isset($_GET[reg_ok])) //действия после заполнения регистрационной формы
{
	
	$mail = f_data ($_GET['mail'], 'text', 0);
?>

<br>  
<div style="color:#333; font-size:17px; padding:6px; border:1px dotted #999999; line-height:20px; margin-left:15px; background-color:#f3fbfe">
	Регистрация успешно завершена. На Ваш электронный адрес <b><? echo $mail; ?></b> должно прийти письмо с инструкцией по активации аккуанта.
</div> 

<?	
}
elseif (isset($_GET[podtverdil_ok])) //действия после подтверждения email
{
?>
<br>  
<div style="color:#333; font-size:17px; padding:6px; border:1px dotted #999999; line-height:20px; margin-left:15px; background-color:#f3fbfe">
	Регистрация успешно завершена! Вы можете войти в свой личный кабинет! <a href='?page=form_enter' style='color:red;'>ВОЙТИ В КАБИНЕТ</a>
</div> 
<?	
}
else
{
	echo "<br><div style='color:red; font-size:24px; text-align:center'>Странно, как Вы сюда вообще попали ;)</div>";	
}
?>
</div>
</div>