<? 
$sub='lalala';
$text='lalala';
$headers = 'From: info@moyzakon.com' . "\r\n" .
    'Reply-To: no-reply@moyzakon.com' . "\r\n" .
    'Content-type: text/html; charset=utf-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if( mail('zubizubwork@gmail.com', $sub." [$_SERVER[HTTP_HOST]]", $text, $headers)) {

	print_r('ok');
}