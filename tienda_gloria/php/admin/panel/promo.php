<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Untitled Document</title>
</head>

<body>
<?
@session_start();
require ("../../fns.php");
require ("../admin_fns.php");

  $conn = db_connect();
  if (!$conn)
    return 0;
	
//Para cuando decidamos DESACTIVAR la promoción
if ($_GET['activar'])
{
$activar=$_GET['activar'];	

	if ($activar==2)	
	{
	 $query = "UPDATE promociones
           SET value=0
           WHERE id=1";
	$result = mysql_query($query );
		
		if ($result)
	echo "Promoción DESACTIVADA";
	else
	echo "la promoción no se ha podido Descativar";
	}
//pARA cuando decidamos ACTIVAR la promoción
	if ($activar==1)	
	{
	$activar=$_GET['activar'];	
	 $query = "UPDATE promociones
           SET value=1
           WHERE id=1";
	$result = mysql_query($query );
		
		if ($result)
	echo "Promoción ACTIVADA";
	else
	echo "la promoción no ha podido ser Activada";
	}
}
		   
//Para cuando se envie el formulario se modificará la promoción el la Bd
if ($_POST['promo'])
{
$promo=$_POST['promo'];
 $query = "UPDATE promociones
           SET promo='$promo'
           WHERE id=1";
		   
	
	$result = mysql_query($query);

	if (!$result)
	echo "La nueva promoción NO se ha actualizado correctamente";
	else
	echo "La nueva promoción SI se ha actualizado correctamente";
	echo $promo;


}

if (session_is_registered("admin_user")) 
{
	panel_control ();
	$promo=promo ();
	?>
	<table align='center'>
	<tr>
	<td><a href='<? echo $_SERVER['PHP_SELF']."?activar="."1" ?>'> Activar </a> </td><td></td>
	<td><a href='<? echo $_SERVER['PHP_SELF']."?activar="."2" ?>'> Desactivar </a>  </td>
	</tr>
	</table>
	<form action="<? echo $_SERVER['PHP_SELF'] ?>" method="post" name="form_promo">
	<table align='center'>
	<tr>
	<td><textarea name="promo" cols="140" rows="19"> <? echo  $promo  ?> </textarea> </td>
	</tr>
	<tr>
   <td>  <input type="submit" name="Submit" value="modificar promoción" /></td>
   </tr>
   	</table>

	</form>
<?	
}
else
echo "Usted no tiene permiso para acceder a este lugar";


?>
</body>
</html>
