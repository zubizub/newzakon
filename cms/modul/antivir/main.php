<link rel="stylesheet" type="text/css" href="modul/antivir/css.css">
<script type="text/javascript" src="modul/antivir/js.js"></script>

јнтивирус провер€ет наличие подозрительных JS файлов, наличие в них iframe, провер€ет основные php файлы на наличие вредоносного кода. 
<br>
<a href="#" class="popup scan_vir button_save">«апустить проверку</a>

<br><br>


<div class="inf_div" style="font-size:12px"></div>

<br><br>
<div style="font-size:11px">
<?

		$result = mysql_query("SELECT * FROM signature");
		$myrow = mysql_fetch_assoc($result); 
		$vir = "";
		
		do
		{
			echo "<b>C$myrow[id]</b> $myrow[name]<br>";
		}while($myrow = mysql_fetch_assoc($result));	


?>

</div>