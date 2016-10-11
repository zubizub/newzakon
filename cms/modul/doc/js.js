$(document).ready(function() {
	$(".fadein_news").click(function() {
		$(".fide_rows").fadeIn();	
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
	
	
	$(".del_doc").click(function() {
		$("#msgBox_del").fadeIn();
		$(".button_yes").attr("href","modul/doc/obr_doc.php?del="+$(this).attr("num"));
		
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
	
});
