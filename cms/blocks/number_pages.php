<?

function pages_number($num,$page_index,$kratnost)
{
	/*	
	$num = 35; //����� ���������
	$page_index = "number.php"; //�������� ������
	$kratnost - ������� ������� �������� �� ��������
	*/
	
	
	$num_page_real = ceil($num/$kratnost); //������� ����� �������

	if ($num_page_real<11) 
	{
		$vivid=ceil($num/$kratnost); //������� ����� �������
		$start=1;
		$end = $vivid;
	} 
	else 
	{
		$vivid = 11; //�� ������� ��������, ������ �������� �����
		
		$param1 = ceil(($vivid+1)/2); //�������������� ����������
		$param2 = floor(($vivid-1)/2);//�������������� ����������	
		if (isset($_GET[pages])) {$p=$_GET[pages];} else {$p=1;}
		if ($p<=$param1) {$start=1; $end=$vivid;} 
		if ($p>$param1 && $p<=($num-$param2)) {$start=$p-$param2; $end=$p+$param2;}
		if ($p>$param1 && $p>($num-$param2)) {$start=$num-$vivid+1; $end=$num;}		
	}
	
	//if (($num/$kratnost)<$vivid) {$end = ceil($num/$kratnost); $start = 1;}

	
	if ($end>1)
	{
		for ($i=$start; $i<=$end; $i++)
		{
			if ($i==$_GET[pages] || ($i==1 && !isset($_GET[pages]))) {$cl='pages_number_hover';} else {$cl='';}
			if ($i!=1) {$page_url="&pages=$i";}
			echo "<a href='$page_index$page_url' class='pages_number $cl'>$i</a>";	
		}		
	}

	
}
?>