<?php
include("lib_carrito.php");
require_once("../php/fns.php");
?>
<html>
<head>
	<title>Introduce Producto</title>
    <link href="carrito.css" rel="stylesheet" type="text/css">
	<link href="../gloria.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
	//Le pasamos la categor�a a la q  pertenece para poder volver desp�es
	$catid=$_GET['catid'];
	$_SESSION["ocarrito"]->introduce_producto($_GET["id"], $_GET["nombre"], $_GET["precio"],$_GET["img"],$_GET["ref"]		,$_GET['qty']);
	$_SESSION["ocarrito"]->imprime_carrito($catid);
	?>
</body>
</html>
