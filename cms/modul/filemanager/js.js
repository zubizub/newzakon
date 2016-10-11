var url_obj='';
var ctrl_press = 0; //�����������, ������ �� ������ ctrl

$(document).keydown(function(event){
    if (event.keyCode == 17) {
       ctrl_press=1;
    }
});


$(document).keyup(function(event){
    if (event.keyCode == 17) {
       ctrl_press=0;
    }
});


$(document).ready(function() {
	url_file="";
	url_folder="";
	var color_bg="";
	var tr_chet = "#f6f6f6";
	var tr_nechet = "#fff";
	var stroka_select = 0; //���������� ��������� ������ ��� ���
	
	$(".check_fm").click(function() 
	{
			var obj_stroka = $(".tr_"+$(this).attr("num2"));
			//�������� ������
			if (obj_stroka.css("background-color")!=color_bg) 
			{
				obj_stroka.css("background-color",'#cee7fc');
				color_bg=obj_stroka.css("background-color");
				stroka_select=1;
			}
			else
			{
				if (obj_stroka.attr("num_shetnost")==0)
				{
					obj_stroka.css("background-color",tr_chet);
				}
				else
				{
					obj_stroka.css("background-color",tr_nechet);
				}
				stroka_select=0;
			}
			
			url_obj = $(this).attr('num');
			url_obj_name = $(this).attr('name');
			prava = $(this).find("a").attr('prava');
			$(".m_download_file").attr("href","/"+url_obj); //��������� ���� � ����� � ������ ���������� �����
			$(".up_menu_fm").css("opacity","1");
			
			//������� ���������� � ������� (��������))
			if (obj_stroka.find("a").attr("name")!='')
			{
				if (stroka_select==1)//���� ������ ���������
				{
					if (url_file.indexOf(obj_stroka.find("a").attr("name"))=="-1" && url_folder.indexOf(obj_stroka.find("a").attr("name"))=="-1")
					{
						if (obj_stroka.find("a").attr("value")!='folder')
						{
							if (url_file=='')
							{
								url_file = url_file+obj_stroka.find("a").attr("name");
							}
							else
							{
								url_file = url_file+"++"+obj_stroka.find("a").attr("name");
							}								
						}
						else
						{
							if (url_folder=='')
							{
								url_folder = url_folder+obj_stroka.find("a").attr("name");
							}
							else
							{
								url_folder = url_folder+"++"+obj_stroka.find("a").attr("name");
							}								
						}
					}					
				}
				else
				{
					url_file = url_file.replace("++"+obj_stroka.find("a").attr("name"), "");
					url_file = url_file.replace(obj_stroka.find("a").attr("name"), "");
				}
				
				$(".files_url").val(url_file);
				$(".folder_url").val(url_folder);
			}
	
	});
	
	$(".tbl_filemanager tr").dblclick(function() {
			if ($(this).find("a").attr('value')=='file')
			{
				edit_file($(this).attr('num'));
				$(".title_file").html("�������������� <b>"+$(this).attr('name')+"</b>");
			}
			else
			{
				send_url($(this).find("a").attr('num'));
			}
	})
	
	$(".check_fm_all").click(function() {
		if ($(this).prop("checked")==true)
		{
			$(".check_fm").each(function(indx, element){
	  			if ($(element).prop("checked")==false) {
	  				$(element).click();
	  			}
			});			
		}
		else
		{
			$(".check_fm").each(function(indx, element){
	  			if ($(element).prop("checked")==true) {
	  				$(element).click();
	  			}
			});			
		}
		
	})
	
	
	$(".close_windows").click(function() {$('.pop_fmanager1').fadeOut();});
	$(".close_windows_edit").click(function() {$('.box_edit').fadeOut();});
	
	$(".btn_box").click(function() {
		$(this).val("�����...");	
	})
	
});

function copyFile()
{
	$("#msgBox").fadeIn();
	$(".msgBox_content").html("���� ����������!");
	set_cookie("copy_file",url_obj);
}


