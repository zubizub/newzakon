<?
include("$_SERVER[DOCUMENT_ROOT]/cms/blocks/db.php");
include("$_SERVER[DOCUMENT_ROOT]/cms/blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

if ($_POST[w_type]==1) // создание файла
{
	$old_name = f_data($_POST[w_old_name],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);
	$ourFileHandle = fopen($url.$name_name, 'w') or die("can't open file");
	fclose($ourFileHandle);
	set_logs("Файлменеджер","Создание файла");
	Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Файл успешно создан!");	
	exit;		
}


if ($_POST[w_type]==2) // создание папки
{
	$old_name = f_data($_POST[w_old_name],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);
	@chdir ("$url$name_name"); //путь где создавать папку
	@mkdir ($url.$name_name, 0775); //имя папки и атрибуты на папку
	set_logs("Файлменеджер","Создание папки");
	Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Изменение прошло успешно!");	
	exit;		
}


if ($_POST[w_type]==3)
{
	$old_name = f_data($_POST[w_old_name],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);
	set_logs("Файлменеджер","Переименование");
	rename("$url$old_name","$url$name_name");
	Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Изменение прошло успешно!");	
	exit;		
}
 
 
if ($_POST[w_type]==4)
{
	set_logs("Файлменеджер","Удаление файла");
	$old_name = f_data($_POST[w_old_name],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);
	
	if ($name_name==false)
	{
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Значение не может быть пустым!");	
	}
	else
	{
		@mkdir("$url$old_name", $name_name);
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Изменение прошло успешно!");
	}

	exit;		
} 
 
 
if ($_POST[w_type]==5)
{
	set_logs("Файлменеджер","Удаление дирректории или файла");
	$result = mysql_query("SELECT * FROM settings");
	$myrow = mysql_fetch_array($result); 	
	$s_pass = $myrow[s_pass];
	
	$old_name = f_data($_POST[w_old_name],'text',0);
	$files_url = f_data($_POST[files],'text',0);
	$folder_url = f_data($_POST[folder],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);
	
		function cleardir($url)
		{
			
			foreach (scandir("$url/") as $item) {
				if ($item != '.' && $item != '..')
				{
					$dir = $url."/".$item;
					
					if (is_dir($dir)==false) 
					{
						@unlink($dir);
					}
					else
					{
						@cleardir($dir);
						@rmdir($dir);
					}
				}
			}	
			
			@rmdir($url);	
		}
		
			
	if (md5(md5($name_name)) == $s_pass)
	{
		if ($files_url!='')
		{
			if (substr_count($files_url,"++")==0)
			{
				$FILES_ARR = $files_url;
				$one_file=1;
				@unlink("$url$FILES_ARR");
			}
			else
			{
				$FILES_ARR = explode("++",$files_url);
				$one_file=0;
				
				for ($i=0;$i<count($FILES_ARR);$i++)
				{
					@unlink("$url$FILES_ARR[$i]");
				}
			}
		}
		
		
		if ($folder_url!='')
		{
			if (substr_count($folder_url,"++")==0)
			{
				$FOLDER_ARR = $folder_url;
				$one_folder=1;
				cleardir("$url$FOLDER_ARR");
			}
			else
			{
				$FOLDER_ARR = explode("++",$folder_url);
				$one_folder=0;
				
				for ($i=0;$i<count($FOLDER_ARR);$i++)
				{
					cleardir("$url$FOLDER_ARR[$i]");
				}
			}	
		}	
		

		
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Изменение прошло успешно!");	
		exit;
	}
	else
	{
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Неверный пароль протекции!");	
		exit;
	}
	
			
}



if ($_POST[w_type]==7)
{
	set_logs("Файлменеджер","Создание архива");
	$old_name = f_data($_POST[w_old_name],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);
	@unlink("$url$name_name.zip");
	$real_url = f_data($_POST[real_url],'text',0);
	//снова создаем новый объект ZipArchive
	$zip = new ZipArchive;
	//снова используем метод open(), но теперь используем ключ ZipArchive::CREATE
	//который говорит, что архив нужно создать
	//а первым параметром передаем название архива] 
	

	$res = $zip->open("$url$name_name.zip", ZipArchive::CREATE);
	if ($res === TRUE) {
		//тут все просто: говорим, какой файл добавить в архив

			if (substr_count($_POST[files],"++")!=0)
			{
				$FILES_ARR = explode("++",$_POST[files]);
				
				for ($i=0;$i<count($FILES_ARR);$i++)
				{
					if (is_dir("$url$FILES_ARR[$i]")==true)
					{
						Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=В архив нельзя добавлять папки.");	
						exit;
					}
					else
					{
						if ($FILES_ARR[$i]!='') {$zip->addFile("$url$FILES_ARR[$i]","$FILES_ARR[$i]");}
					}
				}
			}
			else
			{
				if (is_dir("$url$_POST[files]")==true)
				{
					Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=В архив нельзя добавлять папки.");	
					exit;
				}
				else
				{
					$zip->addFile("$url$_POST[files]","$_POST[files]");
				}
			}
		
		//закрываем работу с архивом
		$zip->close();
	} else {
		echo 'Ошибка №'.$res;
	}

	
	if ($name_name==false)
	{
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Значение не может быть пустым!");	
	}
	else
	{
		@mkdir("$url$old_name", $name_name);
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Архив создан!");
	}

	exit;		
} 
 


if ($_POST[w_type]==6)
{
	set_logs("Файлменеджер","Распаковка архива");
	$old_name = f_data($_POST[files],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);;
	$new_name_arhiv =  $old_name;
	$new_name_arhiv = $url.str_replace(".", "", "$new_name_arhiv");
	@chdir ($new_name_arhiv); //путь где создавать папку
	@mkdir ($new_name_arhiv, 0775); //имя папки и атрибуты на папку	
	//$_POST[files]

		
	$zip = new ZipArchive;		
	if ($zip->open("$url$old_name") === TRUE) {
		$zip->extractTo($new_name_arhiv);
		$zip->close();
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Архив распакован!");
	} else {
		Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Ошибка при  извлечении информации из архива!");
	}
	exit;
}


if ($_POST[w_type]==8)
{
	set_logs("Файлменеджер","Загрузка фала");
	$old_name = f_data($_POST[w_old_name],'text',0);
	$url = f_data($_POST[w_url],'text',0);
	$name_name = f_data($_POST[name],'text',0);;	
	move_uploaded_file($_FILES["file"]["tmp_name"], "$url".$_FILES["file"]["name"]);
	chmod ("$url".$_FILES["file"]["name"], '644');
	Header("location:/cms/?page=fmanager&to_url=$_POST[w_to_url]&msg=Файл загружен!");	
	exit;
}
?>