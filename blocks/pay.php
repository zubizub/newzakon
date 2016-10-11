<?

// подтверждение (согласие) на оплату заказа пользователем

$zakaz_id = f_data($_GET[zakaz_id],'text',0);

$summa_dostavka = "";

$result_zakaz = mysql_query("SELECT * FROM zakaz WHERE id='$zakaz_id' && uid='$uid'");
$myrow_zakaz = mysql_fetch_assoc($result_zakaz); 
$num_rows_zakaz = mysql_num_rows($result_zakaz);

if ($num_rows_zakaz!=0)
{
	//сумма заказа
	$out_summ = $myrow_zakaz[price];
	
	//если необходима доставка и сумма заказа меньше необходимой для бесплатной доставки
	if ($myrow_zakaz[dostavka]==1 && $out_summ<$SETTINGS[price_dostavka_null])
	{
		$out_summ = $out_summ+$SETTINGS[price_dostavka];
		$summa_dostavka = " + $SETTINGS[price_dostavka] руб за доставку.";
	}
	
	if ($out_summ>=$SETTINGS[price_dostavka_null])
	{
		$out_summ = $out_summ;
		$summa_dostavka = "";
	}
}


$mrh_login = get_pass($SETTINGS[mrh_login]);      // your login here
$mrh_pass1 = get_pass($SETTINGS[mrh_pass1]);   // merchant pass1 here

// order properties
$inv_id    = $_GET[zakaz_id];        // shop's invoice number 
                       // (unique for shop's lifetime)
$inv_desc  = "desc";   // invoice desc
//$out_summ  = $_GET[price_max];   // invoice summ

// build CRC value
$crc  = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");

// build URL
$url = "https://auth.robokassa.ru/Merchant/Index.aspx?MrchLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id&Desc=$inv_desc&SignatureValue=$crc";

//$url = "http://test.robokassa.ru/Index.aspx?MrchLogin=$mrh_login&OutSum=$out_summ&InvId=$inv_id&Desc=$inv_desc&SignatureValue=$crc";
?>

<? if (!isset($_GET[oplata])) { ?>
<div style="text-align:center; font-size:1em; line-height:33px; color:#f0362f; font-weight:bold"><br>СПАСИБО! ВАШ ЗАКАЗ ПРИНЯТ!<Br><br>

Ваш заказ № <? echo $zakaz_id; ?> принят и ожидает обработки!<br>

<? echo "Сумма заказа ".price_convert($myrow_zakaz[price])." руб $summa_dostavka"; ?>
<br>
<? 
echo "======================================
<br>
Итого: ".price_convert($out_summ)." руб.
<br>";
?>


<Br><br></div>
<? } ?>



<? if ($num_rows_zakaz!=0) { ?>
<div align="center">
Чтобы оплатить нажмите кнопку. <br>

<br>
<a href="<? echo $url; ?>" class="btn_pay">Оплатить заказ</a> <a href="/" class="button_save">Спасибо, не надо</a>
<Br><br>
<div align="center">
<img src="/img/pay_logo/1.jpg" alt="Visa" />
<img src="/img/pay_logo/2.jpg" alt="MasterCard" />
<img src="/img/pay_logo/3.jpg" alt="Яндекс Деньги" /><Br><Br>
<img src="/img/pay_logo/4.jpg" alt="WebMoney" />
<img src="/img/pay_logo/5.jpg" alt="Maestro" />
<img src="/img/pay_logo/6.jpg" alt="Visa Electron" />
</div>
<? } ?>


</div>