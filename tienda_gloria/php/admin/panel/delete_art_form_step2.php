<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />


<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?
@session_start();

require ("../../fns.php");
require ("../admin_fns.php");	

$catid=$_POST['catid'];		
if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>"; 
 exit; 
}


	panel_control ();
	
		$arts=get_all_arts_from_categorie($catid);
		if ($arts==NULL)
		{
			echo "<br><br>No hay Artículos en esta categoría , porfavor seleccione otra, Gracias";
			echo "<br><a href='delete_art_form_step1.php'>Atrás</a>";
			exit;
		}
?>
<form id="form1" name="form1" method="post" action="delete_art.php">
  <table width="75%" border="0" align="center" cellpadding="9" cellspacing="9">
    <tr bgcolor="#E9E9F8">
      <td align="center"><center>Borrar Art&iacute;culo - Paso 2/2 </center></td>
    </tr>

    <tr bgcolor="#E9E9F8">
      <td><div align="center">
        Seleccione categoria 
          <select name="artid" class='box'>
          <?
		//	Listamos todos los artículos de una categoría previamente seleccionada en "step 1/2 "
		


		$catid=$_POST[catid];
		//recojemos el valor de catid en la variable $catid  por medio de $_POST
		
	
				foreach ($arts as $row) 
		{
		    $artid=$row['artid'];
			$art_name=$row['art_name'];
			echo "<option value='$artid'>$art_name</option>";
		}
		?>
        </select>
      </div></td>
    </tr>

    <tr bgcolor="#E9E9F8">
      <td>
        <div align="center">
          <input type="submit" name="Submit" value="Borrar" />
          </div>
     </td>
    </tr>
    <tr bgcolor="#E9E9F8">
      <td height="37"><div align="center"><a href="articles_menu.php">Finalizar</a></div></td>
    </tr>
  </table>
</form>
</body>
</html>
