<?

// вывод вопросов пользователей и ответов администрации на них

$pages = f_data ($_GET[pages], 'text', 0);
if (isset($_GET[pages])) {$pages=($pages-1)*10;} else {$pages=0;}

$result = mysql_query("SELECT * FROM vopros_otvet WHERE enabled=1 ORDER BY id DESC  LIMIT $pages,10");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
		if ($myrow[otvet]!='') $otvet_button="<i>$myrow[otvet]</i>";
		
		echo "
		  <div class='otziv_and_voprosotvet'>
				<b>$myrow[name]</b>
				<div style='font-size:11px;margin-bottom:6px'><i>$myrow[text]</i></div>
				<span style='color:#F7941F'><b>Администрация</b></span><br>
				$otvet_button
		
		  </div>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "
		  <tr>
			<th colspan='2'>Записей нет</th>
		  </tr>  		
		";	
}

?>


<br>
<?
	$result = mysql_query("SELECT * FROM vopros_otvet WHERE enabled=1");
	
	if (mysql_num_rows($result)>10)
	{
		$num_rows = mysql_num_rows($result);
		include("blocks/number_pages.php");
		pages_number($num_rows,"/vopros_otvet/",10);
	}
?>

<br><br>

<div id="vopros_otvet_form">
	<div class='title_form'>Задайте свой вопрос</div>
	<form action="/blocks/obr_vopros_otvet.php" method="post">
    	<span>Ваше имя<div class="required_pole">*</div>:</span> 
    	<input name="name" type="text" required><br>
    	
        <span>E-mail<div class="required_pole">*</div>:</span>
        <input name="mail" type="email" required><br>
        
        <span style="border-bottom:0px; margin-top:10px; width:200px">Введите Ваш вопрос
        	<div class="required_pole" style="display:inline-block">*</div>:
        </span><br>
        
        <textarea name="text" cols="" rows="" required></textarea><br>
        <Br>
        
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
    			<? include('blocks/capcha.php'); ?>
                <? echo $primer; ?>
                <input name="otvet_user" type="text" id="otvet" size="3" style="width:45px !important" required/>
                <input type="hidden" name="otvet_comp" value="<? echo $summa_number; ?>">        
            </div>
        
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"> 
                <div class="btn_send_dop_form">
               	    <input name='button' type='submit' value='отправить' class='btn2'>  
                </div>          
            </div>   
        </div>
        
        <br>
        <div class="required_pole">* - обязательное поле для заполнения</div>
        
         	
        
        <Br><Br>
    </form>
</div>