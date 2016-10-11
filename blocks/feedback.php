<?
	// форма обратной связи
?>

<div class="row">
    <form action="#" method="post" name="frm_feedback" class="frm_feedback">
    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    		<span class="title_inpt">Ваше ФИО</span>
    		<input name="fio" type="text" class="inpt inpt_90 frm_feedback_name" required>
    	</div>
    	
    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    		<span class="title_inpt">Ваш телефон</span>
    		<input name="phone" type="text" class="inpt inpt_90 frm_feedback_phone phone" required>
    	</div>
    	
    	
    	<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
    		<span class="title_inpt">Ваш E-mail</span>
    		<input name="mail" type="email" class="inpt inpt_90 frm_feedback_mail" required>
    	</div>
    	
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    		<span class="title_inpt">Ваше сообщение</span>
    		<textarea name="text" class="inpt" style="height: 100px; width: 100%; max-width: 590px;"></textarea>
    	</div>
    	
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<input name="token" type="hidden" value="<? echo rand(11111111,999999999); ?>"/>
    	<input name="type_form" class="type_form" type="hidden" value="feedback"/>
    	<input name="name_form" class="name_form" type="hidden" value="frm_feedback"/>
    	<input name='button' type="button" value='отправить' class='btn btn_frm'> 
        </div> 
    </form>
</div>