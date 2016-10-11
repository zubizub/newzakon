<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>

<?
if (isset($_GET[prodlit]))
{
	$result_edit = mysql_query("UPDATE settings SET date_domain='".date("d-m-Y")."', date_host='".date("d-m-Y")."'", $db);	
	echo "<script>window.location.href = '?page=domain&msg=Данные продлены!'</script>";	
}

if (isset($_POST[date_host]))
{
	$date_domain = f_data ($_POST[date_domain], 'text', 0);
	$date_host = f_data ($_POST[date_host], 'text', 0);

	if (isset($_POST[domain_other])) {$domain_other=1;} else {$domain_other=0;}
	if (isset($_POST[host_other])) {$host_other=1;} else {$host_other=0;}
	
	$result_edit = mysql_query("UPDATE settings SET date_domain='$date_domain', date_host='$date_host',domain_other='$domain_other', host_other='$host_other'", $db);	
	echo "<script>window.location.href = '?page=domain&msg=Настройки сохранены!'</script>";
}

$result_d = mysql_query("SELECT * FROM settings");
$myrow_d = mysql_fetch_assoc($result_d); 

if ($myrow_d[date_domain]!='' && $myrow_d[domain_other]!='')
{
	$d_domain = $myrow_d[date_domain];
	$d_host = $myrow_d[date_host];
	$ostatok_day_domain = time()-mktime(0,0,0,$d_domain[3].$d_domain[4],$d_domain[0].$d_domain[1],substr($d_domain,-4));
	$ostatok_day_domain = round($ostatok_day_domain/(60*60*24));
	
	$ostatok_day_host = time()-mktime(0,0,0,$d_host[3].$d_host[4],$d_host[0].$d_host[1],substr($d_host,-4));
	$ostatok_day_host = round($ostatok_day_host/(60*60*24));	
?>

<div class="inf_domain">
	Домен заканчивается через: <span style="color:#06C"><? echo 365-$ostatok_day_domain; ?></span> дней<br>
    Хостинг заканчивается через <span style="color:#06C"> <? echo 365-$ostatok_day_host; ?> </span> дней<br>
    <a href="?page=domain&prodlit" class="button_cancel">продлить всё</a>
</div>

<?

}
else
{
?>

<form action="" method="post"  class="inf_domain">

Дата регистрации домена: <input name="date_domain" type="text" size="10" style="padding:6px; width:130px; margin-bottom:4px; margin-left:5px"> (12-12-2012)<br>
<label><input name="domain_other" type="checkbox" value=""> домен заказчика</label><br><br>

Дата регистрации хостинга: <input name="date_host" type="text" size="10" style="padding:6px; width:130px"> (12-12-2012)<br>
<label><input name="host_other" type="checkbox" value=""> хостинг заказчика</label><br>
<br>
<input name="button" type="submit" value="сохранить" class="button_save">
</form>


<? } 

if ($N_USER=="AntiBuger")
{
?>	
<form action="" method="post"  class="inf_domain">

Дата регистрации домена: <input name="date_domain" type="text" size="10" style="padding:6px; width:130px; margin-bottom:4px; margin-left:5px"> (12-12-2012)<br>
<label><input name="domain_other" type="checkbox" value=""> домен заказчика</label><br><br>

Дата регистрации хостинга: <input name="date_host" type="text" size="10" style="padding:6px; width:130px"> (12-12-2012)<br>
<label><input name="host_other" type="checkbox" value=""> хостинг заказчика</label><br>
<br>
<input name="button" type="submit" value="сохранить" class="button_save">
</form>
	
<?	
}

?>


