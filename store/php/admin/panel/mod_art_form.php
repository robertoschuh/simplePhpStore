<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<?php

@session_start();
$idioma=$_SESSION['idioma'];

require ("../../fns.php");
require ("../admin_fns.php");

if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
 exit;

}

//Recibimos artid por medio de get
$artid=$_GET[artid];
//obtenemos todos los detalles de este art?culo a trav?s de la funci?n get_article
$article=get_article($artid);
$unidades=get_almacen($artid);

//Formulario al que enviamos el array $article con los detalles del art?culo como valores por defecto
mod_article_form ($article,$unidades,$_GET['catid']);
