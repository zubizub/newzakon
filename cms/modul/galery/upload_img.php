
<?
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
$i=0;


if($_FILES['img']['size']>0) {		
		foreach ($_FILES[img][tmp_name] as $key => $value)
		{	
			$name_file = $_FILES[img][name][$key];
			$date = date("H:m d.m.Y");
			$ext = substr($name_file, 1 + strrpos($name_file, "."));
			@chmod ("upload/img/".$name_file, 0775);
			$img_name = md5($name_file.$date.rand(0,999999)).".$ext";
			copy($value, "upload/img/".$img_name);
			$url_img = "upload/img/".$img_name;
			//$url_img2 = "upload/img/111".$img_name;
			$url_mini_img = "upload/img/mini_".$img_name;	
			resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);	

						
			$table = "<table width='100%' border='0' class='img_list'><tr><td style='width:200px; vertical-align:top'><img src='modul/galery/upload/img/mini_".$img_name."' height='100' style='max-width:200px'></td><td>Описание:<br><textarea name='description$i'></textarea><input type='hidden' name='img$i' value='$img_name'></td></tr></table><br>";
			
			echo'
				<script type="text/javascript">
				var elm=parent.window.document.getElementById("result");
				elm.innerHTML=elm.innerHTML+"<br />'.$table.'";
				</script>
			';			
			$i++;
		}
		
		echo'
			<script type="text/javascript">
			var elm=parent.window.document.getElementById("result");
			elm.innerHTML=elm.innerHTML+"'."<a href='?page=galery_img' class='button_cancel' style='margin-right:13px !important;'>Отмена</a><input name='button' type='submit' value='сохранить' class='button_save'>  ".'";
			</script>
			';				
}


?>

