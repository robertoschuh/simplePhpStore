    <link href="carrito.css" rel="stylesheet" type="text/css">

<link href="../gloria.css" rel="stylesheet" type="text/css">

<?
include("lib_carrito.php");
require_once("../php/fns.php");

$catid=$_GET['catid'];
$_SESSION["ocarrito"]->elimina_producto($_GET["linea"]);
$_SESSION["ocarrito"]->imprime_carrito($catid);



	 if($_SESSION['idioma']==2)
	 $delete="Deleted";
	 else
	 $delete="Producto eliminado";
	



?>

<html>
<head>
	<title>Introduce Producto</title>
</head>

<body>


<br>
<br>
<br>

</body>
</html>
