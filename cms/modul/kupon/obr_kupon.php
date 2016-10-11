<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

//удаление
if (isset($_GET[del]))
{
	set_logs("Купоны","Удаление купона");
	$del= f_data ($_GET[del], 'text', 0);
	$id=substr($del,0,-1);
	
	
	if (substr_count($id,',')!=0)
	{
		$id_obj = explode(",", $id);
		for ($i=0; $i<count($id_obj); $i++)
		{
			$id_where .= " id='".$id_obj[$i]."' ||";
		}
		$id_where=substr($id_where,0,-3);
	}
	else
	{
		$id_where = " id='".$id."'";
	}
	//удаление
	$del = mysql_query ("DELETE FROM kupon WHERE $id_where",$db);
	
	Header("location:../../?page=kupon&msg=Операция удаления прошла успешно!");	
	exit;	
	
}


$name =  f_data($_POST['name'],'text',0);
$num = f_data($_POST['num'],'text',0);
$firm = f_data($_POST['firm'],'text',0);
$date_end = f_data($_POST['date_end'],'text',0);
$date = date("H:m d.m.Y");

if (isset($_POST[name]))
{
	set_logs("Купоны","Добавление купона");
	if ($name==false)
	{
		Header("location:../../?page=add_kupon&msg=Не заполнено поле НОМЕР!");	
		exit;		
	}
	
	$result_add = mysql_query ("INSERT INTO kupon (name,date_end,date,firm,enabled) VALUES ('$name','$date_end','$date','$firm','1')");	
	
	Header("location:../../?page=kupon&msg=Операция прошла успешно!");	
	exit;	
}

if (isset($_POST[num]))
{
	set_logs("Купоны","Массовая генерация купонов");
	if ($num==false)
	{
		Header("location:../../?page=add_kupon&msg=Не заполнено КОЛИЧЕСТВО!");	
		exit;		
	}
	
	for ($i=0;$i<=$num;$i++)
	{
		$a1 = rand(1000,9999);
		$a2 = rand(1000,9999);
		$a3 = rand(1000,9999);
		$a4 = rand(1000,9999);
		$name = $a1."-".$a2."-".$a3."-".$a4;
		$result_add = mysql_query ("INSERT INTO kupon (name,date_end,date,firm,enabled) VALUES ('$name','$date_end','$date','$firm','1')");	
	}

	Header("location:../../?page=kupon&msg=Операция прошла успешно!");	
	exit;	
}




if (isset($_POST[file_upload]))
{
	set_logs("Купоны","Загрузка файла с купонами");
	$ext = substr($_FILES['file']['name'], 1 + strrpos($_FILES['file']['name'], ".")); // расширение файла	
	
	if ($ext=="csv" || $ext=='xls')
	{
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["file"]["tmp_name"], "upload/files/".$img_name);	
		
		if ($ext=="csv")
		{
			$row = 1;
			$handle = fopen("upload/files/"."$img_name", "r");
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				$row++;
				for ($c=0; $c < $num; $c++) {
					//echo $data[$c]."<br>";
					$data = explode(";", $data[$c]);
					$name = $data[0];
					$firm = $data[1];
					$date_end = $data[2];
					$enabled = $data[3];
					if ($enabled=="Активен") {$enabled=1;} else {$enabled=0;}
					if ($name!="Купон")
					{
						$result_add = mysql_query ("INSERT INTO kupon (name,firm,date_end,enabled,date) VALUES ('$name','$firm','$date_end','$enabled','$date')");	
					}
				}
				
			}
			fclose($handle);
		}
		
		Header("location:../../?page=kupon&msg=Операция прошла успешно!");	
		exit;			
	}
	else
	{
		Header("location:../../?page=add_kupon&msg=Неверный формат файла!");	
		exit;			
	}
	
}

ob_flush();	
?>