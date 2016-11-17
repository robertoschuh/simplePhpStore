<link href="carrito.css" rel="stylesheet" type="text/css">
<link href="../gloria.css" rel="stylesheet" type="text/css">
<head>
<title>Introduce Producto</title>
</head>
<body>
<?php
include("lib_carrito.php");
require ("../php/fns.php");
if (!isset($_SESSION["init"]) )	{
?>		
<a href='http://www.gloriabotonero.com/tienda_gloria/index.php' target="_parent"><center><h2> Ir a Tienda de <br>
Gloriabotonero.com</h2></center> </a> 
<?php
exit;
}
$_SESSION["ocarrito"]->imprime_carrito($catid=129);
?>
</body>
</html>