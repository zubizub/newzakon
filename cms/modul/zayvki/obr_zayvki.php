<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

//��������
if (isset($_GET[del]))
{
	set_logs("������","�������� ������");
	//��������
	$del = mysql_query ("DELETE FROM zayvki WHERE id = '$_GET[del]'",$db);
	
	Header("location:../../?page=zayvki&msg=������ �������!");	
	exit;	
	
}


if (isset($_POST[edit]))
{
	set_logs("������","�������������� ������");
	$text =  f_data($_POST['text'],'text',0);
	//��������������
	$result_edit = mysql_query("UPDATE zayvki SET text='$text' WHERE id='$_POST[edit]'", $db);

	Header("location:../../?page=zayvka_inf&id=$_POST[edit]&msg=�������� ������ �������!");	
	exit;		
}

?>