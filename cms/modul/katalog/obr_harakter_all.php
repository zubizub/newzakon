<?

include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

if (isset($_GET[id]))
{
	$id = f_data ($_GET[id], 'text', 0);
	set_logs("�������","�������� ���� ��������������","#$id");
	$cat_get = f_data ($_GET[cat], 'text', 0);
	$cat_post = f_data ($_POST[cat], 'text', 0);
	$query = "ALTER TABLE har_$_GET[cat] DROP $_GET[id]";
	$result = mysql_query($query) or die ("������".mysql_error());
	if (isset($_POST[cat])) {$cat=$cat_post;} else {$cat=$cat_get;}
	Header("location:?page=harakter_all&cat=$cat&msg=�������� �������!");
	exit;	
}

function translit($str) 
{
	$translit = array(
		"�"=>"A","�"=>"B","�"=>"V","�"=>"G",
		"�"=>"D","�"=>"E","�"=>"J","�"=>"Z","�"=>"I",
		"�"=>"Y","�"=>"K","�"=>"L","�"=>"M","�"=>"N",
		"�"=>"O","�"=>"P","�"=>"R","�"=>"S","�"=>"T",
		"�"=>"U","�"=>"F","�"=>"H","�"=>"TS","�"=>"CH",
		"�"=>"SH","�"=>"SCH","�"=>"","�"=>"YI","�"=>"",
		"�"=>"E","�"=>"YU","�"=>"YA","�"=>"a","�"=>"b",
		"�"=>"v","�"=>"g","�"=>"d","�"=>"e","�"=>"j",
		"�"=>"z","�"=>"i","�"=>"y","�"=>"k","�"=>"l",
		"�"=>"m","�"=>"n","�"=>"o","�"=>"p","�"=>"r",
		"�"=>"s","�"=>"t","�"=>"u","�"=>"f","�"=>"h","/"=>"",
		"�"=>"ts","�"=>"ch","�"=>"sh","�"=>"sch","�"=>"y",
		"�"=>"yi","�"=>"","�"=>"e","�"=>"yu","�"=>"ya"," "=>"_","%"=>"","!"=>"","$"=>"","^"=>"","="=>"","#"=>"","@"=>"",":"=>"","."=>"",")"=>"","("=>"",
		"�"=>"e","�"=>"E","&"=>"",";"=>"","#"=>"","\""=>"","|"=>"","="=>"_",
		"1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","0"=>"0","-"=>"_"
	);
	return strtr($str,$translit);
}


