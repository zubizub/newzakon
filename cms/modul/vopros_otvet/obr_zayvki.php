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
	set_logs("������-�����","�������� ���������");

	$del_g = f_data ($_GET[del], 'text', 0);
	$del = mysql_query ("DELETE FROM vopros_otvet WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=vopros_otvet&msg=������ �������!");	
	exit;	
	
}


if (isset($_POST[id]))
{
	set_logs("������-�����","��������� ������ �� ������");
	$text =  f_data($_POST['text'],'text',0);
	$id_g = f_data ($_POST[id], 'text', 0);
	
	$result_edit = mysql_query("UPDATE vopros_otvet SET otvet='$text',enabled='1' WHERE id='$id_g'", $db);

	Header("location:../../?page=vopros_otvet&id=$id_g&msg=�������� ������ �������!");	
	exit;		
}

?>