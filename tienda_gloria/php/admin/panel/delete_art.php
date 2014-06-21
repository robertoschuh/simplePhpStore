<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?php

@session_start();


require ("../../fns.php");
require ("../admin_fns.php");

if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte con el soporte t?cnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>";
}

panel_control ();
$artid=$_POST[artid];
$connect=db_connect();
$query="SELECT art_name FROM articles
		WHERE artid='$artid'";
$result=mysql_query($query);
$art_name=mysql_fetch_array($result);
$art_name=$art_name[0];
delete_art($artid,$art_name);
