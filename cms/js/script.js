
$(document).ready(function() {
	
	var checkbox_frost_chpu = $(".checkbox_frost_chpu").attr("num"); //замораживаем изменение „ѕ”
	
	$(".checkbox_frost_chpu").click(function() {
		if ($(this).prop("checked")==true)
		{
			checkbox_frost_chpu = 1;
		}
		else
		{
			checkbox_frost_chpu = 0;
		}	
	})
	
	
	$(".button_save_main").click(function() {
		if ($(".name").val()!='') {$(this).val("ждите....");}
	})
	
	$(".msgBox_close_windows").click(function() {$('#msgBox').fadeOut();});
	$(".msgBox_close_windows2").click(function() {$('#msgBox').fadeOut();});
	$(".msgBox_close_windows_del").click(function() {$('#msgBox_del').fadeOut();});
	$(".button_no").click(function() {$('#msgBox_del').fadeOut();});
	
	//$("input, textarea").focusin(function() {$(this).addClass("focus_input");});//подсветка поле при его выделении
	//$("input, textarea").focusout(function() {$(this).removeClass("focus_input");});//убераем подсветку пол€ при удалении фокуса с элемента
	
	$(".pole_chek").keypress(function() {
		$(".m"+$(this).attr("num")).html($(this).val().length)+1;
	})//определение длины текста введенного в input или textarea
	
	$(".pr_kirill").keyup(function() {
		//запрещает ввод кириллицы
		var reg = /[а-€ј-яЄ®]/g; 
		if (this.value.search(' ') !=  -1) {this.value  =  this.value.replace(' ', '');}
		if (this.value.search(reg) !=  -1) {this.value  =  this.value.replace(reg, '');}		
	});
	
	//убераем подсветку пол€ при удалении фокуса с элемента
	$(".name").focusout(function() {
		if ($(".m_title").val()=="") {
			$(".m_title").val($(this).val());
			var new_znach_page = $(".name").val();
			var new_znach = $(".name").val();
			if (new_znach_page.length>50) {new_znach_page=new_znach_page.substr(0,50)+"...";}
			
			$(".name_link1").html(name_link1+" <b>"+new_znach_page+"</b>"); 
			if (checkbox_frost_chpu==0) {
				$(".m_link").val(toTranslit(new_znach));
			}
		}
	});
	
	var name_link1 = $(".name_link1").html(); // сохран€ем значение имени (названи€) по умолчанию (Ќапример "Ќовость")
	
	
	//в заголовок вкладки вставл€ем название из имени
	$(".name").keyup(function() {
		var new_znach = $(".name").val();
		var new_znach_page = $(".name").val();
		if (new_znach_page.length>50) {new_znach_page=new_znach_page.substr(0,50)+"...";}
		
		$(".name_link1").html(name_link1+" <b>"+new_znach_page+"</b>"); 
		if (checkbox_frost_chpu==0) {
			$(".m_link").val(toTranslit(new_znach));
		}
	});
	
	
	$(".name_link4").click(function() {
		$(".m1").html($(".m_title").val().length);
		$(".m2").html($(".m_description").val().length);
		$(".m3").html($(".m_keywords").val().length);
		$(".m4").html($(".m_link").val().length);
	});
	
	$(".name_link").click(function(e) {
		e.preventDefault();
		$(".name_link").removeClass("menu_center_a_enabl");
		$(this).addClass("menu_center_a_enabl");
		$(".block_contayner").css("display","none");
		$(".block_contayner").css("display","none");
		$(".block"+$(this).attr("num")).css("display","block");
	});
	
	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});	
	
	
	//запоминает текст который стоит поумолчанию
	var text_pole_old;
	
	$(".text_pole").focus(function() {
		text_pole_old = $(this).val();
		var text_pole_new;
		text_pole_new =  $(this).val();
		if (text_pole_new == text_pole_old) {$(this).css('color','#000'); $(this).val('');} 
	});
	
	$(".text_pole").focusout(function() {
		text_pole_new =  $(this).val();
		if (text_pole_new == "") {$(this).css('color','#999'); $(this).val(text_pole_old);}
	});
	
	//////////////////////////////////////	
	
	 $(".popup,#popup").click(function(e){
		e.preventDefault();
	 });
	 
	 
	 $(".block3_toolbar").on("click",function() {
		$(".block3_toolbar_list").fadeIn(); 
	 });
	 
	 $(".block3_toolbar").on("mouseleave",function() {
		$(".block3_toolbar_list").fadeOut(); 
	 });	
	 

	 $("#left_menu").css("height",(screen.height-130)+"px"); 
	 $(".div2_left").css("height",(screen.height-100)+"px"); 
	 
	 $(".bg_l").css("height",(screen.height)+"px"); 
	 $(".bg_l").css("width",(screen.width)+"px"); 

	 $(".left_menu_a").on("click",function() {
		if ($(".td_left").css("width")!="300px") {$(".td_left").css("width","300px"); $(".close_left_menu").fadeIn();} 	
		$(this).find("img").animate({"opacity":"0.5"},200).animate({"opacity":"1"},200);
	 });
	 
	 
	 $(".close_left_menu").on("click",function() {
		 if (get_cookie ("close_left_menu")==0 || get_cookie ("close_left_menu")=='') {set_cookie("close_left_menu",'1');} else {set_cookie("close_left_menu",'0');}
		 $(this).fadeOut();
		 $(".td_left").css("width","110px");
		 $(".dop_podmenu").css("display","none");
	 });
	 
	 $(".left_menu_a1").on("click",function() {
		$(".dop_podmenu").css("display","none");
		$(".left_menu_a").removeClass("left_menu_a_hover");
		if ($(this).hasClass("left_menu_a_hover")) {$(this).removeClass("left_menu_a_hover"); $(".div2_left").css("display","none");}
		else {$(this).addClass("left_menu_a_hover"); $(".div2_left").css("display","block");} 
	 });
	 
	 $(".left_menu_a2").on("click",function() {
		$(".dop_podmenu").css("display","none");
		$(".left_menu_a").removeClass("left_menu_a_hover");
		$(this).addClass("left_menu_a_hover"); 
		$(".div2_left2").css("display","block");
	 });	 
	 
	 $(".left_menu_a3").on("click",function() {
		$(".dop_podmenu").css("display","none");
		$(".left_menu_a").removeClass("left_menu_a_hover");
		$(this).addClass("left_menu_a_hover"); 
		$(".div2_left3").css("display","block");
	 });


	 $(".left_menu_a4").on("click",function() {
		$(".dop_podmenu").css("display","none");
		$(".left_menu_a").removeClass("left_menu_a_hover");
		$(this).addClass("left_menu_a_hover"); 
		$(".div2_left4").css("display","block");
	 });


	 $(".left_menu_a5").on("click",function() {
		$(".dop_podmenu").css("display","none");
		$(".left_menu_a").removeClass("left_menu_a_hover");
		$(this).addClass("left_menu_a_hover"); 
		$(".div2_left5").css("display","block");
	 });


	 $(".left_menu_a6").on("click",function() {
		$(".dop_podmenu").css("display","none");
		$(".left_menu_a").removeClass("left_menu_a_hover");
		$(this).addClass("left_menu_a_hover"); 
		$(".div2_left6").css("display","block");
	 });

	 	 
	 $(".enbl_btn_desktop").on("click",function() {
		var str = $(this).css("background");
		if (str.indexOf('disabled_small') + 1)
		{
			$(this).css("background",'url("/cms/img/enabled_small.png")')
		}
		else {$(this).css("background",'url("/cms/img/disabled_small.png")')}

		$.post("blocks/ajax_desktop.php",  {type: $(this).attr("num")}, fnct_enabl);
		function fnct_enabl(data)
		{
			$(".inf_enbl_block").fadeIn().delay(3000).fadeOut(); 
		}
	 });
	 
	 
	 $("#msgBox").css("opacity","1").delay(2200).fadeOut();
	 
	 
	 $(".button_yes").click(function() {
	 	$(this).html("<img src='/img/preloader.gif' height='19' />");	
	 	$(".button_no").css("top","-2px");
	 })
	 
	 
	 
});


