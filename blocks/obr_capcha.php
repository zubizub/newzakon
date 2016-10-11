<?

// обработчик капчи

if (isset($_POST['otvet_user']) && trim($_POST['otvet_user']) != '' && strlen($_POST['otvet_user'])<3)
{
	$otvet_user = $_POST['otvet_user'];
	$otvet_comp = $_POST['otvet_comp'];
	$otver_degen = ((($otvet_user*1024)+((228-$otvet_user*2)*132))*32)*$otvet_user*3;
	
	if ($otvet_comp == $otver_degen) {
		$capcha = true;
	}
	else
	{
		$capcha = false;
	}
}
else
{
	$capcha = false;
}
?>