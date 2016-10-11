<link rel="stylesheet" type="text/css" href="modul/rassilka/css.css">
<script type="text/javascript" src="modul/rassilka/js.js"></script>

<? $page_g = f_data ($_GET[page], 'text', 0); ?>

<table width="100%" border="0">
  <tr>
    <td style="font-size:12px">
    	<form action="modul/rassilka/obr_zayvki.php" method="post">
        	Добавить подписчика: 
            имя: <input name="name" type="text" style="width:200px; padding:3px; margin-right:13px"> 
            e-mail: <input name="mail" type="text" style="width:130px; padding:3px;">
            <input name="button" type="submit" value="сохранить" class="button_save" style="margin-top:0px; padding:4px; margin-left:6px; font-size:11px; border-radius: 4px;">
        </form> 
        
        <Br>
        <div class="box_link_import_user">
        <img src="img/users.png"/>
        <a href="#" class="popup btn_import_users"> импортировать всех пользователей</a>
        </div>
    </td>
    <td style="text-align:right;">
    	<form action="" method="get">
        	<input type="hidden" name="page" value="<? echo $page_g; ?>">
            <input name="search" type="text" class="text_pole" value="поиск..."> 
            <input name="button" type="submit" value="найти">
        </form>
    </td>
  </tr>
</table>

<div style="margin-top:5px; margin-bottom:5px; border-bottom:1px dotted #999"></div>

<a href="#" class="popup open_msg button_save" onClick="open_msg()">Показать окно сообщения</a>
<div style="display:none; background-color:#fdffe5; border:1px dotted #CCC; padding:10px;" class="block_msg">
<form action="modul/rassilka/obr_zayvki.php" method="post" style="width:600px">
    Тема: <input name="sub" type="text" style="width:360px; padding:3px;" required><br><br>
    Сообщение<br>
    <textarea name="text" style="width:98%; height:250px" required></textarea><br>
    <a href="#" class="button_cancel" onClick="close_msg()">Отмена</a>  
    <input name="button" type="submit" value="отправить всем пользователям" class="button_save" style="">
    
    <input type="hidden" name="rassilka">
</form>
</div>
<br>
<?
	if (isset($_GET[search]))
	{
		$search = f_data ($_GET[search], 'text', 0);
		
		$sql_search = "WHERE name LIKE '%$search%' || mail LIKE '%$search%'";	
		echo "<a href='?page=rassilka' style='color:#60a6ee'>Вернуться к подпищикам</a> | Вы искали: <b>$search</b><br><br>";
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


<a href="#" class="link_del button_cancel" style="display:none; margin-bottom:10px">Удалить выбраные</a>
<br>
<table width="100%" border="0" id="tbl_obj">
  <tr>
    <th style="text-align:center; width:30px"><a href="?page=<? echo $page_g.$search_url; ?>&sort=<? echo $n_sort; ?>" style="color:inherit">№</a></th>
    <th style="text-align:left"><a href="?page=<? echo $page_g.$search_url; ?>&sort=<? echo $fio_sort; ?>" style="color:inherit">ФИО</a></th>
    <th style="width:150px">e-mail</th>
    <th style="width:100px">дата</th>
    <th style="width:65px"></th>
    <th style="width:25px"><input name="all_chek" id="all_chek" type="checkbox" value=""></th>
  </tr>
  
<?
//запрос к базе
if (isset($_GET[sort]) && $_GET[sort]=='fio_up') {$sort="name ASC";}
elseif (isset($_GET[sort]) && $_GET[sort]=='fio_down') {$sort="name DESC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_up') {$sort="id  ASC";} 
elseif (isset($_GET[sort]) && $_GET[sort]=='n_down') {$sort="id DESC";} 
else {$sort="id DESC";}

$pages_g = f_data ($_POST[pages], 'text', 0);
if (isset($_GET[pages])) {$pages=$pages_g*30;} else {$pages=0;}

$result = mysql_query("SELECT * FROM rassilka $sql_search ORDER BY $sort LIMIT $pages,30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		echo "
		  <tr>
			<td style='text-align:center'>$myrow[id]</td>
			<td>$myrow[name]</td>
			<td>$myrow[mail]</td>
			<td>$myrow[date]</td>
			<td style='text-align:center'><a href='#' style='color:red' class='del_zayvki1 popop del_link' num='$myrow[id]'>удалить</a></td>
			<td style='text-align:center'><input name='obj_chek[]' class='obj_chek' type='checkbox' value='$myrow[id]'></td>
		  </tr>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "
		  <tr>
			<th colspan='8'>Подпищиков нет</th>
		  </tr>  		
		";	
}

?>

</table>

<a href="#" class="link_del button_cancel" style="display:none">Удалить выбраные</a>
<br><br>




<?
	$result = mysql_query("SELECT * FROM rassilka");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=rassilka",30);
?>


	
<script>
var msg=0;
function open_msg()
{
	if (msg==0) 
	{$(".block_msg").css("display","inline-block"); msg=1; $(".open_msg").css("display","none");} 
	else {$(".block_msg").css("display","none"); msg=0;}
}

function close_msg()
{
	$(".block_msg").css("display","none"); msg=0; $(".open_msg").css("display","inline-block");
}
</script>



<br>
<br>
<div style="font-size:10px; text-align:justify">
1. Распространение рекламы по сетям электросвязи, в том числе посредством использования телефонной, факсимильной, подвижной радиотелефонной связи, допускается только при условии предварительного согласия абонента или адресата на получение рекламы. При этом реклама признается распространенной без предварительного согласия абонента или адресата, если рекламораспространитель не докажет, что такое согласие было получено. Рекламораспространитель обязан немедленно прекратить распространение рекламы в адрес лица, обратившегося к нему с таким требованием.<br>
2. Не допускается использование сетей электросвязи для распространения рекламы с применением средств выбора и (или) набора абонентского номера без участия человека (автоматического дозванивания, автоматической рассылки).
<br>
<b>P.S. Реальные штрафы за рассылку спама составляют около 10 000 рублей на физ лицо и 500 000 рублей на юр лицо. УФАС очень активно занимается этим вопросом во всех регионах России.</b>
</div>
