<link rel="stylesheet" type="text/css" href="modul/antivir/css.css">
<script type="text/javascript" src="modul/antivir/js.js"></script>

��������� ��������� ������� �������������� JS ������, ������� � ��� iframe, ��������� �������� php ����� �� ������� ������������ ����. 
<br>
<a href="#" class="popup scan_vir button_save">��������� ��������</a>

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