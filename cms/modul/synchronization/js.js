$(document).ready(function() {
	$(".fadein_news").click(function() {
		$(".fide_rows").fadeIn();	
	});
	
	
	$(".creat_csv").click(function() {
		$.post("modul/synchronization/ajax_creat.php",
		  {
			param1: "1",
			export_cat:$(".export").val()
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".creat_csv_l").html("Загрузить csv");
		  $(".creat_csv_l").attr("href","modul/synchronization/upload/file.csv");
		}		
		
	});
			
	$(".del_file").click(function() {
		
		$("div [num="+$(this).attr("value")+"]").fadeOut();
		$.post("modul/news/ajax_delfile.php",
		  {
			file_url: $(this).attr("num")
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  alert("Файл удален!");
		}		
	});
	
	$(".del_img").click(function() {
		$.post("modul/news/ajax_delfile.php",
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
	
	
	$(".del_news1").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/news/obr_news.php?del="+$(this).attr("num"));
		
	});
	
	$(".button_enabl").click(function() {
		$.post("modul/news/ajax.php",
		  {
			num: $(this).attr("num"),
			id: $(this).attr("value")
		  }
		);
		
		if ($(this).attr("num")==0) {$(this).attr("src",'img/disabled.png'); $(this).attr("num",'1');} else {$(this).attr("src",'img/enabled.png'); $(this).attr("num",'0');}		
	});
	
	 
	 var $bitrix_chek = 0;
	 $(".bitrix_chek").on("click",function() {
		if ($bitrix_chek==0) {
			$bitrix_chek = 1; $(".frm_import").attr("action",'modul/synchronization/obr_import_bitrix.php');
			$(".artic").css("border","1px solid red");
			$(".name_goods").css("border","1px solid red");
			$(".price_goods").css("border","1px solid red");
			$(".desc_goods").css("border","1px solid red");
			$(".img_goods").css("border","1px solid red");
			
			$(".artic1").attr("selected",true);
			$(".name_goods1").attr("selected",true);
			$(".desc_goods1").attr("selected","selected");
			$(".img_goods1").attr("selected",true);
			$(".price_goods1").attr("selected",true);
			
			alert('Обратите внимание, порядок столбцов изменен, сделайте свой csv файл в соответствии с нумерацией!');
		} 
		else {$bitrix_chek = 0; $(".frm_import").attr("action",'modul/synchronization/obr_import.php');}
	 });
	 
	 
	 
	 $(".draggedTable").tableDnD({
		 onDrop: function(table, row) {
			var i = 0;
			var this_e = $(row).attr('id');
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
			

				$.post("modul/news/ajax_drag.php",
				  {
					this_e: this_e,
					last_e: last_e,
					next_e: next_e,
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
	 
	 
	 $(".btn_upload_new_price").click(function() {
	 	if ($(".file_new_price").val()!='')
	 	{
			$(this).val("загружаю...");
		}
	 })
	
});
