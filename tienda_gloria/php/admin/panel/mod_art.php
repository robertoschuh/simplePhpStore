<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<?
require ("../../fns.php");
require ("../admin_fns.php");
require ("upload.php");

@session_start();

if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización.<br>";
 echo "<a href='admin/acces.html'>Volver</a>";  
}
//Si esta modificando desde la tienda NO MUESTRA EL PANEL DE CONTROL ,si esta modificando desde panel de control SI LO MUESTRA
if ( stristr ($_SERVER['HTTP_REFERER'],"mod_art_form_stock.php")==true )
 panel_control ();
 

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
$catid=$_POST['catid'];

if ( $_POST["escaparate"] == "on" )
$escaparate=1;




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
if ($id_ext < 4  )
{
  


upload_image($_FILES [ 'file' ],$destino,$destino_peq,$size,$size_peq);
//move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' . $_FILES [ 'file' ][ 'name' ]);
}
else

$id_ext=NULL;
//Actualizamos el artículo con los valores que recojemos del formulario

$update=update_articles($art_name,$art_name_eng,$art_details,$art_details_eng,$art_price,$artid,$id_ext,$ref,$unidades,$stock,$catid,$escaparate);


if ($update )
{

	$catid=$_POST['catid_tienda'];
	if ($catid == 2 )
	$url="../../categories.php?catid=2";
	else
	$url="../../show_arts.php?catid=$catid";

	echo "Sus Artículo se ha actualizado correctamente, Gracias.";
	echo "<a href='$url'>Volver</a><br>";
	if (!$_POST['cat']==2)
	 echo "En breves segundos volverá a la categoría  <meta http-equiv='refresh' content='2;URL=$url'> ";
	else
		 echo "En breves segundos volverá a la categoría  <meta http-equiv='refresh' 
		 		content='2;URL=../../categories.php?catid=2'> ";

}
else

echo "No se ha podido llevar a cabo la actualización, por favor inténtelo de nuevo y si no puede consulte a su soporte técnico, Gracias.";

//Recojemos el catid enviado como oculto por el form para devolverle a su categoría 
/*
if ($_POST['catid'])
{
	$catid=$_POST['catid'];
	echo " <a href='show_arts_stock.php?catid=$catid'>Volver</a><br>";
} */
//Volvemos a nombrar la nueva imagen con un nuevo nombre ,que será el artid +art+ su extensión.

?>