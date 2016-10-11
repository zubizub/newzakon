<? 

// корзина

if (isset($_COOKIE[uid])) {$uid=$_COOKIE[uid]; $guest=0;} 
else 
{
	$uid = $_COOKIE[uid_cart];
	$guest=1;
}

$result = mysql_query("SELECT * FROM carts WHERE uid='$uid'");
$num_rows = mysql_num_rows($result);


if ($num_rows!=0) 
{ 

?>

<table width="100%">
	<tr>
		<td>
<div class='left_block_carts'>
	<? include("blocks/carts_list.php"); //подключение списка товаров в корзине ?>
</div>

<div class='right_block_carts'>
	<div class="box_right_carts">
		<a href="#" class="clear_carts">очистить корзину</a>
		
		<div class="box_right_carts-text1">Общая стоимость Вашего заказа</div>
		<div class="box_right_carts-summa"><span><? echo price_convert($summa_zakaz); ?></span> <img src="/img/r.png" alt="Р" /></div>
		
		<a href="/oformit_zakaz/" class="oformit_zakaz">Оформить заказ</a>
		
		<div class="box_right_carts-text2">Нажмите ОФОРМИТЬ ЗАКАЗ и заполните форму, где Вы сможете выбрать способ доставки и оплаты.</div>
		
		<div class="box_right_carts-text3">Мы принимаем</div>
		<img src="/img/pay_logo/1.jpg" alt="Visa" />
		<img src="/img/pay_logo/2.jpg" alt="MasterCard" />
		<img src="/img/pay_logo/3.jpg" alt="Яндекс Деньги" /><Br><Br>
		<img src="/img/pay_logo/4.jpg" alt="WebMoney" />
		<img src="/img/pay_logo/5.jpg" alt="Maestro" />
		<img src="/img/pay_logo/6.jpg" alt="Visa Electron" />
	</div>
</div>

</td>
	</tr>
</table>

<?

	if ($count_max!=0) 
	{
		echo "Всего товаров: <b><span class='count_all'>$count_max</span></b> шт. На сумму <b><span class='price_all'>$price_max</span></b> рублей";
	}
}
else
{
	echo "Товаров к корзине еще нет!";
} 
?>