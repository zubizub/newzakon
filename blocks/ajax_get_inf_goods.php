<?php

//получение информации о товаре, которые загружаются во всплывающую форму после добавления в корзину

include("db.php");
include("f_data.php");

$id_carts = f_data ($_POST[id_carts], 'text', 0);

$result = mysql_query("SELECT * FROM carts WHERE id='$id_carts'");
$myrow = mysql_fetch_assoc($result); 
$id = $myrow['id_g'];

$result_g = mysql_query("SELECT * FROM goods WHERE id='$id'");
$myrow_g = mysql_fetch_assoc($result_g); 
$num_rows_g = mysql_num_rows($result_g);

if ($num_rows_g!=0)
{
	
	$m_link = explode("/",$myrow_g[m_link]);
	$m_link = $m_link[(count($m_link)-1)];
	$name = "<a href='/goods/$myrow_g[id]/$m_link/' target='_blank'>$myrow_g[name]</a>";
	if ($myrow_g[img]!='') {$img="/cms/modul/katalog/upload/img/$myrow_g[img]";} else {$img = "/img/no_img2.png";}

	$price = $myrow[price];
	$price = price_convert($price);

	echo "
	<div class='tbl_div_add_carts'>
        <div class='row'>
            <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>
                <img src='$img' height='110'>
            </div>
            
            <div class='col-lg-7 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-12'>
                <div class='tbl_div_add_carts_right'>
                    $name<Br><span>$price</span> руб.
        			<div class='count_bay_form'>
        				<input type='text' value='$myrow[count]' class='count_carts count_carts_$id_carts' readonly/>
        				<a href='#' class='count_min popup' num='$id_carts'></a>
        				<a href='#' class='count_max popup' num='$id_carts'></a>
        				<input type='hidden' class='id_g id_g_$id_carts' value='$myrow[id_g]'>
        			</div>
                </div>    
            </div>
        </div>        
	</div>";
	
}


//преобразование стоимости
function price_convert($price)
{
	if ($price>=1000 && $price<10000) //1 000
	{
		$price.="";
		$price = $price[0]." ".$price[1].$price[2].$price[3];
	}
	elseif ($price>=10000 && $price<100000) //10 000
	{
		$price.="";
		$price = $price[0].$price[1]." ".$price[2].$price[3].$price[4];
	}
	elseif ($price>=100000 && $price<1000000) //100 000
	{
		$price.="";
		$price = $price[0].$price[1].$price[2]." ".$price[3].$price[4].$price[5];
	}
	
	return $price;
}

?>