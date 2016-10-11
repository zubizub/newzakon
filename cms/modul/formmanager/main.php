<link rel="stylesheet" type="text/css" href="modul/formmanager/css.css">
<script type="text/javascript" src="modul/formmanager/js.js"></script>

<?
	//Изменение формы
	if (isset($_GET[id]))
	{
		$result = mysql_query("SELECT * FROM forms WHERE id = '$_GET[id]'");
		$myrow = mysql_fetch_array($result);
		$forma = $myrow[forma];
		$palitra = $myrow[palitra];
		$f_mail = $myrow[f_mail];
		$f_title = $myrow[f_title];
		$capcha = $myrow[capcha];
	}
?>


<table width="100%" border="0">
  <tr>
    <td style="width:400px">
        <div id="form_preview" class="<? if (isset($_GET[id])) {echo "$palitra";} else {echo "palitra1";} ?>">
            <div class="form_preview_head"><? if (isset($_GET[id])) {echo "$f_title";} else {echo "Заголовок формы";} ?></div>
            <div class="pole_editor"><? if (isset($_GET[id])) {echo "$forma";} ?></div>
            <div style="text-align:right; position:relative">
            	<input name="reset" type="button" value="очистить" class="button_cancel"> <input name="button" type="button" value="отправить" class="button_save">
                <div style="position:absolute; top:14px; left:5px; color:#F00; font-size:10px">* - обязательное поле для заполнения</div>
            </div>
        </div>  
        
        <div id="form_settings">
            <p><div>Заголовок:</div> <input name="f_title" class="f_title" type="text" value="<? if (isset($_GET[id])) {echo "$f_title";} else {echo "Заголовок формы";} ?>"></p>
            <p><div>E-mail для уведомлений:</div> <input name="f_mail" class="f_mail" type="text" value="<? if (isset($_GET[id])) {echo "$f_mail";} ?>"></p>
            <p><label><input name="capcha" class="capcha" type="checkbox" value="" <? if ($capcha=='' || $capcha==0) {echo "";} else {echo "checked";} ?> > включить Каптчу (Captcha)</label> 
            <img src="modul/formmanager/img/palitra1.jpg" width="34" height="12" style="margin-right:5px; margin-left:10px; border:1px dashed #999" id="palitra1">
            <img src="modul/formmanager/img/palitra2.jpg" width="34" height="12" style="margin-right:5px; border:1px dashed #999" id="palitra2">
            <img src="modul/formmanager/img/palitra3.jpg" width="34" height="12" style="border:1px dashed #999" id="palitra3">
            </p>
            <br>
            <input name="button" type="button" value="сохранить форму" class="button_save" onClick="saveForm()">
             <? if (isset($_GET[id])) {echo "<input type='hidden' name='edit' class='edit' value='$_GET[id]'>";} else {echo '<input type="hidden" name="edit" class="edit" value="0">';} ?>
        </div>        
    </td>
    <td>
        <div id="elements_form">
            Текстовое поле
            <div style="widows:219px; height:29px; background-image:url(modul/formmanager/img/textpole.jpg); background-repeat:no-repeat; position:relative" class="elemform1 elemform">
                <div class="bg_elemform">добавить</div>
            </div>
        
            <br>
            
            Текстовый блок
            <div style="widows:219px; height:45px; background-image:url(modul/formmanager/img/textblock.jpg); background-repeat:no-repeat; position:relative" class="elemform2 elemform">
                <div class="bg_elemform">добавить</div>
            </div>
            
            <br>
            
            Раскрывающийся список
            <div style="widows:136px; height:29px; background-image:url(modul/formmanager/img/spisok.jpg); background-repeat:no-repeat; position:relative" class="elemform3 elemform">
                <div class="bg_elemform">добавить</div>
            </div>    
        
            <br>
            
            Флажок
            <div style="widows:98px; height:29px; background-image:url(modul/formmanager/img/cheked.jpg); background-repeat:no-repeat; position:relative" class="elemform4 elemform">
                <div class="bg_elemform">добавить</div>
            </div>     
        </div>  
        
        <div id="form_settings_list">
        <span>
        
        <a href='?page=formmanager' class='name_form_spisok' num='' style="text-align:center; display:block; font-weight:bold">создать новую форму</a>
        </span>
        	<?
           		$result = mysql_query("SELECT * FROM forms ORDER BY id DESC");
				
				if (mysql_num_rows($result)!=0)
				{
					$myrow = mysql_fetch_array($result);
					do
					{
						echo "<span>
						<a href='#' class='del_link' onClick=\"del_form('$myrow[id]')\">X</a>
						<a href='?page=formmanager&id=$myrow[id]' class='name_form_spisok' num='$myrow[id]'>$myrow[f_title]</a>
						</span>";
					}while($myrow = mysql_fetch_array($result));
				}
				
			
			?>
        </div>  
    </td>
  </tr>
</table>




<div id="msgBox_add_elemform">
	<div style="position:relative">
        <div class="msgBox_head_add_elemform">Добавить элемент</div>
        <div class="msgBox_content_add_elemform" style="margin-bottom:10px; padding:10px;">
        	Название поля:<br>
			<input name="name_pole" class="name_pole" type="text" style="width:95%">
            <label style="display:block; margin-top:5px; margin-bottom:10px;" class="ch_obyzat"><input name="obyzat" class="ch_obyzat_ch" type="checkbox" value=""> обязательное</label>
            <input type="hidden" name="type_pole" class="type_pole" value="">
            
            <div class="r_spisok" style="border-top:1px dashed #CCC; margin-bottom:5px; font-size:11px">
            	Значения списка<br>
            	<input name="spisok1" type="text" class='spisok_list' value=''> <span class="add_spisok plus_span">+</span>            
            </div>
            
            <div align="center"><input name="button" type="button" value="сохранить" onClick="add_elem()"> 
           
            </div>
        </div>
        <a href="#" class="msgBox_close_windows_add_elemform">X</a>
    </div>
</div>


