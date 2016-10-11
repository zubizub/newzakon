<?

// парсинг даты и вывод в нужном формате

function date_str($dates)
{
	$day = $dates[0].$dates[1];
	$mount = $dates[3].$dates[4];
	$year = substr($dates,-4);
	if ($mount=='01') {$mount='Января';}
	elseif ($mount=='02') {$mount='Февраля';} 
	elseif ($mount=='03') {$mount='Марта';} 
	elseif ($mount=='04') {$mount='Апреля';} 
	elseif ($mount=='05') {$mount='Мая';} 
	elseif ($mount=='06') {$mount='Июня';} 
	elseif ($mount=='07') {$mount='Июля';} 
	elseif ($mount=='08') {$mount='Августа';} 
	elseif ($mount=='09') {$mount='Сентября';} 
	elseif ($mount=='10') {$mount='Октября';} 
	elseif ($mount=='11') {$mount='Ноября';} 
	elseif ($mount=='12') {$mount='Декабря';} 
	
	return " | ".$day." ".$mount." ".$year;
}
	
	
?>