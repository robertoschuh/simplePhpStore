

<?
include("carrito_php/lib_carrito.php");

$_SESSION["ocarrito"]->imprime_articulos ();
$_SESSION["ocarrito"]->imprime_carrito($catid);


?>