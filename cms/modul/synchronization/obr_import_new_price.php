<?
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

$ext = explode(".",$_FILES["file"] ["name"]);					
$ext = $ext[count($ext)-1];
if ($ext!="xls")
{
	Header("location:../../?page=goods_export&msg=���� � �������� �����������!");	
	exit;	
}


if ($_FILES["file"] ["name"] != "")
{ 
	set_logs("�������","���������� ��� � �������� �� xls","");
	@unlink("upload/files/import_new_price.xls");
	copy($_FILES["file"]["tmp_name"], "upload/files/import_new_price.xls");

	function readExelFile($filepath){
		require_once "../../classes/PHPExcel.php"; //���������� ��� ���������
		$ar=array(); // �������������� ������
		$inputFileType = PHPExcel_IOFactory::identify($filepath);  // ������ ��� �����, excel ����� ������� ����� � ������ ��������, xls, xlsx � ������
		$objReader = PHPExcel_IOFactory::createReader($inputFileType); // ������� ������ ��� ������ �����
		$objPHPExcel = $objReader->load($filepath); // ��������� ������ ����� � ������
		$ar = $objPHPExcel->getActiveSheet()->toArray(); // ��������� ������ �� ������� � ������
		return $ar; //���������� ������
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
	
	Header("location:../../?page=goods_export&msg=�������� ������ �������!&nom=$end_number");	
	exit;				
	
}

?>