<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Gloria Botonero belenes y miniaturas</title>

<link href="../gloria.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	img
		{border: 0px;}
</style>
</head>

<body>
<?
@session_start();
  
require ("fns.php");
require ("admin/admin_fns.php");


//Notas importantes: cuando $_GET['catid'] vale -2 entonces categories.php carga la página de el ESCAPARATE

$catid=$_GET['catid'] ;

if ($catid!=2)
//Si clicamos en una categoría que no sea la de novedades		
session_unregister('novedades');


//Si seleccionan la categoría novedades se mostraran los últimos Nº artículos añadidos 
if ($catid == 2)
{

$_SESSION['novedades']='novedades';
	?>
		
		<meta http-equiv="refresh" content="0;URL=show_last_articles.php" > 
<?
	//echo "<a href='show_last_articles.php' >Ver Artículos sds $catid</a> ";

	exit;
}	
if ($catid == -2)
{

$_SESSION['novedades']='novedades';
	?>
		
		<meta http-equiv="refresh" content="0;URL=escaparate.php" > 
<?
	//echo "<a href='show_last_articles.php' >Ver Artículos sds $catid</a> ";

	exit;
}	


//Cuando sea cualquier categoría que no sea "ESPECIAL"
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
			if (session_is_registered("admin_user") )
		
				$wellcomen ="<table width='456' border='0' align='left' cellpadding='8' cellspacing='8' bgcolor='#E3E5FE'>
  <tr>
    <td width='450' height='123' bgcolor='#C8CBFD'><p align='center' >Bienvenido Administrador; usted puede: </p>
      <div align='center' >
        <p >&middot;Modificar Artículos<br />
        &middot;Ver existencias de TODOS los artículos<br />
        &middot;Ver Artículos excasos -ALMACEN<br />
        (sino lo ve recarge la página)<br />
        &middot;
        Eliminar de la vista del público un artículo temporalmente (-1)<br />
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
		
		//Sino se ha seleccionado categoría alguna 
	/*if (!isset ($_GET['catid']) )
	{	
		?>
		<center><img src="../img/hada_portada.jpg" /></center>
		
		<?
		exit;
	} */
	
	
	$id_ext= $categorie["id_ext"];
	$ext=extension_check($id_ext); 
	if (($categorie["id_ext"])==4 )
		$img="demo.jpeg"; //sino hay ninguna imagen asociada a ese artículo, se carga esta por defecto
	else
		 $img=$catid."cat.$ext"; 

 }
 ?>

 
<div align="center">
  
<table width="782" class="categorie_position">
<tr>
<td width="772" height="200" align="center" valign="middle" >

<a href='show_arts.php?catid=<? echo $catid ?>'>
  <? echo "<a href='show_arts.php?catid=$catid' class='ver_articulos'>$show_articles</a>"  ?><br />
  <a href='show_arts.php?catid=<? echo $catid ?>' class="enlace_imagen"><img src="admin/panel/img/cats/<? echo $img ?>" alt="i" class="img_big_cat " /></a><a href="'show_arts.php?catid=$catid' class='ver_articulos'&gt;$show_articles"></a><br />
  <span class="descripcion_ver_articulo"><? echo  $cat_details ?></td>
</tr>

</table>


</div>

<?
} //FIN DEL ELSE

?>

</body>
</html>

