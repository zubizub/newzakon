<?

//создание пароля
function creat_pass($pass) 
{
	$pass = strtolower($pass);
	$new_pass = substr($pass,1,strlen($pass)-1).$pass[0];
	$new_pass .= "eurosites";
	for ($i=strlen($new_pass); $i>-1; $i--)
	{
		$new_pass2 .= $new_pass[$i];	
	}
	
	$pass = "";
	$ARR = array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','1','2','3','4','5','6','7','8','9','0','_',' ');
	$ARR2 = array('m','n','b','v','c','x','z','l','k','j','h','g','f','d','s','a','p','o','i','u','y','t','r','e','w','q','3','2','1','4','6','5','0','8','9','7','_',' ');
	for ($i=0; $i<strlen($new_pass2); $i++)
	{
		for ($j=0; $j<38; $j++) {if ($ARR[$j]==$new_pass2[$i]) {$simvol = $ARR2[$j];}}
		$pass .= $simvol;	
	}
	
	return $pass;	
}



//расшифровка пароля
function get_pass($pass)
{
	
	$ARR = array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','1','2','3','4','5','6','7','8','9','0','_',' ');
	$ARR2 = array('m','n','b','v','c','x','z','l','k','j','h','g','f','d','s','a','p','o','i','u','y','t','r','e','w','q','3','2','1','4','6','5','0','8','9','7','_',' ');
	for ($i=0; $i<strlen($pass); $i++)
	{
		for ($j=0; $j<38; $j++) {if ($ARR2[$j]==$pass[$i]) {$simvol = $ARR[$j];}}
		$new_pass .= $simvol;	
	}
	
	for ($i=strlen($new_pass); $i>-1; $i--)
	{
		$new_pass2 .= $new_pass[$i];	
	}	
	
	$new_pass2 = str_ireplace("eurosites", "", $new_pass2);
	$pass = $new_pass2[strlen($new_pass2)-1].substr($new_pass2,0,strlen($new_pass2)-1);	
		
	return $pass;
}


?>