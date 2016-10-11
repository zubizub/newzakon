<?
//ini_set('display_errors','On');
//error_reporting('E_ALL');


ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");
include("../../blocks/send_sms.php");


//удаление
if (isset($_GET[del]))
{
	//запрос к базе
	$del_g = f_data ($_GET[del], 'text', 0);
    $vopros = f_data ($_GET[vopros], 'text', 0);
	$result = mysql_query("SELECT * FROM vopros_comment WHERE id='$del_g'");
	$myrow = mysql_fetch_assoc($result); 

	set_logs("Вопросы","Удаление комментария",$myrow[name]);

	$del = mysql_query ("DELETE FROM vopros_comment WHERE id = '$del_g'",$db);
	
	Header("location:../../?page=vopros_inf&id=$vopros&msg=Комментарий удален!");	
	exit;	
	
}




ob_flush();	
?>