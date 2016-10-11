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

var showListOptionSearch3 = 0;
var showListOptionSearch4 = 0;

$(document).ready(function() {
    

    $(window).resize(function(){
        var w_width = $(document).width()*1;
        if (w_width>1180 && w_width<1220) {location.reload();}

    });


    var btnShowAllCatVopros = 0;
    $(".btnShowAllCatVopros").on("click",function() {
        if (btnShowAllCatVopros==0)
        {
            btnShowAllCatVopros=1;
            $(".boxShowAllCatVopros").fadeIn();
            $(".btnShowAllCatVopros").html('Скрыть категории вопросов');
        }
        else
        {
            btnShowAllCatVopros=0;
            $(".boxShowAllCatVopros").fadeOut();
            $(".btnShowAllCatVopros").html('Показать категории вопросов');
        }
    })
    
    
    $(".text_comment").on("focusin",function() {
        $(".text_comment").addClass("text_comment_activ");
        $(".text_comment").animate({"height":"160px"},300);
    })
    
    $(".text_comment").on("focusout",function() {
        $(".text_comment").removeClass("text_comment_activ");
        //$(".text_comment").animate({"height":"90px"},300);
    })
    
    //Отправка комментария
    $(".btn_send_comment").on("click",function() {
        var text_comment = $(".text_comment").val();
        var id_vopros = $(".h_id_vopros").val();
        $(".btn_send_comment").html("<img src='/img/add_cart.gif' height='13' />");
        
        $.post("/blocks/ajax_send_comment.php",  {text_comment: text_comment,  id_vopros: id_vopros}, onAjaxSuccessSendComment);
         
        function onAjaxSuccessSendComment(data)
        {
            if (data==0 || data=='0')
            {
                alertS("Ошибка, Комментарий не добавлен!");
            }
            else
            {
               var jsContent = $(".boxJsContent").html();
               $(".boxJsContent").html(jsContent+data);
               $(".boxJsContent").fadeIn();
            }
           
            $(".btn_send_comment").html("отправить");
            $(".text_comment").val('');
        }

    })
    
    //раздел нового вопроса
    $(".btnSendNewVopros").on("click",function() {
        var nameNewVopros = $(".nameNewVopros").val();
        var textVopros = $(".textVopros").val();
        nameNewVopros = trim(nameNewVopros);
        textVopros = trim(textVopros);
        
        if (nameNewVopros=='' || textVopros=='')
        {
            alertS('Введите название и описание вопроса!');
        }
        else
        {
            var uid = get_cookie("uid");
            if (uid=='' || uid==undefined || uid==false)
            {
                $(".boxAuthEmail").fadeIn();
            }
            else
            {
                $(".frmNewVopros").attr("action","/blocks/obr_new_question.php");
                $(".frmNewVopros").submit();
            }
        }
    })
    
    $(".boxAuthEmail-btn").on("click",function() {
        var mailUserVopros = $(".mailUserVopros").val();
        mailUserVopros = trim(mailUserVopros);
        
        if (mailUserVopros=='' || mailUserVopros=='' || isValidEmail(mailUserVopros)==false)
        {
            alertS('Введите свой e-mail!');
        }
        else
        {
            $(".mailVoprosFrm").val(mailUserVopros);
            $(".frmNewVopros").attr("action","/blocks/obr_new_question.php");
            $(".frmNewVopros").submit();
            $(".boxAuthEmail-btn").html('Отправляю...');
        }
        
    });
    
    //конец раздела нового вопроса
    
    
    $(document).mouseup(function (e){ // событие клика по веб-документу
		var inpn = $(".boxHeadSearch2-select3"); // тут указываем ID элемента
		if (!inpn.is(e.target) // если клик был не по нашему блоку
		    && inpn.has(e.target).length === 0) { // и не по его дочерним элементам
			$(".listSearchSelect2-3").fadeOut();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
              
            $(".listSearchSelect2-4").fadeOut();
            $(".boxSearchSelect4").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch4 = 0;  
            
            $(".listSearchSelect").fadeOut();
            $(".imgListSelect0").attr("src","/img/for_option_up.png");
            showListOptionSearch = 0;
		}
	});
    
    var numNapravl = $('.btnAddNapravlen').attr('num')*1;
    $(".btnAddNapravlen").on("click",function() {
        numNapravl = numNapravl+1;
        if (numNapravl<6)
        {
            $(".blockCabNapravlen"+numNapravl).fadeIn();
            if (numNapravl==5)
            {
                $(this).css('display',"none");
            }
        }

    });    
    
    
    $(".btnChengMainReg").on("click",function() {
        $(".boxMainEnter1").css("display","none");
        $(".boxMainReg1").css("display","block");
    });
    
    $(".btnChengMainEnter").on("click",function() {
        $(".boxMainEnter1").css("display","block");
        $(".boxMainReg1").css("display","none");
    });
    
    var showFaqMenu = 0;
    $(".showFaqMenu").on("click",function() {
        $(".leftFaq").slideToggle();
        if (showFaqMenu==0)
        {
            showFaqMenu=1;
        }
        else
        {
            showFaqMenu=0;
        }
    });
        
    $(".addFavorit").on("click",function() {
        var urist = $(this).attr("num");
        var typeD = $(this).attr("num2");
        $(".addFavorit").html("<img src='/img/add_cart.gif' height='13' />");
        $.post("/blocks/ajax_add_favorites.php",  {urist: urist, typeD: typeD}, onAjaxSuccessFav);
     
        function onAjaxSuccessFav(data)
        {
          $(".addFavorit").html("добавлено");
        }
    });
    
    $(".btnCancelUspolni").on("click",function() {
        var idz = $(this).attr("num");
        var ido = $(this).attr("num2");
        $(".btnCancelUspolni").html("<img src='/img/add_cart.gif' height='13' />");
        $.post("/blocks/ajax_del_ispolnitel.php",  {idz: idz, ido:ido}, onAjaxSuccessIspoln);
     
        function onAjaxSuccessIspoln(data)
        {
          location.reload();
        }
    });
    
    
    
    $(".delFavorit").on("click",function() {
        var urist = $(this).attr("num");
        var typeD = $(this).attr("num2");
        $(".delFavorit").html("<img src='/img/add_cart.gif' height='13' />");
        $.post("/blocks/ajax_add_favorites.php",  {urist: urist, typeD: typeD}, onAjaxSuccessFav2);
     
        function onAjaxSuccessFav2(data)
        {
          $(".delFavorit").html("удалено");
        }
    });
    
    
    $(".fileDoc").change(function() {
        var fileDoc = $(".fileDoc").val();	
        fileDoc = fileDoc.replace(/\\/g, '/').replace(/.*\//, '');
        $(".addFileLink").html('Прикреплен файл <b>'+fileDoc+"</b>");
    });
    
        
    $(".boxHeadSearch-btnm").on("click",function() {
        var HeadSearch = $(".boxHeadSearch-pole").val(); 
        var HeadSearchType = $(".boxHeadSearch-select").val(); 
        if (HeadSearch!='')
        {
           window.location.href = '/search/?search='+HeadSearch+'&type='+HeadSearchType; 
        }
        else
        {
            alertS('Введите текст для поиска!');
        }
        
    });  
    
    var idCityMain;
    
    $(".selectSity").on("click",function() {
        $(".boxFormCity").fadeIn();
        $(".bg_page").fadeIn();
    });  
    
    
    $(".frmNewZadanie-btn").on("click",function() {
        var inpCityPop = $(".inpCityPop").val();
        $(".selectSity").html(inpCityPop);
        $(".boxFormCity").fadeOut();
        $(".bg_page").fadeOut();
        set_cookie("city",idCityMain,2020,10,1,'/');
    });  
    
    
    
    $(".boxHeadSearch2-btn").on("click",function() {
        var val1 = $(".boxHeadSearch2-select2").val();
        var val2 = $(".boxHeadSearch2-select3").val();
        var val3 = $(".boxHeadSearch2-select4").val();
        $(".valMain_search1").val(val1);
        $(".valMain_search2").val(val2);
        $(".valMain_search3").val(val3);

        $(".frmMainSearch").attr("action","/zadaniy/")
        $(".frmMainSearch").submit();
    });   
    
    
    $(".boxHeadSearch10-btn").on("click",function() {

        $(".frmMainSearch10").attr("action","/docs/")
        $(".frmMainSearch10").submit();
    });  
    
    
    $(".boxHeadSearch2-btn2").on("click",function() {
        var val1 = $(".boxHeadSearch2-select2").val();
        var val2 = $(".boxHeadSearch2-select3").val();
        var val3 = $(".boxHeadSearch2-select4").val();
        $(".valMain_search1").val(val1);
        $(".valMain_search2").val(val2);
        $(".valMain_search3").val(val3);

        $(".frmMainSearch").attr("action","/urists/")
        $(".frmMainSearch").submit();
    });    
     
    
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
    
   
    
    
    $('.inpCityPop').keyup(function(eventObject){
        var city = $(".inpCityPop").val();
        
        $.post("/blocks/ajax_get_city.php",  {city: city}, onAjaxSuccessCityPop);
 
        function onAjaxSuccessCityPop(data)
        {
          if (data!='')
          {
              $(".listCityPop").html(data);
              $(".listCityPop").fadeIn();
          }
          
          $('.listCityPop').find('a').on('click', function(e){
              var nameCityNew = $(this).html();
              idCityMain = $(this).attr('num2');
             
              $('.inpCityPop').val(nameCityNew);
              $(".listCityPop").fadeOut();
              
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
    


    $('.listSearchSelect2-4').find('a').on('click', function(e){
      var nameSortNew = $(this).html();
      $('.boxHeadSearch2-select4').val(nameSortNew);
      $(".listSearchSelect2-4").fadeOut();
      $(".boxSearchSelect4").find(".imgListSelect").attr("src","/img/for_option_up.png");
      showListOptionSearch4 = 0;
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
    if (w_height2<690) {w_height2=690;}
    $("header").css("height",w_height2);
    
    $(window).resize(function(){
        var w_height2 = $(window).height()*1;
        var w_height_menu = $(".up_menu").height()*1;
        if (w_height2<750) {w_height2=750;}
        w_height2 = w_height2-w_height_menu;
        $("header").css("height",w_height2);
    });

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
            
            $(".listSearchSelect2-4").fadeOut();
            $(".boxSearchSelect4").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch4 = 0;
        }
        else
        {
            $(".listSearchSelect2-3").fadeOut();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
        }
    });
    
    $(".boxHeadSearch2-select2").focus(function() {
        $(".listSearchSelect2-3").fadeOut();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
    });
    
    $(".boxHeadSearch2-select44").focus(function() {
        $(".listSearchSelect2-3").fadeOut();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
    });
    
    $(".boxHeadSearch2-select44").focus(function() {
        $(".listSearchSelect2-3").fadeOut();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
    });
    
    
    var showListOptionSearch4 = 0;
    $(".boxHeadSearch2-select4").on("click",function() {
        if (showListOptionSearch4==0)
        {
            $(".listSearchSelect2-4").fadeIn();
            $(".boxSearchSelect4").find(".imgListSelect").attr("src","/img/for_option_up2.png");
            showListOptionSearch4 = 1;
            
            $(".listSearchSelect2-3").fadeOut();
            $(".boxSearchSelect3").find(".imgListSelect").attr("src","/img/for_option_up.png");
            showListOptionSearch3 = 0;
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
        $(".boxFormCity").fadeOut();
        $(".boxFormNewZadaniePop").fadeOut();
    })
    
    /*
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
            alert('Слишком короткий вопрос!');
        }
    })
    */
    
    $(".headFormZayvka-btn").on("click",function() {
        var textVopros = $(".headFormZayvka").val();
        if (textVopros!='' && textVopros.length>50)
        {
            $(".mainFrmUserZadanie").attr("action",'/new_zadanie/');
            $(".mainFrmUserZadanie").submit();
        }
        else
        {
            alert('Слишком короткий вопрос!');
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
        var bigZadanie = 1;
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
                $(".boxFormNewZadaniePop").fadeIn();
                $(".bg_page").fadeIn();
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
    
    
    //вход при создании нового задания на главной
    $(".regMainEtap15-btn").on("click",function() {
        $(".regMainEtap15-btn").html('ждите...');
        
        var u_phone = $(".enter-phoneEnterUser").val();
        var u_pass = $(".enter-passEnterUser").val();

        u_pass = trim(u_pass);
        u_phone = trim(u_phone);
        if (u_phone=='' && u_pass=='' || u_phone.length<5 || u_pass.length<4)
        {
            alertS('Заполните поле телефон и пароль!');
            $(".regMainEtap15-btn").html("подтвердить");
            errorZadan = 1;
        }
        else
        {
            $.post("/blocks/ajax_enter_user.php",  {type: 1, phone: u_phone, pass: u_pass}, onAjaxSuccessEnter2);
  
            function onAjaxSuccessEnter2(data)
            {
              if (data!=0)
              {
                    var textZadach = $(".headFormZayvka").val(); 
                    var phoneRegUser = $(".phoneRegUser").val();

                    $.post("/blocks/ajax_reg_user.php",  {type: 2, text: textZadach,  phone: "777"}, onAjaxSuccessReg2);
         
                    function onAjaxSuccessReg2(data)
                    {
                        if (data!=0) 
                        {
                            $(".regMainEtap3-title-inner").css('display',"none");
                            $(".regMainEtap1").css('display',"none");
                            $(".regMainEtap3").fadeIn();
                            
                        }
                        else
                        {
                            alert('Такой пользователь уже есть в базе!');
                        }
                    } 
              }
              else
              {
                  alertS('Неверные данные');
                  errorZadan = 1;
                  $(".regMainEtap15-btn").html("подтвердить");
              }
            }
        }
    });
    
    
    
    
    $(".formNewZadaniePop-btn").on("click",function() {
        $(".formNewZadaniePop-btn").html('ждите...');
        
        var u_name = $(".u_name").val();
        var u_phone = $(".u_phone").val();
        
        u_name = trim(u_name);
        u_phone = trim(u_phone);
        if (u_phone=='' && u_name=='' || u_phone.length<5 || u_name.length<4)
        {
            alertS('Заполните поле телефон и имя!');
            $(".formNewZadaniePop-btn").html("подтвердить");
            errorZadan = 1;
        }
        else
        {
            $.post("/blocks/ajax_proverka_user.php",  {type: 1, phone: u_phone}, onAjaxSuccessReg2);

            $('.u_phone_verify').val(u_phone);
            function onAjaxSuccessReg2(data)
            {
              if (data!=0)
              {
                  $(".boxRegUserNewZadach").css('display','none');
                  $(".boxCodMsg").fadeIn();
                  $(".btnSendNewZadach").fadeOut();
                  kodPodtvZadach = data;
                  errorZadan = 1;
                  $(".formNewZadaniePop-btn").html("подтвердить");
              }
              else
              {
                  alertS('Вы уже зарегистрированы! Войдите на сайт!');
                  errorZadan = 1;
                  $(".formNewZadaniePop-btn").html("подтвердить");
              }
              
              if (errorZadan==0)
              {
                $(".frmNewZadanie").attr("action","/blocks/obr_zadanie.php");
                $(".frmNewZadanie").submit(); 
                $(".formNewZadaniePop-btn").html("подтвердить");
              }
            }
        }
    });
    
    
    $(".btnShowEnter").on("click",function() {
        $(".boxNewZadanieReg").css("display","none");
        $(".boxNewZadanieEnter").css("display","block");
    })
    
    $(".btnShowAvtoriz").on("click",function() {
        $(".boxNewZadanieReg").css("display","block");
        $(".boxNewZadanieEnter").css("display","none");
    })
    
    $(".formNewZadaniePop-btnEnter").on("click",function() {
        $(".formNewZadaniePop-btnEnter").html('ждите...');
        
        var u_phone = $(".u_phone1").val();
        var u_pass = $(".u_pass").val();
        
        u_pass = trim(u_pass);
        u_phone = trim(u_phone);
        
        if (u_phone=='' && u_pass=='')
        {
            alertS('Заполните поле телефон и пароль!');
            $(".formNewZadaniePop-btnEnter").html("войти");
            errorZadan = 1;
        }
        else
        {
            //alert(u_phone);
            $.post("/blocks/ajax_enter_user.php",  {phone: u_phone, pass: u_pass}, onAjaxSuccessEnter);

            function onAjaxSuccessEnter(data)
            {
                
              if (data!=0)
              {
                  $(".frmNewZadanie").attr("action","/blocks/obr_zadanie.php");
                  $(".frmNewZadanie").submit();
                  errorZadan = 1;
                  $(".formNewZadaniePop-btnEnter").html("войти");
              }
              else
              {
                  alertS('Неверные данные');
                  errorZadan = 1;
                  $(".formNewZadaniePop-btnEnter").html("войти");
              }
              
            }
        }
    });
    
    
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
            //alertS('Неверный код подтверждения!');
            $(".u_cod").css("border","1px solid red");
            $(".frmNewZadanie-btnpodtverdit").html('подтвердить');
        }
    })
    
    
    $(".innerAlert-ok").on("click",function() {
        $(".boxAlert").fadeOut();
    });
    
    
    
    $(".typeCatUsluga").change(function() {
        var valZnach = $(this).val();  
        var vidTask = $(".vidTask").val();
        var textTask = "";

        if (vidTask=='Юридическая консультация')
        {
            if (valZnach=='Не знаю') {$(".nameNewZadanie").val('');} 
            
            if (valZnach=='Автомобильное право') {$(".nameNewZadanie").val('Консультация автоюриста');
                textTask = "Необходима консультация опытного автоюриста по спору со страховой компанией";
            } 
            
            if (valZnach=='Кредиты и займы') {$(".nameNewZadanie").val('Консультация кредитного юриста');
                textTask = "Необходима консультация опытного юриста по возможности снижения размера займа по кредиту, списанию задолженности.";
            } 
            
            if (valZnach=='Недвижимость') {$(".nameNewZadanie").val('Консультация по покупке квартиры');
                textTask = "Необходима консультация опытного юриста по вопросу безопасного преобретения квартиры";
            } 
            
            if (valZnach=='Семейное право') {$(".nameNewZadanie").val('Консультация по расторжению брака');
                textTask = "Необходима консультация опытного юриста по вопросу росторжения брака и раздела иммущества";
            } 
            
            if (valZnach=='Авторские и смежные права') {$(".nameNewZadanie").val('Консультация по получению патента');
                textTask = "Необходима консультация опытного юриста по подготовке документов на регистрацию патента";
            } 
            
            if (valZnach=='Административное право') {$(".nameNewZadanie").val('Консультация по обжалованию штрафа');
                textTask = "Необходима консультация опытного юриста по вопросу законности наложения штрафа сотрудником полиции за курение в общественном местеы";
            } 
            
            if (valZnach=='Уголовное право') {$(".nameNewZadanie").val('Консультация по уголовному делу');
                textTask = "Необходима консультация опытного адвоката по законности возбуждения уголовного дела за вождение в нетрезвом виде";
            }
            
            if (valZnach=='Антимонопольное право') {$(".nameNewZadanie").val('Консультация по штрафу ФАС РФ');
                textTask = "Необходима консультация опытного юриста законности штрафа за нарушение антимонопольного законодательства";
            }
            
            if (valZnach=='Арбитраж') {$(".nameNewZadanie").val('Консультация о перспективе дела в арбитраже');
                textTask = "Необходима консультация опытного юриста о перспективе судебного разбирательства в арбитражном суде по иску  заказика о взыскании пени за нарушение сроков поставки товара";
            }
            
            if (valZnach=='Исполнительное производство') {$(".nameNewZadanie").val('Консультация по исполнению решения суда');
                textTask = "Необходима консультация опытного юриста о возможности обжалования действий судебного пристава";
            }
            
            if (valZnach=='Военная служба') {$(".nameNewZadanie").val('Консультация военного юриста');
                textTask = "Необходима консультация опытного военного юриста по закооности увольнения с военной службы";
            }
            
            if (valZnach=='Трудовое право') {$(".nameNewZadanie").val('Консультация юриста по увольнению с работы');
                textTask = "Необходима консультация опытного юриста законности действий работодателя по увольнению с работы по отрицательной статье";
            }
            
            if (valZnach=='Бухгалтерия') {$(".nameNewZadanie").val('Консультация по бухгалтерии');
                textTask = "Необходима консультация бухгалтера по правилам начисления отпускных";
            }
            
            if (valZnach=='Страхование') {$(".nameNewZadanie").val('Консультация по страховке');
                textTask = "Необходима консультация опытного юриста по обоснованности отказа выплаты страховой комппании за возмещение ущерба по ДТП";
            }
            
            if (valZnach=='Экология') {$(".nameNewZadanie").val('Консультация по страховке');
                textTask = "Необходима консультация опытного юриста по обоснованности отказа выплаты страховой комппании за возмещение ущерба по ДТП";
            }
            
            if (valZnach=='Миграционное право') {$(".nameNewZadanie").val('Консультация по получению гражданства');
                textTask = "Необходима консультация опытного юриста. Муж месяц назад получил гражданство РФ, могу ли я получить гражданство РФ в упрощенном порядке?";
            }
            
            if (valZnach=='Гос.закупки и тендеры') {$(".nameNewZadanie").val('Консультация по госзакупкам');
                textTask = "Необходима консультация опытного юриста по порядку подготовки заявки на участие в электонном аукционе на поставку запасных частей для автомобилей ";
            }
            
            if (valZnach=='Гражданские дела') {$(".nameNewZadanie").val('Консультация по гражданскому делу');
                textTask = "Необходима консультация опытного юриста по перспективе гражданского дела в районном суде по вопросу раздела иммущества";
            }
            
            if (valZnach=='Разработка документов и договоров') {$(".nameNewZadanie").val('Консультация по договору ');
                textTask = "Необходима консультация опытного юриста по порядку заключения договора на продажу квартиры ";
            }
            
            if (valZnach=='ЖКХ') {$(".nameNewZadanie").val('Консультация по коммунальным платежам');
                textTask = "Необходима консультация опытного юриста по законности действий управляющей компании по начислению коммунальных платежей";
            }
            
            if (valZnach=='Корпоративное право') {$(".nameNewZadanie").val('Консультация по созданию филиалов компании');
                textTask = "Необходима консультация опытного юриста по порядку и условиях создания филиалов компании в других регионах России";
            }
            
            if (valZnach=='Защита прав потребителей') {$(".nameNewZadanie").val('Консультация по возврату денег за путевку');
                textTask = "Необходима консультация опытного юриста по вопросу как вернуть деньга за путевку если передумал ехать на отдых в связи с изменившимися обстоятельствами";
            }
            
            if (valZnach=='Здравоохранение') {$(".nameNewZadanie").val('Консультация медицинского юриста');
                textTask = "Необходима консультация опытного юриста в области медицины по вопросу некачественного оказании медицинской помощи по протезированию зубов частной клиникой";
            }
            
            if (valZnach=='Связь, СМИ, Интернет') {$(".nameNewZadanie").val('Консультация юриста ');
                textTask = "Необходима консультация опытного юриста по вопросу нарушения авторского права в сети интернет";
            }
            
            if (valZnach=='Конституционное право') {$(".nameNewZadanie").val('Консультация по соблюдению прав человека');
                textTask = "Необходима консультация опытного юриста по вопросу написания жалобы в Конституционный суд РФ ";
            }
            
            if (valZnach=='Нотариат') {$(".nameNewZadanie").val('Консультация по нотариальному спору');
                textTask = "Необходима консультация опытного юриста по вопросу отказа натариуса в оформлении вступления в наследство";
            }
            
            if (valZnach=='Международное  право') {$(".nameNewZadanie").val('Консультация юриста по международному праву');
                textTask = "Необходима консультация опытного юриста по вопросу оформление договоров с иностранными компаниями";
            }
            
            if (valZnach=='Налоговое право') {$(".nameNewZadanie").val('Консультация по транспортному налогу');
                textTask = "Необходима консультация опытного юриста по вопросу необходимости оплаты транспортного налога поступившего мне после продажи автомобиля";
            }
            
            if (valZnach=='Наследование') {$(".nameNewZadanie").val('Консультация по наследству');
                textTask = "Необходима консультация опытного юриста по вопросу порядка вступления в наследство и обязанности уплаты долгов умершего";
            }
            
            if (valZnach=='Образование') {$(".nameNewZadanie").val('Консультация по льготам при поступлении в ВУЗ');
                textTask = "Необходима консультация опытного юриста по вопросу наличия льгот у победителя олимпиады при поступлении в ВУЗ";
            }
            
            if (valZnach=='Лицензирование') {$(".nameNewZadanie").val('Консультация по лицензированию');
                textTask = "Необходима консультация опытного юриста по вопросу получения лицензии на добычу песка";
            }
            
            if (valZnach=='Таможня') {$(".nameNewZadanie").val('Консультация по таможенному оформлению');
                textTask = "Необходима консультация опытного юриста по вопросу таможенного оформления грузов ввозимых в Россиию из стран Евросоюза";
            }
            
            if (valZnach=='Экспертиза') {$(".nameNewZadanie").val('Консультация по независимой экспертизе');
                textTask = "Необходима консультация опытного юриста по вопросу выбора компании где провести качественную независимую медицинскую экспертизу, а также подготовке необходимых вопросов для разрешения экспертами";
            }
            
            if (valZnach=='Юридические лица') {$(".nameNewZadanie").val('Консультация по созданию юридического лица');
                textTask = "Необходима консультация опытного юриста по вопросу создания юридического лица, выбору вида юридического лица, системы налогообложения";
            } 
        }
        
        
        if (vidTask=='Составление и проверка договоров')
        {
            if (valZnach=='Не знаю') {$(".nameNewZadanie").val('');} 
            
            if (valZnach=='Автомобильное право') {$(".nameNewZadanie").val('Составить договор грузоперевозки');
                textTask = "Необходимо составить договор на перевозку груза, в котором учесть все интересы заказчика";
            } 
            
            if (valZnach=='Авторские и смежные права') {$(".nameNewZadanie").val('Составить договор авторского заказа');
                textTask = "Необходимо составить договор авторского заказа с учетом интересов автора";
            } 
            
            if (valZnach=='Недвижимость') {$(".nameNewZadanie").val('Проверить договор купли-продажи квартиры');
                textTask = "Необходимо проверить договор купли продажи квартиры на наличие в нем 'подводных камней'";
            } 
            
            if (valZnach=='Административное право') {$(".nameNewZadanie").val('Составить договор займа');
                textTask = "Необходимо составить договор кредитования не ущемляющий права потребителей с целью недопущения привлечения к  административной ответственности компании";
            } 
            
            if (valZnach=='Семейное право') {$(".nameNewZadanie").val('Составить брачный договор ');
                textTask = "Необходимо составить брачный договор о порядке раздела имущества после расторжения брака";
            } 
            
            if (valZnach=='Уголовное право') {$(".nameNewZadanie").val('Проверить договор');
                textTask = "Необходимо проверить договор с адвокатом на оказание юридической помощи по уголовному делу";
            }
            
            if (valZnach=='Кредиты и заем') {$(".nameNewZadanie").val('Расторгнуть договор займа');
                textTask = "Необходимо помочь в расторжении договора заима по кредитному договору с банком";
            } 
           
            if (valZnach=='Антимонопольное право') {$(".nameNewZadanie").val('Составить договор');
                textTask = "Необходимо проверить договор на соблюдение требований антимонопольного законодательства";
            }
            
            if (valZnach=='Арбитраж') {$(".nameNewZadanie").val('Проверить договор');
                textTask = "Необходимо проверить договора на соблючение законодательства о банкротстве  заключаемые конкурсным управляющим";
            }
            
            if (valZnach=='Исполнительное производство') {$(".nameNewZadanie").val('Составить договор');
                textTask = "Необходимо составить договор на оказание услуг по взысканию долга по решению суда";
            }
            
            if (valZnach=='Военная служба') {$(".nameNewZadanie").val('Проверить договор военной ипотеки ');
                textTask = "Необходимо проверить договор с банком о предоставлении кредита по военной ипотеке на приобретение жилья";
            }
            
            if (valZnach=='Трудовое право') {$(".nameNewZadanie").val('Составить трудовой договор ');
                textTask = "Необходимо составить трудовой договор с работником, в котором учесть все интересы работодателя и ответственность работника";
            }
            
            if (valZnach=='Бухгалтерия') {$(".nameNewZadanie").val('Проверить договор на бухгалтерское обслуживание');
                textTask = "Необходимо проверить договор на бухгалтерское обслуживание ИП на предмет соблюдение интересов заказчика и ответственности исполнителя (бухгалтера) за некачественное оказание услуг";
            }
            
            if (valZnach=='Возмещение вреда и убытков') {$(".nameNewZadanie").val('Проверить договор на возможность взыскание ущерба');
                textTask = "Необходимо проверить договор страхования КАСКО на возможность взыскания ущерба  причиненного стихийным бедствием (наводнением)";
            }
            
            if (valZnach=='Страхование') {$(".nameNewZadanie").val('Заключить договор страхобания без комиссий');
                textTask = "Необходима помощь в заключении договора страхования транспортного средства без оплаты дополнительных комиссий навязываемых страховыми компаниями";
            }
            
            if (valZnach=='Экология') {$(".nameNewZadanie").val('Проверить договор на экологию');
                textTask = "Необходима помощь в проверке договора на экологическое обслуживание на соблюдение интересов заказчика и требований природоохранного законодательства";
            }
            
            if (valZnach=='Миграционное право') {$(".nameNewZadanie").val('Подготовить трудовой договор с иностранцем');
                textTask = "Необходима помощь в подготовке трудового договора с иностранным граждинином, имеющим разрешение на работу в России";
            }
            
            if (valZnach=='Гос.закупки и тендеры') {$(".nameNewZadanie").val('Составить госконтракт');
                textTask = "Необходимо внести изменения в государственный контракт на выполнение работ по уборке помещений";
            }
            
            if (valZnach=='Гражданские дела') {$(".nameNewZadanie").val('Проверить договор ');
                textTask = "Необходимо проверить на наличие \"подвохов\" предварительный договор на покупки квартиры";
            }
            
            if (valZnach=='Юридическое обслуживание и аутсорсинг') {$(".nameNewZadanie").val('Составление и проверка договоров для  ООО');
                textTask = "Необходимо юрсдическое сопровождение ООО в части составления правовых документов – договоров, протоколов разногласий к договорам, контрактов, соглашений, писем, справок, учредительных документов и т. д.";
            }
            
            if (valZnach=='Разработка документов и договоров') {$(".nameNewZadanie").val('Составить договор продажи авто');
                textTask = "Необходимо составить договор купли-продажи автомобиля между физическими лицами с учетом всех необходимых условий для покупателяи минимизации возможных рисков";
            }
            
            if (valZnach=='ЖКХ') {$(".nameNewZadanie").val('Составить договор управления домом');
                textTask = "Необходимо составить договор управления многоквартирным домом с учетом всех необходимых условий согласно закона";
            }
            
            if (valZnach=='Корпоративное право') {$(".nameNewZadanie").val('Составить трудовой ');
                textTask = "Необходимо составить трудовой договор договор с исполнительным директором ООО";
            }
            
            if (valZnach=='Защита прав потребителей') {$(".nameNewZadanie").val('Проверить договор');
                textTask = "Необходимо проверить договор на посещение фитнес-клуба на возможность его досрочного расторжения по инициативе клиента";
            }
            
            if (valZnach=='Здравоохранение') {$(".nameNewZadanie").val('Проверить договор');
                textTask = "Необходимо проверить договор на медицинское обслуживание на возможность взымания по нему необоснованной дополнительной платы за услуги по лечению пациэнта";
            }
            
            if (valZnach=='Связь, СМИ, Интернет') {$(".nameNewZadanie").val('Составить рекламный договор');
                textTask = "Необходимо составить договор на оказание рекламных услуг в средствах массовой информации с минимизацией рисков штрафных санкций для рекламного агенства";
            }
            
            if (valZnach=='Конституционное право') {$(".nameNewZadanie").val('Составить  договор');
                textTask = "Необходимо провести правовую эксперитзу конституционно-правового договора на предмен соблюдение прав человека и норм Международного права";
            }
            
            if (valZnach=='Нотариат') {$(".nameNewZadanie").val('Составить  договор');
                textTask = "Необходимо составить договор купли-продажи дома и заверить его у нотариуса";
            }
            
            if (valZnach=='Международное  право') {$(".nameNewZadanie").val('Составить договор с иностранной компанией');
                textTask = "Необходима проверка контрактов заключенных компанией с зарубежными фирмами на полное соответствие всем нормам отечественного и международного права а также подготовка и оформление международных договоров";
            }
            
            if (valZnach=='Налоговое право') {$(".nameNewZadanie").val('Составить договор');
                textTask = "Необходимо составить договор поставки садового инструмента, в котором учесть все налоги и сборы организации и проанализирровать финансовую отчётность, которая подтверждает деятельность компании";
            }
            
            if (valZnach=='Наследование') {$(".nameNewZadanie").val('Составить договор');
                textTask = "Необходимо составить договор купли-продажи автомобиля доставшегося мне по наследству";
            }
            
            if (valZnach=='Образование') {$(".nameNewZadanie").val('Составить договор с преподователем');
                textTask = "Необходимо составить договор с преподователем дополнительного образования для подготовки к поступлению в институт";
            }
            
            if (valZnach=='Лицензирование') {$(".nameNewZadanie").val('Составить лицензионный договор ');
                textTask = "Необходимо составить договор на право передачи в пользование объекта интеллектуальной собственности";
            }
            
            if (valZnach=='Таможня') {$(".nameNewZadanie").val('Услуги контрактодержателя');
                textTask = "Необходим  полный комплекс  мероприятий по  организации  операций по импорту и экспорту товаров  по  поручению компании";
            }
            
            if (valZnach=='Экспертиза') {$(".nameNewZadanie").val('Экспертиза договора');
                textTask = "Необходима лингвистическая экспертиза договора подряда на предмет установления смыслового содержания текста документа для защиты в суде";
            }
            
            if (valZnach=='Юридические лица') {$(".nameNewZadanie").val('Составление и проверка договоров для  ООО');
                textTask = "Необходимо стоставить договора для деятельности ООО и проверить заключенные договоры на предмет возможных рисков";
            } 
        }
        
        
        
        if (vidTask=='Составление и подача жалоб, исков, защита в суде')
        {
            if (valZnach=='Не знаю') {$(".nameNewZadanie").val('');} 
            
            if (valZnach=='Автомобильное право') {$(".nameNewZadanie").val('Составить исковое заявление');
                textTask = "Надо составить исковое заявление в суд о взыскании полного размера ущерба от ДТП со страховой компании";
            } 
            
            if (valZnach=='Авторские и смежные права') {$(".nameNewZadanie").val('Составить иск в суд о защите авторского права');
                textTask = "Надо составить исковое заявление в суд о защите авторского права и возмещении убытков";
            } 
            
            if (valZnach=='Недвижимость') {$(".nameNewZadanie").val('Подать иск в суд о взыскании пени с застройщика');
                textTask = "Надо подать исковое заявление в суд о взыскании пени с засторищика который просрочил срок сдачи дома по договору долевого участия";
            } 
            
            if (valZnach=='Административное право') {$(".nameNewZadanie").val('Обжаловать штраф');
                textTask = "Надо подать жалобу на выписанный мне штраф за нарушение пожарной безопасности";
            } 
            
            if (valZnach=='Семейное право') {$(".nameNewZadanie").val('Лишить родительских прав');
                textTask = "Надо подать заявление в суд о лишении отца родительских прав за уклонение от уплаты алиментов";
            } 
            
            if (valZnach=='Уголовное право') {$(".nameNewZadanie").val('Помощь по уголовному делу');
                textTask = "Требуется помощь опытного адвоката по защите интересов по уголовному делу и подаче жалоб на действия следователя ";
            }
            
            if (valZnach=='Кредиты и заем') {$(".nameNewZadanie").val('Защита в суде по иску банка ');
                textTask = "Нужна защита в суде  по иску банка о взыскании задолженности и неустойки по кредиту";
            } 
           
            if (valZnach=='Антимонопольное право') {$(".nameNewZadanie").val('Составить жалобу в антимонопольную службу');
                textTask = "Надо составить жалобу в антимонопольную службу на действия управляющей компании";
            }
            
            if (valZnach=='Арбитраж') {$(".nameNewZadanie").val('Нужен арбитражный юрист');
                textTask = "Надо представить интересы организации в арбитражном суде по иску поставщика о взыскании задолженности";
            }
            
            if (valZnach=='Исполнительное производство') {$(".nameNewZadanie").val('Жалоба на судебного пристава');
                textTask = "Требуется подготовить жалобу на бездействие судебного пристава по взысканию задолженности по решению суда";
            }
            
            if (valZnach=='Военная служба') {$(".nameNewZadanie").val('Подать иск в военный суд');
                textTask = "Надо составить исковое заявление в суд о признании незаконным действий жилищной комиссии об отказе обеспечения жильем военнослужащего";
            }
            
            if (valZnach=='Трудовое право') {$(".nameNewZadanie").val('Подать в суд на работодателя');
                textTask = "Надо составить исковое заявление в суд о восстановление на работе в связи с незаконным увольнением";
            }
            
            if (valZnach=='Бухгалтерия') {$(".nameNewZadanie").val('Подать в суд на бухгалтера');
                textTask = "Надо составить исковое заявление в суд о привлечение к материальной ответственности главного бухгалтера";
            }
            
            if (valZnach=='Возмещение вреда и убытков') {$(".nameNewZadanie").val('Составить исковое заявление');
                textTask = "Надо составить исковое заявление в суд о взыскании полного размера ущерба от затопления квартиры соседями";
            }
            
            if (valZnach=='Страхование') {$(".nameNewZadanie").val('Подать в суд на страховую');
                textTask = "Надо подать в суд на страховую компанию по ОСАГО и взыскать полную стоимость ущерба";
            }
            
            if (valZnach=='Экология') {$(".nameNewZadanie").val('Подать в суд на штраф по экологии');
                textTask = "Надо обжаловать штраф на юридическое лицо за несоблюдение экологических и санитарно-эпидемиологических требований при обращении с отходами производства";
            }
            
            if (valZnach=='Миграционное право') {$(".nameNewZadanie").val('Подать в суд на штраф ФМС');
                textTask = "Надо обжаловать штраф ФМС за работу иностранцев в компании без разрешения на работу";
            }
            
            if (valZnach=='Гос.закупки и тендеры') {$(".nameNewZadanie").val('Обжаловать результат аукциона');
                textTask = "Надо оспорить в суде результат электронного аукциона которым нашей компании отказанно в допуске в участии в торгах";
            }
            
            if (valZnach=='Гражданские дела') {$(".nameNewZadanie").val('Подать в суд');
                textTask = "Надо подать в суд на гражданина взявшего деньги в долг под расписку и не вернувшего их в срок";
            }
            
            if (valZnach=='Юридическое обслуживание и аутсорсинг') {$(".nameNewZadanie").val('Представление интересов организации в судах');
                textTask = "Требуется юридичесеское сопровождение ООО в части представления интересов организации в судебных органах, органах государственной власти и местного самоуправления, общественных организациях, подготовке жалоб, исков";
            }
            
            if (valZnach=='Разработка документов и договоров') {$(".nameNewZadanie").val('Обязать через суд заключить договор');
                textTask = "Надо через суд обязать сторону заключить договор на покупку компьютеров по итогам торгов";
            }
            
            if (valZnach=='ЖКХ') {$(".nameNewZadanie").val('Подать жалобу на управляющую компанию');
                textTask = "Надо написать и направить в компетентные органы жалобу на бездействия управляющей компании по ремонту и обслуживанию дома и придомовой территории";
            }
            
            if (valZnach=='Корпоративное право') {$(".nameNewZadanie").val('Оспорить решение собрания ООО');
                textTask = "Надо отменить в суде решение собрания участников ООО о смене генерального директора компании";
            }
            
            if (valZnach=='Защита прав потребителей') {$(".nameNewZadanie").val('Жалоба за некачественный ремонт автомобиля');
                textTask = "Надо подать жалобу на автосервис, произвевший некачественну ремон автомобиля и отказывающися устранять недостатки в добровольном порядке";
            }
            
            if (valZnach=='Здравоохранение') {$(".nameNewZadanie").val('Подать всуд на медицинскую клинику');
                textTask = "Надо подать в суд на медицинскую клинику, оказавшую некачественные услуги по проведению пластической операциии, с взысканием ущерба и морального вреда";
            }
            
            if (valZnach=='Связь, СМИ, Интернет') {$(".nameNewZadanie").val('Подать жалобу на спам');
                textTask = "Надо подать жалобу за спам приходящий мне в виде СМС сообщений на телефон без моего согласия";
            }
            
            if (valZnach=='Конституционное право') {$(".nameNewZadanie").val('Подать жалобу в Конституционный суд');
                textTask = "Надо оспорить Постановление Правительства РФ в Конституционном суде и представить интересы в суде";
            }
            
            if (valZnach=='Нотариат') {$(".nameNewZadanie").val('Оспорить нотариальную сделку');
                textTask = "Надо признать незаконным нотариальный договор купли-продажи недвижимости, совершенный с грубым нарушением интересов владельца доли недвижимости";
            }
            
            if (valZnach=='Международное право') {$(".nameNewZadanie").val('Защита в иностранном суде');
                textTask = "Требуется защита прав и интересов организации за рубежом, в том числе представительство при рассмотрение дел в международном арбитраже";
            }
            
            if (valZnach=='Налоговое право') {$(".nameNewZadanie").val('Отменить штраф налоговой');
                textTask = "Требуется отменить в суде штраф налоговой инспекции за непредоставление налолговой декларации";
            }
            
            if (valZnach=='Наследование') {$(".nameNewZadanie").val('Признать право на наследство');
                textTask = "Требуется подать в суд для признания моего права на наследство";
            }
            
            if (valZnach=='Образование') {$(".nameNewZadanie").val('Оспорить отчисление');
                textTask = "Требуется оспорить отчисление из института за неуспеваемость";
            }
            
            if (valZnach=='Лицензирование') {$(".nameNewZadanie").val('Расторгнуть лицензионный договор');
                textTask = "Требуется составить исковое заявление о расторжении лицензионного договора";
            }
            
            if (valZnach=='Таможня') {$(".nameNewZadanie").val('Оспорить корректировку стоимости ввезенного товара');
                textTask = "Требуется оспорить решение таможни о корректировке таможенной стоимости ввезенных товаров";
            }
            
            if (valZnach=='Экспертиза') {$(".nameNewZadanie").val('Оспорить результат медицинской экспертизы');
                textTask = "Требуется оспорить результат медицинской экспертизы не установившей причинение тяжкого вреда здоровтю пострадавшего";
            }
            
            if (valZnach=='Юридические лица') {$(".nameNewZadanie").val('Подать в суд на юридическое лицо (ООО)');
                textTask = "Требуется подать в суд на компанию отказывающуюся устранить недостатки в ремонте напольного покрытия дома";
            } 
        }
        
        
               
        if (vidTask=='Оформление документов, разрешений, лицензий')
        {
            if (valZnach=='Не знаю') {$(".nameNewZadanie").val('');} 
            
            if (valZnach=='Автомобильное право') {$(".nameNewZadanie").val('Подготовить документы в ГИБДД');
                textTask = "Нужно подготовить документы в ГИБДД для замены водительского удостоверения в связи с истечением его срока действия";
            } 
            
            if (valZnach=='Авторские и смежные права') {$(".nameNewZadanie").val('Составить иск в суд о защите авторского права');
                textTask = "Надо составить исковое заявление в суд о защите авторского права и возмещении убытков";
            } 
            
            if (valZnach=='Недвижимость') {$(".nameNewZadanie").val('Получить разрешение на строительство');
                textTask = "Нужно подготовить документы и получить разрешение на строительство частного жилого дома";
            } 
            
            if (valZnach=='Административное право') {$(".nameNewZadanie").val('Составить запрос в полициию');
                textTask = "Нужно подготовить запрос в полицию об устновлении сведений о наличии у сотрудника компании приводов в полицию";
            } 
            
            if (valZnach=='Семейное право') {$(".nameNewZadanie").val('Получить материнский капитал');
                textTask = "Нужно быстро подготовить документы в государственные органы для выплаты мне материнского капитала";
            } 
            
            if (valZnach=='Уголовное право') {$(".nameNewZadanie").val('Подготовить документы снятие судимости');
                textTask = "Нужно подготовить документы для снятия судимости по приговору суда о лишении свободы условно за мошенничество";
            }
            
            if (valZnach=='Кредиты и заем') {$(".nameNewZadanie").val('Исправить кредитную историю');
                textTask = "Нужно подготовить документы для внесения изменений в кредитную историю для получения кредита в банках";
            } 
           
            if (valZnach=='Антимонопольное право') {$(".nameNewZadanie").val('Получить разрешение антимонопольного органа');
                textTask = "Нужно получить согласование антимонопольного органа на совершение сделки по приобретению акций компании";
            }
            
            if (valZnach=='Арбитраж') {$(".nameNewZadanie").val('Составить претензию');
                textTask = "Нужно составить претензию к подрядчику о нарушении сроков строительства";
            }
            
            if (valZnach=='Исполнительное производство') {$(".nameNewZadanie").val('Получить исполнительный лист');
                textTask = "Нужно подготовить документы для получения исполнительного листа в суде и направления его в службу судебных приставов";
            }
            
            if (valZnach=='Военная служба') {$(".nameNewZadanie").val('Подготовить рапорт на обеспечение жильем');
                textTask = "Нужно подготовить рапорт на имя командира воинской части о постановке меня и членов семьи на жилищный учет";
            }
            
            if (valZnach=='Трудовое право') {$(".nameNewZadanie").val('Получить разрешение на работу');
                textTask = "Нужно получить разрешение на работу иностранному гражданину";
            }
            
            if (valZnach=='Бухгалтерия') {$(".nameNewZadanie").val('Составить отчет в Пенсионный фонд России');
                textTask = "Нужно ежемесячно подготавливать и сдавать отчетность в ПФР ";
            }
            
            if (valZnach=='Возмещение вреда и убытков') {$(".nameNewZadanie").val('Подготовить соглашение о возмещении ущерба');
                textTask = "Нужно подготовить солашение о добровольном возмещении материального ущерба причиненного в результате ДТП";
            }
            
            if (valZnach=='Страхование') {$(".nameNewZadanie").val('Подготовить заявление о возврате страховке');
                textTask = "Нужно подготовить заявление о возврате страховки уплаченной мной банку по кредитному договору";
            }
            
            if (valZnach=='Экология') {$(".nameNewZadanie").val('Получить лицензию на отходы');
                textTask = "Нужно подготовить необходимые документы и получить лицензии на сбор и транспортировку отходов ООО";
            }
            
            if (valZnach=='Миграционное право') {$(".nameNewZadanie").val('Получить разрешение на работу');
                textTask = "Нужно подготовить необходимые документы и получить разрешение на работу в России гражданину Узбекистана";
            }
            
            if (valZnach=='Гос.закупки и тендеры') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Требуется юридическая помощь в создании юридического лица с возможностью участия в государственных закупках ";
            }
            
            if (valZnach=='Гражданские дела') {$(".nameNewZadanie").val('Составить доверенность');
                textTask = "Нужно составить грамотно доверенность на получение товара от поставщиков";
            }
            
            if (valZnach=='Юридическое обслуживание и аутсорсинг') {$(".nameNewZadanie").val('Проверка документов бизнеса');
                textTask = "Нужно юридичесеское сопровождение ИП в части анализа документов, подготовка правовых заключений, проверки всех контрагентов на честность и добропорядочность в вопросах бизнеса и взаимного сотрудничества";
            }
            
            if (valZnach=='Разработка документов и договоров') {$(".nameNewZadanie").val('Подготовить документы для продажи квартиры');
                textTask = "Нужно подготовить документы для продажи квартиры \"под ключ\"";
            }
            
            if (valZnach=='ЖКХ') {$(".nameNewZadanie").val('Подготовить документы для ТСЖ');
                textTask = "Нужно подготовить документы для создания и постоянной деятельности ТСЖ";
            }
            
            if (valZnach=='Корпоративное право') {$(".nameNewZadanie").val('Внести изменения в ЕГРЮЛ');
                textTask = "Нужно подготовить в налолговую инспекцию о смене руководителя ООО";
            }
            
            if (valZnach=='Защита прав потребителей') {$(".nameNewZadanie").val('Составить претензию на возврат товара');
                textTask = "Нужно составить претензию в магазин оптики, продавший мне бракаванные очки, для возврата денег за некачественный товар";
            }
            
            if (valZnach=='Здравоохранение') {$(".nameNewZadanie").val('Получить лицензию для косметолога');
                textTask = "Нужно получить лицензию для оказания услуг косметолога в салоне красоты";
            }
            
            if (valZnach=='Связь, СМИ, Интернет') {$(".nameNewZadanie").val('Получить патент');
                textTask = "Нужно получить патент на результаты интеллектуальной собственности";
            }
            
            if (valZnach=='Конституционное право') {$(".nameNewZadanie").val('Запрос  в Конституционный суд');
                textTask = "Нужно подготовить запрос в Конституционный суд о проверке конституционности закона";
            }
            
            if (valZnach=='Нотариат') {$(".nameNewZadanie").val('Составить доверенность');
                textTask = "Нужно подготовить доверенность на представление организации в государственных органах для заверения нотариусом";
            }
            
            if (valZnach=='Международное право') {$(".nameNewZadanie").val('Защита в иностранном суде');
                textTask = "Требуется защита прав и интересов организации за рубежом, в том числе представительство при рассмотрение дел в международном арбитраже";
            }
            
            if (valZnach=='Налоговое право') {$(".nameNewZadanie").val('Подготовить заявление на налоговый вычет');
                textTask = "Нужно подготовить в налоговую инспекцию документы для получения налогового вычета на покупку квартиры";
            }
            
            if (valZnach=='Наследование') {$(".nameNewZadanie").val('Составить завещание');
                textTask = "Нужно подготовить проект завещания с учетом интересов наследников и заверить его у нотариуса";
            }
            
            if (valZnach=='Образование') {$(".nameNewZadanie").val('Лицензия на образовательную дечтельность');
                textTask = "Нужно подготовить докумены и получить лицензию для ведения организацией образовательной деятельности";
            }
            
            if (valZnach=='Лицензирование') {$(".nameNewZadanie").val('Оформить разрещшение на оружие');
                textTask = "Нужно получить разрешение на оружие без стояния в очереди и сбора документов клиентом";
            }
            
            if (valZnach=='Таможня') {$(".nameNewZadanie").val('таможенная сертификация');
                textTask = "Нужно получить таможенные сертификаты на ввозимые из Китая игрушки";
            }
            
            if (valZnach=='Экспертиза') {$(".nameNewZadanie").val('Лицензия на экспертизу');
                textTask = "Нужно получить лицензию на проведение экспертизы промышленной безопасности";
            }
            
            if (valZnach=='Юридические лица') {$(".nameNewZadanie").val('Оформить документы для самостоятельной регистрации ООО');
                textTask = "Нужно поготовить необходимые документы для самостоятельной регистрации ООО в налоговой";
            }
        }
        
        if (vidTask=='Регистрация, ликвидация, реорганизация юридических лиц')
        {
            if (valZnach=='Не знаю') {$(".nameNewZadanie").val('');}
             
            if (valZnach=='Автомобильное право') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Требуется юридическая помощь в организации продажи автомобиля ООО при ликвидации юридического лица ";
            } 
            
            if (valZnach=='Авторские и смежные права') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Требуется юридическая помощь в регистрации товарного знака при создании юридического лица ";
            } 
            
            if (valZnach=='Недвижимость') {$(".nameNewZadanie").val('Аренда юридического адреса');
                textTask = "Требуется юридический адрес для регистрации ООО";
            } 
            
            if (valZnach=='Административное право') {$(".nameNewZadanie").val('Ликвидация ООО имеющей штрафы');
                textTask = "Требуется помощь в ликвидации ООО имеющей неоплаченные штрафы ФМС";
            } 
            
            if (valZnach=='Семейное право') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Нужно зарегистрировать фирму с видом деятельности по оказанию помощи в получении материнского капитала";
            } 
            
            if (valZnach=='Уголовное право') {$(".nameNewZadanie").val('Подготовить документы снятие судимости');
                textTask = "Нужно подготовить документы для снятия судимости по приговору суда о лишении свободы условно за мошенничество";
            }
            
            if (valZnach=='Кредиты и заем') {$(".nameNewZadanie").val('Ликвидация юридического лица');
                textTask = "требуется юридическая помощь в ликвидации ООО при наличии долгов перед банками";
            } 
           
            if (valZnach=='Антимонопольное право') {$(".nameNewZadanie").val('Помощь в слиянии организаций');
                textTask = "Требуется юридическая помощь в слиянии коммерческих организаций с получением согласования мантимонопольной службы";
            }
            
            if (valZnach=='Арбитраж') {$(".nameNewZadanie").val('Помощь в банкротстве');
                textTask = "Требуется юридическая помощь в ликвидации юридического лица в связи с банкротством";
            }
            
            if (valZnach=='Исполнительное производство') {$(".nameNewZadanie").val('Помощь в ликвидациии ООО');
                textTask = "Требуется ликвидация фирмы имеющей арест имущества по решению судебных приставов";
            }
            
            if (valZnach=='Военная служба') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Требуется юридическая помощь в подготовке заявления в налоговую инспекцию о внесении изменений о руководителе организации (назначении нового командира воинской части)";
            }
            
            if (valZnach=='Трудовое право') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Требуется юридическая помощь в составлении устава ООО при регистрации юридического лица";
            }
            
            if (valZnach=='Бухгалтерия') {$(".nameNewZadanie").val('Подготовить заявление в налоговую о смене бухгалтера');
                textTask = "Требуется подготовить заявление в налоговую инспекцию о смене главного бухгалтера который в соответствии с учредительными документами организации наделен правом действовать от имени организации без доверенности";
            }
            
            if (valZnach=='Возмещение вреда и убытков') {$(".nameNewZadanie").val('Необходима ликвидация ООО');
                textTask = "Требуется помощь в ликвидации юридического лица с минимальным ущербом для контрагентов, учредителей и участников.";
            }
            
            if (valZnach=='Страхование') {$(".nameNewZadanie").val('Необходимо зарегистрировать компанию');
                textTask = "Требуется помощь в  регистрации и создании страховой компании";
            }
            
            if (valZnach=='Экология') {$(".nameNewZadanie").val('Необходимо зарегистрировать компанию');
                textTask = "Требуется помощь в  регистрации компании с видом деятельности по сбору и транспортировке отходов";
            }
            
            if (valZnach=='Миграционное право') {$(".nameNewZadanie").val('Необходимо зарегистрировать компанию');
                textTask = "Требуется помощь в  регистрации компании с видом деятельности по сбору и транспортировке отходов";
            }
            
            if (valZnach=='Гос.закупки и тендеры') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Требуется юридическая помощь в создании юридического лица с возможностью участия в государственных закупках ";
            }
            
            if (valZnach=='Гражданские дела') {$(".nameNewZadanie").val('Зарегистрировать ИП');
                textTask = "Требуется зарегистрировать \"под ключ\" ИП в ИФНС Октябрьского района";
            }
            
            if (valZnach=='Юридическое обслуживание и аутсорсинг') {$(".nameNewZadanie").val('Юридическое сопровождение бизнеса');
                textTask = "Требуется юридическое сопровождение компании по подготовке уставных документов и вносимых в них изменений";
            }
            
            if (valZnach=='Разработка документов и договоров') {$(".nameNewZadanie").val('Подготовить документы для регистрации ООО');
                textTask = "Требуется подготовить комплект документов для самостоятельной регистрации ООО в ИФНС Кировского района г. Ростов-на-Дону";
            }
            
            if (valZnach=='ЖКХ') {$(".nameNewZadanie").val('Подготовить документы для регистрации ТСЖ');
                textTask = "Требуется подготовить комплект документов для  регистрации ТСЖ в налоговой";
            }
            
            if (valZnach=='Корпоративное право') {$(".nameNewZadanie").val('Зарегистрировать общество по защите прав потребителей');
                textTask = "Требуется зарегистрировать \"под ключ\" общество по защите прав потребителей во всех требуемых государственных органах";
            }
            
            if (valZnach=='Защита прав потребителей') {$(".nameNewZadanie").val('Зарегистрировать общество по защите прав потребителей');
                textTask = "Требуется зарегистрировать \"под ключ\" общество по защите прав потребителей во всех требуемых государственных органах";
            }
            
            if (valZnach=='Здравоохранение') {$(".nameNewZadanie").val('Зарегистрировать частную медицинскую клинику');
                textTask = "Требуется зарегистрировать \"под ключ\" частную медицинскую клинику в налоговой инспекции и получить необходимые лицензии на осуществление медицинской деятельности";
            }
            
            if (valZnach=='Связь, СМИ, Интернет') {$(".nameNewZadanie").val('Зарегистрировать интернет-магазин');
                textTask = "Требуется зарегистрировать \"под ключ\" интернет-магазин налоговой инспекции ";
            }
            
            if (valZnach=='Конституционное право') {$(".nameNewZadanie").val('Зарегистрировать ООО');
                textTask = "Требуется зарегистрировать \"под ключ\" ООО";
            }
            
            if (valZnach=='Нотариат') {$(".nameNewZadanie").val('Зарегистрировать ООО');
                textTask = "Требуется по нотариальной доверенности зарегистрировать \"под ключ\" ООО";
            }
            
            if (valZnach=='Международное право') {$(".nameNewZadanie").val('Разрешение на строительство иностранной компании');
                textTask = "Нужно получить разрешение на строительство для иностранной компании, согласовать все необходимые условия с местными органами власти";
            }
            
            if (valZnach=='Налоговое право') {$(".nameNewZadanie").val('Подготовить заявление на налоговый вычет');
                textTask = "Нужно подготовить в налоговую инспекцию документы для получения налогового вычета на покупку квартиры";
            }
            
            if (valZnach=='Наследование') {$(".nameNewZadanie").val('Оформить наследство юридического лица');
                textTask = "Требуется регистрация  юридического лица на нового собственника по наследству";
            }
            
            if (valZnach=='Образование') {$(".nameNewZadanie").val('Отурыть образовательное учреждение');
                textTask = "Требуется помощь в открытии, регистрации негосударственного образовательного учреждения";
            }
            
            if (valZnach=='Лицензирование') {$(".nameNewZadanie").val('Регистрация охранной организации');
                textTask = "Требуется помощь в создании, регистрации, лицензировании частной охранной организации (ЧОО)";
            }
            
            if (valZnach=='Таможня') {$(".nameNewZadanie").val('Регистрация  организации');
                textTask = "Нужно зарегистрировать ООО с правом заниматься растаможкой товаров";
            }
            
            if (valZnach=='Экспертиза') {$(".nameNewZadanie").val('Регистрация  организации');
                textTask = "Нужно зарегистрировать ООО с правом заниматься электромонтажными работами и оформлением соответствующей лицензии";
            }
            
            if (valZnach=='Юридические лица') {$(".nameNewZadanie").val('Ликвидировать ООО');
                textTask = "Нужно ликвидировать ООО со сроком деятельности менее 3 лет";
            }
        }
        
        
        
        
        if (vidTask=='Бухгалтерские услуги')
        {
            if (valZnach=='Не знаю') {$(".nameNewZadanie").val('');}
             
            if (valZnach=='Автомобильное право') {$(".nameNewZadanie").val('Рассчитать транспортный налог');
                textTask = "Требуется рассчитать транспртный налог и подать декларацию в налоговую инспекцию";
            } 
            
            if (valZnach=='Авторские и смежные права') {$(".nameNewZadanie").val('Бухгалтерский учет интеллектуальной собственности');
                textTask = "Требуется организовать бухгалтерский учет интеллектуальной собственности компании";
            } 
            
            if (valZnach=='Недвижимость') {$(".nameNewZadanie").val('Бухгалтерский учет  недвижимости');
                textTask = "Требуется организовать бухгалтерский учет объектов недвижимости компании";
            } 
            
            if (valZnach=='Административное право') {$(".nameNewZadanie").val('Отразить штрафы в бухгалтерском учете ');
                textTask = "Требуется оказать помощь в проводке штрафов наложенных на компанию по бухгалтерскому учету";
            } 
            
            if (valZnach=='Семейное право') {$(".nameNewZadanie").val('Семейный бухгалтер');
                textTask = "Требуется ведение семейной бухгалтерии ";
            } 
            
            if (valZnach=='Уголовное право') {$(".nameNewZadanie").val('Бухгалтерская эксперитза по уголовному делу');
                textTask = "Требуется независимая судебно-бухгалтерская эксперитза по уголовному делу";
            }
            
            if (valZnach=='Кредиты и заем') {$(".nameNewZadanie").val('Рассчитать кредит');
                textTask = "Требуется рассчитать законность уплаченных процентов по кредиту";
            } 
           
            if (valZnach=='Антимонопольное право') {$(".nameNewZadanie").val('Требуется юридическая помощь');
                textTask = "Требуется отразить в бухгалтерском учете штрафы антимонопольной службы";
            }
            
            if (valZnach=='Арбитраж') {$(".nameNewZadanie").val('Бухгалтерские услуги при банкротстве');
                textTask = "требуется ведение бухгалтерского учета и сдача налоговой отчетности организаций на стадии банкротства";
            }
            
            if (valZnach=='Исполнительное производство') {$(".nameNewZadanie").val('Требуется юридическая помощь');
                textTask = "Требуются бухгалтесрские услуги по отражению в учете задолженности признаной судебными пирставами нереальной ко взысканию";
            }
            
            if (valZnach=='Военная служба') {$(".nameNewZadanie").val('Рассчитать денежное довольствие военнослужащего');
                textTask = "Требуется рассчитать размер денежного довольствия военнослужащего с учетом надбавок, льгот и компенсаций";
            }
            
            if (valZnach=='Трудовое право') {$(".nameNewZadanie").val('Услуги бухгалтерского обслуживания');
                textTask = "Требуется полное бухгалтерское сопровождение ООО";
            }
            
            if (valZnach=='Бухгалтерия') {$(".nameNewZadanie").val('Услуги бухгалтерского обслуживания');
                textTask = "Требуется полное бухгалтерское сопровождение ООО";
            }
            
            if (valZnach=='Возмещение вреда и убытков') {$(".nameNewZadanie").val('Отразить ущерб в бухгалтерии');
                textTask = "Требуется помощь в составлении проводок сумм удержанных с зарплаты сотрудника за возмещение ущерба причиненного организации";
            }
            
            if (valZnach=='Страхование') {$(".nameNewZadanie").val('Отразить страховку в бухгалтерии');
                textTask = "Требуется помощь в составлении проводок расходов на страхование имущества ООО";
            }
            
            if (valZnach=='Экология') {$(".nameNewZadanie").val('Отчет по экологии');
                textTask = "Требуется подготовить и сдать отчет по экологии за квартал";
            }
            
            if (valZnach=='Миграционное право') {$(".nameNewZadanie").val('Требуется ведение бухгалтерии');
                textTask = "Требуется бухгалтерское обслуживание иностранного представительства в России зарубежной компании";
            }
            
            if (valZnach=='Гос.закупки и тендеры') {$(".nameNewZadanie").val('Провести расходы на участие в тендерах');
                textTask = "Требуется правильно отразить в бухгалтерском учете расходы , связанные с участием в тендерах, т.е. доступ к системе электронных торгов";
            }
            
            if (valZnach=='Гражданские дела') {$(".nameNewZadanie").val('Ведение бухгалтерии');
                textTask = "Требуется бухгалтерское обслуживание ООО с численностью работников 15 человек";
            }
            
            if (valZnach=='Юридическое обслуживание и аутсорсинг') {$(".nameNewZadanie").val('Ведение бухгалтерии и юридическое сопровождение бизнеса');
                textTask = "Требуется комплексное бухгалтерское и юридическое обслуживание бизнеса ";
            }
            
            if (valZnach=='Разработка документов и договоров') {$(".nameNewZadanie").val('Подготовка документации к сдаче в архив ');
                textTask = "Требуется подготовить к сдаче в архив первичных бухгалтерских документов, бухгалтерской отчетности, учетных регистров ООО";
            }
            
            if (valZnach=='ЖКХ') {$(".nameNewZadanie").val('Бухгалтерское обслуживание ТСЖ');
                textTask = "Требуется комплексное бухгалтерское обслуживание ТСЖ по договору";
            }
            
            if (valZnach=='Корпоративное право') {$(".nameNewZadanie").val('Бухгалтерское обслуживание акционерного общества');
                textTask = "Требуется комплексное бухгалтерское обслуживание акционерного общества";
            }
            
            if (valZnach=='Защита прав потребителей') {$(".nameNewZadanie").val('Бухгалтерское обслуживание общество по защите прав потребителей');
                textTask = "Требуется комплексное бухгалтерское обслуживание общество по защите прав потребителей";
            }
            
            if (valZnach=='Здравоохранение') {$(".nameNewZadanie").val('Бухгалтерское обслуживание медицинской клиники');
                textTask = "Требуется комплексное бухгалтерское обслуживание частной медицинской клиники";
            }
            
            if (valZnach=='Связь, СМИ, Интернет') {$(".nameNewZadanie").val('Бухгалтерское обслуживание интернет-магазина');
                textTask = "Требуется комплексное бухгалтерское обслуживание интернет-магазина";
            }
            
            if (valZnach=='Конституционное право') {$(".nameNewZadanie").val('Бухгалтерское обслуживание');
                textTask = "Требуется комплексное бухгалтерское обслуживание ";
            }
            
            if (valZnach=='Нотариат') {$(".nameNewZadanie").val('Бухгалтерское обслуживание ');
                textTask = "Требуется комплексное бухгалтерское обслуживание";
            }
            
            if (valZnach=='Международное право') {$(".nameNewZadanie").val('Регистрация иностранного юридического лица');
                textTask = "Требуется регистрация  юридических лиц с полными или частичными иностранными инвестициями";
            }
            
            if (valZnach=='Налоговое право') {$(".nameNewZadanie").val('Бухгалтерское обслуживание ');
                textTask = "Требуется комплексное бухгалтерское обслуживание ИП";
            }
            
            if (valZnach=='Наследование') {$(".nameNewZadanie").val('Бухгалтерское обслуживание');
                textTask = "Требуется проверить (рассчитать) сумму налога, подлежащей уплате наследником";
            }
            
            if (valZnach=='Образование') {$(".nameNewZadanie").val('Бухгалтерские курсы');
                textTask = "Требуется дополнительное обучение в сфере ведения бухгалтери ";
            }
            
            if (valZnach=='Лицензирование') {$(".nameNewZadanie").val('Бухгалтерское обслуживание юридического лица');
                textTask = "Требуется бухгалтерское обслуживание частной  охранной организации";
            }
            
            if (valZnach=='Таможня') {$(".nameNewZadanie").val('Бухгалтерское обслуживание');
                textTask = "Требуется бухгалтерское обслуживание организации занимающейся внешнеэкономической деятельностью";
            }
            
            if (valZnach=='Экспертиза') {$(".nameNewZadanie").val('СРО для бухгалтерского аудита');
                textTask = "Требуется помощь в вступление в СРО для ведения бухгалтерского аудита";
            }
            
            if (valZnach=='Юридические лица') {$(".nameNewZadanie").val('Бухгалтерское обслуживание юридического лица');
                textTask = "Требуется полное бухгалтерское сопровождение ООО занимающегося торговлей";
            }
        }
        
        
        
        if (vidTask=='другое')
        {
            if (valZnach=='Не знаю') {$(".nameNewZadanie").val('');}
            
             
            if (valZnach=='Автомобильное право') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Нужна помощь юриста для проверки автомобиля при покупке на угон и залог в банке";
            } 
            
            if (valZnach=='Авторские и смежные права') {$(".nameNewZadanie").val('Необходима оценка интеллектуальной собственности');
                textTask = "Нужно провести оценку нематериальных активов, в т.ч. Интеллектуальной собственности при ликвидации компании";
            } 
            
            if (valZnach=='Недвижимость') {$(".nameNewZadanie").val('Помощь в оформлении ипотеки');
                textTask = "Нужно помошь юриста в получении ипотеки в банке с использованием средств материнского капитала";
            } 
            
            if (valZnach=='Административное право') {$(".nameNewZadanie").val('Необходима юридическая помощь');
                textTask = "Нужна помошь юриста в проверке наличия у меня неоплаченных штрафов ";
            } 
            
            if (valZnach=='Семейное право') {$(".nameNewZadanie").val('Установить отцовство');
                textTask = "Нужна помошь юриста в установлении отцовства лица отказывающегося признавать ребенка своим сыном";
            } 
            
            if (valZnach=='Уголовное право') {$(".nameNewZadanie").val('Условно-досрочное освобождение');
                textTask = "Нужна помощь опытного адвоката в досрочном освобождении осужденного от отбывания наказания за преступление небольшой тяжести";
            }
            
            if (valZnach=='Кредиты и заем') {$(".nameNewZadanie").val('Защита от коллекторов');
                textTask = "Нужна помощь юриста для защиты от судебных приставово и коллекторов";
            } 
           
            if (valZnach=='Антимонопольное право') {$(".nameNewZadanie").val('Провести правовой аудит');
                textTask = "Нужен правовой аудит компании с целью выявления нарушения норм антимонопольного права";
            }
            
            if (valZnach=='Арбитраж') {$(".nameNewZadanie").val('Требуется юридическая помощь');
                textTask = "Нужна помощь юриста в оценке перспективы обжалования в суд решения антимонопольного органа";
            }
            
            if (valZnach=='Исполнительное производство') {$(".nameNewZadanie").val('Помощь в взыскании долга по решению суда');
                textTask = "Нужна помощь юриста для взыскании долга по решению суда которое долго не исполняется  ";
            }
            
            if (valZnach=='Военная служба') {$(".nameNewZadanie").val('Защита прав призвыника');
                textTask = "Нужна помощь для освобождения от призыва на военную службу";
            }
            
            if (valZnach=='Трудовое право') {$(".nameNewZadanie").val('Оценка условий труда');
                textTask = "Нужно провести специальную оценку условий труда (СОУТ) с составлением отчета  ";
            }
            
            if (valZnach=='Бухгалтерия') {$(".nameNewZadanie").val('Провести аудиторскую проверку');
                textTask = "Нужно провести аудиторскую проверку компании с выдачей аудиторского заключения и оказанием помощи главному бухгалтеру по устранению выявленных нарушений в ходе проверки  ";
            }
            
            if (valZnach=='Возмещение вреда и убытков') {$(".nameNewZadanie").val('Оценить ущерб деловой репутации');
                textTask = "Нужна помощь в оценке ущерба причиненного деловой репутации компании от публикации в СМИ, а также помощь в привлечении виновных к ответственности  ";
            }
            
            if (valZnach=='Страхование') {$(".nameNewZadanie").val('Страхование груза');
                textTask = "Нужна помощь в оценке ущерба причиненного компании от уничтожения застрахованного груза транспортной компанией, а также помощь в получении страховки";
            }
            
            if (valZnach=='Экология') {$(".nameNewZadanie").val('Отчет по экологии');
                textTask = "Требуется подготовить и сдать отчет по экологии за квартал";
            }
            
            if (valZnach=='Миграционное право') {$(".nameNewZadanie").val('Экспертиза документации тендера');
                textTask = "Нужна экспертиза документации заказчика на соответствие требованиям законодательства, выявления возможных \"подводных камней\" и \"заточек\"";
            }
            
            if (valZnach=='Гос.закупки и тендеры') {$(".nameNewZadanie").val('Экспертиза документации тендера');
                textTask = "Нужна экспертиза документации заказчика на соответствие требованиям законодательства, выявления возможных \"подводных камней\" и \"заточек\"";
            }
            
            if (valZnach=='Гражданские дела') {$(".nameNewZadanie").val('Вернуть товар в магазин');
                textTask = "Нужна помощь в возврате бракованного сотового телефона в магазин";
            }
            
            if (valZnach=='Юридическое обслуживание и аутсорсинг') {$(".nameNewZadanie").val('Юридическое сопровождение бизнеса');
                textTask = "Требуется юридическое сопровождение бизнеса по профессиональному юридическому разрешению вопросов, возникающих в ходе ведения коммерческой деятельности компании";
            }
            
            if (valZnach=='Разработка документов и договоров') {$(".nameNewZadanie").val('Подготовить документацию по котировочной заявке');
                textTask = "Нужна помощь спициалиста по подготовке документации для участия в запросе котировок на портале государственных закупок согласно требований госзаказчика";
            }
            
            if (valZnach=='ЖКХ') {$(".nameNewZadanie").val('Представительство в жилищной инспекции');
                textTask = "Нужна помощь опытного юриста в области ЖКХ в работе с жилищной инспекцией при проверках работы управлющей компании";
            }
            
            if (valZnach=='Корпоративное право') {$(".nameNewZadanie").val('Правовая экспертиза документов компании');
                textTask = "Нужно провести экспертизу учредительных и иных внутренних документов/регламентов компании на соответствие законодательству";
            }
            
            if (valZnach=='Защита прав потребителей') {$(".nameNewZadanie").val('Независимая экспертиза автомобиля');
                textTask = "Нужно провести независимую экспертизу автомобиля после ДТП с выдачей письменного заключения";
            }
            
            if (valZnach=='Здравоохранение') {$(".nameNewZadanie").val('Независимая медицинская экспертиза');
                textTask = "Нужно провести независимую медицинскую экспертизу, на предмет врачебной ошибки доктора, приведшей к причинению вреда пациэнту";
            }
            
            if (valZnach=='Связь, СМИ, Интернет') {$(".nameNewZadanie").val('Правовое сопровождение рекламного агенства');
                textTask = "Нужно полное правовое сопровождение текущей хозяйственной деятельности рекламного агенстава";
            }
            
            if (valZnach=='Конституционное право') {$(".nameNewZadanie").val('Анализ закона на соблюдение Конституции РФ');
                textTask = "Нужно провести правовой анализ закона на соответствие его нормам Конституции РФ";
            }
            
            if (valZnach=='Нотариат') {$(".nameNewZadanie").val('Выезд нотариуса на дом');
                textTask = "Нужно заверить нотариально на дому копии документов";
            }
            
            if (valZnach=='Международное право') {$(".nameNewZadanie").val('Европейский суд');
                textTask = "Нужна помощь юриста в Европейском суде";
            }
            
            if (valZnach=='Налоговое право') {$(".nameNewZadanie").val('Аудит организации');
                textTask = "Требуется аудит и финансовый анализ компании с целью оценки и идентификации внутренних проблем компании для подготовки, обоснования и принятия различных управленческих решений, в том числе в области развития, выхода из кризиса, привлечения инвестиций, покупки-продажи бизнеса или пакета акций, перехода к процедурам банкротства";
            }
            
            if (valZnach=='Наследование') {$(".nameNewZadanie").val('Помощь в наследовании');
                textTask = "Требуется оказание правовой помощи при наследовании денежных вкладов, государственных наград, почетных и памятных знаков";
            }
            
            if (valZnach=='Образование') {$(".nameNewZadanie").val('Научная работа по юриспруденции');
                textTask = "Требуется написание SEO текстов по юриспруденции для правового портала";
            }
            
            if (valZnach=='Лицензирование') {$(".nameNewZadanie").val('Документы для регистрации товарного знака');
                textTask = "Требуется подготовка документов для самостоятельной регистрации товарного знака компании";
            }
            
            if (valZnach=='Таможня') {$(".nameNewZadanie").val('Помощь в лицензировании');
                textTask = "Требуется помощь в лицензировании деятельности компании занимающейся газификацией";
            }
            
            if (valZnach=='Экспертиза') {$(".nameNewZadanie").val('Расстаможка груза');
                textTask = "Требуется помощь в растаможке и оформлении грузов из Китая";
            }
            
            if (valZnach=='Юридические лица') {$(".nameNewZadanie").val('Юридическое сопровождение юридического лица');
                textTask = "Требуется полное юридическое сопровождение (аутсорсинг) бизнеса";
            }
        }
        
        
        if (textTask!="")
        {
            $(".textZadach").prop("placeholder",textTask);
        }
        else
        {
            $(".textZadach").prop("placeholder","Опишите какая стоит перед Вами задача и максимально подробно расскажите о её деталях");
        }
        
    });
    
});


function addLink() {
var body_element = document.getElementsByTagName('body')[0];
var selection;
selection = window.getSelection();
 var pagelink = " <i>Подробнее на moyzakon.com: <a href='"+document.location.href+"'>"+document.location.href+"</a></i>";
var copytext = selection + pagelink;
var newdiv = document.createElement('div');
newdiv.style.position='absolute';
newdiv.style.left='-99999px';
body_element.appendChild(newdiv);
newdiv.innerHTML = copytext;
selection.selectAllChildren(newdiv);
window.setTimeout(function() {
body_element.removeChild(newdiv);
},0);
}
document.oncopy = addLink;

 
  