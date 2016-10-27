<link href="../../../gloria.css" rel="stylesheet" type="text/css" />


<?

@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
include ("upload.php");


if (!$_SESSION['admin_user'])
{

  echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte
  										con el soporte t?cnico, Gracias<br>";
login_box();
exit;
}
panel_control ();

$cat_name=$_POST['cat_name'];
$cat_details=$_POST['cat_details'];

$cat_name_eng=$_POST['cat_name_eng'];
$cat_details_eng=$_POST['cat_details_eng'];
$stock=$_POST['stock'];

if ($cat_name==NULL )

{
	echo "Lo sentimos pero NO HA RELLENADO TODOS LOS DATOS , es necesario rellenarlos todos <br>";
	echo " <a href='javascript:history.back(-1)'>Volver</a><br>";
	exit;

}

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

	//Comprobar la ?ltima posici?n
	$last_post=last_pos () ;

//enviamos el nombre de la categor?a y los detalles a la funci?n add_cat que lo insertar? en la Bd
	$result=add_cat($cat_name,$cat_name_eng,$cat_details,$cat_details_eng,$id_ext,$stock,$last_post);

//Si ha sucedido alg?n error y no se ha podido a?adir la nueva categor?a a la Bd devuelve un mensaje de error
if (!$result)

print "No se ha podido a?adir la nueva categor?a a la Base de datos, consulte con su administrador , Disculpe las molestias<br>";

else if ($result)

{
	$catid=ask_catid();

	$img_id= last_id($catid); /*Esto nos sirve para obtener la ?ltima id de artid ,nos sirve tanto para loas imagnes 		    como para el almacen*/

$img_name=$img_id++."cat.$ext"; //nombramos imagen con el nombre de la KEY del art?culo a?adido y la extensi?n que le corresponda $ext


$img = $_FILES [ 'file' ][ 'name' ]=$img_name;
  //Agregamos la nueva entrada a la base de datos

//Movemos el fichero a la carpeta donde la queremos guardar. y con el nombre deseado.
   $destino = 'img/cats' ;
   $size=320;
	upload_image_cat($_FILES [ 'file' ],$destino,$size);

//move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' . $_FILES [ 'file' ][ 'name' ]);

print " Su Categor?a se ha a?adido correctamente a la Base de datos";

 }
else

echo "Ha surgido un error inseperado ,consulte al soporte t?cnico ,Gracias y disculpe las molestias";



echo "</br>";
echo "<a href='form_cat.php'> A?adir Otra Categor?a</a>";
?>
