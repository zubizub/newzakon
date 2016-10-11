<link rel="stylesheet" type="text/css" href="modul/galery/css.css">
<script type="text/javascript" src="modul/galery/js.js"></script>
<script type="text/javascript" src="modul/galery/ajax_upload_img.js"></script>

<?

if (isset($_GET[pages])) {$pages=ceil(($_GET[pages]-1)*28);} else {$pages=0;}
$id = f_data ($_GET[id], 'text', 0);

//запрос к базе
$result = mysql_query("SELECT * FROM galery_img WHERE cat='$_GET[id]' ORDER BY id DESC LIMIT $pages,28");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

//запрос к базе
$result_cat = mysql_query("SELECT * FROM galery_cat WHERE id='$myrow[cat]'");
$myrow_cat = mysql_fetch_assoc($result_cat); 

$history = "<a href='?page=galery'>Главная категория</a> > $myrow_cat[name]";					

echo "<div class='history'>$history</div>";

?>



<form id="test_form" method="post" enctype="multipart/form-data" onSubmit="">
	Выберите файлы для загрузки <input class="file_form" type="file" name="img[]" multiple accept="image/jpeg,image/png,image/gif"/>
    <div onclick="SendFile();" class="button_save" >загрузить</div><br>
    <div style="font-size:12px; color:red">Не рекомендуем выбирать более 10 файлов. Размер загружаемого фала не должен привышать 1Мб.</div>
</form>
<br />
<form action='modul/galery/obr_add_img.php' method='post'>
<div id="result"><img src='/img/preloader.gif' width='50' height='50' class='preloader' style="display:none"></div><br /><br />
<input type="hidden" name="cat" value="<? echo $_GET[id]; ?>">

</form>


<?


if ($num_rows!=0)
{	
	do
	{
		echo "<div class='galery_block'>
		<a href='modul/galery/upload/img/$myrow[url]' rel='example_group' class='popup fancybox' title='$myrow[description]'><img src='modul/galery/upload/img/mini_$myrow[url]' height='130' style='max-width:190px'></a>
		<a href='#' class='edit_img_galery' onClick='edit_img_galery($myrow[id])'>изменить</a>
		<a href='#' class='del_img_galery popup' num='$myrow[id]'>удалить</a>
		<div class='edit_div_$myrow[id] edit_div' style='display:none'>
		<form action='modul/galery/obr_add_img.php' method='post'>
		<textarea name='description' style='width:172px; height:74px; margin-left:-6px'>$myrow[description]</textarea>
		<input name='button_cancel' type='button' value='отмена' onClick='close_edit($myrow[id])' class='button_cancel'> 
		<input name='button' type='submit' value='сохранить' class='button_save'>
		<input type='hidden' name='cat' value='$id'>
		<input type='hidden' name='edit' value='$myrow[id]'>
		</form>
		</div>
		</div>";
	}while($myrow = mysql_fetch_assoc($result));
}

?>
<br><br>
<div>
<?
	
	$result = mysql_query("SELECT * FROM galery_img WHERE cat='$id'");
	$num_rows = mysql_num_rows($result);
	include("blocks/number_pages.php");
	pages_number($num_rows,"?page=galery_img&id=$id",28);
?>
</div>
<br>
<div align="right">
<? echo "Всего изображений <b>$num_rows</b>"; ?>
</div>
<br>

<script type="text/javascript">

function close_edit(id)
{
	$(".edit_div_"+id).fadeOut();
}


function edit_img_galery(id)
{
	$(".edit_div_"+id).fadeIn();
}


function SendFile() {
	if ($(".file_form").val()!="")
	{
		$(".button_save").html("ждите...");
		$(".preloader").fadeIn();
		//отправка файла на сервер
		$$f({
			formid:'test_form',//id формы
			url:'modul/galery/upload_img.php',//адрес на серверный скрипт который будет принимать файл
			onstart:function () {//действие при начале загрузки файла
				//$$('result','начинаю отправку файла');//в элемент с id="result" выводим результат
			},
			onsend:function () {//действие по окончании загрузки файла
				
				$$('result',$$('result').innerHTML);//в элемент с id="result" выводим результат
				$(".preloader").fadeOut();
				$(".button_save").html("загрузить");
			}
		});
	}
	else
	{
		alert('Выберите сначала файл!');	
	}
}
</script>