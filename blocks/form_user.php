<?

//форма авторизации пользователя, в случае если пользователь авторизован, то ему показывается его ФИО и форма входа в личный кабинет

?>

<div class="left_block_user_form">

<?
if (!isset($_COOKIE[uid]))
{
?>
<a href="/enter/" rel="nofollow" class="btnUpEnter">Вход</a> | 
<a href="/reg/" rel="nofollow" class="popup btnUpReg">Регистрация</a>
<?		
}
else
{
	
	$uid = f_data($_COOKIE[uid],'text',0);
	$token =  f_data($_COOKIE[token],'text',0);
	$result = mysql_query("SELECT * FROM users WHERE uid='$uid' && token='$token'");
	$myrow = mysql_fetch_assoc($result); 
    if ($numUvedomlen==0) {
        $numUvedomlen='';
    }
		
?>

<div id="forma_user">   
    <a href="/cabinet/" class="btnUpCab">Кабинет<? echo $numUvedomlen; ?></a> | <a href="/cookie.php?exit" class="btnUpExit">Выход</a>


<?
//новые заказы с маркета
$query = "SELECT id FROM zadaniy WHERE new='1' && ispolnitel='$_COOKIE[uid]'";
$result_new_offers = mysql_query($query);
$num_rows_market = mysql_num_rows($result_new_offers);
if ($num_rows_market!=0) {$num_rows_market=" <span class='marketNewOffer'>($num_rows_market)</span>";} else {$num_rows_market='';}
?>


<?
}
?>
</div>
