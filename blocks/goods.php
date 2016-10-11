<?

// товар

?>

<div itemscope itemtype="http://schema.org/Product">

<?

$id = f_data ($_GET[id], 'text', 0);
$id_g = $id;
$result = mysql_query("SELECT * FROM goods WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);
$m_title = $myrow[m_title];
$m_description = $myrow[m_description];
$m_keywords = $myrow[m_keywords];
$m_link = $myrow[m_link];
$name_page = $myrow[name];
$url_g =  $myrow[url];

?>

<a href="<? $new_url = str_replace("/", "-", $myrow[url]); echo "/katalog/".$new_url."/"; ?>" class="back"  rel="nofollow">< назад</a><br><br>

<?

if ($myrow[firm]!='' && $myrow[firm]!=0)
{
	$result_f = mysql_query("SELECT * FROM firms WHERE id='$myrow[firm]'");
	$myrow_f = mysql_fetch_assoc($result_f); 			
	$firm = "
		<div style='display:inline-block; margin-left:10px; font-size:14px'>Производитель: <a href='/firm/$myrow_f[id]/' style='color:#333; font-size:13px' rel='nofollow'><b>$myrow_f[name]</b></a></div>
";	
}
?> 


    

<?
	if ($myrow[img]!='')
	{
		$img = "/cms/modul/katalog/upload/img/$myrow[img]";
	}
	else
	{
		$img = "/img/no_img_big.png";
	}


	if (isset($_GET[id]))
	{
			$id = f_data ($_GET[id], 'text', 0);
			$folder_img = "cms/modul/katalog/upload/files/$id/";
			@$dir    = "cms/modul/katalog/upload/files/$id/";
			@$files_img = scandir($dir);    
			$j=0;
			$x=0;
			$y=0;
			
			for ($i=0;$i<=30;$i++)
			{
				if ($files_img[$i]!='' && $files_img[$i]!='.' && $files_img[$i]!='..' && $files_img[$i]!="Thumbs.db") 
				{
					if (substr_count($files_img[$i], "jpeg")!=0 || substr_count($files_img[$i], "jpg")!=0 || substr_count($files_img[$i], "gif")!=0 || substr_count($files_img[$i], "JPG")!=0 || substr_count($files_img[$i], "JPEG")!=0 || substr_count($files_img[$i], "bmp")!=0)
					{
						
						if (substr_count($files_img[$i],'mini_')==0)
						{
							$ARRIMG[$x] =  "
							<a href='/cms/modul/katalog/upload/files/$id/$files_img[$i]' class='fancybox main_img mini_img_goods' rel='example_group'>
							<img src='/cms/modul/katalog/upload/files/$id/mini_$files_img[$i]' height='60'>
							</a>";		
							$x++;
						}
					}
					else
					{
						$ARRFILE[$y] =  "<a href='/cms/modul/katalog/upload/files/$id/$files_img[$i]' class='mini_img_goods' target='_blank'>$files_img[$i]</a><br>";
						$y++;	
					}
				}
			} 
	}
	
	
if ($myrow[sale]==0) {$price=$myrow[price1]; $sale=""; $real_price = $myrow[price1];} 
		else {$price="<span  style='font-size:12px !important'>".floor($myrow[price1]-(($myrow[price1]*$myrow[sale])/100))." $myrow_c[name] |</span> <span style='color:#F00; text-decoration:line-through; font-size:12px !important'> $myrow[price1] $myrow_c[name]</span>"; 
		$real_price  = floor($myrow[price1]-(($myrow[price1]*$myrow[sale])/100));
		$sale="<div class='sale_goods'> - $myrow[sale]%</div>";}	


if ($myrow[presence]==0)
{	
	$presence = "<div style='background-color:#30c403; color:#fff;' class='nalich_label'>есть в наличии</div>";
}

if ($myrow[presence]==1)
{	
	$presence = "<div style='background-color:#d5c372; color:#fff;' class='nalich_label'>под заказ</div>";
}

if ($myrow[presence]==2)
{	
	$presence = "<div style='background-color:#da0707; color:#fff;' class='nalich_label'>нет в наличии</div>";
}

//валюта
$result_cur = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
$myrow_cur = mysql_fetch_assoc($result_cur);
$curent = $myrow_cur[name];

$price = $myrow[price1]-($myrow[price1]*$myrow[sale]/100);
$price = floor($price);
$real_price = $price;
$price = price_convert($price."")." <span>$curent/$myrow[razmer]</span>";

if ($myrow[sale]>0 && $myrow[sale]!='') 
{
	$price_skidka = "<div style='position: absolute; top:53px'>
		<span class='span_skidka'>".price_convert($myrow[price1])." $curent/$myrow[razmer]</span>
	</div>";
	
	$skidka_num = $myrow[sale];
} 
else {$price_skidka = ""; $skidka_num=0;}

?>

<div class="row">
    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12">
        <div class="left_block_goods">
        	<div class="box_main_img">
        		<a href="<? echo $img; ?>" class="fancybox main_img" itemprop="image"><img src="<? echo $img; ?>" width="285" style="max-height:553px"></a>
        	</div>

            <div style="margin-top:13px;" class="dop_img_goods">
        		<?
                    for ($i=0; $i<count($ARRIMG); $i++)
                    {
                        echo $ARRIMG[$i];	
                    }
                ?>
            </div> 
        </div>    
    </div>


<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
    <div class="right_block_goods">
    	<? if ($myrow[art]!='')  {echo "<div class='articul_text'>Артикул: $myrow[art] $firm</div>";} ?> 
    	<div class='name_goods'><? echo "<h1 itemprop='name'>$name_page</h1>"; ?></div>

        
        <div class="price_in_goods" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        	<div><? echo $price.$price_skidka; ?></div>
        	<meta itemprop="price" content="<? echo $myrow[price1]; ?>">
    		<meta itemprop="priceCurrency" content="RUB">
        </div><br>
        
        <? echo $presence; ?>
        			
        <? 
        if ($myrow[presence]==0) 
        { 
    		echo "<a href='#' rel='nofollow' class='popup btn_big_zakaz button_zakaz' num='$real_price' numskidka='$skidka_num' numid='$myrow[id]'>
    		В корзину
    		</a>";
    	} 
    	elseif ($myrow[presence]==1) 
    	{ 
    		echo "<a href='/podzakaz/$myrow[id]/' rel='nofollow' class='btn_big_zakaz'>Оформить</a>";
    	}
    	?>
        
        
        <? if ($myrow[presence]==0) { ?>
    		<a href="#" rel='nofollow' class='popup buy_one_click btn_buy_one_click' num='<? echo $myrow[id]; ?>'>Купить в один клик</a>
    	<? } ?>
    	<br><br>
    		
    	<div class="line_box_goods_inf"></div>
        
        <div class="row">
        	<div class="col-xs-4">
                <a href="#" class="popup svyz_manager" num="<? echo $id; ?>" rel="nofollow">Связаться с менеджером</a>
            </div>
        	<div class="col-xs-4">
                <a href="#" class="popup add_favorite2 add_fovorit" num="<? echo $id; ?>" rel="nofollow">Добавить в избранное</a>
            </div>
        	<div class="col-xs-4">
                <a href="#" class="popup add_sravnenie" num="<? echo $id; ?>" rel="nofollow">Добавить к сравнению</a>
                <a href="/compare.php" target="_blank" rel="nofollow" class="spisok_sravnenie">[список]</a>
            </div>
        </div>
        
        <div class="text_small">
        	<?
        		echo $myrow[text_small];
        	?>
        </div>
          

    	<div class="box_right_soc">
    		Точную информацию по товару и его характеристикам Вы можете получить у наших менеджеров по телефону 8 (863) 000-00-00
    	</div>  
    </div>     
</div>

</div>


<div style="font-size:13px; margin-top: 15px">
<table width="100%" border="0">
  <tr>
    <td style="vertical-align:top; padding-right:10px; text-align: justify;">
    	<div itemprop="description" class="description_goods"><? echo $myrow[text]; ?></div>
    </td>
		<?
            include("blocks/goods_har.php");	
        ?>
  </tr>
</table>

	
</div>
<br><br>


<?
if ($myrow[with_item]!='')
{
	echo "<div class='title_with_item_goods'>С этим товаром покупают:</div>";
	
	if (substr_count($myrow['with_item'], ",")!=0)
	{
			$with_item = explode(",",$myrow['with_item']);
			
			for ($i=0;$i<count($with_item);$i++)
			{
				$with_item_new .= "id='".$with_item[$i]."' || ";
			}
			
			$with_item_new = substr($with_item_new,0,-4);
	}
	else
	{
		$with_item_new = "id=".$myrow['with_item'];
	}

	$where_whis_item = "WHERE $with_item_new";

	
	
	//echo $where_whis_item."<Br>";
	$result_item = mysql_query("SELECT * FROM goods $where_whis_item LIMIT 5");
	$myrow_item = mysql_fetch_assoc($result_item); 
	$num_rows_item = mysql_num_rows($result_item);

	if ($num_rows_item!=0)
	{
		do
		{
			include("blocks/tovar_rekomend.php");
		}while($myrow_item = mysql_fetch_assoc($result_item));
			
		echo "<br><br>";
	}
}



include("blocks/nav_goods.php");

?>


</div>