<?

function pars_date($date)
{
	$day = $date[0].$date[1];
	$year = $date[6].$date[7].$date[8].$date[9];
	if ($date[3].$date[4]=='01') {$month='������';}
	if ($date[3].$date[4]=='02') {$month='�������';}
	if ($date[3].$date[4]=='03') {$month='�����';}
	if ($date[3].$date[4]=='04') {$month='������';}
	if ($date[3].$date[4]=='05') {$month='���';}
	if ($date[3].$date[4]=='06') {$month='����';}
	if ($date[3].$date[4]=='07') {$month='����';}
	if ($date[3].$date[4]=='08') {$month='�������';}
	if ($date[3].$date[4]=='09') {$month='��������';}
	if ($date[3].$date[4]=='10') {$month='�������';}
	if ($date[3].$date[4]=='11') {$month='������';}
	if ($date[3].$date[4]=='12') {$month='�������';}
}

?>

