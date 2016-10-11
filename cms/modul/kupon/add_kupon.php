<link rel="stylesheet" type="text/css" href="modul/kupon/css.css">
<script type="text/javascript" src="modul/kupon/js.js"></script>

<?

$startdate = date("d.m.Y"); 
$enddate = strtotime("+30 day", strtotime(preg_replace('~^(\d+)\.(\d+)\.(\d+)$~', '$3-$2-$1', $startdate))); 
$enddate = date('d.m.Y',($enddate));
?>

<table width="100%" border="0" style="max-width:690px; line-height:26px" id="tbl_obj">
 <tr>
	<th style="width:30%">Добавить один купон</th>
    <th style="width:30%">Загрузить файл *.xls</th>
    <th style="width:40%">Сгенирировать купоны</th>
 </tr>
  <tr>
    <td style="padding:10px; width:30%; font-size:11px">
    	<form action="modul/kupon/obr_kupon.php" method="post">
        	Номер:<br>
            <input name="name" type="text" size="30"><br>
            Действует до:<br>
            <input name="date_end" type="text" size="30" value="<? echo $enddate; ?>"><br>
            Фирма (Биглион, Групон и т.п.):<br>
            <input name="firm" type="text" size="30"><br>            
            <input name="button" type="submit" value="сохранить" class="button_save">
        </form>
    </td>
    <td style="padding:10px; width:30%; font-size:11px">
    	<form action="modul/kupon/obr_kupon.php" method="post" enctype="multipart/form-data">
        	Выберите файл:<br>
            <input name="file" type="file"><br>
            <input type="hidden" name="file_upload" value="1">
            <input name="button" type="submit" value="сохранить" class="button_save">
        </form>    
        
        <div style="line-height:18px; margin-top:13px">
        <b>Формат содержимого файла:</b><br>
		Купон | Фирма | Действует до<br>
        Купон | Фирма | Действует до<br>
        Купон | Фирма | Действует до
        </div>
    </td>
    <td style="padding:10px; width:40%; font-size:11px">
    	<form action="modul/kupon/obr_kupon.php" method="post">
        Сгенирировать:<br>
        <input name="num" type="text" size="10" value="10"> купонов<br>
        Действуют до:<br>
        <input name="date_end" type="text" size="30" value="<? echo $enddate; ?>"><br>
        Фирма (Биглион, Групон и т.п.):<br>
        <input name="firm" type="text" size="30"><br>             
        <input name="button" type="submit" value="генирировать" class="button_save">
        </form>
    </td>
  </tr>
</table>
