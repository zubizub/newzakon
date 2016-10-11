$(document).ready(function() {
		get_zayvka();
		get_obr_svyz();
		get_zakaz();
		get_comment();
		get_vopros_otvet();
		get_otziv();
		get_dopinf_zayvka();
		get_dopinf_obr_svyz();
		get_dopinf_comment();
		get_dopinf_vopros_otvet();
		get_dopinf_otziv();
		get_dopinf_zakaz();		
		
        /*
		var timer;
		var timeout = 50000;
		timer = $.timer(timeout, function() {
			get_zayvka();
			get_obr_svyz();
			get_zakaz();
			get_comment();
			get_vopros_otvet();
			get_otziv();	
			get_dopinf_zayvka();
			get_dopinf_obr_svyz();	
			get_dopinf_comment();	
			get_dopinf_vopros_otvet();
			get_dopinf_otziv();
			get_dopinf_zakaz();
		});		
	    */
	
	$("#chart_div").on("click",function() {
		$("#chart_div2").fadeIn();
	});
	
	$("#chart_div2").on("click",function() {
		$("#chart_div2").fadeOut();
	});	
	
	$(".close_block_news_es").on("click",function() {
		$.post("modul/desktop/ajax_news_es.php",  {id_news: $(".id_news").val()});
		$(".blocks_news_es").fadeOut();
	});		
	
});


function get_zayvka()
{
	$.post("modul/desktop/ajax.php",
	  {
		type: "zayvki"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".zayvki_div").html(data);
	}	
}


function get_obr_svyz()
{
	$.post("modul/desktop/ajax.php",
	  {
		type: "obr_svyz"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".obr_svyz_div").html(data);
	}	
}



function get_zakaz()
{
	$.post("modul/desktop/ajax.php",
	  {
		type: "zakaz"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".zakaz_div").html(data);
	}	
}



function get_comment()
{
	$.post("modul/desktop/ajax.php",
	  {
		type: "comment"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".comment_div").html(data);
	}	
}


function get_vopros_otvet()
{
	$.post("modul/desktop/ajax.php",
	  {
		type: "vopros_otvet"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".vopros_otvet_div").html(data);
	}	
}



function get_otziv()
{
	$.post("modul/desktop/ajax.php",
	  {
		type: "otziv"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".otziv_div").html(data);
	}	
}


function get_dopinf_zayvka()
{
	$.post("modul/desktop/ajax_dopinf.php",
	  {
		type: "zayvki"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".dopinf_zayvka").html(data);
	}	
}


function get_dopinf_obr_svyz()
{
	$.post("modul/desktop/ajax_dopinf.php",
	  {
		type: "obr_svyz"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".dopinf_obr_svyz").html(data);
	}	
}



function get_dopinf_comment()
{
	$.post("modul/desktop/ajax_dopinf.php",
	  {
		type: "comment"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".dopinf_comment").html(data);
	}	
}


function get_dopinf_vopros_otvet()
{
	$.post("modul/desktop/ajax_dopinf.php",
	  {
		type: "vopros_otvet"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".dopinf_vopros_otvet").html(data);
	}	
}


function get_dopinf_vopros_otvet()
{
	$.post("modul/desktop/ajax_dopinf.php",
	  {
		type: "vopros_otvet"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".dopinf_vopros_otvet").html(data);
	}	
}


function get_dopinf_otziv()
{
	$.post("modul/desktop/ajax_dopinf.php",
	  {
		type: "otziv"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".dopinf_otziv").html(data);
	}	
}


function get_dopinf_zakaz()
{
	$.post("modul/desktop/ajax_dopinf.php",
	  {
		type: "zakaz"
	  },
	  onAjaxSuccess1
	);
	 
	function onAjaxSuccess1(data)
	{
	  $(".dopinf_zakaz").html(data);
	}	
}