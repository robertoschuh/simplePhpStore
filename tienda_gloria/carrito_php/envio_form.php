<?php
include("lib_carrito.php");
include("../php/fns.php");

$catid = $_GET['catid'];
//si no esta creado el objeto carrito en la sesion, lo creo
if (!isset($_SESSION["ocarrito"])){
	$_SESSION["ocarrito"] = new carrito();
}
//Bloqueamos que se vea el carrito si a�n no esta registrado
if ($_SESSION['valid_user']) {
    $_SESSION["ocarrito"]->imprime_carrito($catid);
}
if (!$_SESSION["valid_user"]) {
    login_box_user($_GET['apagar']);
} else {
    echo "<br><br><br>";
    display_envio_form($_GET['apagar']);
}

$_SESSION['idioma'];
?>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
<link href="carrito.css" rel="stylesheet" type="text/css">
