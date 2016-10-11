<link rel="stylesheet" type="text/css" href="modul/news/css.css">
<script type="text/javascript" src="modul/news/js.js"></script>

<?
$id_g = f_data ($_GET[id], 'text', 0);
//запрос к базе
$result = mysql_query("SELECT * FROM news WHERE id='$id_g'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$m_title = $myrow[m_title];
$m_description = $myrow[m_description];
$m_keywords = $myrow[m_keywords];
$m_link = $myrow[m_link];

echo "<div class='history'><a href='?page=news' style='color:#5587ae'>Новости</a> > $myrow[name]</div><br>";
?>

<form action="modul/news/obr_news.php" method="post" enctype="multipart/form-data" name="form_news">
<?
	if (isset($_GET[id]))
	{
		echo "<input type='hidden' name='edit' value='$id_g'>";	
	}
?> 
<div id="main_inf_block">
    <div id="menu_center">
        <a href="#" class="name_link1 menu_center_a_enabl name_link" style="margin-left:0px" num='1'>Новость</a>
        <a href="#" class="name_link2 name_link" num='2'>Файлы</a>
        <a href="#" class="name_link3 name_link" num='3'>Формы</a>
        <a href="#" class="name_link4 name_link" num='4'>Meta</a>
    </div>
    
    <div id="center_contayner">
        <div class="block1 block_contayner">
            <table width="100%" border="0">
              <tr>
                <td style="width:150px">
                	<?
                    	if ($myrow[img]!='')
						{
							$img = "modul/news/upload/img/$myrow[img]";
						}
						else
						{
							$img = "img/no_img.jpg";
						}
					?>
                    <a href="<? echo $img; ?>" class="fancybox main_img"><img src="<? echo $img; ?>" width="115" style="max-height:143px"></a>
                    <? if ($myrow[img]!='') {echo "<a href='#' class='del_img' style='color:red; display:block; margin-left:30px' num='$myrow[img]'>удалить</a>";} ?>
                </td>
                <td>
                    <div class="head_input">
                        <div>Название:</div> <input name="name" type="text" class="name" value="<? echo $myrow[name]; ?>"><br>
                        <div>Дата:</div> <input name="date" type="text" value="<? if ($myrow[date]!='') {echo $myrow[date];} else {echo date("H:m d.m.Y");} ?>"><br>
                        <div>Изображение:</div> <input name="img" type="file"><br>
                        <label style="margin-top:5px"><input name="enabled" type="checkbox" value=""  <? if ($myrow[enabled]==1 || !isset($_GET[id])) echo "checked"; ?>> 
                        показывать новость</label> 
                        <? if (isset($_GET[id])) { ?>
                        | номер новости <input name="number" type="text" style="width:30px" value="<? if ($myrow[number]!="") echo $myrow[number]; ?>">
                        <? } ?>
                    </div>
                </td>
              </tr>
            </table>
            <div class="editor_div">
                <textarea name="text" cols="30" style="width:100%; height:250px" class="moxiecut"><? echo $myrow[text]; ?></textarea>
            </div>
        </div>
        
        <div class="block2 block_contayner">
            Чтобы загрузить файлы, выберите их:<br>
            <input name="files[]" type="file" style="width:300px; padding:7px;" multiple>
            <br><br>
            Файлы можно загружать следующих форматов: *.doc, *.docx, *.xls, *.xsls, *.xml, *.rar и т.п.<br>
            <span style="color:red">Запрещено загружать файлы следующих форматов: *.exe, *.php, *.asp, *.js</span>
            <br><br>
            <br>

				<?
				if (isset($_GET[id]))
				{
						$folder_img = "modul/news/upload/files/$id_g/";
						@$dir    = "modul/news/upload/files/$id_g/";
						@$files_img = scandir($dir);    
						$j=0;
						
						for ($i=0;$i<=30;$i++)
						{
							if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
							{
									echo "<div num='div$i'>
									<a href='#' style='display:inline-block; color:red; margin-right:5px; text-decoration:none' class='popop del_file' num='upload/files/$id_g/$files_img[$i]' value='div$i'>X</a>
									<a href='modul/news/upload/files/$id_g/$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>$files_img[$i]</a></div>";		
							}
						} 
				}
                ?>            
            
            
        </div>
        
        <div class="block3 block_contayner">
            Выберите форму из списка и она будет прикреплена к новости:
            <br>
        	<select name="form" class="form_add">
            	<option value="0">нет</option>
                  <?
					$result2 = mysql_query("SELECT * FROM forms ORDER BY id DESC");
					
					if (mysql_num_rows($result2)!=0)
					{
						$myrow2 = mysql_fetch_array($result2);
						do
						{
							if ($myrow[form]==$myrow2[id])
							{
								echo "<option value='$myrow2[id]' selected>$myrow2[f_title]</option>";
							}
							else
							{
								echo "<option value='$myrow2[id]'>$myrow2[f_title]</option>";
							}
						}while($myrow2 = mysql_fetch_array($result2));
					}
				?>
            </select>
            <br>Расположение формы<br>
            <select name="form_position" class="form_add">
                <option value="down" <? if ($myrow[form_position]=='down') {echo "selected";}; ?>>внизу</option>
                <option value="up" <? if ($myrow[form_position]=='up') {echo "selected";}; ?>>вверху</option>
            </select>
            <br><br>
            Чтобы создать новую форму перейдите в <a href="?page=formmanager" style="color:red">редактор форм</a>.
        </div>
        <div class="block4 block_contayner"><?  $host='news'; include("blocks/key_desc.php"); ?></div>
        
        <div style="text-align:right">
            <a href="?page=news" class="button_cancel">Отмена</a> 
            <input name="button" type="submit" value="сохранить" class="button_save button_save_main">
        </div>
    </div>
</div>
</form>