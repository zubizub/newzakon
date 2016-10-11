<?

// вывод отзывов

$pages = f_data ($_GET[pages], 'text', 0);
if (isset($_GET[pages])) {$pages=$pages*30;} else {$pages=0;}
$result = mysql_query("SELECT * FROM otziv WHERE enabled=1 ORDER BY id DESC LIMIT $pages,30");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$i=1;
$j=1;

if ($num_rows!=0)
{
	do
	{
        if ($myrow[img]!='') 
        {
            $img="
            <div class='otziv_block_left'>
                <a href='/img/otziv/$myrow[img]' rel='example_group' class='popup fancybox'>
                    <img src='/img/otziv/$myrow[img]' width='80'/>
                </a>
            </div>";
        } 
        else 
        {
            $img="";
        }
        
		echo "
		  <div class='otziv_and_voprosotvet'>
                
                $img   

                <div class='otziv_block_right'>
                    <div class='otziv_and_voprosotvet-name'>$myrow[name]</div>
    				<div class='otziv_and_voprosotvet-text'>$myrow[text]</div>
    			    <div class='otziv_and_voprosotvet-date'>$myrow[date]</div>
                </div>
		  </div>  		
		";	
	}while($myrow = mysql_fetch_assoc($result));
}
else
{
		echo "Записей нет";	
}

?>


<br>
<?
	if (mysql_num_rows($result)>28)
	{
		$result = mysql_query("SELECT * FROM otziv WHERE enabled=1");
		$num_rows = mysql_num_rows($result);
		include("blocks/number_pages.php");
		pages_number($num_rows,"/otziv/",30);
	}
?>


<br><br>

<div id="otziv_form">
	<div class='title_form'>Оставить отзыв</div>
	<form action="/blocks/obr_otziv.php" method="post" enctype="multipart/form-data">
    	<span>Ваше имя<div class="required_pole">*</div>:</span> <input name="name" type="text" required><br>
    	
        <span>E-mail<div class="required_pole">*</div>:</span> <input name="mail" type="email" required><br>
        
        <span>Фото:</span> <input name="img" type="file" accept="image/*,image/jpeg"> (не более 300Кб)<br>
        
        <span style="border-bottom:0px; margin-bottom:0px; width:150px; padding-left: 0px;">Введите Ваш отзыв<div class="required_pole">*</div>:</span><br>
        <textarea name="text" cols="" rows="" required><? $text = f_data ($_GET[text], 'text', 0); echo $text; ?></textarea><br>
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

          	
    </form>
</div>