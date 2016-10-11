<script type="text/javascript" src="modul/materials/js.js"></script>

<?


if (isset($_GET[id]))
{
	//запрос к базе
	$id = f_data ($_GET[id], 'text', 0);
	$result = mysql_query("SELECT * FROM folder_materials WHERE id='$id'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	$m_title = $myrow[m_title];
	$m_description = $myrow[m_description];
	$m_keywords = $myrow[m_keywords];
	$m_link = $myrow[m_link];
}



$url_g = f_data ($_GET[url], 'text', 0);
$id_g = f_data ($_GET[id], 'text', 0);

$history = $url_g;
$where_url = "WHERE url='$url_g'";
if (substr_count($history,"/")>0)
{
	$history = explode("/",$url_g);
	
	for ($i=0; $i<count($history); $i++)
	{
		$result_h = mysql_query("SELECT * FROM folder_materials WHERE id='$history[$i]'");
		$myrow_h = mysql_fetch_assoc($result_h); 	
		if ($myrow_h[url]!="") {$back_url = "$myrow_h[url]/$myrow_h[id]";} else {$back_url = "$myrow_h[id]";}	
		$new_history .= "<a href='?page=materials&url=$back_url'>$myrow_h[name]</a> > ";	
	}
	
	$new_history = substr($new_history,0,-2);
	$history = "<a href='?page=materials'>Главная категория</a> > $new_history";			
}
else
{
	$result_h = mysql_query("SELECT * FROM folder_materials WHERE id='$url_g'");
	$myrow_h = mysql_fetch_assoc($result_h); 
	$history = "<a href='?page=materials'>Главная категория</a> > <a href='?page=materials&url=$url_g'>$myrow_h[name]</a>";					
}

echo "<div class='history'>$history $name_edit_page</div>";



?>

<form action="modul/materials/obr_add_folder_materials.php" method="post" enctype="multipart/form-data" name="form_news">
<input type="hidden" name="url_back" value="<? echo $_SERVER[HTTP_REFERER]; ?>"/>
<?
	if (isset($_GET[id]))
	{
		echo "<input type='hidden' name='edit' value='$id'>";	
	}
	
	if (isset($_GET[url]))
	{
		$url = f_data ($_GET[url], 'text', 0);
		echo "<input type='hidden' name='url' value='$url'>";	
	}	
?> 
<div id="main_inf_block">
    <div id="menu_center">
        <a href="#" class="name_link1 menu_center_a_enabl name_link" style="margin-left:0px" num='1'>Категория </a>
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
							$img = "modul/materials/upload/img/$myrow[img]";
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
                        <div>Изображение:</div> <input name="img" type="file"><br>
                        <label style="margin-top:5px"><input name="enabled" type="checkbox" value=""  <? if ($myrow[enabled]==1 || !isset($_GET[id])) echo "checked"; ?>> 
                        показывать категорию</label> 
                    </div>
                </td>
              </tr>
              
        
        
            </table>
                  		 <div class="editor_div">
                <textarea name="article" cols="30" style="width:100%; height:250px" class="moxiecut"><? echo $myrow[article]; ?></textarea>
            </div>
        </div>
        
    
  
        <div class="block4 block_contayner"><?  $host='material'; include("blocks/key_desc.php"); ?></div>
        
        <div style="text-align:right">
            <a href="?page=" class="button_cancel">Отмена</a> 
            <input name="button" type="submit" value="сохранить" class="button_save">
        </div>
    </div>
</div>
</form>