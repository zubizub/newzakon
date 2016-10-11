$(document).ready(function() {
	$(".elemform").mouseover(function() {$('.bg_elemform').css("display","none"); $(this).find(".bg_elemform").css("display","block");});	
	$(".elemform").mouseleave(function() {$(".bg_elemform").css("display","none");});	
	$(".elemform1").click(function() {$('.name_pole').val(''); $('#msgBox_add_elemform').fadeIn(); $(".type_pole").val("1");});
	$(".elemform2").click(function() {$('.name_pole').val(''); $('#msgBox_add_elemform').fadeIn(); $(".type_pole").val("2");});
	
	$(".elemform3").click(function() {
		$('#msgBox_add_elemform').fadeIn(); 
		$(".type_pole").val("3"); 
		$(".ch_obyzat").css("display","none");
		$(".r_spisok").css("display","block");
	});
	
	$(".elemform4").click(function() {$('.name_pole').val(''); $('#msgBox_add_elemform').fadeIn(); $(".type_pole").val("4");});
	
	$(".msgBox_close_windows_add_elemform").click(function() {
		$('#msgBox_add_elemform').fadeOut(); 
		$('.name_pole').css("display","block"); 
		$(".ch_obyzat").css("display","block");
		$(".r_spisok").css("display","block");
		$(".r_spisok").css("display","none");
	});
	
	$("#elements_form").mouseleave(function() {$('.bg_elemform').css("display","none")});
	
	
	var r_spisok_name = 1;
	
	$(".r_spisok").delegate(".add_spisok","click",function(){
			r_spisok_name++;
			$(".r_spisok").append("<input name='spisok"+r_spisok_name+"' type='text' class='spisok_list' value=''> <span class='add_spisok plus_span' num='"+r_spisok_name+"'>+</span> <span class='del_spisok minus_span' num='"+r_spisok_name+"'>-<br></span>");
	})
	
	$(".r_spisok").delegate(".del_spisok","click",function(){
		var sel_name = $(this).attr("num");
		$("[name = spisok"+sel_name+"]").detach();
		$("[num = "+sel_name+"]").detach();
	});
	
	
	$("#palitra1").click(function() {
		$("#form_preview").removeClass("palitra2");	
		$("#form_preview").removeClass("palitra3");
		$("#form_preview").addClass("palitra1");
	});
	
	$("#palitra2").click(function() {
		$("#form_preview").removeClass("palitra1");	
		$("#form_preview").removeClass("palitra3");
		$("#form_preview").addClass("palitra2");
	});
	
	$("#palitra3").click(function() {
		$("#form_preview").removeClass("palitra2");	
		$("#form_preview").removeClass("palitra1");
		$("#form_preview").addClass("palitra3");
	});	
	
	
	$(".f_title").keyup(function() {
		$(".form_preview_head").html($(this).val());	
	});	
	
	$(".pole_editor").delegate(".del_elem","click",function(){
		$("[num="+$(this).attr("num")+"]").remove();	
	});	
	
	
	$(".name_form_spisok1").click(function() {
		$.post("modul/formmanager/ajax_get_form.php",  {id: $(this).attr("num"),type: "form"}, onAjaxSuccess_get_form);
		function onAjaxSuccess_get_form(data)	{$(".pole_editor").html(data);}		
		
		$.post("modul/formmanager/ajax_get_form.php",  {id: $(this).attr("num"),type: "palitra"}, onAjaxSuccess_get_palitra);
		function onAjaxSuccess_get_palitra(data)	{$(".pole_editor").attr("class",data);}				
		
		$.post("modul/formmanager/ajax_get_form.php",  {id: $(this).attr("num"),type: "f_mail"}, onAjaxSuccess_get_f_mail);
		function onAjaxSuccess_get_f_mail(data)	{$(".f_mail").val(data);}		
			
		$.post("modul/formmanager/ajax_get_form.php",  {id: $(this).attr("num"),type: "f_title"}, onAjaxSuccess_get_f_title);
		function onAjaxSuccess_get_f_title(data)	{$(".f_title").val(data);}	
		
		$.post("modul/formmanager/ajax_get_form.php",  {id: $(this).attr("num"),type: "f_title"}, onAjaxSuccess_get_capcha);
		function onAjaxSuccess_get_capcha(data)	{if (data==1) {$(".capcha").prop("checked",'checked');} else {$(".capcha").prop("checked",'');}}							
	});
});






