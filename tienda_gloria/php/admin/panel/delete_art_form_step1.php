<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

</head>

<body>
	  	<?php
		require ("../../fns.php");
		require ("../admin_fns.php");
		@session_start();
				if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte con el soporte t?cnico, Gracias<br>";
 echo "<a href='../acces.html'>Volver</a>";
 echo "sesion no iniciada correctamente";
 exit;
}
panel_control ();

?>
	  	<form id='form1' name='form1' method='post' action='delete_art_form_step2.php'>
  <table width="75%" border="0" align="center" cellpadding="9" cellspacing="9">
    <tr bgcolor="#ECF3F9">
      <td colspan="3"><div align="center">Borrar Art?culos</div></td>
    </tr>
    <tr bgcolor="#ECF3F9">
      <td width="191" colspan="2">Seleccione Categoria </td>
      <td width="117">Paso 1/2 </td>
    </tr>
    <tr bgcolor="#ECF3F9">
      <td><select name="catid" class='box'>
          <?
		$cats=get_all_cats();
		foreach ($cats as $row)
		{
		    $catid=$row['catid'];
			$cat_name=$row['cat_name'];
		echo "<option value=$catid>$cat_name</option>";
		}
		?>
        </select>
      </td>
      <td><label>
        <input type="submit" name="Submit" value="Siguiente 2/2" />
      </label></td>
    </tr>
    <tr bgcolor="#ECF3F9">
      <td colspan="2"><label></label></td>
    </tr>
  </table>
        </form>
</body>
</html>
