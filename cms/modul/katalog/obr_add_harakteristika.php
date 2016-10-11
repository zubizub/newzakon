<?
ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

if (isset($_GET['del']))
{
	$del = f_data ($_GET[del], 'text', 0);
	set_logs("Каталог","Удаление таблицы характеристик","#$del");
	
	$query = "DROP TABLE har_$del";
	@$result = mysql_query($query);
	$del=mysql_query ("DELETE FROM goods_harakteristiki WHERE id = '$del'",$db);	
	Header("location:../../?page=goods_harakteristiki&msg=Операция прошла успешно!");	
	exit;
}

$name =  f_data(trim($_POST['name']),'text',0);
$descript = f_data(trim($_POST['descript']),'text',0);

if ($name==false)
{
	Header("location:../../?page=add_cat_harakteristika&msg=Заполните поле НАЗВАНИЕ!");	
	exit;		
}

if (!isset($_POST['update']))
{
	set_logs("Каталог","Создание таблицы характеристик",$name);
	$result_add = mysql_query ("INSERT INTO goods_harakteristiki (name,descript) VALUES ('$name','$descript')");
	$msg = "Новая характеристика добавлена!";
	$result_h = mysql_query("SELECT * FROM goods_harakteristiki ORDER BY id DESC LIMIT 1");
	$myrow_h = mysql_fetch_array($result_h); 	
	Header("location:../../?page=harakter_all&cat=$myrow_h[id]&msg=$msg");	
	exit;	
}
else
{
	set_logs("Каталог","Изменение таблицы характеристик",$name);
	$update = f_data ($_POST[update], 'text', 0);
	$result_edit = mysql_query("UPDATE goods_harakteristiki SET name='$name', descript='$descript' WHERE id='$update'", $db);
	$msg = "Изменение характеристики произведено!";
	Header("location:../../?page=goods_harakteristiki&msg=$msg");	
	exit;	
}

?>