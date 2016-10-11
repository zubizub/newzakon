<link rel="stylesheet" type="text/css" href="modul/katalog/css.css">
<script type="text/javascript" src="modul/katalog/js.js"></script>

<?	
	if (isset($_GET['id']))
	{
		$id = f_data ($_GET[id], 'text', 0);
		@$result = mysql_query("SELECT * FROM firms WHERE id='$id'");
		@$myrow = mysql_fetch_array($result); 	

		$name = $myrow['name'];
		$description = $myrow['description'];
		if ($myrow['img']=="")
		{
			$img = "/img/no_img2.png";
		}
		else
		{
			$img = "modul/katalog/upload/img/img_proizvoditel/".$myrow['img'];
		}
	}

?>

<div style="padding:7px; background-color:#467bb5; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px; max-width:756px;">Добавление производителя</div>
<div style="border:1px solid #2B91D2; max-width:768px; background-color:#f5fafd">
    <form action="modul/katalog/obr_firms.php" method="post" name="form_viborka" enctype="multipart/form-data">
    <table width="50%" border="0">
      <tr>
        <td style="width:80px; padding:9px">Производитель:
        <input name="firm" type="text" size="40" style="width:250px" value="<? if (isset($name)) {echo $name;} ?>"></td>
        <td rowspan="2" style="padding:9px">
         Описание: <br><textarea name="description"  style="width:300px; height:95px"><? if (isset($description)) {echo $description;} ?></textarea><br>
         <div align="right" style="margin-top:9px">
         <? if (isset($_GET['id'])) { ?> <a href="?page=goods_firms" class="button_cancel">Отмена</a> <? } ?>
         <input name="button" type="submit" value="<? if (!isset($_GET['id'])) {echo "добавить производителя";} else {echo "сохранить изменения";}?>" style="padding:8px" class="button_save">
         </div>
        </td>
        <td width="346" rowspan="2" style="padding:9px">
       	<? 
		if (isset($img)) 
		{echo "<img src='$img' height='120' style='border:1px solid #999; max-width:130px'>";} 
		?>
        </td>
      </tr>
      <tr>
        <td style="width:150px; padding:9px">Изображение:
        	<input name="img_firm" type="file" style="width:250px"><br>        
             <? 
			if (isset($img)) 
			{echo "<span style='color:red; font-size:12px'>Что бы изменить изображение выберите его!</span>";} 
			?>           
            </td>
      </tr>
    </table>
    
    <? if (isset($_GET['id'])) {echo "<input type='hidden' name='edit' value='$id'>";} ?>
   
     
    </form>
 </div>   
    
    <br>
<div style="padding:7px; background-color:#467bb5; color:#FFF; font-weight:bold; border-radius:3px 3px 0px 0px; font-size:13px">Производители</div>
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:180px; text-align:center;">Название</th>
    <th style="text-align:left">Описание</th>
    <th style="width:65px"></th>
    <th style="width:55px"></th>
  </tr>
<?
	$result = mysql_query("SELECT * FROM firms");
	$myrow = mysql_fetch_array($result);  
	
	if (mysql_num_rows($result)>0)
	{
		do
		{			
		echo "
			  <tr>
				<td style='text-align:left;'>$myrow[name]</td>
				<td style='text-align:left'>$myrow[description]</td>
				<td style='text-align:center;'><a href='?page=goods_firms&id=$myrow[id]' style='margin-right:5px' class='edit_link'>изменить</a></td>
				<td style='text-align:center;'><a href='#' style='margin-right:5px' class='del_firm popop del_link' num='$myrow[id]'>удалить</a></td>
			  </tr>		
		";			
		}while($myrow = mysql_fetch_array($result));
	}
	else
	{
		echo "<br> Производителей еще не добавленно!";	
	}

?>    

</div>

</table>
<script type="application/javascript">

	function view_inf(id)
	{
		$(".inf_"+id).slideToggle();	
	}

</script>