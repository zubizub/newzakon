<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");

$name =  f_data($_POST['name'],'text',0);
$description = f_data($_POST['description'],'text',0);
$keywords = f_data($_POST['keywords'],'text',0);


$USERARR

//������ � ����
$result = mysql_query("SELECT * FROM test ORDER BY id DESC");
$myrow = mysql_fetch_assoc($result); 
$num_rows = mysql_num_rows($result);

if ($num_rows!=0)
{
	do
	{
		echo "";
	}while($myrow = mysql_fetch_assoc($result));
}

	
//��������
$del = mysql_query ("DELETE FROM test WHERE id = '$_GET[del]'",$db);


//��������������
$result_edit = mysql_query("UPDATE test SET name='$name', description='$description' WHERE id='$_POST[edit]'", $db);


//����������
$result_add = mysql_query ("INSERT INTO test (name,description,keywords) VALUES ('$name','$description','$keywords')");		

		
ob_start();
Header("location:../../?page=news&msg=�������� ������ �������!");	
echo "<script>window.location.href = '?page=pages'</script>";
ob_flush();



//�������� ���� ���� �� ����
$date = new DateTime();
$date->modify('-1 day');
$old_date = $date->format('d.m.Y');

//�������� ������
$date = new DateTime();
$date->modify('-15 minutes');
$old_date = $date->format('d.m.Y');


///
//�������� ����� 
$date = new DateTime();
$date->modify('-1 month');
echo $date->format('Y-m-d H:i:s');
?>


mb_substr($var,0,142, "utf-8");
mb_strlen('���','UTF-8');
transition: 0.15s all;


$.post("/ajax_test.php",  {param1: "param1",  param2: 2}, onAjaxSuccess);
 
function onAjaxSuccess(data)
{
  // ����� �� �������� ������, ������������ �������� � ������� �� �� �����.
  alert(data);
}



 class="button_save"
 
 id="tbl_obj"
 
 
.main_cat:nth-child(1) {margin-left:1px !important}
.main_cat:nth-child(6) {margin-left:1px !important}
.main_cat:nth-child(11) {margin-left:1px !important}
.main_cat:nth-child(5) {margin-right:0px !important}
.main_cat:nth-child(10) {margin-right:0px !important}
.main_cat:nth-child(15) {margin-right:0px !important}


.goods_block:nth-child(4n+4) {margin-right:0px !important;}
:nth-child(1)


//����� �� �������
$result_stat0 = mysql_query("SELECT SUM(rekl_client) FROM stat WHERE date='".date("Y-m-d")."'");
$mysql_stat0 = mysql_result($result_stat0, '0');


//���������� ���� ���
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=980">

//������� � ������ �������
mb_strtolower($for_title_allcat, 'UTF-8');



������ �������������� ����������� � ����� ���������� ���������
<input name="points" readonly onfocus="$(this).removeAttr('readonly');" /> 

��������� ������������� ���������� � js
if(typeof(variable) != "undefined" && variable !== null) {
    ...
}