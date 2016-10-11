<?

//покупка товара в один клик

include("db.php");
include("f_data.php");

$id = f_data ($_POST[id], 'text', 0);

//для режима отладки на localhost
$local = 1;
if ($local!=1 && $_SERVER["REMOTE_ADDR"]!='127.0.0.1') {$enkod_to = "utf-8";} else {$enkod_to = "windows-1251";}

$result = mysql_query("SELECT * FROM goods WHERE id='$id'");
$myrow = mysql_fetch_assoc($result); 
if ($myrow[sale]>0 && $myrow[sale]!='') {$price = floor($myrow[price1]-(($myrow[price1]*$myrow[sale])/100));} else {$price = $myrow[price1];}
$result_cur = mysql_query("SELECT * FROM curent WHERE id='$myrow[curent]'");
$myrow_cur = mysql_fetch_assoc($result_cur);

if ($myrow[img]!=''){$img = "/cms/modul/katalog/upload/img/$myrow[img]";}else{$img = "/img/no_img_big.png";}   			
					
echo iconv("windows-1251", "$enkod_to", "
<table width='100%' border='0'>
  <tr>
    <td style='width:150px; text-align:center'><img src='$img' width='153' style='max-height:150px;'></td>
    <td style='padding-left:15px'>
		<div><b>$myrow[name]</b></div><br>
		Стоимость: <b>$price</b> $myrow_cur[name] за 1 $myrow[razmer]<br>
		<div style='margin-top:10px;'>Артикул: <b>$myrow[art]</b></div>
	</td>
  </tr>
</table>
<a href='/buy/$id/' class='msg_buy_btn_ok'>купить сейчас</a>");

?>