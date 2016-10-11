<link rel="stylesheet" type="text/css" href="modul/zadaniy/css.css">
<script type="text/javascript" src="modul/zadaniy/js.js"></script>

<?php


$id = f_data ($_GET[id], 'text', 0);



$result = mysql_query("SELECT * FROM zadaniy WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
echo "<div class='history'><a href='?page=zadaniy' style='color:#5587ae'>Задания</a> > $myrow[name]</div><br>";


$text = $myrow[text];

$date_do = $myrow[date1];
if ($date_do!='') {$date_do = "Срок выполнения до: <span>$myrow[date1]</span>";}

$bujet = $myrow[bujet];
if ($bujet!='') {$bujet = "Бюджет: <span>$myrow[bujet] руб</span>";}

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
    $user = "<a href='?page=user_inf&id=$myrow_u[id]' target='_blank' class='boxZadach-ispol' style='display:block'>Создал: $myrow_u[phone]</a>";
}

?>



<form action="modul/zadaniy/obr_zadaniy.php" method="post" enctype="multipart/form-data" class='frmZadaniy'>
    <input type='hidden' name='edit' value="<? echo $myrow[id]; ?>">
    
    <div class='frmLineZadaniy'><span>Название:</span> <input name="name" type="text" value="<? echo $myrow[name]; ?>"/></div>
    <div class='frmLineZadaniy'><span>Сделать до:</span> <input name="date_do" type="text" value="<? echo $myrow[date1]; ?>"/></div>
    <div class='frmLineZadaniy'><span>Бюджет:</span> <input name="bujet" type="text" value="<? echo $myrow[bujet]; ?>"/></div>
    <div class='frmLineZadaniy'><span>Город:</span> <input name="city" type="text" value="<? echo $myrow[city]; ?>"/></div>
    <div class='frmLineZadaniy'><span>Имя пользователя:</span> <input name="fakeName" type="text" value="<? echo $myrow[fakeName]; ?>"/></div>
    
    
    <div class='frmLineZadaniy'>Описание:</div>
    <textarea name="text"><? echo $myrow[text]; ?></textarea>
    
    <div class='frmLineZadaniy'>Категория:</div>
    <select name="cat">
        <option>Не знаю</option>
        <?
            $result_cat = mysql_query("SELECT * FROM napravlenie ORDER BY name DESC");
            $myrow_cat = mysql_fetch_assoc($result_cat); 
            $num_rows_cat = mysql_num_rows($result_cat);

            if ($num_rows_cat!=0)
            {
            	do
            	{
                    if ($myrow[cat]==$myrow_cat[name]) {$sel='selected';} else {$sel='';}
            		echo "<option $sel>$myrow_cat[name]</option>";
            	}while($myrow_cat = mysql_fetch_assoc($result_cat));
            }
        ?>
    </select>
    <br><br>
    <div class='frmLineZadaniy'>Статус:</div>
    <select name="enabled">
        <option value="1" <? if ($myrow[enabled]=='1') {echo "selected";} ?>>Активный</option>
        <option value="0" <? if ($myrow[enabled]=='0') {echo "selected";} ?>>Неактивный</option>
    </select>
    
    <Br><br>
    <input name="button" type="submit" value="сохранить" class="button_save button_save_main">
</form>

<? echo $user; ?>


