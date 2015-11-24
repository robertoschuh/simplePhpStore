<?php 
session_start();
if (!isset($itemsEnCesta) )
{
$itemsEnCesta=array(); //Creamos el array ,osea la cesta de la compra
session_register('itemsEnCesta');

	$catid=$_GET['catid'];
	$art_name=$_GET['art_name'];

 //Registramos la categoría como variable de sesión para poder volver cuando queramos a esa categoría
	session_register('catid');
	$cantidad=1; 
}
else

	$art_name=$_POST['art_name'];


$catid=$_SESSION['catid'];
$itemsEnCesta=$_SESSION['itemsEnCesta'];
if (isset($itemsEnCesta) ) //Poque si la cesta todavía está vacia ,entonces cantidad=1

if ( ($cantidad=$_POST['cantidad'])==NULL)
$cantidad=1;
else
$cantidad=$_POST['cantidad'];


if ($art_name){
   if (!isset($itemsEnCesta)){  //si NO HAY todavía ningún artículo  en el array asociativo $itemsEnCesta ,SE AÑADE el primero
   								//convierte en parte del array y se le añade la cantidad
      $itemsEnCesta[$art_name]=$cantidad;
   }else{   //Sino , es decir si ya hay se le suma la cantidad modificada en el formulario
      foreach($itemsEnCesta as $k => $v){ //recorre el array hasta encontrar el artículo en cuestión
         if ($art_name==$k){ //Si el artículo está ya en la cesta
         $itemsEnCesta[$k]=$cantidad; //Se le añade la nueva cantidad
         $encontrado=1; //le damos a encontrado el valor 1 (true)
         }
      }
      if (!$encontrado) $itemsEnCesta[$art_name]=$cantidad; //si el artículo no está en la cesta 
   }
}
?>
<html>
<body>
<tt>
<?
if (isset($itemsEnCesta))
{
echo "Tu Cesta de compra <br>";
?>
<form action="process_cart.php" method="post">
<table>
<?
foreach ($itemsEnCesta as $item => $qty)
	{
	echo "<tr><td>Nombre: </td><td><input type='text' name='art_name' value='$item'></td>
	<td>Cantidad</td><td><input type='text' name='cantidad' value='$qty' size='5'></td></tr>";

	}
echo "<br>$art_name";
?>
</table>
<input name="button" type="button" value="Actualizar">
</form>
<?
echo "<a href='../../show_arts.php?catid=$catid '>Comprar más</a><br>";
}
?>
</tt>
</body>
</html> 