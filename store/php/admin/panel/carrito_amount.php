<?php // Manual de PHP de WebEstilo.com
session_start();
session_register('itemsEnCesta');
$item=$_POST['art_name'];
$cantidad=$_POST['cantidad'];
$itemsEnCesta=$_SESSION['itemsEnCesta'];

if ($item){
   if (!isset($itemsEnCesta)){
      $itemsEnCesta[$item]=$cantidad;
   }else{
      foreach($itemsEnCesta as $k => $v){
         if ($item==$k){
         $itemsEnCesta[$k]+=$cantidad;
         $encontrado=1;
         }
      }
      if (!$encontrado) $itemsEnCesta[$item]=$cantidad;
   }
}
$_SESSION['itemsEnCesta']=$itemsEnCesta;
?>
<html>
<body>
<tt>
<form action="<?=$PHP_SELF."".$SID?>" method="post">
Dime el producto <input type="text" name="item" size="20"><br>
Cuantas unidades <input type="text" name="cantidad" size="20"><br>
<input type="submit" value="Añadir a la cesta"><br>
</form>
<?
if (isset($itemsEnCesta)){
   echo'El contenido de la cesta de la compra es:<br>';
   foreach($itemsEnCesta as $k => $v){
      echo 'Artículo: '.$k.' ud: '.$v.'<br>';
   }
}
?>
</tt>
</body>
</html> 