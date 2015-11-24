<?php
@session_start();
?>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../panel.css" rel="stylesheet" type="text/css" />
<title>Ticket</title>
<style type="text/css">
.factura {margin-top:50px}

</style>
<script type="text/javascript">
function AbreVentana() {
    //sustituir ejemplo.html por la ruta y nombre de la pagina a cargar en la ventana
    window.open("modelo_factura.php?sid=<?php echo session_id();?>","" ,"" ,"width=40,heigth=20")
}

</script>
</head>
<body>
<?php
require ("../../fns.php");
require ("../admin_fns.php");

if ($_POST['pedidos']) {
    $_SESSION["pedidos"] = $_POST['pedidos'];
       $total_amount = 0;
     foreach ($_POST['total_row'] as $row){
         $total_amount = $total_amount + $row;        
     }
     // Set total amount.
      $_SESSION['suma_total'] = $total_amount;
    
}

?>
<a href='stock.php'> Panel de control</a></br>
<div align='center'>
  <form name="arts" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
  <input type="text" name="num"  />
  <input type="submit" name="enviar" value="Añadir artículos" />
  </form>

</div>
<br/><br/><br/>
<div class="logo_factura"><img src='../../../img/FACTURA.jpg' alt='logo' /></div>
<div class="pedido_manual">

<table  align="center" cellpadding="5" cellspacing="5">

<tr>
<td> </td>
</tr>
<tr>
<td> </td>
</tr>
<tr>
<td> </td>
</tr>
<tr><td class="input"> Ref</td><td class="input">Artículo</td><td class="input">Unidades</td>
	<td class="input">Precio</td><td class="input">Total</td></tr>



<form name="form2" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post"  >
<?php
if ($_POST['num']) {
    $num = $_POST['num'];
   
}
else {
    $num=0;
}

	for ($i=0 ; $i <= $num ; $i++)
	
	{	
            //Referencia
            echo "<tr><td ><input name='pedidos[$i][0]' type='text' value='".$_SESSION['pedidos'][$i][0]."' /></td >";

            //Articulo nombre
            echo "<td ><input name='pedidos[$i][1]' type='text' value='".$_SESSION['pedidos'][$i][1]."' /></td >";

            //Unidades artículo
            echo "<td ><input name='pedidos[$i][2]' type='text' value='".$_SESSION['pedidos'][$i][2]."'  /></td >";

            //Precio artçiculo/unidad
            echo "<td ><input name='pedidos[$i][3]' type='text' value='".$_SESSION['pedidos'][$i][3]."'  /></td >";


            // Total price.
            echo "<td class='input'>"
            . "<input name='total_row[]' type='text' value='". $_SESSION['pedidos'][$i][2] * $_SESSION['pedidos'][$i][3] ."'/>
            <input name='num' type='hidden'  value='".$i."'  /></td></tr>";

    echo "<tr></td></td></tr>";
                    echo "<tr></td></td></tr>";
                    echo "<tr></td></td></tr>";
            //echo "<tr><td>".$_SESSION['suma_total']+=$total."</td></tr>";
	
	
	}

//Si no le damos al botón Terminar cierra la fila y no muestra el total
	
	
		
	echo "<tr><td align='center'><input name='Siguiente' type='submit' value='ACTUALIZAR' /></td>";
	echo "<td align='center'><input name='Terminar' type='submit' value='IMPRIMIR' onClick='AbreVentana()' /></td></tr>";
	
	
	echo "<tr><td colspan='5' align='right'>Suma Total : ".$_SESSION['suma_total'] ."</td></tr>";
	
        ?>
  </form>	
</table>

</div>

<?php
echo $_SESSION['pedidos'][5][1];
?>
</body>