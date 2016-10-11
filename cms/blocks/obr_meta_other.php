<?

ob_start();
include("db.php");
include("f_data.php");

$m_title =  f_data($_POST['m_title'],'text',0);
$m_name =  f_data($_POST['m_name'],'text',0);
$m_description = f_data($_POST['m_description'],'text',0);
$m_keywords = f_data($_POST['m_keywords'],'text',0);
$page = $_POST[page];

//редактирование
$result_edit = mysql_query("UPDATE meta_other SET m_title='$m_title', m_description='$m_description',m_keywords='$m_keywords',m_name='$m_name' WHERE page='$page'", $db);

Header("location:../?page=$page&msg=Операция прошла успешно!");	
exit;	
?>