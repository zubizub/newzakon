<link rel="stylesheet" type="text/css" href="modul/news/css.css">
<script type="text/javascript" src="modul/news/js.js"></script>



<form action="" method="get">
    �������� ���������: 
    <input name="katalog_arhiv" type="text"  value=""> 
    <input name="button" type="submit" value="���������">
</form>
<br><br>

<table width="400" border="0" id="tbl_obj">
  <tr>
    <th>��������</th>
    <th style="width:55px"></th>
    <th style="width:55px"></th>
  </tr>
  
<?
//������ � ����
$result = mysql_query("SELECT * FROM katalog_arhiv ORDER BY id ASC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);


if ($num_rows!=0)
{
	do
	{
		echo "
		  <tr>
			<td>$myrow[name]</td>
			<td><a href='?page-arhiv'>��������</a></td>
			<td style='text-align:center'><a href='#' style='color:red' class='del_news1 popop' num='$myrow[id]'>�������</a></td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "
		  <tr>
			<th colspan='3'>��������� ���</th>
		  </tr>  		
		";	
}

?>

</table>
