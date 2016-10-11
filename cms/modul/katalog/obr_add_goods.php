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

	$del = f_data ($_GET[del], 'text', 0);
	
	if (substr_count($del,',')==0)
	{
		$result = mysql_query("SELECT * FROM goods WHERE id='$del'");
		$myrow = mysql_fetch_assoc($result); 
		set_logs("Каталог","Удаление товара",$myrow[name]);
		
		$id = $myrow[id];
		$number = $myrow[number];
		$url = $myrow[url];
		
		//запрос к базе
		$result2 = mysql_query("SELECT * FROM goods WHERE url='$url' && number>'$number'");
		$myrow2 = mysql_fetch_assoc($result2); 
		$num_rows2 = mysql_num_rows($result2);
		
		if ($num_rows2!=0)
		{
			do
			{
				$result_edit = mysql_query("UPDATE goods SET number=number-1 WHERE id='$myrow2[id]'", $db);
			}while($myrow2 = mysql_fetch_assoc($result2));
		}
		


		if ($handle = opendir("upload/files/$del/")) {
			while (false !== ($file = readdir($handle))) { 
				if ($file != "." && $file != "..") { 
					unlink("upload/files/$del/".$file); 
				} 
			}
			closedir($handle); 
		}	
			
		@unlink("upload/img/".$myrow[img]);
		@unlink("upload/img/mimi_".$myrow[img]);
		@rmdir("upload/files/$del/");
		
		$del = mysql_query ("DELETE FROM goods WHERE id = '$del'",$db);
	}
	else
	{
		//если выделили несколько товаров
		
		$DEL_ARR = explode(",",$del);
		
		for ($j=0;$j<count($DEL_ARR)-1;$j++)
		{
			$del = $DEL_ARR[$j]; 
			$result = mysql_query("SELECT * FROM goods WHERE id='$del'");
			$myrow = mysql_fetch_assoc($result); 
			set_logs("Каталог","Удаление товара",$myrow[name]);
			
			$id = $myrow[id];
			$number = $myrow[number];
			$url = $myrow[url];
			
			//запрос к базе
			$result2 = mysql_query("SELECT * FROM goods WHERE url='$url' && number>'$number'");
			$myrow2 = mysql_fetch_assoc($result2); 
			$num_rows2 = mysql_num_rows($result2);
			
			if ($num_rows2!=0)
			{
				do
				{
					$result_edit = mysql_query("UPDATE goods SET number=number-1 WHERE id='$myrow2[id]'", $db);
				}while($myrow2 = mysql_fetch_assoc($result2));
			}
			


			if ($handle = opendir("upload/files/$del/")) {
				while (false !== ($file = readdir($handle))) { 
					if ($file != "." && $file != "..") { 
						unlink("upload/files/$del/".$file); 
					} 
				}
				closedir($handle); 
			}	
				
			@unlink("upload/img/".$myrow[img]);
			@unlink("upload/img/mimi_".$myrow[img]);
			@rmdir("upload/files/$del/");
			
			$del = mysql_query ("DELETE FROM goods WHERE id = '$del'",$db);		
			
			//echo "url=$url<br>";		
		}	
	}
	
	
	Header("location:../../?page=katalog&url=$url&msg=Удаление прошло успешно!");	
	exit;
	
}



