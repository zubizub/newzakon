<?
	// форма заявки
?>

<div id="zayvka2">
	<div id="zayvka_box">
        <div class="zayvka2_head">Оставить заявку</div>
        <form action="/blocks/obr_zayvka2.php" method="post">
	        <div class="zayvka_input">
	            <input name="fio" type="text" placeholder="Введите ФИО" required><span>*</span><br>
	            <input name="phone" type="text" placeholder="Введите телефон" class="phone" required><span>*</span><br>
	            <input name="address" type="text" placeholder="Введите адрес"><span>*</span><br>
	            <input name="mail" type="email" placeholder="Введите e-mail"><span>*</span><br>
	        </div>   
	        <div align="left" style="text-align:left !important; padding:3px; margin-top:5px; padding-bottom:0px">
	            <? include('blocks/capcha.php'); ?>
	            <? echo $primer; ?>
	            <input name="otvet_user" type="text" id="otvet" size="3" style="width:45px !important" required/>
	            <input type="hidden" name="otvet_comp" value="<? echo $summa_number; ?>">        
	        </div>   
	        <div style="text-align:right; padding-top:5px; margin-bottom:4px; position:absolute; bottom:35px; right:7px">
	            <input name='reset' type='button' value='очистить' class='button_cancel'> 
	            <input name='button' type='submit' value='отправить' class='button_save'>               
	        </div>  
	        <div class="zayvka2_footor">* - обязательные поля</div>
        </form>
    </div>
</div>