function pastFile(url,real_url)
{
	if (get_cookie("copy_file")!=null)
	{
		//url - ����� � ���������� ������
		//real_url - ����� �� �������
		$.post("modul/filemanager/ajax_pastfile.php",
		  {
			copy_to: real_url
		  }
		);
		
		if (url!='')
		{
			window.location.replace('?page=fmanager&to_url='+url+"&�������� ���������!");
		}
		else
		{
			window.location.replace('?page=fmanager'+"&�������� ���������!");
		}
		
		delete_cookie("copy_file");
	}
	else
	{
		$("#msgBox").fadeIn();
		$(".msgBox_content").html("���������� ������� ����!");		
	}
}


function send_url(url)
{
	window.location.replace('?page=fmanager&to_url='+url);
}


function pop_fmanager1(msg, type) {	
	if (url_obj=='' && (type!=1 && type!=2 && type!=8))
	{		
		alert("�������� ���� ��� �����");
	}
	else
	{
		var popupid = $(this).attr('rel');
		$('.pop_fmanager1').fadeIn();
		var popuptopmargin = ($('.pop_fmanager1').height() + 10) / 2;
		var popupleftmargin = ($('.pop_fmanager1').width() - 200) / 2;
		$('.pop_fmanager1').css({
		'margin-top' : -popuptopmargin,
		'margin-left' : -popupleftmargin
		});
		
		$(".pop_fmanager_head").html(msg);
		$(".w_type").val(type);
		$(".w_method").val(url_obj);
		$(".btn_box").val("�����������");
		$(".w_name").fadeIn();
		
		if (type==1) {$(".w_name").val("");}
		if (type==3) {$(".w_name").val(url_obj_name); $(".w_old_name").val(url_obj_name);}
		if (type==2) {$(".w_name").val("");}
		if (type==4) {
			$(".w_name").val(prava); 
			$(".title_box").css("font-size","11px"); 
			$(".title_box").html("��������� ���� ���: <b>"+url_obj_name+"</b>"); 
			$(".w_old_name").val(url_obj_name); 
			$(".btn_box").val("�����������");
		}
		if (type==5) {
			$(".title_box").css("font-size","11px"); 
			$(".title_box").html("������� ��� ��������� ��� ��������: <b>"+url_obj_name+"</b>"); 
			$(".w_old_name").val(url_obj_name);
		}
		
		if (type==6) {$(".w_name").fadeOut(); 
			$(".title_box").css("font-size","11px"); 
			$(".title_box").html("�� ������ ����������� �����: <b>"+url_obj_name+"</b>?"); 
			$(".w_old_name").val(url_obj_name); 
			$(".btn_box").val("�����������");
		}

		if (type==7) {$(".title_box").css("font-size","11px"); $(".title_box").html("������� �������� ������"); $(".w_old_name").val(url_obj_name); 
		$(".btn_box").val("�����������");}
		
		if (type==8) {		
			$(".title_box").css("font-size","11px"); 
			$(".title_box").html("�������� ���� ��� ��������"); 
			$(".w_name").css("display","none");
			$(".w_file").css("display","block");
		}
	}
	
	$(".btn_box").val("�����������");
}


function edit_file(url_file)
{
	$(".url_file_input").val(url_file);
	$.post("modul/filemanager/ajax_edit_file.php",
	  {
		url: url_file,
		type: '1'
	  },
	  onAjaxSuccess_edit_file
	);
}


function onAjaxSuccess_edit_file(data)
{
	$(".box_edit_text").val(data);
	$(".box_edit").fadeIn();

}

function saveFile()
{
	$.post("modul/filemanager/ajax_edit_file.php",
	  {
		url: $(".url_file_input").val(),
		type: '2',
		text_file: $(".box_edit_text").val()
	  }
	);
	$(".box_edit").fadeOut();
}