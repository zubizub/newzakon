<?
ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

if (isset($_GET['del']))
{
	$del = f_data ($_GET[del], 'text', 0);
	set_logs("�������","�������� ������� �������������","#$del");
	
	$query = "DROP TABLE har_$del";
	@$result = mysql_query($query);
	$del=mysql_query ("DELETE FROM goods_harakteristiki WHERE id = '$del'",$db);	
	Header("location:../../?page=goods_harakteristiki&msg=�������� ������ �������!");	
	exit;
}

$name =  f_data(trim($_POST['name']),'text',0);
$descript = f_data(trim($_POST['descript']),'text',0);

if ($name==false)
{
	Header("location:../../?page=add_cat_harakteristika&msg=��������� ���� ��������!");	
	exit;		
}

if (!isset($_POST['update']))
{
	set_logs("�������","�������� ������� �������������",$name);
	$result_add = mysql_query ("INSERT INTO goods_harakteristiki (name,descript) VALUES ('$name','$descript')");
	$msg = "����� �������������� ���������!";
	$result_h = mysql_query("SELECT * FROM goods_harakteristiki ORDER BY id DESC LIMIT 1");
	$myrow_h = mysql_fetch_array($result_h); 	
	Header("location:../../?page=harakter_all&cat=$myrow_h[id]&msg=$msg");	
	exit;	
}
else
{
	set_logs("�������","��������� ������� �������������",$name);
	$update = f_data ($_POST[update], 'text', 0);
	$result_edit = mysql_query("UPDATE goods_harakteristiki SET name='$name', descript='$descript' WHERE id='$update'", $db);
	$msg = "��������� �������������� �����������!";
	Header("location:../../?page=goods_harakteristiki&msg=$msg");	
	exit;	
}

?>