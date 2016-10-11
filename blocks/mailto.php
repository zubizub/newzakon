<?

// функция для отправки e-mail

function cyr_subject($text) { 
   //$text = convert_cyr_string($text,"w","k"); 
   $text = base64_encode($text); 
   return "=?koi8-r?B?".$text."?="; 
}


function mailto($text,$sub,$mailto)
{
	$headers = 'From: noreply@moyzakon.com' . "\r\n" .
    'Reply-To: no-reply@moyzakon.com' . "\r\n" .
    'Content-type: text/html; charset=utf-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	$text .= "<Br> <Br> 
	================================================================<Br>
	<span style='color:#f53700'>Не отвечайте на это письмо! Оно создано автоматически системой уведомлений!</span>";
	//$text = iconv("windows-1251", "utf-8", $text);	
	//$sub =  cyr_subject("$sub");
	$sub = '=?utf-8?B?'. base64_encode($sub) .'?=';
	//mail('zubizubwork@gmail.com,'. $mailto, $sub." [$_SERVER[HTTP_HOST]]", $text, $headers);
	mail($mailto, $sub." [$_SERVER[HTTP_HOST]]", $text, $headers);
}

?>