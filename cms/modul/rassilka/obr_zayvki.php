<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/resizeimg.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

function cyr_subject($text) { 
   $text = convert_cyr_string($text,"w","k"); 
   $text = base64_encode($text); 
   return "=?koi8-r?B?".$text."?="; 
}



if (isset($_GET[del]))
{
	set_logs("Рассылка","Удаление подписчиков");
	if (substr_count($_GET[del], ",")) {$id=substr($_GET[del],0,-1);} else {$id=$_GET[del];}
	
	
	if (substr_count($id,',')!=0)
	{
		$id_obj = explode(",", $id);
		for ($i=0; $i<count($id_obj); $i++)
		{
			$id_where .= " id='".$id_obj[$i]."' ||";
		}
		$id_where=substr($id_where,0,-3);
	}
	else
	{
		$id_where = " id='".$id."'";
	}
	//удаление
	$del = mysql_query ("DELETE FROM rassilka WHERE $id_where",$db);
	
	Header("location:../../?page=rassilka&msg=Операция удаления прошла успешно!");	
	exit;	
	
}



if (isset($_POST[rassilka]))
{
	set_logs("Рассылка","Произведение рассылки");
	$mail_from =  f_data($_POST['mail_from'],'mail',0);
	$sub =  f_data($_POST['sub'],'text',0);
	$text =  f_data($_POST['text'],'text',0);
	$text = nl2br($text);
	$sub =  cyr_subject($sub);
	$text = iconv("windows-1251", "utf-8", $text);
	$num_rows = mysql_num_rows($result);
	
	if ($mail_from!='' && $sub!='' && $text!='')
	{
		$result = mysql_query("SELECT * FROM rassilka");
		$myrow = mysql_fetch_assoc($result); 	
		
		do
		{
			$text_to =  $myrow[mail];
			mail($text_to, $sub, $text,"Content-type: text/html; charset=utf-8; from: $mail_from");
		}while($myrow = mysql_fetch_assoc($result));
		
		Header("location:../../?page=rassilka&msg=Рассылка произведена, $num_rows писем отправлены!");	
		exit;			
	}
	else
	{
		Header("location:../../?page=rassilka&msg=Заполните поля!");	
		exit;			
	}

}


if (isset($_POST[name]))
{
	set_logs("Рассылка","Добавление подписчика");
	$name =  f_data($_POST['name'],'text',0);
	$mail =  f_data($_POST['mail'],'mail',0);
	
	if ($name!='' && $mail!=false)
	{
		//добавление
		$date = date("H:m d.m.Y");
		$result_add = mysql_query ("INSERT INTO rassilka (name,mail,date) VALUES ('$name','$mail','$date')");				
		Header("location:../../?page=rassilka&msg=Операция прошла успешно!");	
		exit;			
	}
	else
	{
		Header("location:../../?page=rassilka&msg=Заполните поля!");	
		exit;	
	}	
}

?>