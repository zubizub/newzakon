<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title><? echo $_POST[title]; ?></title>
<meta name="keywords" content="<? echo $_POST[keyworks]; ?>">
<meta name="description" content="<? echo $_POST[description]; ?>">
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom/js/jquery-1.6.2.min.js"></script>

<style>
.save_button_pages {border:2px solid #d0d0d0;
    -moz-border-radius:5px 5px 5px 5px;
    -webkit-border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    border-radius:5px 5px 5px 5px;
	padding:3px;
	color:#333;
	text-decoration:none;
	font-size:14px; 
	font-family:Arial, Helvetica, sans-serif;
	cursor:pointer;
}


html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	font-size: 100%;
	font-family: inherit;
	vertical-align: baseline; 
	}


</style>
</head>


<body>
<div style="width:1024px; margin:auto; color:#000">
	<? echo $_POST[editor1]; ?>
<br><br><br>
 <div align="center"> <a href="#" title="сохранить" class="save_button_pages" onClick="proverka()">закрыть</a></div>


</form>

</div>

<script>
	
	var title1 = 0;
	var description = 0;
	var keyworks = 0;
	
	function proverka() {
			self.close()
	}
</script>
</body>
</html>