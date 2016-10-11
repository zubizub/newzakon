<?

// обработчик изменения мета данных страницы

include("db.php");
include("f_data.php");

$m_title = f_data ($_POST[title], 'text', 0);
$name = f_data ($_POST[name], 'text', 0);
$m_link = f_data ($_POST[m_link], 'text', 0);
$m_description = f_data ($_POST[desc], 'text', 0);
$m_keywords = f_data ($_POST[keywords], 'text', 0);
$tbl = f_data ($_POST[tbl], 'text', 0);
$tbl_where = strip_tags($_POST[tbl_where]);

if ($m_title == false)
{
	Header("location:$_SERVER[HTTP_REFERER]?msg=Не заполнены обязательные поля!");
	exit;
}

//если это список: новостей, гаререи, каталог товаров
if ($tbl=='meta_other')
{
	$result_edit = mysql_query("UPDATE $tbl SET m_name='$name', m_title='$m_title', m_link='$m_link', m_description='$m_description', m_keywords='$m_keywords' WHERE $tbl_where", $db);
}
else
{
	$result_edit = mysql_query("UPDATE $tbl SET name='$name', m_title='$m_title', m_link='$m_link', m_description='$m_description', m_keywords='$m_keywords' WHERE $tbl_where", $db);
}



Header("location:$_SERVER[HTTP_REFERER]?msg=Изменения сохранены!");	
exit;
	
?>