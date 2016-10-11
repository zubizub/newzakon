$(document).ready(function() {	
	$(".del_img").click(function() {
		$.post("modul/katalog/ajax_delfile.php",
		  {
			num: $(".del_img").attr("num"),
			del_img: 1
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  alert("Файл удален");
		  $(".del_img").fadeOut();
		  $(".main_img").attr("href","img/no_img.jpg");
		}		
	});
	

	$(".del_cur1").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","?page=goods_price&del="+$(this).attr("num"));
		
	});
	
	
	$(".curent").change(function() {
		$(".cur2").html($(".curent option:selected").html());
	});
	
	$(".del_katalog1").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_katalog.php?del="+$(this).attr("num"));
		
	});
	
	$(".button_enabl").click(function() {
		$.post("modul/katalog/ajax.php",
		  {
			num: $(this).attr("num"),
			id: $(this).attr("value"),
			type: $(this).attr("num2")
		  }
		);
		
		if ($(this).attr("num")==0) {
            $(this).attr("src",'img/disabled.png'); 
            $(this).attr("num",'1');
        } 
        else 
        {
            $(this).attr("src",'img/enabled.png'); 
            $(this).attr("num",'0');
        }		
	});
	
    
	$(".del_file").click(function() {
		
		$("div [num="+$(this).attr("value")+"]").fadeOut();
		$.post("modul/katalog/ajax_delfile.php",
		  {
			file_url: $(this).attr("num"),
			file_url2: $(this).attr("num2")
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  alert("Файл удален!");
		}		
	});
	
		 
	 
	 $(".draggedTable").tableDnD({
		 onDrop: function(table, row) {
			var i = 0;
			var this_e = $(row).attr('id');
			var url = $(row).attr('url');
			var last_e;
			var next_e;
			var ARR_NUM = [];
			var ARR_ID = [];
			var max_elem;
			$(".draggedTable tr").each(function(indx, element){
				ARR_NUM[i] = $(element).attr("num"); 
				ARR_ID[i] = $(element).attr("id");i++;
			});	
			

			for (j=1; j<i; j++)
			{
				if (ARR_ID[j]==this_e) 
				{
					if (j!=1 && j!=(i-1))
					{
						next_e = ARR_ID[j+1]; 
						last_e = ARR_ID[j-1];	
						max_elem=10;					
					}
					
					if (j==1)
					{
						next_e = ARR_ID[j+1]; 
						last_e = 0;		
						max_elem=0;		
					}
					
					if (j==(i-1))
					{
						next_e = 0; 
						last_e = ARR_ID[j-1];
						max_elem=1; // означает что этот элемент последний					
					}					
				}
			}
			

				$.post("modul/katalog/ajax_drag.php",
				  {
					this_e: this_e,
					last_e: last_e,
					next_e: next_e,
					url: url,
					max_elem: max_elem
				  },
				  onAjaxSuccess_d
				);
				 
				function onAjaxSuccess_d(data)
				{
				  // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
				  //alert(data);
				}

			 
	 }});
	 
	 
	$(".del_folder").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_add_folder_katalog.php?del="+$(this).attr("num"));
		
	});	 
	
	$(".del_page").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_add_goods.php?del="+$(this).attr("num"));
	});	


	$(".del_page").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_add_goods.php?del="+$(this).attr("num"));
	});	
	
	$(".del_goods").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_add_goods.php?del="+url_link);
	});	
		
	
	
	$(".del_har").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_add_harakteristika.php?del="+$(this).attr("num"));
		
	});
	
	$(".del_firm").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_firms.php?del="+$(this).attr("num"));
		
	});	
	
	$(".del_zakaz").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/katalog/obr_zakaz.php?delzakaz&del="+$(this).attr("num"));
	});	

	$(".del_zakaz_goods").click(function() {
		$("#msgBox_del").fadeIn();
		var zakaz = $(".zakaz").val();
		$(".button_yes").attr("href","modul/katalog/obr_zakaz.php?delgoods&zakaz="+zakaz+"&del="+$(this).attr("num"));
	});	
	
	$(".creat_yml").click(function() {
		$(".creat_yml span").html("<img src='/cms/img/add_cart.gif' height='11' style='margin-right:7px'/>");
		$.post("modul/katalog/ajax_creat_yml.php",
		  {
			this_e: "1"
		  },
		  onAjaxSuccess_d
		);
		 
		function onAjaxSuccess_d(data)
		{
			$(".creat_yml span").html("");
			$(".inf_creat_yml").fadeIn();
		}	
	});
	
	$(".select_goods").click(function() {
		$(".select_td").css("display","table-cell");
	})
	
	
	
	
	//выделение товаров
	$("#all_chek").click(function () {
		  	num_chek=0;
			url_link='';
			if (!$("#all_chek").is(":checked"))
			{
				$(".obj_chek").removeAttr("checked");
			}
			else 
			{
				$(".obj_chek").prop("checked","checked");
			}
			
			$(".obj_chek").each(function(indx){
			  if ($(this).is(":checked")) {num_chek++; url_link+=$(this).val()+",";}
			});	
 			
 			if (num_chek==0) {$(".pole_url").val("");} 
			else {
				$(".pole_url").val(url_link);
			}
			
			if (num_chek>0)
			{
				$(".dop_deystviy").css("display","inline-block");
				$(".kol_videlenno").html(num_chek);
			}
			else
			{
				$(".dop_deystviy").fadeOut();
			}
	  });			
	

		

		$(".obj_chek").click(function ()
		{
			num_chek=0;
			url_link='';
			if ($(this).is(":checked")==false) {$("#all_chek").attr("checked",false);}
			
			$(".obj_chek").each(function(indx){
			  if ($(this).is(":checked")) {num_chek++; url_link+=$(this).val()+",";}
			});	

			if (num_chek==0) {$(".pole_url").val("");} 
			else 
			{
				$(".pole_url").val(url_link);
			}
			
			
			if (num_chek>0)
			{
				$(".dop_deystviy").css("display","inline-block");
				$(".kol_videlenno").html(num_chek);
			}
			else
			{
				$(".dop_deystviy").fadeOut();
			}			
		});	
		
		
        var type_deystvie; // действие с товаром, копирование или перемещение
        
		$(".tofolder_goods").click(function() {
            type_deystvie = "move";
            $(".btn_ok_peremestit").html("переместить");
            
			if ($(".box_peremestit").css("display")=='none')
			{
				$(".box_peremestit").fadeIn();
			}
			else
			{
				$(".box_peremestit").fadeOut();
			}
		})


		$(".copyfolder_goods").click(function() {
            type_deystvie = "copy";
            $(".btn_ok_peremestit").html("копировать");
            
			if ($(".box_peremestit").css("display")=='none')
			{
				$(".box_peremestit").fadeIn();
			}
			else
			{
				$(".box_peremestit").fadeOut();
			}
		})
		
		
		$(".btn_ok_peremestit").click(function() {
			$(this).html("<img src='/img/add_cart.gif' height='15' />");
			var urlfolder_to = $(".list_kategory option:selected").val();	
			$(".goods_rows").removeClass("goods_rows_copy");
            
            if (type_deystvie=="move") //если товары перемещаются
            {
    			$.post("modul/katalog/ajax_peremestit_goods.php",
    			  {
    				url_goods: url_link,
    				urlfolder_to: urlfolder_to
    			  },
    			  onAjaxSuccessPeremestit
    			);
    			 
    			function onAjaxSuccessPeremestit(data)
    			{
    				arr_goods = url_link.split(',');
    				for (i=0;i<num_chek;i++)
    				{
    					$(".goods_rows_"+arr_goods[i]).remove();
    				}
    			  	
    			  	$(".dop_deystviy").fadeOut();
                    $(".box_peremestit").fadeOut();
    			  	$(".btn_ok_peremestit").html("переместить");
    			}
            }
            else // если товары копируются
            {
                $.post("modul/katalog/ajax_copy_goods.php",
    			  {
    				url_goods: url_link,
    				urlfolder_to: urlfolder_to
    			  },
    			  onAjaxSuccessCopy
    			);
    			 
    			function onAjaxSuccessCopy(data)
    			{
    				arr_goods = url_link.split(',');
    				for (i=0;i<num_chek;i++)
    				{
    					$(".goods_rows_"+arr_goods[i]).addClass("goods_rows_copy");
    				}
    			  	
                    $(".box_peremestit").fadeOut();
    			  	$(".dop_deystviy").fadeOut();
    			  	$(".btn_ok_peremestit").html("копировать");
    			}
            }	
		})
		
		
		$(".btn_cancel_peremestit").click(function() {
			$(".box_peremestit").fadeOut();
		});
		
		$(".update_number_goods").on("click", function() {
			$(".img_update_number_goods").css("display","inline-block");
			
			$.post("modul/katalog/ajax_update_number.php",
			  {
				url: $(".url_cat").val()
			  },
			  onAjaxSuccessUpdateNumber
			);
			 
			function onAjaxSuccessUpdateNumber(data)
			{
				window.location.href = '?page=katalog&url='+$(".url_cat").val();
			}	
		})
		
		$(".img_pay").click(function() {
			$(this).css("background","none");	
			$(this).html("<img src='/img/add_cart.gif' height='14'/>");	
			var this_btn = $(this);
			var id_zakaz = $(this).attr("num");
			var type_pay = $(this).attr("num2");
			
			$.post("modul/katalog/ajax_pay.php",
			  {
				id: id_zakaz,
				type_pay:type_pay
			  },
			  onAjaxSuccess
			);
			 
			function onAjaxSuccess(data)
			{
			  this_btn.css("display","none");
			 
			  if (type_pay==1)
			  { 
			  	$(".msg_pay_"+id_zakaz).css("color","#36c922");
			  	$(".msg_pay_"+id_zakaz).html(" [оплачен]");
			  }
			  else
			  {
			  	$(".msg_pay_"+id_zakaz).css("color","#d41515");
			  	$(".msg_pay_"+id_zakaz).html(" [не оплачен]");
			  }
			}
		})
		
		
		
		//поиск товаров для добавления в список С ЭТИМ ТОВАРОМ ПОКУПАЮТ
		var count;
		var with_item = "";
		
		$(".btn_search_goods_withitem").click(function() {
			$(".ajax_div_search").html("<img src='/img/add_cart.gif' height='18'/>");
			
			$.post("modul/katalog/ajax_search_goods.php",
			  {
				search_pole: $(".seach_goods_in_card").val()
			  },
			  onAjaxSuccessSearch
			);
			 
			function onAjaxSuccessSearch(data)
			{
				$(".ajax_div_search").html("");
				$(".box_search_goods").html(data);
				 
				search_goods_item();
			}				
		})
	
	
		
		
	
	$(".btn_contaner_search_goods_now_save").click(function() {
		if ($(this).hasClass("btn_contaner_search_add")==true)
		{
			with_item = $(".with_item").val();
		
			//исключаем дубликаты, смотрим есть ли такой id в строке
			count = (with_item.split($(this).attr("num")).length - 1)
			
			if (count==0)
			{
				if (with_item!='') {
					with_item = with_item+","+$(this).attr("num");
				}
				else
				{
					with_item = $(this).attr("num");
				}
			}
			
			$(".with_item").val(with_item);
			$(this).html('исключить');
			$(this).addClass("btn_contaner_search_goods_h");
			$(this).addClass("btn_contaner_search_del");
			$(this).removeClass("btn_contaner_search_add");
		}
		else
		{
			//кнопка удаления товара из списока С ЭТИМ ТОВАРОМ ПОКУПАЮТ 
			with_item = $(".with_item").val();
		
			//исключаем дубликаты, смотрим есть ли такой id в строке
			count = (with_item.split($(this).attr("num")).length - 1)
			
			if (count==1)
			{
				with_item = with_item.replace(","+$(this).attr("num"), "");
				with_item = with_item.replace($(this).attr("num"), "");
			}
			
			$(".with_item").val(with_item);
			
			$(this).html('добавить');
			$(this).removeClass("btn_contaner_search_goods_h");
			$(this).removeClass("btn_contaner_search_del");
			$(this).addClass("btn_contaner_search_add");
		}
		
	})
	
	
	
		document.onkeyup = function (e) {
			e = e || window.event;
			if (e.keyCode === 13) {
				//$(".button_save_main").click();
			}
			// Отменяем действие браузера
			return false;
		}	
	
		
		
		$(".seach_goods_in_card").focus(function() {
			$(".button_save_main").attr("type","button");	
			
			document.onkeyup = function (e) {
				e = e || window.event;
				if (e.keyCode === 13) {
					$(".btn_search_goods_withitem").click();
				}
				// Отменяем действие браузера
				return false;
			}

		});

		
		$(".seach_goods_in_card").focusout(function() {
			$(".button_save_main").attr("type","submit");	
			
            /*
			document.onkeyup = function (e) {
				e = e || window.event;
				if (e.keyCode === 13) {
					$(".frm_add_goods").submit();
				}
				// Отменяем действие браузера
				return false;
			}
            
            */
		});
		
		
		$(".btn-goods_in_cat_katalog").click(function() {
			var goods_in_cat_katalog = $(".goods_in_cat_katalog option:selected").val();
			$(".btn-goods_in_cat_katalog").val("....");
			
			$.post("modul/katalog/ajax_goods_in_cat.php",
			  {
				goods_in_cat_katalog: goods_in_cat_katalog
			  },
			  onAjaxSuccessSubmit
			);
			 
			function onAjaxSuccessSubmit(data)
			{
				$(".btn-goods_in_cat_katalog").addClass("btn-goods_in_cat_katalog_h");
				$(".btn-goods_in_cat_katalog").val("OK");
			}	
		})
        
        
 		$(".del_url_any").click(function() {
			var id_katalog_url = $(this).attr("num");
			var id_goods = $(this).attr("num2");
            $(this).html("<img src='/cms/img/add_cart.gif' height='6'/>");
            var del_url_any = $(this);
            
			$.post("modul/katalog/ajax_url_any.php",
			  {
                del:1,
				id_katalog_url: id_katalog_url,
                id_goods: id_goods
			  },
			  onAjaxSuccessUrlAny
			);
			 
			function onAjaxSuccessUrlAny(data)
			{
				$(".link_url_any_"+id_katalog_url).css("text-decoration","line-through");
                del_url_any.css("opacity","0");
			}	
		})  
 
 
  		$(".add_url_any").click(function() {
            $(".add_url_any").html('ждите');
			var id_katalog_url = $(this).attr("num");
			var id_goods = $(this).attr("num2");
            
			$.post("modul/katalog/ajax_url_any.php",
			  {
                add:1,
				id_katalog_url: id_katalog_url,
                id_goods: id_goods
			  },
			  onAjaxSuccessUrlAny2
			);
			 
			function onAjaxSuccessUrlAny2(data)
			{
				$(".add_url_any").html('добавить');
                var name_url_cat = $('.name_kat_url_any').val();
                var mainbox_link_url_any_text = $('.mainbox_link_url_any').html();
                $(".mainbox_link_url_any").html("<div class='link_url_any link_url_any_$myrow_katalog[id]'>"+name_url_cat+"</div>"+mainbox_link_url_any_text);
			}	
		})        
        
    $('.name_kat_url_any').keyup(function(eventObject){
        var str_name_kat = $('.name_kat_url_any').val();
        $(".box_list_kat").html("<img src='/cms/img/add_cart.gif' height='20'/>"); 
        
        if (str_name_kat!='')
        {
          $.post("modul/katalog/ajax_get_cat.php",
			  {
				str_name_kat: str_name_kat
			  },
			  onAjaxSuccessGatCat
			);
			 
			function onAjaxSuccessGatCat(data)
			{
                if (data!='')
                {
                    $(".box_list_kat").css("display","block");
                    $(".box_list_kat").html(data); 
                    
                    $(".box_list_kat a").on("click",function(e) {
                       e.preventDefault();
                       $(".box_list_kat").css("display","none");
                       $(".add_url_any").css("display","inline-block");
                       $(".add_url_any").attr("num",$(this).attr("num"));
                       $('.name_kat_url_any').val($(this).html());
                    })
    
                }
                else
                {
                    $(".box_list_kat").css("display","none");
                    $(".add_url_any").css("display","none");
                }
			}	
        }
        else
        {
            $(".box_list_kat").css("display","none");
            $(".add_url_any").css("display","none");
        }

    });         
            
            
            
    
        
});