var popuptopmargin = ($('#msgBox_add_elemform').height() + 10) / 2;
var popupleftmargin = ($('#msgBox_add_elemform').width() - 200) / 2;
$('#msgBox_add_elemform').css({
'margin-top' : -popuptopmargin,
'margin-left' : -popupleftmargin
});

var  rand_chislo = 1;
var elf; //идентификатор для удаление элемента формы

function add_elem()
{	
	rand_chislo++;
	elf = "elf"+rand_chislo;

	if ($(".name_pole").val()!='')
	{
		var obyzat = $(".ch_obyzat_ch").prop("checked"); //флажок установлен, поле обязательное для заполнения
		if (obyzat==true) {var obyzat="<span style='color:red'>*</span>";} else {var obyzat="";} 
		
		var name_pole_translit = translit2win($(".name_pole").val());
		var name_pole = $(".name_pole").val();
		
		if ($(".type_pole").val()==1) {
			$('#msgBox_add_elemform').fadeOut();
			$(".pole_editor").append("<span num='"+elf+"'>"+$(".name_pole").val()+" <span num='"+elf+"' class='del_elem'>удалить</span> "+obyzat+" <input name='f_title_name_pole"+name_pole_translit+"' type='text'> <input name='f_title_h_"+name_pole_translit+"' type='hidden' value='"+name_pole+"'></span>");
		}
		
		if ($(".type_pole").val()==2) {
			$('#msgBox_add_elemform').fadeOut();
			$(".pole_editor").append("<span num='"+elf+"'>"+$(".name_pole").val()+" <span num='"+elf+"' class='del_elem'>удалить</span> "+obyzat+" <textarea name='f_text_name_pole"+name_pole_translit+"' style='100%' rows='5'></textarea><input name='f_text_h_"+name_pole_translit+"' type='hidden' value='"+name_pole+"'></span>");
		}	
	
	
		if ($(".type_pole").val()==3) {
			$('#msgBox_add_elemform').fadeOut();
			var spisok_list='';
			$(".spisok_list").each(function(indx, element){
			  spisok_list = spisok_list+"<option value='"+$(element).val()+"'>"+$(element).val()+"</option>";
			});
			spisok_list = "<select name='f_select_name_pole"+name_pole_translit+"'>"+spisok_list+"</select><input name='f_select_h_"+name_pole_translit+"' type='hidden' value='"+name_pole+"'>";
			$(".pole_editor").append("<span num='"+elf+"'>"+$(".name_pole").val()+" <span num='"+elf+"' class='del_elem'>удалить</span> "+obyzat+spisok_list+"</span>");
		}	
		
		if ($(".type_pole").val()==4) {
			$('#msgBox_add_elemform').fadeOut();
			$(".pole_editor").append("<span num='"+elf+"'>"+"<label><input name='f_chek_name_pole"+name_pole_translit+"' type='checkbox' value=''> "+$(".name_pole").val()+"</label><input name='f_chek_h_"+name_pole_translit+"' type='hidden' value='"+name_pole+"'> <span num='"+elf+"' class='del_elem'>удалить</span></span>");
		}	
		
		$(".r_spisok").css("display","none");
	}
	else
	{
		alert("Значение не может быть пустым!");
		$(".name_pole").focusin();	
	}
}


function saveForm()
{

	$.post("modul/formmanager/ajax_save_form.php",
	  {
		forma: $(".pole_editor").html(),
		palitra: $("#form_preview").attr("class"),
		f_mail: $(".f_mail").val(),
		f_title:$(".f_title").val(),
		capcha:$(".capcha").val(),
		edit: $(".edit").val()
	  },
	  onAjaxSuccess_form
	);
	 
	function onAjaxSuccess_form(data)
	{
	   window.location.href = "?page=formmanager&msg=Форма созранена";
	}	
}


function del_form(del)
{
	$('#msgBox_del').fadeIn();
	$(".msgBox_head_del").html("Подтвердите удаление");
	$(".button_yes").attr("href","modul/formmanager/obr_main.php?del="+del);
}