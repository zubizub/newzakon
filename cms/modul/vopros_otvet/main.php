<link rel="stylesheet" type="text/css" href="modul/vopros_otvet/css.css">
<script type="text/javascript" src="modul/vopros_otvet/js.js"></script>

<?
	$page_g = f_data ($_GET[page], 'text', 0);
?>

<table width="100%" border="0">
  <tr>
    <td>
    	
    </td>
    <td style="text-align:right;">
    	<form action="" method="get">
        	<input type="hidden" name="page" value="<? echo $page_g; ?>">
            <input name="search" type="text" class="text_pole" value="�����..."> 
            <input name="button" type="submit" value="�����">
        </form>
    </td>
  </tr>
</table>

<?
	if (isset($_GET[search]))
	{
		$search = trim($_GET[search]);
		$sql_search = "WHERE name LIKE '%$search%' || text LIKE '%$search%' || mail LIKE '%$search%' || otvet LIKE '%$search%'";	
		echo "<a href='?page=vopros_otvet' style='color:#60a6ee'>��������� � �������</a> | �� ������: <b>$search</b><br><br>";
		$search_url="&search=$search";
	}
	else
	{
		$sql_search = "";
	}
	
	if ($_GET[sort]!="fio_up") {$fio_sort="fio_up";} else {$fio_sort="fio_down";}
	if ($_GET[sort]!="type_up")  {$type_sort="type_up";} else {$type_sort="type_down";}
	if ($_GET[sort]!="n_up")  {$n_sort="n_up";} else {$n_sort="n_down";}
?>

<br>
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="width:30px">�������</th>
    <th style="text-align:center; width:30px"><a href="?page=<? echo $page_g.$search_url; ?>&sort=<? echo $n_sort; ?>" style="color:inherit">�</a></th>
    <th style="text-align:left"><a href="?page=<? echo $page_g.$search_url; ?>&sort=<? echo $fio_sort; ?>" style="color:inherit">���</a></th>
    <th style="width:150px">e-mail</th>
    <th style="width:100px">����</th>
    <th style="width:65px"></th>
  </tr>
  
<?
//������ � ����
if (isset($_GET[sort]) && $_GET[sort]=='fio_up') {$sort="name ASC";}
elseif (isset($_GET[sort]) && $_GET[sort]=='fio_down') {$sort="name DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='type_up') {$sort="type ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='type_down') {$sort="type DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_up') {$sort="id  ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_down') {$sort="id DESC";} 
else {$sort="id DESC";}

$pages_g = f_data ($_GET[pages], 'text', 0);
if (isset($_GET[pages])) {$pages=$pages_g*30;} else {$pages=0;}

$result = mysql_query("SELECT * FROM vopros_otvet $sql_search ORDER BY $sort LIMIT $pages,30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		$enabled = $myrow['enabled']; //���������� �������
		if ($enabled==1) {$enabled="<img src='img/enabled.png' height='20' class='button_enabl' num='0' value='$myrow[id]'>";} 
		else {$enabled="<img src='img/disabled.png' height='20' class='button_enabl' num='1' value='$myrow[id]'>";}
		if ($myrow[otvet]=='') {$otvet_button = "<a href='#' class='popup' style='color:#4f7ee8' onClick='open_otvet($myrow[id])'>��������</a>";} 
		else {$otvet_button="<b>- $myrow[otvet]</b>";}
		
		echo "
		  <tr>
			<td style='text-align:center'>$enabled</td>
			<td style='text-align:center'>$myrow[id]</td>
			<td>
				<a href='../?page=vopros_otvet&id=$myrow[id]#a$myrow[id]' style='color:#333' target='_blank'>$myrow[name]</a>
				<div style='font-size:11px'><i>$myrow[text]</i></div>
				$otvet_button
				<div class='otvet_$myrow[id] otvet_div' style='display:none'>
					<form action='modul/vopros_otvet/obr_zayvki.php' method='post'>
						<textarea name='text' cols='65' rows='10'></textarea>
						<div style='margin-top:10px'>
							<input name='button' type='button' value='��������' onClick='close_otvet()' class='button_cancel'>
							<input name='button' type='submit' value='���������' style='margin-left:10px' class='button_save'>
						</div>
						<input type='hidden' name='id' value='$myrow[id]'>
					</form>
				</div>
			</td>
			<td>$myrow[mail]</td>
			<td>$myrow[date]</td>
			<td style='text-align:center'><a href='#' class='del_zayvki1 popop del_link' num='$myrow[id]'>�������</a></td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "
		  <tr>
			<th colspan='8'>������� ���</th>
		  </tr>  		
		";	
}

?>

</table>
<br>
<?
	$result = mysql_query("SELECT * FROM vopros_otvet");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=vopros_otvet",30);
?>

<br><br>
<div class="oboznach">
	<img src="img/disabled.png" height="12">  ������ ��������� <img src="img/enabled.png" height="12">  ������ �������
</div>

<script>

	function open_otvet(id)
	{
		$(".otvet_div").css("display","none");	
		$(".otvet_"+id).css("display","block");	
	}

	function close_otvet()
	{
		$(".otvet_div").css("display","none");		
	}

</script>