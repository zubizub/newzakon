<link rel="stylesheet" type="text/css" href="modul/settings/css.css">
<script type="text/javascript" src="modul/settings/js.js"></script>


<a href="?page=users" style="color:#999; text-decoration:none" class="back">< пользователи</a>

<?
$id_g = f_data ($_GET[id], 'text', 0);
$result = mysql_query("SELECT * FROM users WHERE id='$id_g'");
$myrow = mysql_fetch_assoc($result); 
if ($myrow[img]!='') {$img="img/users/$myrow[img]";} else {$img="img/users/no_photo.png";}
?>


<div class="form_users">
<table width="100%" border="0">
  <tr>
    <td style="width:200px;">
    <img src="<? echo $img; ?>" width="180"><br>
    <a href='?page=add_users&id=<? echo $id_g; ?>' style="display:block; font-size:16px; color:#F00; text-align:center; margin-top:10px">изменить</a>
    </td>
    <td>
    	<?
        	if ($myrow[podtverjdenie]==1) {$podtverjdenie="<spna style='color:green'>подтверждено</span>";} else 
			{$podtverjdenie="<spna style='color:red'>не подтверждено</span>";}
		?>
        <p><div>Логин</div> <span><? echo $myrow[name]; ?> | <span style="font-style:italic; font-size:12px; color:#F00; display:inline-block !important; width:100px"><? echo $myrow[status]; ?></span></span> </p>
        <p><div>ФИО</div> <span><? echo $myrow[fio]; ?></span></p>
        <p><div>Дата рождения</div> <span><? echo $myrow[data_rojden]; ?></span></p>
        <p><div>Телефон</div> <span><? echo $myrow[phone]; ?></span></p>
        <p><div>E-mail</div> <span><? echo $myrow[mail]; ?></span></p>
        <br><span style="font-size:12px; font-weight:bold; display:inline-block">Дополнительная информация</span>
        <? if ($myrow[text]!='') { ?><span style="font-size:12px; font-weight:normal;"><? echo $myrow[text]; ?></span><br><br> <? } ?>
        <p><div>Зарегистрирован</div> <span><? echo $myrow[date_reg]; ?></span></p> 
        <p><div>Заказов</div> <span><? echo $myrow[orders]; ?></span></p>
        <p><div>Подтверждение</div> <span><? echo $podtverjdenie; ?></span></p>
    </td>
  </tr>
</table>


</div>


<Br><Br>

<?

$result_user_comp = mysql_query("SELECT * FROM company_users WHERE uid='$myrow[uid]'");
$myrow_user_comp = mysql_fetch_assoc($result_user_comp); 
$num_rows = mysql_num_rows($result_user_comp);

if ($num_rows!=0)
{
	echo "<div style='margin-bottom:10px'><b>Данные организации</b></div>";
	
?>

<table width="100%" style="max-width: 800px; font-size: 12px; line-height: 20px">
	<tr>
		<td style="width: 50%">
			<?
				echo "
				<b>Название</b> $myrow_user_comp[name]<Br>
				<b>Адрес</b> $myrow_user_comp[address]<Br>
				<b>Директор</b> $myrow_user_comp[direktor]<Br>
				<b>Основание</b> $myrow_user_comp[osnovanie]<Br>
				
				<b>ИНН</b> $myrow_user_comp[inn] | 
				<b>КПП</b> $myrow_user_comp[kpp] | 
				<b>ОКАТО</b> $myrow_user_comp[okato]<Br>";
			?>
		</td>
		<td style="width: 50%">
			<?
				echo "<b>Банк</b> $myrow_user_comp[bank_name]<Br> 
				<b>Город</b> $myrow_user_comp[bank_city]<Br>
				<b>БИК</b> $myrow_user_comp[bik] <Br>
				<b>Рас. счет</b> $myrow_user_comp[raschet_schet] <Br>
				<b>Кор. счет</b> $myrow_user_comp[kor_schet]<Br>";
			?>
		</td>
	</tr>
</table>

<?
}


?>




