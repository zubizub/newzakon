<link rel="stylesheet" type="text/css" href="modul/otziv/css.css">
<script type="text/javascript" src="modul/otziv/js.js"></script>

<?
$page_g = f_data ($_GET[page], 'text', 0);
?>

<table width="100%" border="0">
  <tr>
    <td>
    	
    </td>
    <td style="text-align:right;">
    	<form action="" method="get" class="frm_search_small">
        	<input type="hidden" name="page" value="<? echo $page_g; ?>">
            <input name="search" type="text" class="frm_search_small" placeholder="�����..." required> 
            <input name="button" type="submit" value="�����">
        </form>
    </td>
  </tr>
</table>


<Br><Br>
<?
	$edit = f_data ($_GET[id], 'text', 0);
	$result_otz = mysql_query("SELECT * FROM otziv WHERE id='$edit'");
	$myrow_otz = mysql_fetch_assoc($result_otz);
?>
<div class="frm_add_otziv">
	<form action="modul/otziv/obr_otziv.php" method="post" enctype="multipart/form-data">
		<div><? if (!isset($_GET[id])) {echo "���������� ������";} else {echo "�������������� ������";} ?></div>
		<? if (isset($_GET[id])) {echo "<input type='hidden' name='edit' value='$edit'/>";}  ?>
        <span>���: </span> <input name="name" type="text" placeholder="" required value="<? echo $myrow_otz[name]; ?>" /><Br>
        <span>����: </span> <input name="date" type="text" placeholder="" required value="<? if (isset($_GET[id])) {echo $myrow_otz[date];} else {echo date("H:i d.m.Y");} ?>" /><Br>
        <span>E-mail: </span> <input name="mail" type="text" placeholder="" value="<? echo $myrow_otz[mail]; ?>" /><br>
        <span>����:</span> <input name="img" type="file" accept="image/*,image/jpeg"><br>
        
        <span style="display: block">�����: </span>
        <textarea name="text"><? echo $myrow_otz[text]; ?></textarea><Br>
        <input name="button" type="submit" value="���������">
    </form>
</div>


<Br><Br>

<?
	if (isset($_GET[search]))
	{
		$search = f_data ($_GET[search], 'text', 0);
		
		$sql_search = "WHERE name LIKE '%$search%' || text LIKE '%$search%' || mail LIKE '%$search%'";	
		echo "<a href='?page=otziv' style='color:#60a6ee'>��������� � �������</a> | �� ������: <b>$search</b><br><br>";
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
    <th style="text-align:center; width:50px">����</th>
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

$result = mysql_query("SELECT * FROM otziv $sql_search ORDER BY $sort LIMIT $pages,30");
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
        
        if ($myrow[img]!='') 
        {
            $img="<a href='/img/otziv/$myrow[img]' rel='example_group' class='popup fancybox'>
            <img src='/img/otziv/$myrow[img]' width='50'/>
            </a>";
        } 
        else 
        {
            $img="���";
        }        
        
		echo "
		  <tr>
			<td style='text-align:center'>$enabled</td>
			<td style='text-align:center'>$myrow[id]</td>
            <td style='text-align:center'>$img</td>
			<td>
				<a href='?page=otziv&id=$myrow[id]' style='color:#333'>$myrow[name]</a>
				<div style='font-size:11px'>$myrow[text]<Br><b>ip:</b> $myrow[ip]</div>
			</td>
			<td>$myrow[mail]</td>
			<td>$myrow[date]</td>
			<td style='text-align:center'><a href='#' class='del_zayvki1 popup del_link' num='$myrow[id]'>�������</a></td>
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
	$result = mysql_query("SELECT * FROM otziv");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=otziv",30);
?>

<br><br>
<div class="oboznach">
	<img src="img/disabled.png" height="12">  ����� ��������� <img src="img/enabled.png" height="12">  ����� �������
</div>
<Br>