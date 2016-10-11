<?

function cyr_subject($text) { 
   $text = convert_cyr_string($text,"w","k"); 
   $text = base64_encode($text); 
   return "=?koi8-r?B?".$text."?="; 
}


function mailto($text,$sub,$mailto)
{
	$text = iconv("windows-1251", "utf-8", $text);	
	$sub =  cyr_subject("$sub");
	mail($mailto, $sub, $text,"Content-type: text/html; charset=utf-8");
}
?>