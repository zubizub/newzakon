<?
// комментарии для товаров или новостей или страниц
?>

<? $id = f_data($_GET[id],'text',0); $uid = f_data($_GET[uid],'text',0); ?>

<div id="comments">
	<div class="title_form">Введите свой комментарий</div>
	<form action="/blocks/obr_comments.php" method="post">
		<span>Ваше имя<div class="required_pole">*</div>:</span> 
    	<input name="name" type="text" required><br>
    	
        <span>E-mail<div class="required_pole">*</div>:</span>
        <input name="mail" type="email" required><br>
        
        <span style="border-bottom:0px; margin-top:10px; width:200px">
        	Введите Ваш комментарий
        	<div class="required_pole" style="display:inline-block">*</div>:
        </span><br>
        
        <textarea name="text" cols="" rows="" required></textarea><br>
        <div align="left" style="text-align:left !important; padding:3px; margin-top:5px; padding-bottom:0px">
			<? include('blocks/capcha.php'); ?>
            <? echo $primer; ?>
            <input name="otvet_user" type="text" id="otvet" size="3" style="width:45px !important" required/>
            <input type="hidden" name="otvet_comp" value="<? echo $summa_number; ?>">        
        </div>
        <Br>
        
        <p style="text-align:right; margin-top:-56px"> 
           	<input name='button' type='submit' value='отправить' class='button_save'>            
        </p>    
        <input type="hidden" name="url" value="<? echo $_SERVER['REQUEST_URI']; ?>">
        <input type="hidden" name="name_obj" value="Товар">
        <input type="hidden" name="id_obj" value="<? echo $id; ?>">
        <input type="hidden" name="uid" value="<? echo $uid; ?>">
    </form>
</div>



<?
//запрос к базе

$result = mysql_query("SELECT * FROM comment WHERE id_obj='$id' && enabled=1 ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	echo "<br><br>";
	
	do
	{
		echo "
		<table width='100%' border='0' class='comment_user'>
		  <tr>
			<td><b>$myrow[name]</b></td>
			<td class='date_comment'>$myrow[date]</td>
		  </tr>
		  <tr>
			<td colspan='2' class='text_comment'>$myrow[text]</td>
		  </tr>
		</table><br>";
	}while($myrow = mysql_fetch_assoc($result));
	
	echo "<br><br>";
}
?>