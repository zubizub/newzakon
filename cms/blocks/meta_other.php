<?

$result_m = mysql_query("SELECT * FROM meta_other WHERE page='$page'");
$myrow_m = mysql_fetch_array($result_m); 

$name_page = $myrow_m[m_name]; 
$m_title = $myrow_m[m_title];
$m_description = $myrow_m[m_description];
$m_keywords = $myrow_m[m_keywords];

?>

<form action="blocks/obr_meta_other.php" method="post" style="font-size:12px; margin-top:15px" class="meta_other_form">
<div style="background-color:#dadada; color:#333; text-align:center; padding:5px; text-align:center; font-weight:bold; font-size:13px; margin:-5px; margin-bottom:10px">Meta-данные</div>
<div class="meta_div">
Заголовок страницы <span style="font-size:11px; color:#333">[всего набрано <span class="m1">0</span> символов]</span><br>
<input name="m_title" type="text" class='pole_chek m_title' num="1" value="<? echo $m_title; ?>"  style="width:410px;"><br><br>
Название страницы <br>
<input name="m_name" type="text" class='m_name' num="1" value="<? echo $name_page; ?>"  style="width:410px;"><br><br>
Описание <span style="font-size:11px; color:#333">[всего набрано <span class="m2">0</span> символов]</span><br>
<textarea name="m_description" class='pole_chek m_description' num="2" style="width:410px; height:30px"><? echo $m_description; ?></textarea><br><br>
Ключевые слова <span style="font-size:11px; color:#333">[всего набрано <span class="m3">0</span> символов]</span><br>
<textarea name="m_keywords" class='pole_chek m_keywords' num="3"  style="width:410px; height:30px"><? echo $m_keywords; ?></textarea><br><br>
<input type="hidden" name="page" value="<? echo $page; ?>">
</div>

<input name="button" type="submit" value="сохранить" class="button_save">
</form>