function search_goods_item()
{
	//кнопка добавления товара в список С ЭТИМ ТОВАРОМ ПОКУПАЮТ 
	$(".btn_contaner_search_goods").on('click',function() {
		if ($(this).hasClass("btn_contaner_search_add"))
		{
			with_item = $(".with_item").val();
		
			//исключаем дубликаты, смотрим есть ли такой id в строке
			count = (with_item.split($(this).attr("num")).length - 1)
			
			if (count==0)
			{
				if (with_item!='') {
					with_item = with_item+","+$(this).attr("num");
				}
				else
				{
					with_item = $(this).attr("num");
				}
			}
			
			$(".with_item").val(with_item);
			$(this).html('исключить');
			$(this).addClass("btn_contaner_search_goods_h");
			$(this).addClass("btn_contaner_search_del");
			$(this).removeClass("btn_contaner_search_add");
		}
		else
		{
			//кнопка удаления товара из списока С ЭТИМ ТОВАРОМ ПОКУПАЮТ 
			with_item = $(".with_item").val();
		
			//исключаем дубликаты, смотрим есть ли такой id в строке
			count = (with_item.split($(this).attr("num")).length - 1)
			
			if (count==1)
			{
				with_item = with_item.replace(","+$(this).attr("num"), "");
				with_item = with_item.replace($(this).attr("num"), "");
			}
			
			$(".with_item").val(with_item);
			$(this).html('добавить');
			$(this).removeClass("btn_contaner_search_goods_h");
			$(this).addClass("btn_contaner_search_add");
		}
		
	})
}

