
$(document).ready(function() {
	
	$(".msgBox_close_windows").click(function() {$('#msgBox').fadeOut();});
	$(".msgBox_close_windows_del").click(function() {$('#msgBox_del').fadeOut();});
	$(".button_no").click(function() {$('#msgBox_del').fadeOut();});
	
	$(".type_devel").niceScroll({cursorcolor:"#b7bfc6"}); //ползунок для div
	
	//$("input, textarea").focusin(function() {$(this).addClass("focus_input");});//подсветка поле при его выделении
	//$("input, textarea").focusout(function() {$(this).removeClass("focus_input");});//убераем подсветку поля при удалении фокуса с элемента
	$(".pole_chek").keypress(function() {$(".m"+$(this).attr("num")).html($(this).val().length)+1;})//определение длины текста введенного в input или textarea

	//Показывать или убрать меню на мобильника
	$(".menu_ico_mob").click(function() {
		$(".box_nav_mob").animate({left: "0px"}, 400);
		var height_screen = screen.height;
		$(".box_nav_mob").css("height",height_screen);
		$(".close_box_nav_mob").css("display","block");
		$(".menu_ico_mob").fadeOut();
		$("#body").animate({left: "300px"}, 400);
		$("body").css("overflow", "hidden");
        $(".bg_page").fadeIn();
	})	
	
	$(".close_box_nav_mob, .bg_page").click(function() {
		$(".box_nav_mob").animate({left: "-350px"}, 500);
		$(".close_box_nav_mob").css("display","none");
		$(".menu_ico_mob").fadeIn();
		$("#body").animate({left: "0px"}, 400);
		$("body").css("overflow", "visible");
        $(".bg_page").fadeOut();
	})
    

	$(".pr_kirill").keyup(function() {
		//запрещает ввод кириллицы
		var reg = /[а-яА-ЯёЁ]/g; 
		if (this.value.search(' ') !=  -1) {this.value  =  this.value.replace(' ', '');}
		if (this.value.search(reg) !=  -1) {this.value  =  this.value.replace(reg, '');}		
	});
	
	$(".name").focusout(function() {if ($(".m_title").val()=="") {$(".m_title").val($(this).val());}});//убераем подсветку поля при удалении фокуса с элемента
	var name_link1 = $(".name_link1").html(); // сохраняем значение имени (названия) по умолчанию (Например "Новость")
	$(".name").keyup(function() {$(".name_link1").html(name_link1+" <b>"+$(".name").val()+"</b>"); $(".m_link").val(toTranslit($(".name").val()));});//в заголовок вкладки вставляем название из имени
	
	$(".name_link4").click(function() {
		$(".m1").html($(".m_title").val().length);
		$(".m2").html($(".m_description").val().length);
		$(".m3").html($(".m_keywords").val().length);
		$(".m4").html($(".m_link").val().length);
	});
	
	$(".name_link").click(function() {
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
	
	
	//купить в один клик
	$(".btn_buy_one_click").click(function() {
		$.post("/blocks/ajax_infgoods_buy_one_click.php",
		  {
			id: $(this).attr('num')
		  },
		  onAjaxSuccess_buy
		);
		 
		function onAjaxSuccess_buy(data)
		{
		  $(".msg_buy_text").html(data);
		}		 
		
		$("#msg_buy").fadeIn();  
	 });
	 
	 
	 $(".msg_buy_btn").click(function() {
	 	$("#msg_buy").fadeOut();
	 })
	
	/*
	$("#msg_buy").draggable({ cursor:"pointer"});
	$(".msg_buy_text").draggable({ helper:'#msg_buy' })
	 */
	/////////////////////////////
	
	
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
	
	 
	 $(".popup,#popup").click(function(e){
		e.preventDefault();
	 });
	 	 
	 $(".btn_cancel_meta").click(function() {
		$(".box_meta_form").fadeOut();
	 });
	
	 $(".show_meta_form").click(function() {
		$(".box_meta_form").fadeIn();
	 });

	 $(".title_meta_frm").keyup(function() {
		if ($(".chek_translit_meta").prop("checked")==true) {
			var title_meta_frm = $(".title_meta_frm").val();
	 		title_meta_frm = toTranslit(title_meta_frm);
	 		$(".m_link").val(title_meta_frm);
		}
	 });	 
	 
	 $(".chek_translit_meta").change(function() {
	 	if ($(this).prop("checked")==true) {
	 		var title_meta_frm = $(".title_meta_frm").val();
	 		title_meta_frm = toTranslit(title_meta_frm);
	 		$(".m_link").val(title_meta_frm);
	 	}
	 	else
	 	{
			$(".m_link").val($(this).attr("num"));
		}
	 })
	 
	 $(".btn_save_meta").click(function() {
	 	if ($(".title_meta_frm").val()!='')	{$(this).val("ждите...");}
	 })



	 $(".button_cancel").click(function() {
		 $("#form_preview input[type=text],textarea").val('');
		  $("#zayvka2 input[type=text],textarea").val('');
		 $("#feedback input[type=text],textarea,input[type=email],input[type=url]").val('');
		 $("#vopros_otvet_form input[type=text],textarea,input[type=email],input[type=url]").val('');
		 $("#comments input[type=text],textarea,input[type=email],input[type=url]").val('');
	 });
	 
	$(".phone").mask("8 999 999-9999");
	
	$(".close_forma_callback").click(function() {
		$(".forma_callback").fadeOut();
        $(".bg_page").fadeOut();
	});
	
	$(".close_forma_enter").click(function() {
		$(".forma_enter").fadeOut();
        $(".bg_page").fadeOut();
	});
		
	
	$(".btn_callback").click(function() {
		$(".forma_callback").fadeIn();
        $(".bg_page").fadeIn();
	});

	$(".open_form_enter").click(function() {
		$(".forma_enter").fadeIn();
	});
		
	 $.fn.scrollToTop=function(){
		 $(this).hide().removeAttr("href");
		 if($(window).scrollTop()!="0"){
			 $(this).fadeIn("slow")
	   }
	   
	   var scrollDiv=$(this);
	   $(window).scroll(function(){
		 if($(window).scrollTop()=="0"){
		 $(scrollDiv).fadeOut("slow"); $("#cart").removeClass("cart_down"); $("#cart").fadeOut();
		 }else{
		 $(scrollDiv).fadeIn("slow"); $("#cart").addClass("cart_down"); $("#cart").fadeIn();
	   }
	   
	   });
		 $(this).click(function(){
		   $("html, body").animate({scrollTop:0},"slow")
		 })
	   }
	 

	 
	 
	 $(".button_zakaz").click(function() {
		$(this).html("<img src='/img/add_cart.gif' height='13'>"); 
		var id_goods = $(this).attr("numid");
		
		$.post("/blocks/ajax_add_cart.php",
		  {
			id: $(this).attr("numid"),
			price: $(this).attr("num"),
			count_goods: "",
			numskidka: $(this).attr("numskidka")
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
			$("#cart").mouseover();
			$(".button_zakaz").html("в корзину"); 
		 	get_carts();
		 	showBoxAddCarts(data);
		 	$(".bg_page").css("display","block");
		}
	 });
	 
	 
	 $(".close_add_carts, .close_add_carts2").click(function() {
	 	$(".box_add_carts").css("display","none");
	 	$(".bg_page").css("display","none");
	 })
	 
	 var cart_view=0;
	 $("#cart").mouseover(function() {
		if (cart_view==0) {$(this).animate({top: "0px"}, 500); cart_view=1;}
	 });
	 
	 $("#cart").mouseleave(function() {
		$(this).stop();
		$("#cart").css("top","-65px"); 
		cart_view=0;
	 });
	 
	 
	 get_carts();
	 
	 $(".cout_carts").focusout(function() {
		 if ($(this).val()=='' || $(this).val()==0) {$(this).val('1');} 
	 })
	
 	//удаление куки из корзины и обновление данных 
	$(".del_carts").click(function() {
		var del_carts = $(this).attr("num")*1;
		
		$.post("/blocks/ajax_add_cart.php",
		  {
			del: del_carts
		  },
		  onAjaxSuccessDel
		);
		 
		function onAjaxSuccessDel(data)
		{
		  	get_carts();
			$(".box_carts_list_"+data).css("background-color","#f98d8d !important").delay(100).fadeOut();
		}		 
		
	});
	
	 var box_contact_send = $(".box_contact_send").html();
	 
	 
	 $(".clear_carts").click(function() {
	 	$(this).html("<img src='/img/add_cart.gif' height='15'/>");
	 	
	 	$.post("/blocks/ajax_add_cart.php",
		  {
			del_all: ""
		  },
		  onAjaxSuccessDellall
		);
		 
		function onAjaxSuccessDellall(data)
		{
		  	window.location.href = '/';
		}
	 });

	
	$(".add_sravnenie").click(function() {
		if (get_cookie("sravnenie1")==null) {set_cookie("sravnenie1",$(this).attr("num"),0,0,0,'/'); alert("Товар добавлен в список сравнения!");}
		else if (get_cookie("sravnenie2")==null) {set_cookie("sravnenie2",$(this).attr("num"),0,0,0,'/'); alert("Товар добавлен в список сравнения!");}
		else if (get_cookie("sravnenie3")==null) {set_cookie("sravnenie3",$(this).attr("num"),0,0,0,'/'); alert("Товар добавлен в список сравнения!");} 
		else if (get_cookie("sravnenie4")==null) {set_cookie("sravnenie4",$(this).attr("num"),0,0,0,'/'); alert("Товар добавлен в список сравнения!");} 
		else {alert("Нельзя сравнивать более 4х товаров, удалите лишние!");}
		
	});
	
	
	var scrinWidth = $(window).width();
	var right_pop = ((scrinWidth-980)/2)+660;
	$('#cart').css("right",right_pop+"px");	
	
	$(".bg_page").click(function() {
		$(this).fadeOut();
		$(".poprel").fadeOut();	
		$(".box_add_carts").fadeOut();
        $(".forma_callback").fadeOut();
	});

	 
	$("#but_per").click(function() {
		$(".poprel").fadeOut(); 
		$(".bg_page").fadeOut(); 
	});
	

	//если показывается в GET переменная msg, то удаляем ее из url
	if ($(".poprel input").hasClass("url_now")==true)
	{
		$('.bg_page').fadeIn();
		var stateParameters = { foo: "bar" };
		var uri = $(".url_now").val(); // или предварительно формирование uri
		history.pushState(stateParameters, "New page title", uri);
		history.pathname = uri;		
	}
	

	
	$(".count_min").click(function() {
		var count_carts = $(".count_carts_"+$(this).attr("num")).val();
		count_carts = count_carts-1;
		if (count_carts>0)
		{
			$(".count_carts_"+$(this).attr("num")).val(count_carts);
			update_carts($(this).attr("num"));
		}
	})
	
	
	
	$('.count_max').click(function() {
		var count_carts = $(".count_carts_"+$(this).attr("num")).val()*1;
		count_carts = count_carts+1;
		
		if (count_carts<100000)
		{
			$(".count_carts_"+$(this).attr("num")).val(count_carts);
			update_carts($(this).attr("num"));
		}
	});	
	
    
	
	//добавление в избранное
	$(".add_fovorit").on("click",function() {
		var id_g = $(this).attr("num");
		var btn_fovorit = $(this);
		
		$(this).html("<img src='/img/add_cart.gif' height='14' style='margin-top:5px;'/>");
		
		$.post("/blocks/ajax_add_favorites.php",
		  {
			id_g: id_g
		  },
		  onAjaxSuccessAddFavorit
		);
		 
		function onAjaxSuccessAddFavorit(data)
		{
			btn_fovorit.html("добавить в избранное");
			showBoxFavorites();
		}
	})
	
	showBoxFavorites();
	
	
	$(".box_favorites").on("click",function() {
		window.location.href = '/favorites/'
	});
	
	
	//удалить из избранного
	$(".del_favorites").on("click",function() {
		var id_f = $(this).attr("num");
		$(this).html("<img src='/img/preloader.gif' height='13' atyle='display:inline-block; margin-top:3px'/>");
		
		$.post("/blocks/ajax_add_favorites.php",
		  {
			del: id_f
		  },
		  onAjaxSuccessDelFavorit
		);
		 
		function onAjaxSuccessDelFavorit(data)
		{
			$(".line_goods_favorites_"+id_f).fadeOut();
			showBoxFavorites();
		}
	});
	
	
	
	//отправка формы (заявка, обратная связь и т.п.)
	$(".btn_frm").click(function() {
		var title_btn = $(this).val();
		$(this).val("ждите...");
		
		var name_form = $(".name_form").val();
		var error_frm = 1;
		var error_frm2 = 1;
		var error_frm3 = 1;
		
		if ($("input").is("."+name_form+"_name")) 
		{
			if ($("."+name_form+"_name").val()=='')
			{
				$("."+name_form+"_name").css("border","1px solid red");
				error_frm = 0;
			}
			else
			{
				$("."+name_form+"_name").css("border","1px solid #dcdcdc");
				error_frm = 1;
			}
		}
		else
		{
			error_frm = 1;
		}
		
		
		if ($("input").is("."+name_form+"_phone")) 
		{
			if ($("."+name_form+"_phone").val()=='')
			{
				$("."+name_form+"_phone").css("border","1px solid red");
				error_frm2 = 0;
			}
			else
			{
				$("."+name_form+"_phone").css("border","1px solid #dcdcdc");
				error_frm2 = 1;
			}
		}
		else
		{
			error_frm2 = 1;
		}
		
		
		if ($("input").is("."+name_form+"_mail")) 
		{
			if ($("."+name_form+"_mail").val()=='')
			{
				$("."+name_form+"_mail").css("border","1px solid red");
				error_frm3 = 0;
			}
			else
			{
				$("."+name_form+"_mail").css("border","1px solid #dcdcdc");
				error_frm3 = 1;
			}
		}
		else
		{
			error_frm3 = 1;
		}
		
		
		if (error_frm == 1 && error_frm2 == 1 && error_frm3 == 1)
		{
			//Тип формы (заявка, обратная связь и т.п.), определяем обработчик
			if ($(".type_form").val()=="zayvka") {$("."+name_form).attr("action","/blocks/obr_zayvka.php"); $("."+name_form).submit();}
			if ($(".type_form").val()=="feedback") {$("."+name_form).attr("action","/blocks/obr_feedback.php"); $("."+name_form).submit();}
		}
		else
		{
			$(this).val(title_btn);
		}
	})
	
	
	$(".btn_send_callback").click(function() {
		if ($(".phone_callback").val()!='') {$(this).val("отправляю...");}
	})
	
	
	
	var slider2_img = $(".slider2_img").height();
	$("#box_slider2").css("height",slider2_img);
		
	//измение размера окна браузера
	$(window).resize(function(){
		//подгоняется слайдер
		slider2_img = $(".slider2_img").height();
		$("#box_slider2").css("height",slider2_img);
	});
	
	
	//скролинг страницы
	$(window).scroll(function(){
		fixed_edit_line_up();
  	});	 

  	fixed_edit_line_up();
  	
  	var btn_display_menu_mob=0;
  	$(".btn_show_inf_carts_mob").click(function() {
		$(".box_left_katalog_mob").slideToggle();
		if (btn_display_menu_mob==1) {
			btn_display_menu_mob=0;
			$(this).html("показать каталог");
		}
		else
		{
			btn_display_menu_mob=1;
			$(this).html("скрыть каталог");			
		}
  	})
  	
  	
  	//используется для свипа (по экрану пальцем)
  	//открываем меню
    /*
	 $("body").on("swiperight", function(e){
	 	if (screen.width <= '970') {
		 	var $target = $(e.target);
		 	if ( !$target.is('#box_slider2') && !$target.parents('#box_slider2').length) {
		 		$(".menu_ico_mob").click();
		 	}
	 	}
	 });
	 
	 $("body").on("swipeleft", function(e){
	 	if (screen.width <= '970') {
	 		$(".close_box_nav_mob").click();
	 	}
	 });
     
     */
     
     
     $(window).resize(function(){
        var w_width = $(document).width();
        var w_height = $(document).height();

    });
});


//обновляет информацию об избранном
function showBoxFavorites()
{
	$.post("/blocks/ajax_get_favorites.php",
	{
		update: 1
	},
	  onAjaxSuccessGetFavorit
	);
	 
	function onAjaxSuccessGetFavorit(data)
	{
		if (data>0)
		{
			$(".box_favorites").fadeIn().delay(100).fadeOut().delay(100).fadeIn().delay(100).fadeOut().delay(100).fadeIn();
			$(".div_favorites").html(data);
		}
		else
		{
			$(".box_favorites").fadeOut();
		}
	}
}



//Определяет  положение прокрутки и фиксирует кнопки изменения страницы администратора
function fixed_edit_line_up()
 {
 	var w_top = $(window).scrollTop();

	if (w_top>20)
	{
		$(".edit_button").css("position","fixed");
		//$(".menu_ico_mob").css("border","1px solid #9c9c9c");
	}
	else
	{
		$(".edit_button").css("position","relative");
		//$(".menu_ico_mob").css("border","1px solid rgba(0,0,0,0)");
	}
    
    return w_top;
 }
	  


//показывает форму добавление товара
function showBoxAddCarts(id_goods)
{
 	$.post("/blocks/ajax_get_inf_goods.php",
	  {
		id_carts: id_goods
	  },
	  onAjaxSuccessGetGoods
	);
	 
	function onAjaxSuccessGetGoods(data)
	{
	  	$(".main_container_add_carts").html(data);
	  	$(".box_add_carts").css("display","block");
	  	
	
		$(".count_max").click(function() {
			var count_carts = $(".count_carts_"+id_goods).val()*1;
			count_carts = count_carts+1;
			if (count_carts<100000)
			{
				$(".count_carts_"+id_goods).val(count_carts);
				update_carts2(id_goods,count_carts);
			}
		})
		
		
		
		$('.count_min').click(function() {
			var count_carts = $(".count_carts_"+id_goods).val();
			count_carts = count_carts-1;
			if (count_carts>0)
			{
				$(".count_carts_"+id_goods).val(count_carts);
				update_carts2(id_goods,count_carts);
			}
		});
		
		
		$(".popup,#popup").click(function(e){
			e.preventDefault();
	 	});
		  	
	}	
}


$(function() {$("#toTop").scrollToTop();});


//перевод числа на порядки
function convert_price(n) 
{
	return n.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ") ;
}


//обновление корзины при изменении количества во всплывающей форме
function update_carts2(id_line,count_carts)
{
	var id_g = $(".id_g_"+id_line).val();
	
	$.post("/blocks/ajax_add_cart.php",  {
			id: id_g,
			price: "",
			count_goods: count_carts
		  },
		  onAjaxSuccess
	);
	
	function onAjaxSuccess(data)
	{
	 	get_carts();
	}
	
}


//обновление корзины
function update_carts(id_line)
{
	$(".box_right_carts-summa span").html("<img src='/img/preloader.gif' height='25' />");
	var price_carts = $(".carts_list_price_"+id_line).find("span").html();
	price_carts = price_carts.replace(" ","")*1;
	
	var count_carts = $(".count_carts_"+id_line).val()*1;
	
	var summ_carts = (count_carts*price_carts)+"";
	summ_carts = convert_price(summ_carts);
	$(".carts_list_summa_"+id_line).find("span").html(summ_carts);
	
	var id_g = $(".id_g_"+id_line).val();
	
	$.post("/blocks/ajax_add_cart.php",  {
			id: id_g,
			price: "",
			count_goods: count_carts
		  },
		  onAjaxSuccess
	);
		 
	function onAjaxSuccess(data)
	{
		var summa_all_carts = 0;
		$(".carts_list_summa").each(function(indx, element){
		 	var summ_new = $(element).find("span").html();
		 	summ_new = summ_new.replace(" ","")*1;
		 	summa_all_carts = summa_all_carts+summ_new;
		});
		
		summa_all_carts = summa_all_carts+"";
		summa_all_carts = convert_price(summa_all_carts);
		$(".box_right_carts-summa span").html(summa_all_carts);
	 	get_carts();
	}			
}

//подписка на сайт
function sendPodpis()
{
	if (isValidEmail($(".email_podpis").val())==true)
	{
		$.post("/blocks/ajax_podpis.php",
		  {
			email: $(".email_podpis").val()
		  },
		  onAjaxSuccess_podpis
		);
		 
		function onAjaxSuccess_podpis(data)
		{
		  if (data=='ok') {alert("Вы подписаны на новости сайта!");} else {alert("Неверно ввели E-mail!");} 
		}		
	}
	else
	{
		alert("Введите корректный e-mail");
	}

}


//обновление корзины
function get_carts()
{
		$.post("/blocks/ajax_carts.php",
		  {
			all_inf: "1"
		  },
		  onAjaxSuccess_carts
		);
		 
		function onAjaxSuccess_carts(data)
		{
		  $(".text_carts").html(data); 
		}
		
		$.post("/blocks/ajax_carts.php",
		  {
			all_inf: "0"
		  },
		  onAjaxSuccess_carts2
		);
		 
		function onAjaxSuccess_carts2(data)
		{
		  if (data!=0 && data!='') {
		  	//$(".inf_goods_cart").html(data+" товара(ов) в корзине");} else {$(".inf_goods_cart").html("корзина пуста");
		  	$(".main_count").html(data);
		  }
		}			
					
}


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
function delete_cookie(cookie_name)
{
  var cookie_date = new Date ( );  // Текущая дата и время
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


/*tinymce.PluginManager.load('moxiecut', '../tinymce/plugins/moxiecut/plugin.min.js');

tinymce.init({
    selector: ".moxiecut",
	image_advtab: true,
	language : 'ru',
    height: 300,
    relative_urls: false,
    plugins: [
     "anchor",
	 "emoticons",
	 "code",
	 "image",
	 "link",
	 "print",
	 "table",
	 "media",
	 "paste",
	 "moxiecut"
    ],
    toolbar: "insertfile undo redo |bold italic | alignleft aligncenter alignright alignjustify | bold italic | link image | anchor | emoticons | code | image | inserttable | textcolor | media | table | forecolor backcolor",
	image_advtab: true,
	autosave_ask_before_unload: false,
	autosave_ask_before_unload: false
});
*/



///////////////////////////////////////////////////////////////////////////
//транслитирация на js
// One character letters
w_table1 = "ABVGDEZIJKLMNOPRSTUFHXCYabvgdezijklmnoprstufhxcy'";
t_table1 = "АБВГДЕЗИЙКЛМНОПРСТУФХХЦЫабвгдезийклмнопрстуфххцыь";
 
// Two character letters
w_table2 = "YOJOZHCHSHYUJUYAJAyojozhchshyujuyajaYoYoZhChShYuJuYaJa";
t_table2 = "ЁЁЖЧШЮЮЯЯёёжчшююяяЁЁЖЧШЮЮЯЯ";
 
 
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


//транслитирация
 function toTranslit(text) {
    return text.replace(/([а-яё])|([\s_-])|([^a-z\d])/gi,
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


function forma_callback()
{
    var phone_callback = $(".phone_callback").val();
    $(".phone_callback").removeClass('forma_callback_input_h'); 
    
    if (phone_callback!='')
    {
        $(".forma_callback_box").html('<Br><Br><img src="/img/add_cart.gif" height="35"/>');
    	$.post("/blocks/ajax_callback.php",
    	  {
    		phone: phone_callback
    	  },
    	  onAjaxSuccess
    	);
    	 
    	function onAjaxSuccess(data)
    	{
    		if (data!="")
    		{
    			$(".forma_callback_box").html('<Br><Br><b>Спасибо!<Br>Скоро мы с Вами свяжемся!</b>');
    		}
    		else
    		{
    			$(".phone_callback").addClass('forma_callback_input_h');
    		}
    	  
    	}	
    }
    else
    {
       $(".phone_callback").addClass('forma_callback_input_h'); 
    }
}


//ввод только цифр в input в корзине
function checkCurr_carts(d,id) {
 if(window.event) 
 { 
 	var keyNum = event.keyCode;
 	if(event.keyCode == 37 || event.keyCode == 39 || (keyNum<=47 && keyNum>=57) || keyNum==8) return; 
 } 
	 
 	d.value = d.value.replace(/\D/g,'');
	var price = $(".price_"+id).html();
	var count = $(".count_"+id).val();
	if (count==0) {count=1; $(".count_"+id).val('0')}
	if (count>100000) {count=100000; $(".count_"+id).val('100000'); alert("Вы не можете ввести количество более 100 000!");}
	
	$(".summ_"+id).html(price*count);
	set_cookie("count_goods_"+id,count,2020,10,1,'/');
	
	$.post("/blocks/ajax_add_cart.php",
	  {
		id: id,
		price: price,
		count_goods: count
	  },
	  onAjaxSuccess
	);
	 
	function onAjaxSuccess(data)
	{
	  get_carts();
	}		 
	 
	 var new_count=0;
	$(".cout_carts").each(function(indx, element){
	  new_count=new_count+$(element).val()*1;
	});	 
	
	var new_summ=0;
	$(".summ_c").each(function(indx, element){
	  new_summ=new_summ+$(element).html()*1;
	});	
		 
	$(".count_all").html(new_count);
	$(".price_all").html(new_summ);
	$(".vsego_summa").html(new_summ);
 }
 

 
 function sendContacts()
 {
	$.post("/blocks/ajax_send_contacts.php",
	  {
		email: $(".email_user").val()
	  },
	  onAjaxSuccess_sendcontacts
	);
	 
	function onAjaxSuccess_sendcontacts(data)
	{
		if (data==1)
		{
			$(".box_contact_send").css('display','none').delay(3000).fadeIn();
			$(".box_contact_send2").fadeIn().delay(2500).fadeOut(10);
			$(".box_contact_send2").html('Информация Вам отправлена!');
		}
		else
		{
			$(".box_contact_send").css('display','none').delay(3000).fadeIn();
			$(".box_contact_send2").fadeIn().delay(2500).fadeOut(1);			
			$(".box_contact_send2").html('Неправильный e-mail!');
		}
	}		 
 }
 

 
 //валидность e-mail
function isValidEmail (email)
{
	regexp = /[a-z0-9!$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|pro|ru|jobs|museum)\b/

	if (email.match(regexp)!=null) {return true; } else {return false; }

}


function alertS(text)
{
    $(".boxAlert").fadeIn();
    $(".innerAlert-text").html(text);
}
 
 
function trim(s)	{
    return s.replace(/(^\s*)|(\s*$)/,"");
} 
  

//удалить все теги из строки  
function strip_tags(str){	// Strip HTML and PHP tags from a string
	// 
	// +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

	return str.replace(/<\/?[^>]+>/gi, '');
}
