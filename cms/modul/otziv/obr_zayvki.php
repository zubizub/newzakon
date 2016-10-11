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
	set_logs("Отзывы","Удаление отзыва");
	
	$del_g = f_data ($_GET[del], 'text', 0);
    $result2 = mysql_query("SELECT * FROM otziv WHERE id='$del_g'");
	$myrow2 = mysql_fetch_assoc($result2);
    
	$del = mysql_query ("DELETE FROM otziv WHERE id = '$del_g'",$db);
	if ($myrow2[img]!='') {@unlink("../../../img/otziv/$myrow2[img]");}
    
	Header("location:../../?page=otziv&msg=Запись удалена!");	
	exit;	
	
}


if (isset($_POST[id]))
{
	$text =  f_data($_POST['text'],'text',0);
	$id_g =  f_data($_POST['id'],'text',0);
	//редактирование
	set_logs("Отзывы","Ответ на отзыв");
	$result_edit = mysql_query("UPDATE otziv SET otvet='$text',enabled='1' WHERE id='$id_g'", $db);

	Header("location:../../?page=otziv&id=$id_g&msg=Операция прошла успешно!");	
	exit;		
}

?>