if (isset($_POST[enabled])) {$enabled=1;} else {$enabled=0;}
$name =  f_data($_POST['name'],'text',0);
$art =  f_data($_POST['art'],'text',0);
$date = f_data($_POST['date'],'text',0);
$text = $_POST['text'];
$text_small = f_data($_POST['text_small'],'text',0);
$form = f_data($_POST['form'],'text',0);
$form_position = f_data($_POST['form_position'],'text',0);
$razmer = f_data($_POST['razmer'],'text',0);
$price1 = f_data($_POST['price1'],'text',0);
$price2 = f_data($_POST['price2'],'text',0);
$har = f_data($_POST['har'],'text',0);
$presence = f_data($_POST['presence'],'text',0);
$firm = f_data($_POST['firm'],'text',0);
$sale = f_data($_POST['sale'],'text',0);
$weight = f_data($_POST['weight'],'text',0);
$width = f_data($_POST['width'],'text',0);
$height = f_data($_POST['height'],'text',0);
$length = f_data($_POST['length'],'text',0);
$stamp = f_data($_POST['stamp'],'text',0);
$curent = f_data($_POST['curent'],'text',0);
$with_item = f_data($_POST['with_item'],'text',0);
$m_title = f_data($_POST['m_title'],'text',0);
$m_description = f_data($_POST['m_description'],'text',0);
$m_keywords = f_data($_POST['m_keywords'],'text',0);
//$m_link =  f_data($_POST['url_m_link'],'text',0)."/".f_data($_POST['m_link'],'text',0);
$m_link = f_data($_POST['m_link'],'text',0);
$count = f_data($_POST['count'],'text',0);
$url = $_POST[url];


