
<?
include("modul/settings/shifr_pass.php");

$result = mysql_query("SELECT * FROM settings");
$myrow = mysql_fetch_assoc($result); 

?>

<form action="modul/settings/obr_config_magazin.php" method="post">
<div style="border-bottom:1px dotted #CCC; width:250px; display:inline-block">Стоимость доставки:</div>
<input name="price_dostavka" type="text" value="<? echo $myrow[price_dostavka]; ?>"> рублей<br>
<div style="border-bottom:1px dotted #CCC; width:250px; display:inline-block; margin-top:15px">Бесплатная доставка от </div>
<input name="price_dostavka_null" type="text" value="<? echo $myrow[price_dostavka_null]; ?>"> рублей<br>

<input name="button" type="submit" value="сохранить" class="button_save"> 
</form>


<Br><Br><Br>
<div style="margin-bottom: 13px;">Данные для Робокассы</div>

<form action="modul/settings/obr_robokassa.php" method="post">
<div style="border-bottom:1px dotted #CCC; width:150px; display:inline-block">mrh_login:</div>
<input name="mrh_login" type="text" value="<? echo get_pass($myrow[mrh_login]); ?>" required><br>

<div style="border-bottom:1px dotted #CCC; width:150px; display:inline-block; margin-top:15px">mrh_pass1:</div>
<input name="mrh_pass1" type="text" value="<? echo get_pass($myrow[mrh_pass1]); ?>" required><br>

<div style="border-bottom:1px dotted #CCC; width:150px; display:inline-block; margin-top:15px">mrh_pass2:</div>
<input name="mrh_pass2" type="text" value="<? echo get_pass($myrow[mrh_pass2]); ?>" required><br>

<input name="button" type="submit" value="сохранить" class="button_save"> 
</form>