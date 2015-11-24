<?php

@session_start();
if (!isset($_SESSION['init']))
    $_SESSION['init'] = 1;

if (isset($_GET['loged_of'])) {
    if ($_GET['loged_of'] == 1)
        session_unregister("valid_user");
}
//Comprueba el idioma
if (isset($_GET['language'])) {
    if ($_SESSION['idioma']) {
        $_SESSION['idioma'] = $_GET['language'];
    } else {

        $_SESSION['idioma'] = $_GET['language'];
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Analitycs -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-7333489-6']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- fin Analitycs -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="belenes,artesanía belensística,artesanía,natividad,miniaturas" />
<meta name="description" content="belenes artesanos y miniaturas elaborados por artesana gloria botonero" />
<title>belenes</title>
<link href="gloria.css" rel="stylesheet" type="text/css" />
</head>

<frameset  class='frame_header' rows="140,*" cols="*" framespacing="0" frameborder="no" border="0">

  <frame src="header.php" name="topFrame" frameborder="no" scrolling="no" marginwidth="0" marginheight="7" bordercolor="#993300" id="topFrame" title="topFrame"  />
  
  <frameset rows="*" cols="180,*" framespacing="0" frameborder="no" border="0" >
  
		<frame src="php/show_menu_categories.php" name="leftFrame" frameborder="no" scrolling="auto" marginheight="0" id="leftFrame" title="leftFrame" />
        
		<frame src="php/categories.php"  name="mainFrame" frameborder="no" scrolling="auto" bordercolor="#FF9933" id="mainFrame" title="mainFrame"/>
 
 </frameset>
</frameset>
<noframes><body>
</body>
</noframes></html>