if (!isset($_POST[edit]))
{
	set_logs("Каталог","Добавление товара",$name);
	//запрос к базе, - задание номера товара
	$result = mysql_query("SELECT * FROM goods WHERE url='$url' ORDER BY number DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result);
	if (mysql_num_rows($result)!=0)
	{
		$number =  $myrow[number]+1;
	}
	else
	{
		$number =  1;
	}
	
		
	//добавление
	$result_add = mysql_query ("INSERT INTO goods (name,art,date,text,form,form_position,enabled,m_title,m_description,m_keywords,m_link,number,url,price1,price2,har,presence,firm,sale,weight,width,height,length,razmer,stamp,curent,text_small,with_item,count) VALUES ('$name','$art','$date','$text','$form','$form_position','$enabled','$m_title','$m_description','$m_keywords','$m_link','$number','$url','$price1','$price2','$har','$presence','$firm','$sale','$weight','$width','$height','$length','$razmer','$stamp','$curent','$text_small','$with_item','$count')");	
	
	//запрос к базе
	$result = mysql_query("SELECT * FROM goods ORDER BY id DESC LIMIT 1");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];	
		
	if ($_FILES["img"] ["name"] != "")
	{ 
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/img/".$img_name);
		$url_img = "upload/img/".$img_name;
		$url_mini_img = "upload/img/mimi_".$img_name;		
		resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		$result_edit = mysql_query("UPDATE goods SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}	
	
	
	$name_folder = $id;
	@mkdir ("upload/files/$name_folder", 0755);
	@chmod("upload/files/$name_folder", 0755);
    
	if ($_FILES[files][tmp_name]!="")
	{
		$file_sql = "";
		foreach ($_FILES[files][tmp_name] as $key => $value)
		{
			$name_file = $_FILES[files][name][$key];
			$ext = substr($_FILES[files][name][$key], 1 + strrpos($_FILES[files][name][$key], "."));
			$name_file = str_replace(" ", "_",$name_file);
			
			if ($ext=='jpg' || $ext=='jpeg') 
			{
				if (f_data($name_file,'num_russ_simbol',0)==true) //определяем есть ли русские символы в названии файла
				{
					$name_file = f_data($name_file,'translit',0);
					@copy($value, "upload/files/$name_folder/".$name_file);
					resizeimg("upload/files/$name_folder/$name_file", "upload/files/$name_folder/mini_$name_file", 150, 250,$folder,$sfolder);
				} 
				else
				{
					@copy($value, "upload/files/$name_folder/".$name_file);
					resizeimg("upload/files/$name_folder/$name_file", "upload/files/$name_folder/mini_$name_file", 150, 250,$folder,$sfolder);
				}
				
			}
			else
			{
				$name_file = f_data($name_file,'translit',0);
				@copy($value, "upload/files/$name_folder/".$name_file);
			}
			
			$file_sql .= $name_file."|";
		}		
		
		$file_sql = substr($file_sql,0,-1);
		$result_edit = mysql_query("UPDATE goods SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
	
	
		/*************Добавление характеристик товара****************
		добавление характеристик к товару
		в цыкле обрабатывается массив $_POST,
		 отбираются только поля относящиеся к характеристикам (имяПоля_таблицаХарактеристик)
		поля характеристик обрабатываются в цикле, 
		после того как меняется таблица к которой относится характеристика, то данные заносятся в таблицу характеристик */
		$i=0;
		$name_table = $_POST[table];
		$id_new_goods = $myrow[id];
		
		foreach($_POST as $key=>$val)
		{

			if (substr_count($key,'har')!=0)  // поиск полей относящихся к характеристикам
			{
				
				$ARR_VAL.="'$val',"; // значение поля характеристики
				$key = str_replace("-har_", "", "$key");
				$ARR_KEY.="$key,";  //имя столбца таблицы характеристики 
			}
		}
		
		
		//последним действием сохраняем последние собранные данные
		$ARR_KEY = substr($ARR_KEY,0,strlen($ARR_KEY)-1);
		$ARR_VAL = substr($ARR_VAL,0,strlen($ARR_VAL)-1);
		
		$result_add = mysql_query ("INSERT INTO $name_table ($ARR_KEY,id_goods) VALUES ($ARR_VAL,'$id_new_goods')");
		//конец добавления характеристик
	//echo "INSERT INTO $name_table ($ARR_KEY,id_goods) VALUES ($ARR_VAL,'$id_new_goods')";
	
	Header("location:../../?page=katalog&url=$url&msg=Операция прошла успешно!");	
	exit;
}
else
{		
	set_logs("Каталог","Измение товара",$name);
	//запрос к базе, - задание номера товара
	$edit = f_data ($_POST[edit], 'text', 0);
	$number = f_data ($_POST[number], 'text', 0);
	$result = mysql_query("SELECT * FROM goods WHERE id='$edit'");
	$myrow = mysql_fetch_assoc($result);
	
	//запрос к базе, какой последний номер в базе
	$result_all = mysql_query("SELECT * FROM goods ORDER BY number DESC LIMIT 1");
	$myrow_all = mysql_fetch_assoc($result_all);
		
	if ($myrow[number]!=$_POST[number] && $_POST[number]<=$myrow_all[number] && $_POST[number]>0)
	{
		$result1 = mysql_query("SELECT * FROM goods WHERE id='".($edit-1)."'");
		$myrow1 = mysql_fetch_assoc($result1);				
		$p_last_e = $myrow1[id];
		
		$result2 = mysql_query("SELECT * FROM goods WHERE id='".($edit+1)."'");
		$myrow2 = mysql_fetch_assoc($result2);		
		$p_next_e = $myrow2[id];
		
		$result3 = mysql_query("SELECT * FROM goods WHERE id='$edit'");
		$myrow3 = mysql_fetch_assoc($result3);		
		$p_this_e = $myrow3[id];

		$result4 = mysql_query("SELECT * FROM goods");	
		$num_goods = mysql_num_rows($result4);
				
		if ($myrow3[numer]==1) {$max_elem = 1;}
		if ($myrow3[numer]==$num_goods) {$max_elem = 0;}
		if ($myrow3[numer]!=$num_goods && $myrow3[numer]!=1) {$max_elem = 10;}
		
		include("drag_drop.php");
		drag($myrow[number],$number);		
			
	}

	//редактирование
	$result_edit = mysql_query("UPDATE goods SET name='$name',art='$art', date='$date',text='$text',form='$form',form_position='$form_position',
	enabled='$enabled',m_title='$m_title',m_description='$m_description',m_keywords='$m_keywords',m_link='$m_link',url='$url', price1='$price1',price2='$price2',har='$har',presence='$presence',firm='$firm',sale='$sale',weight='$weight',width='$width',height='$height',length='$length',razmer='$razmer',stamp='$stamp',curent='$curent',text_small='$text_small', with_item='$with_item',count='$count' 
	WHERE id='$edit'", $db);


	//запрос к базе
	$result = mysql_query("SELECT * FROM goods WHERE id='$edit'");
	$myrow = mysql_fetch_assoc($result); 
	$id = $myrow[id];
			
	if ($_FILES[files][tmp_name]!="" && $_FILES[files][tmp_name][0]!='')
	{
		$file_sql = "";
		foreach ($_FILES[files][tmp_name] as $key => $value)
		{
			$name_file = $_FILES[files][name][$key];
			$name_file = str_replace(" ", "_",$name_file);
			$ext = substr($_FILES[files][name][$key], 1 + strrpos($_FILES[files][name][$key], "."));
			
			if (f_data($name_file,'num_russ_simbol',0)==true) //определяем есть ли русские символы в названии файла
			{
				$name_file = f_data($name_file,'translit',0);
				@copy($value, "upload/files/$edit/".$name_file);
				@resizeimg("upload/files/$edit/$name_file", "upload/files/$edit/mini_$name_file", 150, 250,$folder,$sfolder);
			} 
			else
			{
				@copy($value, "upload/files/$edit/".$name_file);
				@resizeimg("upload/files/$edit/$name_file", "upload/files/$edit/mini_$name_file", 150, 250,$folder,$sfolder);
				exit;
			}
			
			@chmod ("upload/files/$edit/".$name_file, 0755);
			$file_sql .= $name_file."|";
		}		
		
		$file_sql = substr($file_sql,0,-1);
		
		$result_edit = mysql_query("UPDATE goods SET files='$file_sql' WHERE id='$myrow[id]'", $db);
	}	
		

	if ($_FILES["img"] ["name"] != "")
	{ 
		@unlink("../../upload/img/".$myrow[img]);
		@unlink("../../upload/img/mimi_".$myrow[img]);
		$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // расширение файла	
		$img_name = md5($name.$date.rand(0,999999)).".$ext";
		copy($_FILES["img"]["tmp_name"], "upload/img/".$img_name);
		$url_img = "upload/img/".$img_name;
		$url_mini_img = "upload/img/mimi_".$img_name;		
		resizeimg($url_img, $url_mini_img, 350, 450,$folder,$sfolder);
		$result_edit = mysql_query("UPDATE goods SET img='$img_name' WHERE id='$myrow[id]'", $db);
	}
	
	
	
		/*************Добавление характеристик товара****************
		добавление характеристик к товару
		в цыкле обрабатывается массив $_POST,
		 отбираются только поля относящиеся к характеристикам (имяПоля_таблицаХарактеристик)
		поля характеристик обрабатываются в цикле, 
		после того как меняется таблица к которой относится характеристика, то данные заносятся в таблицу характеристик */
		$i=0;
		$name_table = $_POST[table];
		$name_table = f_data ($name_table, 'text', 0);
		$id_new_goods = $myrow[id];
		$har_add=0;//не имеются характеристики

		
		
		foreach($_POST as $key=>$val)
		{

			if (substr_count($key,'har')!=0)  // поиск полей относящихся к характеристикам
			{
				
				$ARR_VAL.="'$val',"; // значение поля характеристики
				$key = str_replace("-har_", "", "$key");
				$ARR_KEY.="$key,";  //имя столбца таблицы характеристики 
				$ARR_EDIT.="$key='$val',";
				$har_add=1;//имеются характеристики
			}
		}
		
		
		//последним действием сохраняем последние собранные данные
		$ARR_KEY = substr($ARR_KEY,0,strlen($ARR_KEY)-1);
		$ARR_VAL = substr($ARR_VAL,0,strlen($ARR_VAL)-1);
		$ARR_EDIT = substr($ARR_EDIT,0,strlen($ARR_EDIT)-1);
		
		if ($har_add==1)
		{
			//запрос к базе
			$result = mysql_query("SELECT * FROM $name_table WHERE id_goods='$id_new_goods'");
			
			if (mysql_num_rows($result)==0)
			{
				$result_add = mysql_query ("INSERT INTO $name_table ($ARR_KEY,id_goods) VALUES ($ARR_VAL,'$id_new_goods')");
			}		
			else
			{
				$result_edit = mysql_query("UPDATE $name_table SET $ARR_EDIT WHERE id_goods='$id_new_goods'", $db);
			}
		}
		
		//конец добавления характеристик
	

	Header("location:../../?page=katalog&url=$url&msg=Операция прошла успешно!");	
	exit;		
	
}

ob_flush();	
?>