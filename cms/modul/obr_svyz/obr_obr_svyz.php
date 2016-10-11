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
	set_logs("Обратная связь","Удаление сообщения");
	
	$del_g = f_data ($_GET[del], 'text', 0);
	//удаление
	$del = mysql_query ("DELETE FROM obr_svyz WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=obr_svyz&msg=Заявка удалена!");	
	exit;	
	
}


if (isset($_POST[edit]))
{
	set_logs("Обратная связь","Редактирование сообщения обратной связи");
	$text =  f_data($_POST['text'],'text',0);
	$edit_g = f_data ($_POST[edit], 'text', 0);
	
	//редактирование
	$result_edit = mysql_query("UPDATE obr_svyz SET text='$text' WHERE id='$edit_g'", $db);

	Header("location:../../?page=obr_svyz_inf&id=$edit_g&msg=Операция прошла успешно!");	
	exit;		
}

?>