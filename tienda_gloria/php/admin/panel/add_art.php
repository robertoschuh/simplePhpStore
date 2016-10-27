<link href="../../../gloria.css" rel="stylesheet" type="text/css" />


<?

@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
include ("upload.php");


if ($_SESSION['admin_user'])


{
panel_control ();


$catid=$_POST["catid"];
$art_name=$_POST["art_name"];
$art_name_eng=$_POST["art_name_eng"];
$details=$_POST["details"];
$details_eng=$_POST["details_eng"];
$price=$_POST["price"];
$ref=$_POST["ref"];
$unidades=$_POST["unidades"];
$stock=$_POST["stock"];
if ( $_POST["escaparate"] == "on" )
$escaparate=1;

//dejamos
if ( $catid==NULL || $art_name==NULL || $details==NULL ||
	$price==NULL ||$ref==NULL || $unidades==NULL )
//asi el ingl?s ser?a obligatorio
/*if ( $catid==NULL || $art_name==NULL || $details==NULL || $art_name_eng==NULL || $details_eng==NULL ||
	$price==NULL ||$ref==NULL || $unidades==NULL )*/

{
	echo "Lo sentimos pero NO HA RELLENADO TODOS LOS DATOS , es necesario rellenarlos todos <br>";
	echo " <a href='javascript:history.back(-1)'>Volver</a><br>";
	exit;
}
else
{
	if (substr_count( $_FILES [ 'file' ][ 'name' ] ,'.jpeg') >0 )
    {
		$id_ext=0;
		$ext="jpeg";
	}
	else if (substr_count( $_FILES [ 'file' ][ 'name' ] ,'.jpg') >0 )
	{
		$id_ext=1;
		$ext="jpg";
	}
	else if (substr_count( $_FILES [ 'file' ][ 'name' ] ,'.gif') >0 )
	{
		$id_ext=2;
		$ext="gif";
	}
	else if (substr_count( $_FILES [ 'file' ][ 'name' ] ,'.png') >0 )
	  {

	 $id_ext=3;
	$ext="png";
	}
	else
	$id_ext=4;
//enviamos el nombre de la categor?a y los detalles a la funci?n add_cat que lo insertar? en la Bd
	//$ext si es 0 es jpg si es 1 es jpeg y si es 2 es gif y si es 3 png
	$result=add_art($catid,$art_name,$art_name_eng,$details,$details_eng,$price,$id_ext,$ref,$stock,$escaparate);


}

//consultamos todos los catid de la tabla categories y recogemos el resultado en un array bidimensional
$artid=ask_artid();




$img_id= last_id($artid); /*Esto nos sirve para obtener la ?ltima id de artid ,nos sirve tanto para loas imagnes como para el almacen*/

//A?adimos el n?mero de unidades de este art?culo a el almacen
$almacen=add_unidades($img_id,$unidades);

if (!$almacen)
{
echo "Ha habido problema mientras se llenaba el almacen de existencias de este art?culo,<br> probablemente esa referencia ya exista sino consulte con su soporte t?cnico,Gracias<br><br><a href='javascript:history.back(1)' class='volver'>Volver</a>";

exit;
}
//Si ha sucedido alg?n error y no se ha podido a?adir la nueva categor?a a la Bd devuelve un mensaje de error
if (!$result)

echo "No se ha podido almacenar este art?culo, porfavor int?ntelo mas tarde, Gracias<br>";





else
{
	echo "Art?culo a?adido a la base da datos, Gracias";
 	echo " <a href='javascript:history.back(-1)'>A?adir Otro</a><br>";

}

//esta funci?n esta tambien en admin_fns.php
//Ahora la imagen tiene el nombre correcto que es el de KEY de su art?culo


//Con esto tendr?amos el nombre para imagen que ahora tendr?amos que guardar en alg?n lugar de nuestro servidor
//CONTINUAR AQU? PROXIMO D?A GUARDANDO LA IMAGEN EN DIRECTORIO DEL SERVIDOR




$img_name=$img_id++."art.$ext"; //nombramos imagen con el nombre de la KEY del art?culo a?adido y la extensi?n que le corresponda $ext



$img = $_FILES [ 'file' ][ 'name' ]=$img_name;
  //Agregamos la nueva entrada a la base de datos

//Movemos el fichero a la carpeta donde la queremos guardar. y con el nombre deseado.



upload_image($_FILES [ 'file' ],$destino,$destino_peq,$size,$size_peq);


//move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' . $_FILES [ 'file' ][ 'name' ]);

} //fin del if
 else
 {
  echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte con el soporte t?cnico, Gracias<br>";
login_box();
 exit;

}

echo "valor de escaparate: ".$escaparate;

?>