//установка куки 
function set_cookie ( name, value, exp_y, exp_m, exp_d, path, domain, secure )
{
  var cookie_string = name + "=" + escape ( value );
 
  if ( exp_y )
  {
    var expires = new Date ( exp_y, exp_m, exp_d );
    cookie_string += "; expires=" + expires.toGMTString();
  }
 
  if ( path )
        cookie_string += "; path=" + escape ( path );
 
  if ( domain )
        cookie_string += "; domain=" + escape ( domain );
  
  if ( secure )
        cookie_string += "; secure";
  
  document.cookie = cookie_string;
}

//удаление куки 
function delete_cookie ( cookie_name )
{
  var cookie_date = new Date ( );  // “екуща€ дата и врем€
  cookie_date.setTime ( cookie_date.getTime() - 1 );
  document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}

//получение куки 
function get_cookie ( cookie_name )
{
  var results = document.cookie.match ( '(^|;) ?' + cookie_name + '=([^;]*)(;|$)' );
 
  if ( results )
    return ( unescape ( results[2] ) );
  else
    return null;
}


var popuptopmargin = ($('#msgBox').height() + 10) / 2;
var popupleftmargin = ($('#msgBox').width() - 200) / 2;
$('#msgBox').css({
'margin-top' : -popuptopmargin,
'margin-left' : -popupleftmargin
});


