<link href="../../../gloria.css" rel="stylesheet" type="text/css">
<?php
@session_start();

require ("../../fns.php");
require ("../admin_fns.php");
require ("upload.php");


if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
 echo "<a href='admin/acces.html'>Volver</a>";
}
 panel_control ();

$ref=$_GET['ref'];

if ($_GET['question']!=1)
{
	echo "<center>Las unidades se decontaran del estocaje general ,<br>
	?esta usted segura de querer llevar a cabo el descuento?<br>";
	echo "<a href='$PHP_SELF?question=1'>SI </a><br><br><center>";

}
//Preguntamos antes si esta seguro de descontar las unidades del Stock
if ($_GET['question']==1)
{
//Listamos todos las Ids de art?culos y sus unidades para descontarlas del stock

	foreach ($_SESSION['arts_unidades_array'] as $key => $value)

	{
	$conn = db_connect();

	$result =mysql_query( "update almacen
             set unidades=unidades - $value
			 where artid='$key' ");
		//OJO??? esta ref es de los pedidos NO DE LOS ARTICULOS
		echo "<center>Art?culo con<b> Id: $key</b> Descontado <b> $value Unidades </b> del stocaje<br></center>";

	}
	 	if (!$result)

     		echo "<center><h5>No se ha podido retraer del srock <br></h5></center>";

		else

			echo "<center><h5>Art?culos correctamente descontados del stock:<br></h5></center>";

}
		 echo "<center><a href='consulta_pedidos.php?imprimir=0&ref=$ref'>Volver Modo Opciones</a></center>";
