  <link href="carrito.css" rel="stylesheet" type="text/css">

<link href="../gloria.css" rel="stylesheet" type="text/css">

<?

include("lib_carrito.php");
require_once("../php/fns.php");


$pos=$_POST['pos'];
$qty=$_POST['qty'];
$catid=$_REQUEST['catid'];


if ($qty==0)

$_SESSION["ocarrito"]->elimina_producto($pos);

else

$_SESSION["ocarrito"]-> update_cart ($pos,$qty) ;

 $_SESSION["ocarrito"]->imprime_carrito($catid);

	
	//Por si no se hubera identificado aún 
if (! $_SESSION['valid_user'] )


?>
