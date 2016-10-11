<?

// обработчик срабатывающий после успешной оплаты заказа пользователем в робокассе

// your registration data
$mrh_pass1 = get_pass($SETTINGS[mrh_pass1]);  // merchant pass1 here

// HTTP parameters:
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$crc = $_REQUEST["SignatureValue"];

$crc = strtoupper($crc);  // force uppercase

// build own CRC
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1"));

if (strtoupper($my_crc) != strtoupper($crc))
{
  echo "bad sign\n";
  exit();
}

// you can check here, that resultURL was called 
// (for better security)

// OK, payment proceeds
echo "Спасибо за оплату! Скоро с Вами свяжутся!";

?>