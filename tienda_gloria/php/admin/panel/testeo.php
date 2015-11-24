<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?
include("../../carrito_php/lib_carrito.php");
$nombre=$_SESSION["ocarrito"]->array_nombre_prod;
$precio=$_SESSION["ocarrito"]->array_precio_prod;
include("lib_carrito.php");
$result = array_merge($nombre,$precio);

echo $array_nombre_prod[1]."<br>";
echo $array_precio_prod[1]."<br>";
?>
</body>
</html>
