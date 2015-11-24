<?php @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>
    <body>
<?php
$idioma=$_SESSION['idioma'];

require ("../../fns.php");
require ("../admin_fns.php");

if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
 exit;

}

//obtenemos todos los detalles de este art?culo a trav?s de la funci?n get_article
$article = get_article($_GET['artid']);
$unidades=get_almacen($_GET['artid']);

//Formulario al que enviamos el array $article con los detalles del art?culo como valores por defecto
mod_article_form ($article,$unidades,$_GET['catid']);
?>
</body>