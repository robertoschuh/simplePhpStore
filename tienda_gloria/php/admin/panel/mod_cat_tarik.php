<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<?php

@session_start();

require ("../../fns.php");
require ("../admin_fns.php");
require ("upload.php");



if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
 echo "<a href='admin/acces.html'>Volver</a>";
 exit;
}
panel_control ();

$newname=$_POST['newname'];
$newname_eng=$_POST['newname_eng'];
$catid=$_POST['catid'];
$details=$_POST['details'];
$details_eng=$_POST['details_eng'];
$stock=$_POST['stock'];
$pos=$_POST['new_pos'];
$old_pos=$_POST['old_pos'];
//$id_ext=$_POST['id_ext'];


//Comrpobamos la extensi?n de la nueva imagen que queremos subir
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

//$artids=ask_artid();
$img_id= $catid;
$img_name=$img_id++."cat.$ext"; //nombramos imagen con el nombre de la KEY del ?ltimo art?culo a?adido y la extensi?n que le corresponda 					                                  //$ext

//Le damos nombre a la imagen
$img = $_FILES [ 'file' ][ 'name' ]=$img_name;


//Movemos el fichero a la carpeta donde la queremos guardar. y con el nombre deseado.
   $destino = 'img/cats' ;
if ($id_ext < 4)
{

$destino = 'img/cats' ;
$size=320;
upload_image($_FILES [ 'file' ],$destino,$size);
}
//move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' . $_FILES [ 'file' ][ 'name' ]);

else

$id_ext=NULL;

if ($newname=="NULL")
{
	echo "No ha escrito un nuevo nombre. <br>";

	exit;
}
if (update_categories($newname,$newname_eng,$catid,$details,$details_eng,$id_ext,$stock,$pos,$old_pos))
{
	echo "<br>La Categor?a se a renombrado con ?xito. $id_ext ";

}
else
{
echo "No se ha podido realizar la actualizaci?n, Disculpe, int?ntelo m?s tarde.";
?>
<table align="center">
<tr>
		<td> <a href='<?php echo $HTTP_SERVER_VARS['HTTP_REFERER'] ?> ' > Atrás </a></td>
		<tr>
</table>
<?
}
