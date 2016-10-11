<div style="min-height:700px; position:relative">
<?
//файловый менеджер
$zip = new ZipArchive;
?>

<script type="text/javascript" src="modul/filemanager/js.js"></script>
<link rel="stylesheet" type="text/css" href="modul/filemanager/css.css">

<?

	if (isset($_GET[to_url])) 
	{
		$to_url = $_GET[to_url];
		if (substr_count($to_url,'-7-') != 0) 
		{
			$to_url_new = explode('-7-',$to_url); 
			$to_url = "";
			for ($i=0; $i<count($to_url_new); $i++)
			{
				$to_url .= $to_url_new[$i]."/"; //путь для функции scandir
				$to_url_link .= $to_url_new[$i]."-7-"; //для ссылки для значния num
				if ($i==count($to_url_new)-2) {$back_url = substr($to_url_link,0,-3);} //для возвращения на предыдущий уровень
			}
		}
		else
		{
			$to_url_link = $_GET[to_url]."-7-";
			$to_url .= '/';
		}
	} 
	else {$to_url='';}
	
	if ($back_url=="") {$back_url="";} else {$back_url="&to_url=$back_url";}

?>

<table width="100%" border="0" style="margin-top:10px; margin-bottom:10px;">
  <tr>
    <td><? echo "$_SERVER[DOCUMENT_ROOT]/$to_url"; ?></td>
    <td style="text-align:right">
    	<div class="menu_fmanager">
        	<a href="#" title="создать новый документ" onClick="pop_fmanager1('Название нового документа','1')">
        		<img src="modul/filemanager/img/m_new.png" height="40">
        	</a>
        	
            <a href="#" title="создать новый каталог" onClick="pop_fmanager1('Название нового каталога','2')">
            	<img src="modul/filemanager/img/m_new_folder.png" height="40">
            </a>
            
            <a href="#" style="opacity:0.4" title="редактировать" onClick="pop_fmanager1('Редактирование названия','3')">
            	<img src="modul/filemanager/img/m_edit.png" height="40">
            </a>
            
            <a href="#" class="up_menu_fm" style="opacity:0.4" title="настроить" onClick="pop_fmanager1('Настройка прав','4')">
            	<img src="modul/filemanager/img/m_settings.png" height="40">
            </a>
            
            <a href="#" class="up_menu_fm" style="opacity:0.4" title="удалить" onClick="pop_fmanager1('Удаление файла или каталога','5')">
            	<img src="modul/filemanager/img/m_del.png" height="40">
            </a>
            
            <a href="#" style="margin-left:13px; opacity:0.4" title="распаковать архив" onClick="pop_fmanager1('Распаковать архив','6')">
            	<img src="modul/filemanager/img/m_rar.png" height="40" class="img_enabl">
            </a>
            
            <a href="#" class="up_menu_fm" style="margin-right:13px; opacity:0.4" title="запаковать архив" onClick="pop_fmanager1('Запаковать архив','7')">
            	<img src="modul/filemanager/img/m_rar_in.png" height="40">
            </a>
            
            <a href="#" class="up_menu_fm" style="opacity:0.4" title="копировать" onClick="copyFile()">
            	<img src="modul/filemanager/img/m_copy.png" height="40">
            </a>
            
            <a href="#" style="opacity:0.4" title="вставить" onClick="pastFile('<? echo $_GET[to_url]; ?>','<? echo "$_SERVER[DOCUMENT_ROOT]/$to_url"; ?>')">
            	<img src="modul/filemanager/img/m_past.png" height="40">
            </a>
            
            <a href="#" style="opacity:1; margin-left:13px; margin-right:5px" title="загрузить на сервер" onClick="pop_fmanager1('Загрузить файл на сервер','8')">
            	<img src="modul/filemanager/img/m_upload.png" height="40">
            </a>
            
            <a href="#" style="opacity:0.4" title="скачать" class="m_download_file">
            	<img src="modul/filemanager/img/m_download.png" height="40">
            </a>
        </div>
    </td>
  </tr>
</table>


<table width="100%" border="0" class="tbl_main tbl_filemanager">
  <tr num='off'>
  	<th style='width:10px'><input type='checkbox' class='check_fm_all' num='all'/></th>
    <th>Имя</th>
    <th style="width:50px">Права</th>
    <th style="width:70px">Размер (Кб)</th>
    <th style="width:110px !important; text-align:right">Дата изменения</th>
  </tr>
  <tr num='off'>
    <td style="text-decoration:underline; font-weight:bold" colspan="4"><a href="?page=fmanager" style='display:block; color:#333; text-decoration:none'>на главную</a></td>
  </tr>
  <tr num='off'>
    <td style="text-decoration:underline; font-weight:bold" colspan="4"><a href="?page=fmanager<? echo $back_url; ?>" style='display:block; color:#333; text-decoration:none'>вверх</a></td>
  </tr>
