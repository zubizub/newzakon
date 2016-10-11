<?
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

$ext = explode(".",$_FILES["file"] ["name"]);					
$ext = $ext[count($ext)-1];
if ($ext!="xls")
{
	Header("location:../../?page=goods_export&msg=Файл с неверным расширением!");	
	exit;	
}


if ($_FILES["file"] ["name"] != "")
{ 
	set_logs("Каталог","Обновление цен и остатков из xls","");
	@unlink("upload/files/import_new_price.xls");
	copy($_FILES["file"]["tmp_name"], "upload/files/import_new_price.xls");

	function readExelFile($filepath){
		require_once "../../classes/PHPExcel.php"; //подключаем наш фреймворк
		$ar=array(); // инициализируем массив
		$inputFileType = PHPExcel_IOFactory::identify($filepath);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
		$objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
		$objPHPExcel = $objReader->load($filepath); // загружаем данные файла в объект
		$ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив
		return $ar; //возвращаем массив
	}

	$end_number=0;
	$file_path_excel = "upload/files/import_new_price.xls";
	$ar=readExelFile($file_path_excel);
	foreach($ar as $ar_colls){
		$art = $ar_colls[0];
		$price = $ar_colls[1];
		$count = $ar_colls[2];
		$result = mysql_query("SELECT * FROM goods WHERE art='$art'");
		$num_rows = mysql_num_rows($result);
		if ($num_rows!=0)
		{
			$result_edit = mysql_query("UPDATE goods SET price1='$price', count='$count' WHERE art='$art'", $db);
			$end_number++;
		}
	}
	
	Header("location:../../?page=goods_export&msg=Операция прошла успешно!&nom=$end_number");	
	exit;				
	
}

?>