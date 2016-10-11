<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>

<?

//запрос к базе
if (isset($_GET[id]))
{
	$id = f_data ($_GET[id], 'text', 0);
	$result = mysql_query("SELECT * FROM goods WHERE id='$id'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	$m_title = $myrow[m_title];
	$m_description = $myrow[m_description];
	$m_keywords = $myrow[m_keywords];
	$m_link = $myrow[m_link];
	$name_page = $myrow[name];
	$name_edit_page = " > $name_page";
}

$history = $_GET[url];
$where_url = "WHERE url='$_GET[url]'";
if (substr_count($history,"/")>0)
{
	$history = explode("/",$_GET[url]);
	//$history = $history[count($history)];
	
	for ($i=0; $i<count($history); $i++)
	{
		$result = mysql_query("SELECT * FROM katalog WHERE id='$history[$i]'");
		$myrow = mysql_fetch_assoc($result); 	
		if ($myrow[url]!="") {$back_url = "$myrow[url]/$myrow[id]";} else {$back_url = "$myrow[id]";}	
		$new_history .= "<a href='?page=katalog&url=$back_url'>$myrow[name]</a> > ";	
	}
	
	$new_history = substr($new_history,0,-2);
	$history = "<a href='?page=katalog'>Главная категория</a> > $new_history";			
}
else
{
	$result = mysql_query("SELECT * FROM katalog WHERE id='$_GET[url]'");
	$myrow = mysql_fetch_assoc($result); 
	$history = "<a href='?page=katalog'>Главная категория</a> > <a href='?page=katalog&url=$_GET[url]'>$myrow[name]</a>";					
}

echo "<div class='history'>$history $name_edit_page</div><Br>";

$result = mysql_query("SELECT * FROM goods WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$m_title = $myrow[m_title];
$m_description = $myrow[m_description];
$m_keywords = $myrow[m_keywords];
$m_link = $myrow[m_link];
$name_page = $myrow[name];

?>

<form action="modul/katalog/obr_add_goods.php" method="post" enctype="multipart/form-data" name="form_news" class="frm_add_goods">
<input type="hidden" name="url" value="<? echo $_GET[url]; ?>">
<?
	if (isset($_GET[id]))
	{
		echo "<input type='hidden' name='edit' value='$id'>";	
	}
?> 
<div id="main_inf_block">
    <div id="menu_center">
        <a href="#" class="name_link1 menu_center_a_enabl name_link" style="margin-left:0px" num='1'>Товар </a>
        <a href="#" class="name_link2 name_link" num='2'>Файлы</a>
        <a href="#" class="name_link3 name_link" num='3'>Свойства</a>
        <a href="#" class="name_link5 name_link" num='5'>С товаром покупают</a>
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
							$img = "modul/katalog/upload/img/$myrow[img]";
						}
						else
						{
							$img = "img/no_img.jpg";
						}
					?>
                    <a href="<? echo $img; ?>" class="fancybox main_img"><img src="<? echo $img; ?>" width="115" style="max-height:143px"></a>
                    <? if ($myrow[img]!='') 
                    {echo "<a href='#' class='del_img' style='color:red; display:block; margin-left:30px' num='$myrow[img]'>удалить</a>";} ?>
                </td>
                <td>
                    <div class="head_input">
                        <div>Название:</div> <input name="name" type="text" class="name" required value="<? echo $myrow[name]; ?>">
                        <select name="razmer" style="margin-left:6px; margin-right:5px; padding: 3px; border-radius: 4px;">
                        	<option <? if ($myrow[razmer]=='шт.') {echo "selected";} ?>>шт.</option>
                            <option <? if ($myrow[razmer]=='М2') {echo "selected";} ?>>М2</option>
                            <option <? if ($myrow[razmer]=='п.м.') {echo "selected";} ?>>п.м.</option>
                            <option <? if ($myrow[razmer]=='уп.') {echo "selected";} ?>>уп.</option>
                            <option <? if ($myrow[razmer]=='гр.') {echo "selected";} ?>>гр.</option>
                            <option <? if ($myrow[razmer]=='кг.') {echo "selected";} ?>>кг.</option>
                            <option <? if ($myrow[razmer]=='поддон') {echo "selected";} ?>>поддон</option>
                            <option <? if ($myrow[razmer]=='рулон') {echo "selected";} ?>>рулон</option>
                        </select>  актикул  <input name="art" type="text" value="<? echo $myrow[art]; ?>" style="width:50px"> <br>
                        <div style="display:inline-block">Розничная цена: </div> 
                        <input name="price1" type="text" value="<? if ($myrow[price1]!='') {echo $myrow[price1];} ?>" style="width:100px !important"> 
                        <select name="curent" class="curent" style="padding: 3px; border-radius: 4px;">
                        	<?
                            	$result_cur = mysql_query("SELECT * FROM curent");
								$myrow_cur = mysql_fetch_assoc($result_cur);
								do
								{
									if ($myrow_cur[enabled]==1) {$enabled='selected'; $set_cur=$myrow_cur[name];} else {$enabled='';}
									echo "<option num='$myrow_cur[name]' value='$myrow_cur[id]' $enabled>$myrow_cur[name]</option>";
								}while($myrow_cur = mysql_fetch_assoc($result_cur));
							?>
                        </select>
                        <br>
                        <div style="display:inline-block;">Оптовая цена: </div> 
                        <input name="price2" type="text" value="<? if ($myrow[price2]!='') {echo $myrow[price2];} ?>" style="width:100px !important"> 
                        <span class="cur2"><? echo $set_cur; ?></span>
                        <br>
                        <div>Изображение:</div> <input name="img" type="file"><br>
                        <label style="margin-top:5px"><input name="enabled" type="checkbox" value=""  <? if ($myrow[enabled]==1 || !isset($_GET[id])) echo "checked"; ?>> 
                        показывать товар</label> 
                        <? if (isset($_GET[id])) { ?>
                        | номер товара <input name="number" type="text" style="width:30px" value="<? if ($myrow[number]!="") echo $myrow[number]; ?>">
                        <? } ?>
                    </div>
                </td>
              </tr>
            </table>
            
           
            <div style="margin-bottom:8px; margin-top:15px;">Краткое описание</div>
            	<textarea name="text_small" style="width:100%; height:110px; max-width: 690px;"><? echo $myrow[text_small]; ?></textarea>
            <Br>
            <div style="margin-bottom: -16px; margin-top:15px;">Полное описание</div>
            <div class="editor_div">
                <textarea name="text" cols="30" style="width:100%; height:250px; max-width: 750px;" class="moxiecut"><? echo $myrow[text]; ?></textarea>
            </div>
        </div>
        
        <div class="block2 block_contayner">
            Чтобы загрузить файлы, выберите их:<br>
            <input name="files[]" type="file" style="width:300px; padding:7px;" multiple>
            <br><br>
            Файлы можно загружать следующих форматов: *.jpg, *.jpeg, *.doc, *.docx, *.xls, *.xsls, *.xml, *.rar и т.п.<br>
            <span style="color:red">Запрещено загружать файлы следующих форматов: *.exe, *.php, *.asp, *.js, *.html</span>
            <br><br>
            <br>

				<?
				if (isset($_GET[id]))
				{
					$folder_img = "modul/katalog/upload/files/$id/";
					@$dir    = "modul/katalog/upload/files/$id/";
					@$files_img = scandir($dir);    
					$j=0;
					
					for ($i=0;$i<=30;$i++)
					{
						$file_n = $files_img[$i];
						if ($file_n!='' && $file_n!='.' && $file_n!='..' && $file_n!="Thumbs.db" && substr_count($file_n,'mini')==0) 
						{
							$num1 = "num='upload/files/$id/$file_n'";
							if (file_exists("modul/katalog/upload/files/$id/mini_$file_n")==true) {$num2 = "num2='upload/files/$id/mini_$file_n'";}
							
							echo "
							<div num='div$i'>
								<a href='#' class='popop del_file btn_del_file' num='upload/files/$id/$file_n' $num1 $num2 value='div$i'>[удалить]</a> 
								<a href='modul/katalog/upload/files/$id/$files_img[$i]' style='display:inline-block; color:#333' target='_blank'>
									$files_img[$i]
								</a>
							</div>";		
						}
					} 
				}
                ?>            
            
            
        </div>
        
        <div class="block3 block_contayner">
        
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:150px">Модуль</th>
    <th>Действие</th>
  </tr>
  <tr>
    <td>Выделить товар:</td>
    <td>
            <select name="stamp" class="form_add">
            	<option value="0" <? if ($myrow[stamp]=='0') {echo "selected";} ?>>нет</option>
                <option value="1" <? if ($myrow[stamp]=='1') {echo "selected";} ?>>да</option>
            </select>     
    </td>
  </tr>
  <tr>
    <td>Наличие:</td>
    <td>
            <select name="presence" class="form_add">
            	<option value="0" <? if ($myrow[presence]=='0') {echo "selected";} ?>>есть в наличии</option>
                <option value="1" <? if ($myrow[presence]=='1') {echo "selected";} ?>>под заказ</option>
                <option value="2" <? if ($myrow[presence]=='2') {echo "selected";} ?>>нет в наличии</option>
            </select>       
    </td>
  </tr>
  <tr>
    <td>Производитель:</td>
    <td>
         <select name="firm" class="form_add">
        	<option value="0"  <? if ($myrow[firm]=='0') {echo "selected";} ?>>нет</option>
            <?
            
				//запрос к базе
				$result_f = mysql_query("SELECT * FROM firms ORDER BY id DESC");
				$myrow_f = mysql_fetch_assoc($result_f); 
				$num_rows_f = mysql_num_rows($result_f);
				
				if ($num_rows_f!=0)
				{
					do
					{
						if ($myrow[firm]==$myrow_f[id]) {echo "<option value='$myrow_f[id]' selected>$myrow_f[name]</option>";}
						else {echo "<option value='$myrow_f[id]'>$myrow_f[name]</option>";}
					}while($myrow_f = mysql_fetch_assoc($result_f));
				}				
			?>                
        </select>    
    </td>
  </tr>
  <tr>
    <td>На складе:</td>
    <td><input name="count" type="text" size="5" value="<? if ($myrow[count]!="") echo $myrow[count]; ?>"> шт.</td>
  </tr> 
  <tr>
    <td>Скидка:</td>
    <td><input name="sale" type="text" size="2" value="<? if ($myrow[sale]!="") echo $myrow[sale]; ?>"> %</td>
  </tr>
  <tr>
    <td>Данные для почты:</td>
    <td>
            <div style="border-bottom:1px dashed #CCC; width:65px; display:inline-block; margin-bottom:3px">Вес:</div> <input name="weight" type="text" size="10" value="<? if ($myrow[weight]!="") echo $myrow[weight]; ?>"> гр.<br>
            <div style="border-bottom:1px dashed #CCC; width:65px; display:inline-block; margin-bottom:3px">Ширина:</div> <input name="width" type="text" size="10" value="<? if ($myrow[width]!="") echo $myrow[width]; ?>"> см.<br>
            <div style="border-bottom:1px dashed #CCC; width:65px; display:inline-block; margin-bottom:3px">Высота:</div> <input name="height" type="text" size="10" value="<? if ($myrow[height]!="") echo $myrow[height]; ?>"> см.<br>
            <div style="border-bottom:1px dashed #CCC; width:65px; display:inline-block; margin-bottom:3px">Длина:</div> <input name="length" type="text" size="10" value="<? if ($myrow[length]!="") echo $myrow[length]; ?>"> см.<br>    
    </td>
  </tr>
  
  
  <? if (isset($_GET[id])) { ?>
  <tr>
    <td>Отнести к категориям:</td>
    <td>
    
    <div class="box_name_kat_url_any">
        Категория: <input type="text" class="name_kat_url_any" placeholder="Название категории"/>
        <a href='#' class="popup add_url_any" num='' num2='<? echo $id; ?>'>добавить</a>
        
        <div class="box_list_kat">
            
        </div>
    
    </div>
    
    <div class="mainbox_link_url_any">
    <?
        
       if ($myrow[url_any]!=',')
       {
           $url_any = $myrow[url_any];
           $url_any = explode(",",$url_any);
           
           for ($i=0;$i<count($url_any);$i++)
           {
               $result_katalog = mysql_query("SELECT * FROM katalog WHERE id='$url_any[$i]' ORDER BY id ASC");
               $myrow_katalog = mysql_fetch_assoc($result_katalog);
               $num_rows_katalog = mysql_num_rows($result_katalog); 
               if ($num_rows_katalog!=0)
               {
                   echo "<div class='link_url_any link_url_any_$myrow_katalog[id]'>
                   <a href='#' class='popup del_url_any' num='$myrow_katalog[id]' num2='$id'>x</a> $myrow_katalog[name]
                   </div>";
               }
           }
       }  
    ?>
    </div>
    <br>
    <div style='font-size:11px'>В каких еще категориях будет отображаться данный товар.</div>   
    </td>
  </tr>
  <? } ?>
  
</table>
<br>

		<? include("modul/katalog/harakter_add_tovar.php"); ?>
       </div>
       
       
        <div class="block4 block_contayner"><? $host='goods'; include("blocks/key_desc.php"); ?></div>
        
        
        <div class="block5 block_contayner">
        	<div class="block5-text">
        	Для добавление к товару других товаров, которые могут быть интересны пользователю, введите данные в форму ниже и сделайте поиск.
        	</div>
        	
        	<div class="block5-search">
        		<input type="text" class="seach_goods_in_card" placeholder="Название товара, id или артикул"/>
        		<input type="button" value="найти" class="button_save btn_search_goods_withitem"/>
        		<div style="display: inline-block; margin-left:10px; padding-top:4px" class="ajax_div_search"></div>
        	</div>
        	
        	<Br>
        	<div class="box_search_goods">
        		
        	</div>
        	
        	<!--уже имеющиеся товары-->
        	<div class="box_search_goods2">
        		<?
        			if ($myrow['with_item']!='')
        			{
        				if (substr_count($myrow['with_item'], ",")!=0)
        				{
							$with_item = explode(",",$myrow['with_item']);
							
							for ($i=0;$i<count($with_item);$i++)
							{
								$with_item_new .= "id='".$with_item[$i]."' || ";
							}
							
							$with_item_new = substr($with_item_new,0,-4);
						}
						else
						{
							$with_item_new = "id=".$myrow['with_item'];
						}
        				
						$where_whis_item = "WHERE $with_item_new";
					}
					else
					{
						$where_whis_item = "WHERE 1=2";
					}
					
					
					//echo $where_whis_item."<Br>";
					$result_item = mysql_query("SELECT * FROM goods $where_whis_item");
					$myrow_item = mysql_fetch_assoc($result_item); 
					$num_rows_item = mysql_num_rows($result_item);

					if ($num_rows_item!=0)
					{
						do
						{
							if ($myrow_item[img]!='')
							{
								$img = "modul/katalog/upload/img/$myrow_item[img]";
							}
							else
							{
								$img = "img/no_img.jpg";
							}
							
							if ($myrow_item[url]!="") {$url=$myrow_item[url]."";} else {$url="";}
											
							echo "<div class='contaner_search_goods'>
								<div style='text-align:center'>
									<a href='?page=add_goods&url=$url&id=$myrow_item[id]' target='_blank'>
									<img src='$img' height='80' style='max-width:130px'>
									</a>
								</div>
								
								<a href='?page=add_goods&url=$url&id=$myrow_item[id]' target='_blank' class='contaner_search_goods-a_name'>
								$myrow_item[name]
								</a>
								
								<div align='center'>
								<a class='popup btn_contaner_search_goods_now_save btn_contaner_search_goods_h' num='$myrow_item[id]'>исключить</a>
								</div>
							</div>";
						}while($myrow_item = mysql_fetch_assoc($result_item));
					}				
        		?>
        	</div>
        	
        	<!--сюда помещаются id товаров для блока "с этим товаром покупают"-->
        	<input type="hidden" class="with_item" name="with_item" value="<? echo $myrow['with_item']; ?>"/>
        	
        	<Br><br>
        	После того, как Вы добавили или исключили товар из списка, необходимо произвести сохранение товара!
        </div>
      	
      	<Br>
        <div style="text-align:right">
            <a href="<? echo $_SERVER['HTTP_REFERER']; ?>" class="button_cancel">Отмена</a> 
            <input name="button" type="submit" value="сохранить" class="button_save button_save_main">
        </div>
    </div>
</div>
</form>