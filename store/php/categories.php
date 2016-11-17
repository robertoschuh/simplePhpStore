<?php
error_reporting(0); 
ini_set('display_errors',0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Gloria Botonero belenes y miniaturas</title>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
<style type="text/css">
img{border: 0px;}
</style>
</head>
<body>
<?php
require ("fns.php");
require ("admin/admin_fns.php");
//Notas importantes: cuando $_GET['catid'] vale -2 entonces categories.php carga la p�gina de el ESCAPARATE
$catid=$_GET['catid'] ;
if ($catid!=2)
//Si clicamos en una categoria que no sea la de novedades
// session_unregister('novedades');
unset($_SESSION['novedades']);
//Si seleccionan la categoria novedades se mostraran los �ltimos N� art�culos a�adidos
if ($catid == 2)
{
$_SESSION['novedades']='novedades';
?>
<meta http-equiv="refresh" content="0;URL=show_last_articles.php"/>
<?php
exit;
}
if ($catid == -2)
{
$_SESSION['novedades']='novedades';
?>
<meta http-equiv="refresh" content="0;URL=escaparate.php" />
<?php
exit;
}
//Cuando sea cualquier categor�a que no sea "ESPECIAL"
if ($catid != "especial")
{
	if ( $categorie= get_details($_GET['catid'] ) );
 	{

	if($_SESSION['idioma']==2 && !session_is_registered("valid_user"))
	{
		$cat_details=$categorie['cat_details_eng'];
		$show_articles="Show articles";
		echo "	<meta http-equiv='refresh' content='2;URL=categories.php?catid=2' > ";

	}
	else
		{
			 if ($_SESSION['admin_user'])

$wellcomen ="<table width='456' border='0' align='left' cellpadding='8' cellspacing='8' bgcolor='#E3E5FE'>
  <tr>
    <td width='450' height='123' bgcolor='#C8CBFD'><p align='center' >Bienvenido Administrador; usted puede: </p>
      <div align='center' >
        <p >&middot;Modificar Art�culos<br />
        &middot;Ver existencias de TODOS los art�culos<br />
        &middot;Ver Art�culos excasos -ALMACEN<br />
        (sino lo ve recarge la p�gina)<br />
        &middot;
        Eliminar de la vista del p�blico un art�culo temporalmente (-1)<br />
        Recuerde:Unidades =-1 </p>
        <p>Recuerde que para Borrar e Insertar  puede hacerlo desde el Panel de Control y 		                             tambi&eacute;n para Modificar,Borrar y  Eliminar Categorias, recuerde que tambi&eacute;n desde all&iacute; puede ver TODOS los pedidos de la tienda.</p>
      </div></td>
  </tr>
</table>";
			if (!isset($catid) )
				{
				echo "	<meta http-equiv='refresh' content='1;URL=categories.php?catid=-2' > ";
				exit;
				}
		$cat_details=$categorie['cat_details'];
    		$show_articles="Ver Artículos";
		}

		//Sino se ha seleccionado categor�a alguna
	$id_ext= $categorie["id_ext"];
	$ext=extension_check($id_ext);
	if (($categorie["id_ext"])==4 )
	$img="demo.jpeg"; //sino hay ninguna imagen asociada a ese art�culo, se carga esta por defecto
	else
	$img=$catid."cat.$ext";
        }
?>
<div align="center">
<table width="782" class="categorie_position">
<tr>
<td width="772" height="200" align="center" valign="middle" >
<a href='show_arts.php?catid=<?php echo $catid ?>'>
  <?php echo "<a href='show_arts.php?catid=$catid' class='ver_articulos'>$show_articles</a>"?><br />
  <a href='show_arts.php?catid=<?php echo $catid ?>' class="enlace_imagen">
  <img src="admin/panel/img/cats/<?php echo $img ?>" alt="i" class="img_big_cat " /></a>
  <a href="'show_arts.php?catid=$catid' class='ver_articulos'&gt;$show_articles"></a><br />
  <span class="descripcion_ver_articulo"><?php echo  $cat_details ?></td>
</tr>
</table>
</div>
<?php
} //FIN DEL ELSE
?>
</body>
</html>