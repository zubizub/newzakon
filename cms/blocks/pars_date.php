<?

function pars_date($date)
{
	$day = $date[0].$date[1];
	$year = $date[6].$date[7].$date[8].$date[9];
	if ($date[3].$date[4]=='01') {$month='Января';}
	if ($date[3].$date[4]=='02') {$month='Февраля';}
	if ($date[3].$date[4]=='03') {$month='Марта';}
	if ($date[3].$date[4]=='04') {$month='Апреля';}
	if ($date[3].$date[4]=='05') {$month='Мая';}
	if ($date[3].$date[4]=='06') {$month='Июня';}
	if ($date[3].$date[4]=='07') {$month='Июля';}
	if ($date[3].$date[4]=='08') {$month='Августа';}
	if ($date[3].$date[4]=='09') {$month='Сентября';}
	if ($date[3].$date[4]=='10') {$month='Октября';}
	if ($date[3].$date[4]=='11') {$month='Ноября';}
	if ($date[3].$date[4]=='12') {$month='Декабря';}
}

?>

