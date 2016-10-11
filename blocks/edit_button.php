<?

//полоса изменения страницы и мета данных страницы, полоса меню фиксированна в верхней части страницы

$page = $_GET[page];
$page = f_data ($page, 'text', 0);

if ($page=='')
{
	$url_edit = "/cms/?page=add_pages&url=1&id=1";
}
else
{
	if ($page=='o-nas') {$url_edit = "/cms/?page=add_pages&url=1&id=2";}
	else if ($page=='kontakty') {$url_edit = "/cms/?page=add_pages&url=1&id=3";}
	else if ($page=='katalog' && !isset($_GET[url])) {$url_edit = "/cms/?page=katalog";}
	else if ($page=='katalog' && isset($_GET[url])) {$url_c = str_replace("-", "/", $_GET[url]); $url_edit = "/cms/?page=katalog&url=$url_c";}
	else if ($page=='goods') 
	{
		$result = mysql_query("SELECT * FROM goods WHERE id='$_GET[id]'");
		$myrow = mysql_fetch_assoc($result); 		
		$url_edit = "/cms/?page=add_goods&url=$myrow[url]&id=$_GET[id]";
	}	
	else if ($page=='news' && !isset($_GET[id])) {$url_edit = "/cms/?page=news";}
	else if ($page=='news_inf' && isset($_GET[id])) {$url_edit = "/cms/?page=add_news&id=$_GET[id]";}
	else if ($page=='galery' && !isset($_GET[id])) {$url_edit = "/cms/?page=galery";}
	else if ($page=='galery' && isset($_GET[id])) {$url_c = str_replace("-", "/", $_GET[url]); $url_edit = "/cms/?page=galery_img&id=$_GET[id]";}		
	else if ($page=='article') {$url_edit = "/cms/?page=materials&url=$_GET[url]";}
	else if ($page=='feedback') {$url_edit = "/cms/?page=obr_svyz";}
	else if ($page=='vopros_otvet') {$url_edit = "/cms/?page=vopros_otvet";}
	else if ($page=='otziv') {$url_edit = "/cms/?page=otziv";}
	else
	{
		$id = f_data ($_GET[id], 'text', 0);
		$page = f_data ($_GET[page], 'text', 0);
		$result = mysql_query("SELECT * FROM pages WHERE id='$id' || m_link='$page'");
		$myrow = mysql_fetch_assoc($result); 
		$url_edit = "/cms/?page=add_pages&url=$myrow[url]&id=$myrow[id]";
	}
}


?>

<div class="edit_button">
	<a href="/cms/" target="_blank" rel="nofollow">[CMS]</a>
	<a href="<? echo $url_edit; ?>" target="_blank" rel="nofollow">редактировать страницу</a>
	<? if ($block_edit_meta==0) { ?><a href="#" target="_blank" rel="nofollow" num="<? echo $url_edit; ?>" class="popup show_meta_form">МЕТА</a> <? } ?>
</div>


<div class="box_meta_form">
	<div class="title_form_meta">МЕТА - ТЕГИ</div>
	<form action="/blocks/obr_meta_form.php" method="post">
		<div class="name_pole_frm_meta">Заголовок</div>
		<input type="text" name="title" placeholder="Заголовок" class="title_meta_frm" required value="<?php echo $title; ?>"/>
		
		<div class="name_pole_frm_meta">Название страницы</div>
		<input type="text" name="name" placeholder="Название страницы" required value="<?php echo $name_page; ?>"/>
		
		<div class="name_pole_frm_meta">ЧПУ</div>
		<input type="text" name="m_link" class='m_link' placeholder="ЧПУ" required value="<?php echo $m_link; ?>" <? if ($chpu==1) {echo "disabled";} ?>/>
		
		<label>
		<input type="checkbox" class="chek_translit_meta" num="<?php echo $m_link; ?>" <? if ($chpu==1) {echo "disabled";} ?>/> транслитирировать
		</label>
		
		<div class="name_pole_frm_meta">Описание</div>
		<textarea name="desc" placeholder="Описание" required><?php echo $description; ?></textarea>
		
		<div class="name_pole_frm_meta">Ключевые слова</div>
		<textarea name="keywords" placeholder="Ключевые слова"><?php echo $keywords; ?></textarea>
		
		<div style="text-align: center">
		<input type="submit" value="сохранить" class="btn_save_meta"/>
		<input type="button" value="отмена" class="btn_cancel_meta"/>
		<input type="hidden" name="tbl" value="<?php echo $tbl; ?>"/>
		<input type="hidden" name="tbl_where" value="<?php echo $tbl_where; ?>"/>
		</div>
	</form>
</div>