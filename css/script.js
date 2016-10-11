/*

КЛАССЫ ДЛЯ HTML (input, ссылок и т.п.)
.phone - задается маска для телефона, применяется к input
.popup - применяется к ссылкам, запрет на выполнение действия, т.е. если задать этот клас ссылке, то при нажатии на нее страница не перепрыгнет вверх


ФУНКЦИИ
fixed_edit_line_up() - определяет положение прокрутки, возвращает отступ сверху
showBoxAddCarts(id_goods) - вызывает форму добавления товара в корзину
convert_price(n) - перевод числа на порядки, делает из "1000" - "1 000"
set_cookie("имя","значение",2020,10,1,'/') - установка кукисов 
delete_cookie("имя") - удаление кукисов  
get_cookie("имя")  - получение кукисов 
toTranslit("значение") - делает транслит
isValidEmail("значение") - проверка e-mail

//запрещает ввод кириллицы
$(".pr_kirill").keyup(function() {
	var reg = /[а-яА-ЯёЁ]/g; 
	if (this.value.search(' ') !=  -1) {this.value  =  this.value.replace(' ', '');}
	if (this.value.search(reg) !=  -1) {this.value  =  this.value.replace(reg, '');}		
});


//таймер
var timersite;
var timeSiteOut = 3700;
timersite = $.timer(timeSiteOut, function() {});			
//конец таймера


ПЕРЕМЕННЫЕ
w_width - ширина окна браузера в текущий момент
w_height - высота окна браузера в текущий момент


ДЛЯ AJAX
$.post("/blocks/ajax_test.php",  {param1: "param1",  param2: 2}, onAjaxSuccess);
function onAjaxSuccess(data)
{
  alert(data);
}

*/


