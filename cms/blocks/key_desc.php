<div class="meta_div">
Заголовок страницы <span style="font-size:11px; color:#333">[всего набрано <span class="m1">0</span> символов]</span><br>
<input name="m_title" type="text" class='pole_chek m_title' num="1" value="<? echo $m_title; ?>"><br><br>
Описание <span style="font-size:11px; color:#333">[всего набрано <span class="m2">0</span> символов]</span><br>
<textarea name="m_description" cols="" rows="" class='pole_chek m_description' num="2"><? echo $m_description; ?></textarea><br><br>
Ключевые слова <span style="font-size:11px; color:#333">[всего набрано <span class="m3">0</span> символов]</span><br>
<textarea name="m_keywords" cols="" rows="" class='pole_chek m_keywords' num="3"><? echo $m_keywords; ?></textarea><br><br>
Символьная ссылка <span style="font-size:11px; color:#333">[всего набрано <span class="m4">0</span> символов]</span><br>
<?
$m_link = explode("/",$m_link);
$m_link = $m_link[(count($m_link)-1)];

?>

<? 
if ($host!='') {$host="/".$host;} else {$host="";}

echo $_SERVER[HTTP_HOST].$host; 

?>/<input name="m_link" type="text" class='pole_chek pr_kirill m_link' num="4" style="width:140px" value="<? echo $m_link; ?>">
<input type="hidden" name="url_m_link" value="<? echo $_SERVER[HTTP_HOST].$host; ?>">
<Br><Br>

<label style="font-size: 14px; color: #4172A7">
	<input type="checkbox" class="checkbox_frost_chpu" <? if ($_GET[id]) {echo 'num="1" checked';} else {echo 'num="0"';} ?>/> заморозить ЧПУ
</label>
</div>