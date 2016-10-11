$(document).ready(function() {
	$(".scan_vir").click(function() {
		$.post("modul/antivir/ajax.php",
		  {
			dir: "/blocks"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html(data+"<br><br>");
		}
		
		
		$.post("modul/antivir/ajax.php",
		  {
			dir: "/js"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html($(".inf_div").html()+data);
		}	
		
		
		
		$.post("modul/antivir/ajax.php",
		  {
			dir: "/fancybox"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html($(".inf_div").html()+data);
		}	
		
		
		$.post("modul/antivir/ajax.php",
		  {
			dir: "/css"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html($(".inf_div").html()+data);
		}
		

		$.post("modul/antivir/ajax.php",
		  {
			dir: "/images"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html($(".inf_div").html()+data);
		}
		
		
		$.post("modul/antivir/ajax.php",
		  {
			dir: "/images"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html($(".inf_div").html()+data);
		}
		
		
		
		
		$.post("modul/antivir/ajax.php",
		  {
			dir: "/uploads"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html($(".inf_div").html()+data);
		}		
		
		
		$.post("modul/antivir/ajax.php",
		  {
			dir: "/"
		  },
		  onAjaxSuccess
		);
		 
		function onAjaxSuccess(data)
		{
		  $(".inf_div").html($(".inf_div").html()+data);
		}			
											
	})
});
