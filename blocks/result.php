<?

// your registration data
$mrh_pass2 = get_pass($SETTINGS[mrh_pass2]);   // merchant pass2 here

// HTTP parameters:
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$crc = $_REQUEST["SignatureValue"];

// HTTP parameters: $out_summ, $inv_id, $crc
$crc = strtoupper($crc);   // force uppercase

// build own CRC
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2"));

if (strtoupper($my_crc) != strtoupper($crc))
{
  echo "bad sign\n";
  exit();
}


//редактирование
$result_edit = mysql_query("UPDATE zakaz SET oplata='1' WHERE id='$inv_id'", $db);

// print OK signature
//echo "OK$inv_id\n";

?>