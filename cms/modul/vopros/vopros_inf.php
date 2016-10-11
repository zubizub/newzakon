<link rel="stylesheet" type="text/css" href="modul/vopros/css.css">
<script type="text/javascript" src="modul/vopros/js.js"></script>

<?php


$id = f_data ($_GET[id], 'text', 0);
$id_vopros = $id;
$result = mysql_query("SELECT * FROM vopros WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
echo "<div class='history'><a href='?page=vopros' style='color:#5587ae'>Вопросы</a> > $myrow[name]</div><br>";


$text = $myrow[text];

$cat = $myrow[cat];
if ($cat!='Не знаю') {$cat = "$myrow[cat]";} else {$cat = '';}

$city = '';
if ($myrow[city]!='')
{
    $city = "| $myrow[city]";
}


$user = "";
if ($myrow['uid']!='')
{
    $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]' ORDER BY id DESC");
    $myrow_u = mysql_fetch_assoc($result_u); 
    $user = "<a href='?page=user_inf&id=$myrow_u[id]' target='_blank' class='boxZadach-ispol' style='display:block'>Создал: $myrow_u[name]</a>";
}

?>



<form action="modul/vopros/obr_vopros.php" method="post" enctype="multipart/form-data" class='frmZadaniy'>
    <input type='hidden' name='edit' value="<? echo $myrow[id]; ?>" id="id">
    
    <div class='frmLineZadaniy'><span>Название:</span> <input name="name" type="text" value="<? echo $myrow[name]; ?>"/></div>
    <div class='frmLineZadaniy'><span>Город:</span> <input name="city" type="text" value="<? echo $myrow[city]; ?>"/></div>
    <div class='frmLineZadaniy'><span>Имя пользователя:</span> <input name="fakeName" type="text" value="<? echo $myrow[fakeName]; ?>"/></div>
    
    
    <div class='frmLineZadaniy'>Описание:</div>
    <textarea name="text"><? echo $myrow[text]; ?></textarea>

    <div class='frmLineZadaniy'>Категория:</div>
    <select name="cat" class="cat_type">
        <option>Не знаю</option>
        <?
            $result_cat = mysql_query("SELECT * FROM napravlenie ORDER BY name ASC");
            $myrow_cat = mysql_fetch_assoc($result_cat); 
            $num_rows_cat = mysql_num_rows($result_cat);
            
            if ($num_rows_cat!=0)
            {
            	do
            	{
                    if ($myrow[cat]==$myrow_cat[name]) {$sel='selected'; $name_c = $myrow_cat[name];} else {$sel='';}
            		echo "<option $sel>$myrow_cat[name]</option>";
            	}while($myrow_cat = mysql_fetch_assoc($result_cat));
            }
        ?>
    </select>
    <? //echo $name_c; ?>
    <br><br>
    <div class='frmLineZadaniy'>Подкатегория: <img src="/img/add_cart.gif" class='progr_type' /></div>
    <select name="type" class="type_list">
        <option>Не знаю</option>
        <?
            $result_f = mysql_query("SELECT * FROM folder_materials WHERE name='$name_c' ORDER BY name DESC");
            $myrow_f = mysql_fetch_assoc($result_f); 
            
            $result_type = mysql_query("SELECT * FROM pages WHERE url='85/$myrow_f[id]' ORDER BY name ASC");
            $myrow_type = mysql_fetch_assoc($result_type); 
            $num_rows_type = mysql_num_rows($result_type);

            if ($num_rows_type!=0)
            {
                do
                {
                    if ($myrow[type]==$myrow_type[name]) {$sel='selected';} else {$sel='';}
                	echo "<option $sel>$myrow_type[name]</option>";
                }while($myrow_type = mysql_fetch_assoc($result_type));
            }
        ?>
    </select>
    
    <br><br>
    <div class='frmLineZadaniy'>Статус:</div>
    <select name="enabled">
        <option value="1" <? if ($myrow[enabled]=='1') {echo "selected";} ?>>Активный</option>
        <option value="0" <? if ($myrow[enabled]=='0') {echo "selected";} ?>>Неактивный</option>
    </select>
<br/>
    <input type='hidden' name='vopsosId' id='vopsosId' value="">
    <a href="javascript:void(0);" id='override'>Опубликовать принудительно!</a>
    
    <Br><br>
    <input name="button" type="submit" value="сохранить" class="button_save button_save_main">
</form>

<? echo $user; ?>


<Br><Br>
Комментарии
<Br><Br>
<?
$result_vc = mysql_query("SELECT * FROM vopros_comment WHERE id_vopros='$id_vopros' ORDER BY id DESC");
$myrow_vc = mysql_fetch_assoc($result_vc); 
$num_rows_vc = mysql_num_rows($result_vc);

if ($num_rows_vc!=0)
{
	do
	{
        
        $result_u = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]' ORDER BY id DESC");
        $myrow_u = mysql_fetch_assoc($result_u); 
        $fio = $myrow_u[fio];
        
		echo "
            <div class='boxVoprosComment'>
                <div class='boxVoprosComment-text'>$myrow_vc[text]</div>
                <div class='boxVoprosComment-podval'><a href='?page=user_inf&id=$myrow_u[id]' target='_blank'>$fio</a> $myrow_vc[date]</div>
                <div class='boxDelComment'><a href='/cms/modul/vopros/obr_comment.php?del=$myrow_vc[id]&vopros=$_GET[id]' class='delComment'>удалить</a></div>
            </div>
        ";
	}while($myrow_vc = mysql_fetch_assoc($result_vc));
}



?>


