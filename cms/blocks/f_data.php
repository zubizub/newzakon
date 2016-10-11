<?

// функция проверки данных и их обработки, чтобы не было взлома и SQL - иньекций

function f_data ($data, $type, $size_file)
{
	
	$data = trim($data);
	$data = htmlspecialchars($data, ENT_QUOTES);
	$textData = $data;
    $data = prepareStr($data);
    $data = mysql_real_escape_string($data);
	$error = 0;
	
	if ($type == 'mail')
	{
		if (substr_count($data,"@") !=1) {$error = 1;}
		if (substr_count($data,".") == 0) {$error = 1;}
		if (stripos($data,"@") == 0) {$error = 1;}
		if ($data == '' || $error == 1) {return false;} else {return $data;}	
	}
	elseif ($type == 'text')
	{
	//	if ($data == '') {return false;} else {return $data;}		
		return $textData;
	}
	elseif ($type == 'img')
	{
		$format = strtolower(substr($data,strlen($data)-4, 4));
		$error = 1;
		if (substr_count($format,"jpg") == 1 || substr_count($format,"JPG") == 1 || substr_count($format,"jpeg") == 1 || substr_count($format,"png") == 1 || substr_count($format,"PNG") == 1 || substr_count($format,"bmp") == 1 || substr_count($format,"gif") == 1) {$error = 0;}
		if ($size_file != 0) {$size_file = $size_file/1000;}
		if ($size_file > 300 || $size_file == 0)  {$error = 1;}
		if ($data != '' && $error != 1) {return true;} else {return false;}	
	}	
	elseif ($type == 'doc')
	{
		$format = strtolower(substr($data,strlen($data)-4, 4));
		$error = 1;
		if (substr_count($format,"doc") == 1 || substr_count($format,"docx") == 1 || substr_count($format,"odt") == 1 || substr_count($format,"xls") == 1 || substr_count($format,"xlsx") == 1) {$error = 0;}
		if ($size_file != 0) {$size_file = $size_file/1000;}
		if ($size_file > 3000 || $size_file == 0)  {$error = 1;}
		if ($data != '' && $error != 1) {return true;} else {return false;}	
	}	
	elseif ($type == 'file')
	{
		$format = strtolower(substr($data,strlen($data)-4, 4));
		$error = 1;
		if (substr_count($format,"doc") == 1 || substr_count($format,"docx") == 1 || substr_count($format,"odt") == 1 || substr_count($format,"xls") == 1 || substr_count($format,"xlsx") == 1 || substr_count($format,"zip") == 1|| substr_count($format,"rar") == 1) {$error = 0;}
		if ($size_file != 0) {$size_file = $size_file/1000;}
		if ($size_file > 3000 || $size_file == 0)  {$error = 1;}
		if ($data != '' && $error != 1) {return true;} else {return false;}	
	}	
}


function prepareStr( $str ) {
	return str_replace(
		array( '\\', "\0", "\n", "\r", "\x1a" ),
		array( '\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z' ),
		$str );
}
?>