<link href="../gloria.css" rel="stylesheet" type="text/css" />
<?php
require ("admin/admin_fns.php");

require ("fns.php");
 
@session_start();

//ver_carrito ();	

$catid=$_GET['catid']; 
$art_array=get_arts($catid);
//display_arts($art_array);

display_arts_numbero_fijo ($art_array);

echo "<br><br>";

foother ();