<table width="100%" border="0">
  <tr>
    <td style="width:400px;">
        <div id="feedback">
            <div class='title_form'>Обратная связь</div>
            <form action="/blocks/obr_feedback.php" method="post">
                <span>Ваше имя<div class="required_pole">*</div>:</span> <input name="name" type="text" required><br>
                <span>Телефон:</span> <input name="phone" class="phone" type="text"><br>
                <span>E-mail<div class="required_pole">*</div>:</span> <input name="mail" type="email" required><br>
                <p>Дополнительный текст</p>
                <textarea name="text" cols="" rows=""><? echo $_GET[text]; ?></textarea><br>
                <div align="left" style="text-align:left !important; padding:3px; margin-top:5px; padding-bottom:0px">
                    <? include('blocks/capcha.php'); ?>
                    <? echo $primer; ?>
                    <input name="otvet_user" type="text" id="otvet" size="3" style="width:45px !important" required/>
                    <input type="hidden" name="otvet_comp" value="<? echo $summa_number; ?>">        
                </div>
                <p style="text-align:right !important">
                <table width="100%" border="0">
                  <tr>
                    <td>
                        <div class="required_pole" style="margin-right:19px; padding-top:14px">* - обязательное поле для заполнения</div>
                    </td>
                    <td style="text-align:right">
                        <input name='reset' type='button' value='очистить' class='button_cancel'> 
                        <input name='button' type='submit' value='отправить' class='button_save'>            
                    </td>
                  </tr>
                </table>
                </p>
            </form>
        </div>    
    </td>
    <td style="padding-left:19px; font-size:12px; text-align:justify; line-height:22px;">
    	<div align="center"><img src="/img/feedback.png" width="128" height="128"></div><br>
    	Обратная связь служит для связи пользователей сайта с администрацией сайта. Здесь Вы можете высказать свои пожелания или жалобы, отблагодарить или написать о своем предложении. Для того чтобы администрация сайта получила сообщение, необходимо корректнозаполнить все поля формы! Укажите совои контактные данные и напишите текст сообщения и нажмите кнопку отправить.
    </td>
  </tr>
</table>

