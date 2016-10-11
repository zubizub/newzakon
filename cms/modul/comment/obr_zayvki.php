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
	set_logs("Комментарии","Удаление комментария");
	
	$del =  f_data($_GET[del],'text',0);
	$del = mysql_query ("DELETE FROM comment WHERE id = '$del'",$db);
	set_logs("Комментарии","Удаление");
	Header("location:../../?page=comment&msg=Комментарий удален!");	
	exit;	
	
}


if (isset($_POST[edit]))
{
	$text =  f_data($_POST['text'],'text',0);
	$edit =  f_data($_POST['edit'],'text',0);
	
	$result_edit = mysql_query("UPDATE zayvki SET text='$text' WHERE id='$edit'", $db);
	
	Header("location:../../?page=zayvka_inf&id=$edit&msg=Операция прошла успешно!");	
	exit;		
}

?>