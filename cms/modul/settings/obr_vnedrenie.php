<?

ob_start();
include("../../blocks/db.php");
include("../../blocks/f_data.php");
include("../../blocks/chek_user.php");
include("../../blocks/logs.php");

$result = mysql_query("SELECT * FROM users WHERE uid='$_COOKIE[uid]'");
$admin = mysql_num_rows($result);

if ($admin==0)
{
	Header("location:../../?page=vnedrenie&msg=�� �� ������ ������ ����!");	
	exit;	
}


$text = f_data($_POST['code'],'text',0);


set_logs("���������","��������� ����� �� �������");
//��������������
if (isset($_POST[edit_code]))
{
	$result_edit = mysql_query("UPDATE settings SET add_code='$text'", $db);
}

	
if ($text!='')
{	
	if (isset($_POST[edit_htaccess]))
	{
		 copy("../../../.htaccess", "../../backup/.htaccess");
		 $fp = fopen("../../../.htaccess", "w"); // ��������� ���� � ������ ������ 
		 $mytext = $_POST['code']; // �������� ������
		 $test = fwrite($fp, $mytext); // ������ � ����
		 fclose($fp); //�������� �����	
		 Header("location:../../?page=vnedrenie&num=2&msg=�������� ������ �������!");	
		 exit;	
	}

	if (isset($_POST[edit_robots]))
	{
		 $fp = fopen("../../../robots.txt", "w"); // ��������� ���� � ������ ������ 
		 $mytext = $_POST['code']; // �������� ������
		 $test = fwrite($fp, $mytext); // ������ � ����
		 fclose($fp); //�������� �����		
		 Header("location:../../?page=vnedrenie&num=3&msg=�������� ������ �������!");	
		 exit;
	}
	
	if (isset($_POST[edit_css]))
	{
		 $fp = fopen("../../../css/user.css", "w"); // ��������� ���� � ������ ������ 
		 $mytext = $_POST['code']; // �������� ������
		 $test = fwrite($fp, $mytext); // ������ � ����
		 fclose($fp); //�������� �����		
		 Header("location:../../?page=vnedrenie&num=8&msg=�������� ������ �������!");	
		 exit;
	}				
}
else
{
	
	if (isset($_POST[edit_favicon]))
	{
		set_logs("���������","��������� favicon");
		if ($_FILES["img"] ["name"] != "")
		{ 
			$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // ���������� �����
			if ($ext=='ico')
			{	
				$img_name ="favicon.ico";
				copy($_FILES["img"]["tmp_name"], "../../../".$img_name);
				Header("location:../../?page=vnedrenie&num=4&msg=�������� ���������!");	
				exit;
			}
			else
			{
				Header("location:../../?page=vnedrenie&num=4&msg=�������� ������ �����!");	
				exit;				
			}
		}	
				
		Header("location:../../?page=vnedrenie&num=4&msg=�������� �����������!");	
		exit;		
	}
	elseif (isset($_POST[edit_favicon2]))
	{
		set_logs("���������","��������� favicon");
		if ($_FILES["img"] ["name"] != "")
		{ 
			$ext = substr($_FILES['img']['name'], 1 + strrpos($_FILES['img']['name'], ".")); // ���������� �����
			if ($ext=='jpg')
			{	
				$img_name ="favicon.jpg";
				copy($_FILES["img"]["tmp_name"], "../../../".$img_name);
				Header("location:../../?page=vnedrenie&num=4&msg=�������� ���������!");	
				exit;
			}
			else
			{
				Header("location:../../?page=vnedrenie&num=4&msg=�������� ������ �����!");	
				exit;				
			}
		}	
				
		Header("location:../../?page=vnedrenie&num=4&msg=�������� �����������!");	
		exit;		
	}	
	elseif (isset($_POST[edit_file]))
	{
		set_logs("���������","�������� ����� � ������");
		$ext = substr($_FILES['file']['name'], 1 + strrpos($_FILES['file']['name'], ".")); // ���������� �����
		if ($ext!="exe" && $ext!="js" && $ext!="php")
		{
			$file_name = $_FILES['file']['name'];
			copy($_FILES["file"]["tmp_name"], "../../../".$file_name);
			Header("location:../../?page=vnedrenie&num=5&msg=�������� �����������!");	
			exit;										
		}
		else
		{
			Header("location:../../?page=vnedrenie&num=5&msg=������ ����� �� ����� ���� exe ��� js!");	
			exit;			
		}			
	}
	elseif (isset($_POST[pereadresat]))
	{
		set_logs("���������","��������� �������������");
		
		for ($i=1; $i<=100; $i++)
		{
			if (isset($_POST["pole_pereadr_".$i]))
			{
				$url = $_POST["pole_pereadr_".$i];
				$url_to = $_POST["pole_pereadr_to_".$i];
				$result_add = mysql_query ("INSERT INTO pereadresat (url,url_to) VALUES ('$url','$url_to')");	
			}
		}
		Header("location:../../?page=vnedrenie&num=6&msg=�������� ���������!");	
		exit;		
	}
	elseif (isset($_POST[formula_title_goods]))
	{
		$formula_title_goods =  f_data($_POST['formula_title_goods'],'text',0);
		$formula_desc_goods =  f_data($_POST['formula_desc_goods'],'text',0);
		$result_edit = mysql_query("UPDATE settings SET formula_title_goods='$formula_title_goods',formula_desc_goods='$formula_desc_goods'", $db);
		Header("location:../../?page=vnedrenie&num=7&msg=�������� ���������!");	
		exit;
	}	
	else
	{
		Header("location:../../?page=vnedrenie&msg=�������� �����������!");	
		exit;
	}
}

ob_flush();	
?>