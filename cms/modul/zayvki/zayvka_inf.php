<link rel="stylesheet" type="text/css" href="modul/zayvki/css.css">
<script type="text/javascript" src="modul/zayvki/js.js"></script>

<a href="?page=zayvki" style="color:#999; text-decoration:none" class="back">< Заявки</a>

<?
//запрос к базе
$result = mysql_query("SELECT * FROM zayvki WHERE id='$_GET[id]'");
$myrow = mysql_fetch_assoc($result); 
if ($myrow[enabled]==0) {$status="на обработке";} else {$status="выполнен";}
?>

<div class="form_inf">
    <p><div>Статус</div> <span><? echo $status; ?> </span></p>
    <p><div>№</div> <span><? echo $myrow[id]; ?> </span></p>
    <p><div>ФИО</div> <span><? echo $myrow[fio]; ?></span></p>
    <p><div>Телефон</div> <span><? echo $myrow[phone]; ?></span></p>
    <p><div>E-mail</div> <span><? echo $myrow[mail]; ?></span></p>
    <p><div>Дата</div> <span><? echo $myrow[date]; ?></span></p>
    <p><div>Источник</div> <span><? echo $myrow[type]; ?></span></p>
    <p><div>IP</div> <span><? echo $myrow[ip]; ?></span></p>
</div>

<br><span style="font-size:12px; font-weight:bold; display:inline-block">Дополнительная информация</span><br>
<span style="font-size:12px; font-weight:normal">
<form action="modul/zayvki/obr_zayvki.php" method="post">
	<textarea name="text" cols="70" rows="10"><? echo $myrow[text]; ?></textarea>
    <br><input name="button" type="submit" value="сохранить" class="button_save">
    <input type="hidden" name="edit" value="<? echo $myrow[id]; ?>">
</form>
</span><br>  


<? if ($myrow[address]!='') { ?>

<br><span style="font-size:12px; font-weight:bold; display:inline-block">Адрес</span><br>
<span style="font-size:12px; font-weight:normal"><? echo $myrow[address]; ?></span><br><br>   

<? } ?>