<?
function get_files($stok,$to_url,$to_url_link)
{
	$url_dir = $_SERVER['DOCUMENT_ROOT'];
	$dir = "$url_dir/$to_url";
	$files = @scandir($dir);
	$chet_tr=0; //четная строка
	
	if ($files!=false)
	{
		for ($i=0; $i<count($files); $i++)
		{	
			$name_file = $files[$i];
			$img='';
			$img_select=0;
			
			//определяем сортировку (сначала папки потом файлы)
			if ($stok=='folder') 
			{
				if (is_dir("$dir/$name_file")==true) {$enabl=1;} else {$enabl=0;}
			} 
			else 
			{
				if (is_dir("$dir/$name_file")!=true) {$enabl=1;} else {$enabl=0;}
			}
			
			if ($name_file!='..' && $name_file!='.' && $enabl==1)
			{
				$stat = stat("$dir/$name_file"); //статистика дирректории
				$date_edit =  date ("d.m.Y H:i:s", filemtime("$dir/$name_file")); //время последнего изменения файла
				$prava = substr(sprintf('%o', fileperms("$dir/$name_file")), -4); //права на файл или каталог
				
				if (is_dir("$dir/$name_file")==true) {$img = "<img src='modul/filemanager/img/folder.png' height='13'>"; $img_select=1;}
				
				if (substr_count($name_file,'.doc')!=0 || substr_count($name_file,'.docx')!=0 || substr_count($name_file,'.txt')!=0) 
				{$img = "<img src='modul/filemanager/img/doc.png' height='13'>"; $img_select=1;}
				
				if (substr_count($name_file,'.rar')!=0 || substr_count($name_file,'.zip')!=0) 
				{$img = " <img src='modul/filemanager/img/arhiv.png' height='13'>"; $img_select=1;}
				
				if (substr_count($name_file,'.html')!=0 || substr_count($name_file,'.php')!=0 || substr_count($name_file,'.js')!=0) 
				{$img = "<img src='modul/filemanager/img/internet_file.png' height='13'>"; $img_select=1;}
				
				if ($img_select!=1) {$img = "<img src='modul/filemanager/img/doc.png' height='13'>";}
				////////////////////////////////////////
				

				echo "
				  
				  <tr num='$to_url$name_file' name='$name_file' class='tr_$i' num2='tr_$i' num_shetnost='$chet_tr'>
				  	<td><input type='checkbox' class='check_fm check_fm_$i' num='$files[$i]' num2='$i'/></td>
					<td>";
					if ($stok=='folder')
					{
						echo "<a href='#' class='name_file' onclick='return false' num='$to_url_link$files[$i]' value='folder' prava='$prava' name='$name_file'>$img $name_file</a>";
					}
					else
					{
						echo "<a href='#' class='name_file' onclick='return false' num='$to_url_link$files[$i]' value='file' name='$name_file' prava='$prava'>$img $name_file</a>";
					}
					
				echo "</td>
				  <td>$prava</td>
					<td>$stat[size]</td>
					<td style='text-align:right; width:140px !important;'>$date_edit</td>
				  </tr>";
				  
				//четность элементов
				if ($chet_tr==0) {$chet_tr=1;} else {$chet_tr=0;}  
			}
		}
	}
}

get_files("folder", $to_url,$to_url_link);
get_files("file", $to_url,$to_url_link);
?>

</table>


<div class="pop_fmanager1">
	<div style="position:relative">
        <div class="pop_fmanager_head">gedgerg</div>
        <div class="pop_fmanager_content">
        	<form action="modul/filemanager/obr_obj.php" method="post" enctype="multipart/form-data">
            	<span class='title_box'>Название</span>
                <input name="file" type="file" style="display:none" class="w_file">
            	<input name="name" type="text" class="w_name"> 
                <input name="button" type="submit" value="подтвердить" class="btn_box">
                <div style="display:none;">
                	<input type="hidden" name="w_type" class="w_type" value="">
                    <input type="hidden" name="w_method" class="w_method" value="">
                    <input type="hidden" name="w_old_name" class="w_old_name" value="">
                    <input type="hidden" name="w_url" class="w_url" value="<? echo "$_SERVER[DOCUMENT_ROOT]/$to_url"; ?>">
                    <input type="hidden" name="w_to_url" class="w_to_url" value="<? echo "$_GET[to_url]"; ?>">
                    <input type="hidden" name="real_url" class="real_url" value="<? echo "$to_url"; ?>">
                    <input type="hidden" name="files" class="files_url" value="">
                    <input type="hidden" name="folder" class="folder_url" value="">
                </div>
            </form>
        </div>
        <a href="#" class="close_windows">X</a>
    </div>
</div>

    <div class="box_edit">
    <div class="title_file"></div>
    <textarea name="text" style="height:80%" class="box_edit_text"></textarea>
    <input name="button" type="button" value="сохранить" onClick="saveFile()">
    <input type="hidden" name="url_file_input" class="url_file_input" value="">
    <a href="#" class="close_windows_edit popup" style="color:red; position:absolute; bottom:10px !important; right:10px; text-decoration:none">X закрыть</a>
    </div>


</div>