$(document).ready(function() {
    
    $(".getDoc").on("click",function() {
        var secretCode = $(this).attr('num');
        $(".boxFormGetDoc").fadeIn();
        $(".fileDoc").val(secretCode);
        $(".bg_page").fadeIn();
    });    

    
    $(".datepicker").datepicker({ altFormat: "dd.mm.yyyy", dateFormat: "dd.mm.yy",
	 dayNamesMin: ['ВС', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'], firstDay: 1,
	  monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь', 'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь']
	});
    
    $('.inpCity').keyup(function(eventObject){
        var city = $(".inpCity").val();
        
        $.post("/blocks/ajax_get_city.php",  {city: city}, onAjaxSuccessCity);
 
        function onAjaxSuccessCity(data)
        {
          if (data!='')
          {
              $(".listCity").html(data);
              $(".listCity").fadeIn();
          }
          
          $('.listCity').find('a').on('click', function(e){
              var nameCityNew = $(this).html();
              $('.inpCity').val(nameCityNew);
              $(".listCity").fadeOut();
              return false;
          });
        }

    }); 
    
    
    $('.inpCityMain').keyup(function(eventObject){
        var city = $(".inpCityMain").val();
        
        $.post("/blocks/ajax_get_city.php",  {city: city}, onAjaxSuccessCity);
 
        function onAjaxSuccessCity(data)
        {
          if (data!='')
          {
              $(".listCityMain").html(data);
              $(".listCityMain").fadeIn();
          }
          
          $('.listCityMain').find('a').on('click', function(e){
              var nameCityNew = $(this).html();
              $('.inpCityMain').val(nameCityNew);
              $(".listCityMain").fadeOut();
              return false;
          });
        }

    });
    
    $('.listSearchSelect2-3').find('a').on('click', function(e){
          var nameCatNew = $(this).html();
          $('.boxHeadSearch2-select3').val(nameCatNew);
          $(".listSearchSelect2-3").fadeOut();
          $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
          showListOptionSearch3 = 0;
          return false;
      });
    
    

    $('.inpCity').on("focusout",function() {
        $(".listCity").fadeOut();
    })
    
    $(".headFormZayvka").on("focus",function() {
        $(".mainBoxheadFormZayvka").animate({backgroundColor: "rgba(255,255,255,0.5)"}, 500);
    }); 
    
    $(".headFormZayvka").on("focusout",function() {
        $(".mainBoxheadFormZayvka").animate({backgroundColor: "rgba(255,255,255,0.3)"}, 500);
    });   
    
    $(".formGetDoc-btn").on("click",function() {
        var mailUser = $(".mailUserDoc").val();
        
        mailUser = trim(mailUser);
        
        if (mailUser=='')
        {
            $('.mailUserDoc').css("border","1px solid red");
        }
        else
        {
            $(".formGetDoc-btn").html('отправляю...');
            $(".frmGetDoc").attr("action","/blocks/obr_getdoc.php")
            $(".frmGetDoc").submit();
        }

    }); 
    
    $(".delFileNow").on("click",function() {
        var idDel = $(this).attr('num');
        $(this).css("display","none");
        $(".boxDelFile"+idDel).fadeIn();
    });    
    
    
    $(".boxDelFile-net").on("click",function() {
        var idDel = $(this).attr('num');
        $(".boxDelFile"+idDel).css("display","none");
        $(".delFileNow"+idDel).fadeIn();
    });    
    
    
    $(".boxDelFile-da").on("click",function() {
        var idDel = $(this).attr('num');
        var secretcod = $(this).attr('num2');
        $(this).html('<img src="/img/preloader.gif" height="10" />');
        
        $.post("/blocks/ajax_delfile.php",  {file: secretcod}, onAjaxSuccessDelFile);
 
        function onAjaxSuccessDelFile(data)
        {
            $(".tbl_file_tr"+idDel).fadeOut();
        }

    });    
    
    $(".btnViborIspolnitely").on("click",function() {
        $(this).html('<img src="/img/add_cart.gif" height="15" />');
        var idZadanie = $(this).attr('data-id');
        var uidZadanie = $(this).attr('data-uid');
        var btnOtklik = $(this);
        
        $.post("/blocks/ajax_vibor_ispolnitel.php",  {id: idZadanie, uid: uidZadanie}, onAjaxSuccessVibor);
 
        function onAjaxSuccessVibor(data)
        {
          btnOtklik.fadeOut();
          alertS('Исполнитель выбран!');
          $(".btnViborIspolnitely").fadeOut();
        }
    })
    
    $(".btnOtkliknutsa").on("click",function() {
        $(this).html('<img src="/img/add_cart.gif" height="15" />');
        var idZadanie = $(this).attr('num');
        var btnOtklik = $(this);
        
        $.post("/blocks/ajax_otklik.php",  {id: idZadanie}, onAjaxSuccessOtklik);
 
        function onAjaxSuccessOtklik(data)
        {
          btnOtklik.fadeOut();
          alertS('Спасибо за отклик!');
        }
    })
    
    $(".btnSendMsgUser").on("click",function() {
        $(".boxFormSendMsgUser").fadeIn();
        $(".bg_page").fadeIn();
    })
    
    
    $(".btnEndProject").on("click",function() {
        $(".boxFormSendOtziv").fadeIn();
        $(".bg_page").fadeIn();
    })
    
    
    $(".btn_enter_lk").on("click",function() {
        $(this).val('захожу...');   
    })
    

    $(".btnOtklikInZadanie").on("click",function() {
        var textOtklik = $('.frmOtklik-text').val();
        textOtklik = trim(textOtklik);
        
        if (textOtklik=='' || textOtklik.length<40)
        {
            $('.frmOtklik-text').css("border","1px solid red");
            alertS('Напишите свое предложение более подробно!');
        }
        else
        {
            $(".btnOtklikInZadanie").html('отправляю...');
            $(".frmOtklik").attr("action","/blocks/obr_otklik.php")
            $(".frmOtklik").submit();
        }
    })
    
    
    
    $(".frmSendMsg-btn").on("click",function() {
        var textSms = $('.frmSendMsg-text').val();
        textSms = trim(textSms);
        
        if (textSms=='')
        {
            $('.frmSendMsg-text').css("border","1px solid red");
        }
        else
        {
            $(".frmSendMsg-btn").html('отправляю...');
            $(".frmSendMsg").attr("action","/blocks/obr_sendsms.php")
            $(".frmSendMsg").submit();
        }
    })
    
    
    
    $(".formSendOtziv-btn").on("click",function() {
        var textSms = $('.formSendOtziv-text').val();
        textSms = trim(textSms);
        
        if (textSms=='')
        {
            $('.formSendOtziv-text').css("border","1px solid red");
        }
        else
        {
            $(".formSendOtziv-btn").html('отправляю...');
            $(".frmSendOtziv").attr("action","/blocks/obr_sendotziv.php")
            $(".frmSendOtziv").submit();
        }
    })
    
    
    
    $(".btnCabSaveUser").on("click",function() {
        var avacab = $(".avacab").val();
        $(".avacab_real").val(avacab);
    })
    
    
    
	var w_height2 = $(window).height()*1;
    var w_height_menu = $(".up_menu").height()*1;
    w_height2 = w_height2-w_height_menu;
    $("header").css("height",w_height2);
    
    $(".listSearchSelect a").on("click",function() {
        var valSelect = $(this).attr("data-value"); 
        $(".boxHeadSearch-select").val(valSelect); 
        $(".listSearchSelect").fadeOut();
        showListOptionSearch = 0;
        $(".imgListSelect").attr("src","/img/for_option_up.png");
    })
    
    var showListOptionSearch = 0;
    
    $(".boxHeadSearch-select").on("click",function() {
        if (showListOptionSearch==0)
        {
            $(".listSearchSelect").fadeIn();
            $(".imgListSelect0").attr("src","/img/for_option_up2.png");
            showListOptionSearch = 1;
        }
        else
        {
            $(".listSearchSelect").fadeOut();
            $(".imgListSelect0").attr("src","/img/for_option_up.png");
            showListOptionSearch = 0;
        }
    });
    
    $(".imgListSelect0").on("click",function() {
        if (showListOptionSearch==0)
        {
            $(".listSearchSelect").fadeIn();
            $(".imgListSelect0").attr("src","/img/for_option_up2.png");
            showListOptionSearch = 1;
        }
        else
        {
            $(".listSearchSelect").fadeOut();
            $(".imgListSelect0").attr("src","/img/for_option_up.png");
            showListOptionSearch = 0;
        }
    });
    
    
    var timerMouse;
	var timeoutMouse = 3700;
	timerMouse = $.timer(timeoutMouse, function() {
		$(".icoMouse").animate({bottom: "25px"}, 300).animate({bottom: "20px"}, 300);
	});	
    
    
    var showListOptionSearch1 = 0;
    $(".boxHeadSearch2-select1").on("click",function() {
        if (showListOptionSearch1==0)
        {
            $(".listSearchSelect2-1").fadeIn();
            $(".boxSearchSelect1").find(".imgListSelect").attr("src","/img/for_option_up2.png");
            showListOptionSearch1 = 1;
        }
        else
        {
            $(".listSearchSelect2-1").fadeOut();
            $(".boxSearchSelect1").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch1 = 0;
        }
    });
    
    var showListOptionSearch2 = 0;
    $(".boxHeadSearch2-select2").on("click",function() {
        if (showListOptionSearch2==0)
        {
            $(".listSearchSelect2-2").fadeIn();
            $(".boxSearchSelect2").find(".imgListSelect").attr("src","/img/for_option_up2.png");
            showListOptionSearch2 = 1;
        }
        else
        {
            $(".listSearchSelect2-2").fadeOut();
            $(".boxSearchSelect2").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch2 = 0;
        }
    });
    
    var showListOptionSearch3 = 0;
    $(".boxHeadSearch2-select3").on("click",function() {
        if (showListOptionSearch3==0)
        {
            $(".listSearchSelect2-3").fadeIn();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up2.png");
            showListOptionSearch3 = 1;
        }
        else
        {
            $(".listSearchSelect2-3").fadeOut();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
        }
    });
    
    
    var showListOptionSearch4 = 0;
    $(".boxHeadSearch2-select4").on("click",function() {
        if (showListOptionSearch4==0)
        {
            $(".listSearchSelect2-4").fadeIn();
            $(".boxSearchSelect4").find(".imgListSelect").attr("src","/img/for_option_up2.png");
            showListOptionSearch4 = 1;
        }
        else
        {
            $(".listSearchSelect2-4").fadeOut();
            $(".boxSearchSelect4").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch4 = 0;
        }
    });
    
    
    
    ////////////////////////////////////////////////
    
    $(".imgListSelect1").on("click",function() {
        if (showListOptionSearch1==0)
        {
            $(".listSearchSelect2-1").fadeIn();
            $(".imgListSelect1").attr("src","/img/for_option_up2.png");
            showListOptionSearch1 = 1;
        }
        else
        {
            $(".listSearchSelect2-1").fadeOut();
            $(".imgListSelect1").attr("src","/img/for_option_up.png");
            showListOptionSearch1 = 0;
        }
    });
    
    
    $(".imgListSelect2").on("click",function() {
        if (showListOptionSearch2==0)
        {
            $(".listSearchSelect2-2").fadeIn();
            $(".imgListSelect2").attr("src","/img/for_option_up2.png");
            showListOptionSearch2 = 1;
        }
        else
        {
            $(".listSearchSelect2-2").fadeOut();
            $(".imgListSelect2").attr("src","/img/for_option_up.png");
            showListOptionSearch2 = 0;
        }
    });
    
    
    
    $(".imgListSelect3").on("click",function() {
        if (showListOptionSearch3==0)
        {
            $(".listSearchSelect2-3").fadeIn();
            $(".imgListSelect3").attr("src","/img/for_option_up2.png");
            showListOptionSearch3 = 1;
        }
        else
        {
            $(".listSearchSelect2-3").fadeOut();
            $(".imgListSelect3").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
        }
    });
    
    
    $(".imgListSelect4").on("click",function() {
        if (showListOptionSearch4==0)
        {
            $(".listSearchSelect2-4").fadeIn();
            $(".imgListSelect4").attr("src","/img/for_option_up2.png");
            showListOptionSearch4 = 1;
        }
        else
        {
            $(".listSearchSelect2-4").fadeOut();
            $(".imgListSelect4").attr("src","/img/for_option_up.png");
            showListOptionSearch4 = 0;
        }
    });
    
    
    //измение размера окна браузера
	$(window).resize(function(){
		var w_height3 = $(window).height()*1;
        var w_width3 = $(window).width()*1;
        
        if (w_width3<w_height3 && (w_width3<1100 && w_width3>700) && (w_height3<1900 && w_height3>1000))
        {
            $(".titleHead1").css("margin-top","200px");
            
        }
	});
    
    
    var w_height3 = $(window).height()*1;
    var w_width3 = $(window).width()*1;
    
    if (w_width3<w_height3 && (w_width3<1100 && w_width3>700) && (w_height3<1900 && w_height3>1000))
    {
        $(".titleHead1").css("margin-top","200px");
    }
    
    
    $(".btnUpReg").on("click",function() {
        $(".box_reg").fadeIn();
        $(".bg_page").fadeIn();
    })
    
    
    $(".bg_page").on("click",function() {
        $(".box_reg").fadeOut();
        $(".bg_page").fadeOut();
        $(".boxFormSendMsgUser").fadeOut();
        $(".boxFormSendOtziv").fadeOut();
        $(".boxFormGetDoc").fadeOut();
    })
    
    
    $(".headFormZayvka-btn").on("click",function() {
        var textVopros = $(".headFormZayvka").val();
        if (textVopros!='' && textVopros.length>50)
        {
            if (get_cookie("uid")!=null)
            {
                $(this).html('ждите...');
                $.post("/blocks/ajax_reg_user.php",  {type: 2, text: textVopros,  phone: "777"}, onAjaxSuccessRegUserNow);
     
                function onAjaxSuccessRegUserNow(data)
                {
                    $(".regMainEtap2").css('display',"none");
                    $(".regMainEtap3-title-inner").css("display","none");
                    $(".regMainEtap3").fadeIn();
                } 
            }
            else
            {
                $(".regMainEtap1").fadeIn();
            }
        }
        else
        {
            alert('Слишьком короткий вопрос!');
        }
    })
    
    
    
    var kodPhone;
    
    $(".regMainEtap1-btn").on("click",function() {
        var textZadach = $(".headFormZayvka").val(); 
        var phoneRegUser = $(".phoneRegUser").val();
        $(".phoneRegUser").css("border","1px solid #15A194");
        
        if (phoneRegUser!='')
        {
           $(".regMainEtap1-btn").html('ждите...');
           $.post("/blocks/ajax_reg_user.php",  {type: 1, text: textZadach,  phone: phoneRegUser}, onAjaxSuccessReg);
 
            function onAjaxSuccessReg(data)
            {
                if (data!=0) 
                {
                    kodPhone = data;
                    $(".regMainEtap2").fadeIn();
                }
                else
                {
                    $(".phoneRegUser").css("border","1px solid red");
                    $(".regMainEtap1-btn").html('зарегистрироваться');
                    alert('Такой пользователь уже есть в базе!');
                }
            } 
        }
        else
        {
            $(".phoneRegUser").css("border","1px solid red");
        }
    })
    
    
    
    
    
    $(".regUserEtap1-btn").on("click",function() {
        var phoneRegUser = $(".phoneRegUserReg").val();
        $(".phoneRegUserReg").css("border","1px solid #15A194");
        
        if (phoneRegUser!='')
        {
           $(".regUserEtap1-btn").html('ждите...');
           $.post("/blocks/ajax_reg_user2.php",  {type: 1,  phone: phoneRegUser}, onAjaxSuccessReg2);
 
            function onAjaxSuccessReg2(data)
            {
                if (data!=0) 
                {
                    kodPhone = data;
                    $(".regUserEtap1").css("display","none");
                    $(".regUserEtap2").fadeIn();
                    
                }
                else
                {
                    $(".phoneRegUser").css("border","1px solid red");
                    $(".regUserEtap1-btn").html('зарегистрироваться');
                    alertS('Такой пользователь уже есть в базе!');
                }
            } 
        }
        else
        {
            $(".phoneRegUserReg").css("border","1px solid red");
        }
    })
    
    
    $(".regMainEtap2-btn").on("click",function() {
        var textZadach = $(".headFormZayvka").val(); 
        var phoneRegUser = $(".phoneRegUser").val();
        var kodRegUser = $(".kodRegUser").val();

        if (kodRegUser!=kodPhone)
        {
            $(".kodRegUser").css("border","1px solid red");
        }
        else
        {
            $(".kodRegUser").css("border","1px solid #15A194");
            
            $(".regMainEtap2-btn").html('ждите...');
            $.post("/blocks/ajax_reg_user.php",  {type: 2, text: textZadach,  phone: phoneRegUser}, onAjaxSuccessReg2);
 
            function onAjaxSuccessReg2(data)
            {
                if (data!=0) 
                {
                    var kodPhone = data;
                    $(".regMainEtap2").css('display',"none");
                    $(".regMainEtap3").fadeIn();
                }
                else
                {
                    alert('Такой пользователь уже есть в базе!');
                }
            } 
        }
    });  
    
    
    
    $(".regUserEtap2-btn").on("click",function() {
        var phoneRegUser = $(".phoneRegUserReg").val();
        var kodRegUser = $(".kodRegUser2").val();

        if (kodRegUser!=kodPhone)
        {
            $(".kodRegUser2").css("border","1px solid red");
        }
        else
        {
            $(".kodRegUser2").css("border","1px solid #15A194");
            
            $(".regUserEtap2-btn").html('ждите...');
            $.post("/blocks/ajax_reg_user2.php",  {type: 2,  phone: phoneRegUser}, onAjaxSuccessReg3);
 
            function onAjaxSuccessReg3(data)
            {
                if (data!=0) 
                {
                    var kodPhone = data;
                    $(".regUserEtap2").css('display',"none");
                    $(".regUserEtap3").fadeIn();
                }
                else
                {
                    alertS('Такой пользователь уже есть в базе!');
                }
            } 
        }
    }); 
    
    
    
    var kodPodtvZadach = '';
    
    $(".btnSendNewZadach").on("click",function() {
        $(".btnSendNewZadach").html("<img src='/img/preloader.gif' height='15'/>");
        var textZadach = $(".textZadach").val();
        var errorZadan = 0;
        
        if (textZadach.length<60)
        {
            $(".textZadach").css("border","1px solid red");
            alertS('Слишком короткое описание');
            $(".btnSendNewZadach").html("создать");
        }
        else
        {
            $(".textZadach").css("border","1px solid #e1e1e1");
            
            var uid = get_cookie("uid");
            
            if (uid==null)
            {
                var u_name = $(".u_name").val();
                var u_phone = $(".u_phone").val();
                
                u_name = trim(u_name);
                u_phone = trim(u_phone);
                if (u_phone=='' && u_name=='' || u_phone.length<5 || u_name.length<4)
                {
                    alertS('Заполните поле телефон и имя!');
                    $(".btnSendNewZadach").html("создать");
                    errorZadan = 1;
                }
                else
                {
                    $.post("/blocks/ajax_proverka_user.php",  {type: 1, phone: u_phone}, onAjaxSuccessReg2);
 
                    function onAjaxSuccessReg2(data)
                    {
                      if (data!=0)
                      {
                          $(".boxRegUserNewZadach").css('display','none');
                          $(".boxCodMsg").fadeIn();
                          $(".btnSendNewZadach").fateOut();
                          kodPodtvZadach = data;
                          errorZadan = 1;
                          $(".btnSendNewZadach").html("создать");
                      }
                      else
                      {
                          alertS('Вы уже зарегистрированы! Войдите на сайт!');
                          errorZadan = 1;
                          $(".btnSendNewZadach").html("создать");
                      }
                      
                      if (errorZadan==0)
                      {
                        $(".frmNewZadanie").attr("action","/blocks/obr_zadanie.php");
                        $(".frmNewZadanie").submit(); 
                        $(".btnSendNewZadach").html("создать");
                      }
                    }
                }
            }
            else
            {
                if (errorZadan==0)
                {
                    $(".frmNewZadanie").attr("action","/blocks/obr_zadanie.php");
                    $(".frmNewZadanie").submit(); 
                }
            }
            
            
        }
    })  
    
    
    $(".frmNewZadanie-btnpodtverdit").on("click",function() {
        $(".frmNewZadanie-btnpodtverdit").html('ждите...');
        var u_cod = $(".u_cod").val();
        
        if (u_cod==kodPodtvZadach)
        {
            $(".frmNewZadanie").attr("action","/blocks/obr_zadanie.php");
            $(".frmNewZadanie").submit();
        }
        else
        {
            alertS('Неверный код подтверждения!');
            $(".frmNewZadanie-btnpodtverdit").html('подтвердить');
        }
    })
    
    
    $(".innerAlert-ok").on("click",function() {
        $(".boxAlert").fadeOut();
    });
    
    
    
    
});



 
  