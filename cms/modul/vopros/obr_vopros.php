<?
//ini_set('display_errors','On');
//error_reporting('E_ALL');


ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
include("../../blocks/mailto.php");


//��������
if (isset($_GET[del]))
{
	//������ � ����
	$del_g = f_data ($_GET[del], 'text', 0);
	$result = mysql_query("SELECT * FROM vopros WHERE id='$del_g'");
	$myrow = mysql_fetch_assoc($result); 
	
    $text_sms = "������������. ��� ������ ������ � ������� MOYZAKON.COM";
    
    $result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
    $myrow_us = mysql_fetch_assoc($result_us);
    //sendSms($myrow_us[phone],$text_sms);
    mailto($text_sms,"�������� �������",$myrow_us[mail]);
	set_logs("�������","�������� �������",$myrow[name]);

	$del = mysql_query ("DELETE FROM vopros WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=vopros&msg=������ ������!");	
	exit;	
	
}

/*$enabled =  f_data($_POST['enabled'],'text',0);
$name = f_data($_POST['name'],'text',0);
$type = f_data($_POST['type'],'text',0);*/

$enabled =  $_POST['enabled'];
$name = $_POST['name'];
$type = $_POST['type'];
$text = $_POST['text'];
$fakeName = $_POST['fakeName'];

/*$city =  f_data($_POST['city'],'text',0);
$cat =  f_data($_POST['cat'],'text',0);*/

$city =  $_POST['city'];
$cat =  $_POST['cat'];


//������ � ����, - ������� ������ ������
$edit_g =  f_data($_POST['edit'],'text',0);
$result = mysql_query("SELECT * FROM vopros WHERE id='$edit_g'");
$myrow = mysql_fetch_assoc($result);
$enabled_old = $myrow[enabled];

if ($enabled_old!=$enabled)
{
    $result_us = mysql_query("SELECT * FROM users WHERE uid='$myrow[uid]'");
    $myrow_us = mysql_fetch_assoc($result_us);
    
    if ($enabled==1)
    {
        //$text_sms = "������������! ��� ������ ����������� �� �����! �������, ��� �� � ����!";
        $text_sms =  "������������!<Br>
    ��� ������ �����������. ������� ���! ������ ��������� �� ������:<Br>
    <a href='https://moyzakon.com/question/$myrow[name_m]/'>https://moyzakon.com/question/$myrow[name_m]/</a>";
    }
    else
    {
        $text_sms = "������������! ���� ������ ���� � ����������! �������, ��� �� � ����!";
    }
    
    mailto($text_sms,"������ �� MOYZAKON.COM",$myrow_us[mail]);
    
    //sendSms($myrow_us[phone],$text_sms);
}


set_logs("������","�������������� �������",$myrow[name]);

$vopsosId = $_REQUEST['vopsosId'];

if (!empty($vopsosId)) {

$edit_g = $vopsosId;
$query = "UPDATE vopros SET enabled='1', name='$name',text='$text', city='$city',cat='$cat',type='$type', podtverdit='1', fakeName='$fakeName' WHERE id='$vopsosId'";
}

else {

    $query = "UPDATE vopros SET enabled='$enabled', name='$name',text='$text', city='$city',cat='$cat',type='$type', fakeName='$fakeName' WHERE id='$edit_g'";
}
print_r($query);

//��������������
$result_edit = mysql_query($query, $db);

Header("location:../../?page=vopros_inf&id=$edit_g&msg=�������� ������ �������!");	
exit;		
	

ob_flush();	
?>