var popuptopmargin = ($('#msgBox_del').height() + 10) / 2;
var popupleftmargin = ($('#msgBox_del').width() - 200) / 2;
$('#msgBox_del').css({
'margin-top' : -popuptopmargin,
'margin-left' : -popupleftmargin
});


tinymce.PluginManager.load('moxiecut', '../tinymce/plugins/moxiecut/plugin.min.js');

tinymce.init({
    selector: ".moxiecut",
    theme: "modern",
    language : 'ru',
    height: 300,
    width: 810,
    fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
        plugins: [
        	    "advlist autolink lists link image charmap print preview anchor",
        		"searchreplace visualblocks code fullscreen textcolor",
        		"insertdatetime colorpicker emoticons colorpicker media table contextmenu moxiecut"
        	],
        toolbar: "fontsizeselect | code | bullist | styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | link insertfile image  media | fullscreen",
    autosave_ask_before_unload: false,
    statusbar: false,
    relative_urls: false,
    forced_root_block : false,
    force_br_newlines : true,
    force_p_newlines : false,
    visualblocks_default_state: true,
    verify_html : false,
    image_advtab: true,
    extended_valid_elements : "a[name|href|target|title|onclick|class|rel],ul[],ol[]",
    entity_encoding: 'raw'
});




///////////////////////////////////////////////////////////////////////////
//транслитираци€ на js
// One character letters
w_table1 = "ABVGDEZIJKLMNOPRSTUFHXCYabvgdezijklmnoprstufhxcy'";
t_table1 = "јЅ¬√ƒ≈«»… ЋћЌќѕ–—“”‘’’÷џабвгдезийклмнопрстуфххцыь";
 
// Two character letters
w_table2 = "YOJOZHCHSHYUJUYAJAyojozhchshyujuyajaYoYoZhChShYuJuYaJa";
t_table2 = "®®∆„ЎёёяяЄЄжчшюю€€®®∆„Ўёёяя";
 
 
function translit2win(str) 
{
 var len = str.length;
 var new_str="";
 
 for (i = 0; i < len; i++)
 {
  // Check for 2-character letters
  is2char=false;
  if (i < len-1) {
   for(j = 0; j < w_table2.length; j++)
   {
    if(str.substr(i, 2) == t_table2.substr(j*2,2)) {
     new_str+= w_table2.substr(j, 1);
     i++;
     is2char=true;
     break;
    }
   }
  }
 
  if(!is2char) {
   // Convert one-character letter
   var c = str.substr(i, 1);
   var pos = t_table1.indexOf(c);
   if (pos < 0)
    new_str+= c;
   else 
    new_str+= w_table1.substr(pos, 1);
  }
 }
 
 return new_str;
}

/////////////////////////////////////////////////////////////////////////////

function trim(s)	{
	return s.replace(/(^\s*)|(\s*$)/,"");
}


//транслитираци€
 function toTranslit(text) {
 	text = text.trim();
    return text.replace(/([а-€Є])|([\s_-])|([^a-z\d])/gi,
    function (all, ch, space, words, i) {
        if (space || words) {
            return space ? '-' : '';
        }
        var code = ch.charCodeAt(0),
            index = code == 1025 || code == 1105 ? 0 :
                code > 1071 ? code - 1071 : code - 1039,
            t = ['yo', 'a', 'b', 'v', 'g', 'd', 'e', 'zh',
                'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
                'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh',
                'shch', '', 'y', '', 'e', 'yu', 'ya'
            ]; 
        return t[index];
    });
}



