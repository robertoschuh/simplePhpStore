<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php session_start(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="gloria.css" rel="stylesheet" type="text/css" />
    <meta name="keywords" content="belenes,artesanía belensística,artesanía,natividad,miniaturas" />
<meta name="description" content="belenes artesanos y miniaturas elaborados por artesana gloria botonero" />
<title>belenes artesanos</title>

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


</head>
<?php
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

    <body>
 

<div id="container">
    <div id="header"><iframe src="header.php" width="100%" scrolling = "no"></iframe></div>

<div id="sidebar_first">
    <iframe src="php/show_menu_categories.php" scrolling = "auto"></iframe>

</div>
<div id="content">
    <iframe src="php/categories.php" width="100%" height="100%" scrolling = "auto" name= "content"></iframe>
</div>
</div>
</body>
</html>
