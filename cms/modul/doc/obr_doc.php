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
	//������ � ����
	$del_g = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM doc WHERE id='$del_g'");
	$myrow = mysql_fetch_assoc($result); 
	
	set_logs("���������","�������� ���������",$myrow[name]);

		
	@unlink("../../../doc/$filename/".$myrow[file]);
	
	$del = mysql_query ("DELETE FROM doc WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=doc&msg=�������� ������!");	
	exit;	
	
}




ob_flush();	
?>