//изменение статуса заказа
function statusEdit(id_zakaz)
{
	$.post("modul/katalog/ajax_zakaz.php",
	  {
		id: id_zakaz,
		status:$(".status"+id_zakaz+" option:selected").val()
	  },
	  onAjaxSuccess
	);
	 
	function onAjaxSuccess(data)
	{
	  alert("Сохранено!");
	}	
}


//изменение количества товаров в заказе
function pereschetCount(id)
{
	var count = $(".num_goods_"+id).val();
	$(".num_goods_"+id).val(count.replace (/\D/, ''));
	count = $(".num_goods_"+id).val();
	
	$.post("modul/katalog/ajax_zakaz.php",
	  {
		id:$(".num_goods_"+id).attr('num'),
		count: $(".num_goods_"+id).val(),
		id_zakaz:$(".num_goods_"+id).attr('num2'),
		editcount:'1'
	  },
	  onAjaxSuccessCount
	);
	 
	function onAjaxSuccessCount(data)
	{
		$(".summ_"+id).css("color","green");
		$(".summ_"+id).html(data);
		
		
		$.post("modul/katalog/ajax_zakaz.php",
		  {
			id_zakaz:$(".num_goods_"+id).attr('num2'),
			get_main_price:'1'
		  },
		  onAjaxSuccessGet_main_price
		);
		 
		function onAjaxSuccessGet_main_price(data)
		{
			$(".main_price").html(data);
		}		
	}	

}