if (!isset($_POST[edit]))
{
	$cat = f_data ($_POST[cat], 'text', 0);
	set_logs("�������","��������� ������������� � �������","#$cat");
	
	for ($i=1; $i<=16; $i++)
	{
		if (isset($_POST['name_har_'.$i]) && $_POST['name_har_'.$i]!='') 
		{
			$name_har = f_data ($_POST['name_har_'.$i], 'text', 0);
			$val_har = f_data ($_POST['val_har_'.$i], 'text', 0);
			
			$pole = translit($name_har); $sql_creat .= "$pole varchar(255), ";
			$pole_val = translit($name_har); $sql_insert_val .= "$pole_val, ";
			$pole_name = $name_har; $sql_insert .= "'$pole_name', "; 
			$pole_name2 = $val_har; $sql_insert2 .= "'$pole_name2', "; 
		}	
	}


	@$sql_creat = "id INT NOT NULL auto_increment, id_goods INT NOT NULL, ".substr($sql_creat,0,strlen($sql_creat)-2).", PRIMARY KEY (id)";
	@$sql_insert_val = substr($sql_insert_val,0,strlen($sql_insert_val)-2);
	@$sql_insert = substr($sql_insert,0,strlen($sql_insert)-2);
	@$sql_insert2 = substr($sql_insert2,0,strlen($sql_insert2)-2);
	
	$cat = f_data ($_POST[cat], 'text', 0);
	$cat_get = f_data ($_GET[cat], 'text', 0);
	$cat_post = f_data ($_POST[cat], 'text', 0);
	
	@$table_sql = "har_".$cat;
	@$query = "CREATE TABLE IF NOT EXISTS $table_sql ($sql_creat) ENGINE=MyISAM  DEFAULT CHARSET=cp1251";
	@$result = mysql_query($query);
	@$result_add = mysql_query ("INSERT INTO $table_sql ($sql_insert_val) VALUES ($sql_insert)");	
	@$result_add = mysql_query ("INSERT INTO $table_sql ($sql_insert_val) VALUES ($sql_insert2)");	
	
	if (isset($_POST[cat])) {$cat=$cat_post;} else {$cat=$cat_get;}	
	Header("location:../../?page=harakter_all&cat=$cat&msg=��������� ���������!");
	exit;
}
else
{
	$cat_post = f_data ($_POST[cat], 'text', 0);
	set_logs("�������","�������������� ������������� � �������","#$cat_post");
	
	@$result_har = mysql_query("SELECT * FROM har_$cat_post WHERE id='1'");
	@$myrow_har = mysql_fetch_assoc($result_har); 

	$i=1;
	
	foreach($myrow_har as $key=>$val)
	{
		if (substr_count($key,'har')==0) {$error = 1;} else {$error = 0;} 
		if ($key!='id' && $key!='id_goods' && $error==0) {$sql .= "$key='".$_POST["name_har_".$i]."', "; $i++;}	
	}



	@$result_har = mysql_query("SELECT * FROM har_$cat_post WHERE id='2'");
	@$myrow_har = mysql_fetch_assoc($result_har); 

	$i=1;
	
	foreach($myrow_har as $key=>$val)
	{
		if (substr_count($key,'har')==0) {$error = 1;} else {$error = 0;} 
		$val_har = f_data ($_POST["val_har_".$i], 'text', 0);
		if ($key!='id' && $key!='id_goods' && $error==0) {$sql2 .= "$key='".$val_har."', "; $i++;}	
	}
	
		
	$sql = substr($sql,0,strlen($sql)-2);	
	$sql2 = substr($sql2,0,strlen($sql2)-2);	
	$edit = f_data ($_POST[edit], 'text', 0);
	
	$result_edit = mysql_query("UPDATE har_$edit SET $sql WHERE id='1'", $db);		
	$result_edit = mysql_query("UPDATE har_$edit SET $sql2 WHERE id='2'", $db);	
	
	$add_sql = 0;
	$sql_insert1='';
	$sql_insert2='';
	$sql_creat='';
	
	for ($i=1; $i<=16; $i++)
	{
		if ($_POST['name_har_'.$i]!='' && !isset($_POST['key_'.$i])) 
		{
			$name_har = f_data ($_POST['name_har_'.$i], 'text', 0);
			$val_har = f_data ($_POST['val_har_'.$i], 'text', 0);
			
			$pole = translit($name_har); $sql_creat .= "ADD $pole varchar(255)  NOT NULL, ";
			$pole_name1 = translit($name_har); $sql_insert1 .= "$pole_name1='".$name_har."', ";
			$pole_name2 = translit($name_har); $sql_insert2 .= "$pole_name2='".$val_har."', ";
			$add_sql = 1;
		}	
	}	
	
	if ($add_sql==1)
	{
		$sql_insert1 = substr($sql_insert1,0,strlen($sql_insert1)-2);
		$sql_insert2 = substr($sql_insert2,0,strlen($sql_insert2)-2);
		$sql_creat = substr($sql_creat,0,strlen($sql_creat)-2);
		
		$table_sql = "har_".$_POST[cat];		
		$query = "ALTER TABLE $table_sql $sql_creat";
		$result = mysql_query($query);	
		
		$edit = f_data ($_POST['edit'], 'text', 0);
		$result_edit = mysql_query("UPDATE har_$edit SET $sql_insert1 WHERE id='1'", $db);		
		$result_edit = mysql_query("UPDATE har_$edit SET $sql_insert2 WHERE id='2'", $db);		
	}

	$cat_get = f_data ($_GET[cat], 'text', 0);
	$cat_post = f_data ($_POST[cat], 'text', 0);	
	if (isset($_POST[cat])) {$cat=$cat_post;} else {$cat=$cat_get;}
	Header("location:../../?page=harakter_all&cat=$cat&msg=��������� ���������!");
	exit;	
}
?>