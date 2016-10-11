<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>

<?
//запрос к базе
$result = mysql_query("SELECT * FROM moduls ORDER BY id ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		if ($myrow[enabled]==1) {$ch="checked"; $ch_val=1;} else {$ch=""; $ch_val=0;}
		echo "<div class='div_modul'><label><input name='modul' type='checkbox' value='$myrow[id]' class='ch_modul' $ch num='$ch_val'> $myrow[name]</label>
		<span class='span_ch s_ch_$myrow[id]'>сохранено</span></div>";
	}while($myrow = mysql_fetch_assoc($result));
}

?>
