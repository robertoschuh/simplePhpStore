<?php @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../gloria.css" rel="stylesheet" type="text/css" />
</head>
 <body>
<?php
require ("fns.php");
@session_start();
//ver_carrito ();	

$cat = $_GET['cat'];
$articles_array = get_article($_GET['artid']);

article_individual($_GET['artid'], $cat);
?>
</body>

