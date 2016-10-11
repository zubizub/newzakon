<script type="text/javascript" src="modul/katalog/js.js"></script>

<?
$history = $_GET[url];
$where_url = "WHERE url='$_GET[url]'";
if (substr_count($history,"/")>0)
{
	$history = explode("/",$_GET[url]);
	
	for ($i=0; $i<count($history); $i++)
	{
		$result_his = mysql_query("SELECT * FROM katalog WHERE id='$history[$i]'");
		$myrow_his = mysql_fetch_assoc($result_his); 	
		if ($myrow_his[url]!="") {$back_url = "$myrow_his[url]/$myrow_his[id]";} else {$back_url = "$myrow_his[id]";}	
		$new_history .= "<a href='?page=katalog&url=$back_url'>$myrow_his[name]</a> > ";	
	}
	
	$new_history = substr($new_history,0,-2);
	$history = "<a href='?page=katalog'>Главная категория</a> > $new_history";			
}
else
{
	$result_his = mysql_query("SELECT * FROM katalog WHERE id='$_GET[url]'");
	$myrow_his = mysql_fetch_assoc($result_his); 
	$history = "<a href='?page=katalog'>Главная категория</a> > <a href='?page=katalog&url=$_GET[url]'>$myrow_his[name]</a>";					
}


echo "<div class='history'>$history $name_edit_page</div><Br>";

if (isset($_GET[id]))
{
	//запрос к базе
	$id = f_data ($_GET[id], 'text', 0);
	$result = mysql_query("SELECT * FROM katalog WHERE id='$id'");
	$myrow = mysql_fetch_assoc($result); 
	$num_rows = mysql_num_rows($result);
	$m_title = $myrow[m_title];
	$m_description = $myrow[m_description];
	$m_keywords = $myrow[m_keywords];
	$m_link = $myrow[m_link];
}

?>

<form action="modul/katalog/obr_add_folder_katalog.php" method="post" enctype="multipart/form-data" name="form_news">
<?
	if (isset($_GET[id]))
	{
		echo "<input type='hidden' name='edit' value='$id'>";	
	}
	
	if (isset($_GET[url]))
	{
		echo "<input type='hidden' name='url' value='$_GET[url]'>";	
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
							$img = "modul/katalog/upload/img/$myrow[img]";
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
                        <div>Название:</div> <input name="name" type="text" class="name" required value="<? echo $myrow[name]; ?>"><br>
                        <div>Изображение:</div> <input name="img" type="file"><br>
                        <label style="margin-top:5px"><input name="enabled" type="checkbox" value=""  <? if ($myrow[enabled]==1 || !isset($_GET[id])) echo "checked"; ?>> 
                        показывать категорию</label> 
                        | 
                        Характеристики:
                         <select name="har" class="form_add">
                            <option value="0"  <? if ($myrow[har]=='0') {echo "selected";} ?>>нет</option>
                            <?
                            
                                //запрос к базе
                                $result_h = mysql_query("SELECT * FROM goods_harakteristiki ORDER BY id DESC");
                                $myrow_h = mysql_fetch_assoc($result_h); 
                                $num_rows_h = mysql_num_rows($result_h);
                                
                                if ($num_rows_h!=0)
                                {
                                    do
                                    {
                                        if ($myrow[har]==$myrow_h[id]) {echo "<option value='$myrow_h[id]' selected>$myrow_h[name]</option>";}
                                        else {echo "<option value='$myrow_h[id]'>$myrow_h[name]</option>";}
                                    }while($myrow_h = mysql_fetch_assoc($result_h));
                                }				
                            ?>
                        </select>                             
                        
                    </div>
                </td>
              </tr>
            </table>
             <div class="editor_div">
                <textarea name="text" cols="30" style="width:100%; height:250px" class="moxiecut"><? echo $myrow[text]; ?></textarea>
            </div>       
        </div>
        
    
  		<?
  			$url_cat='';
  			
  			if (isset($_GET[url]))
  			{
  				if (substr_count($_GET[url],'/')==0)
  				{
					$url_cat=$_GET[url];
				}
				else
				{
					$url_car_exp = explode('/',$_GET[url]);
					
					for ($i=0;$i<count($url_car_exp);$i++)
					{
						$url_cat.=$url_car_exp[$i]."-";
					}
					
					$url_cat = substr($url_cat,0,-1);
				}
				
				$url_cat = "/$url_cat";
				
			}
  		?>
        <div class="block4 block_contayner"><?  $host="katalog$url_cat"; include("blocks/key_desc.php"); ?></div>
        
        <div style="text-align:right">
            <a href="<? echo $_SERVER['HTTP_REFERER']; ?>" class="button_cancel">Отмена</a> 
            <input name="button" type="submit" value="сохранить" class="button_save button_save_main">
        </div>
    </div>
</div>
</form>