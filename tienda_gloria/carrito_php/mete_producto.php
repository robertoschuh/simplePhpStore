<?

include("lib_carrito.php");
require_once("../php/fns.php");

//Le pasamos la categoría a la q  pertenece para poder volver despúes
$catid=$_GET['catid'];


$_SESSION["ocarrito"]->introduce_producto($_GET["id"], $_GET["nombre"], $_GET["precio"],$_GET["img"],$_GET["ref"]
										  ,$_GET['qty']);
$_SESSION["ocarrito"]->imprime_carrito($catid);




?>

<html>
<head>
	<title>Introduce Producto</title>
  <link href="carrito.css" rel="stylesheet" type="text/css">

<link href="../gloria.css" rel="stylesheet" type="text/css">
</head>

<body>


</body>
</html>
