<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?
require ("../../fns.php");
require ("../admin_fns.php");

@session_start();

if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización.<br>";
 echo "<a href='admin/acces.html'>Volver</a>";  
}

$art_name=$_POST['art_name'];
$art_name_eng=$_POST['art_name_eng'];
$art_details=$_POST['art_details'];
$art_details_eng=$_POST['art_details_eng'];
$art_price=$_POST['art_price'];
$artid=$_POST['artid'];
$ext=$_POST['ext'];
$ref=$_POST['ref'];	
$unidades=$_POST['unidades'];
$stock=$_POST['stock'];


 panel_control ();

//Comrpobamos la extensión de la nueva imagen que queremos subir
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


$img_id=  $artid; 
$img_name=$img_id++."art.$ext"; //nombramos imagen con el nombre de la KEY del último artículo añadido y la extensión que le corresponda 					                                  //$ext

//Le damos nombre a la imagen
$img = $_FILES [ 'file' ][ 'name' ]=$img_name;
 
   
//Movemos el fichero a la carpeta donde la queremos guardar. y con el nombre deseado.
   $destino = 'img/arts' ;
if ($id_ext < 4  )

move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' . $_FILES [ 'file' ][ 'name' ]);

else

$id_ext=NULL;
//Actualizamos el artículo con los valores que recojemos del formulario

$update=update_articles($art_name,$art_name_eng,$art_details,$art_details_eng,$art_price,$artid,$id_ext,$ref,$unidades,$stock);


if ($update )

echo "Su Artículo se ha actualizado correctamente, Gracias.";

else

echo "No se ha podido llevar a cabo la actualización , porfavor inténtelo de nuevo y sino puede consulte a su soporte técnico, Gracias";

//Volvemos a nombrar la nueva imagen con un nuevo nombre ,que será el artid +art+ su extensión.

?>