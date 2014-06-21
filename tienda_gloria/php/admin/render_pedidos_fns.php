<?php

function ver_pedidos_todos() {
   
$conn = db_connect();

//mysql_query("SET NAMES 'utf8'", $conn);

$result = mysql_query("SELECT ref, nombre, precio FROM pedidos_articulos
						WHERE servido='0'
						ORDER BY ref Desc ");
if (!$result){
    echo "No hay resultados";
    exit;
}


$articles = db_result_to_array($result);

//var_dump($articles);

if (!$articles) {
 echo "<table align='center'><tr><td>No hay pedidos nuevos</td></tr></table>";
}
?>

<?php		//Abrimos fila
$pedido=0;
$cont=1;
?>
<table align="center" class="categories_menu">
<tr>
<?php
foreach($articles as $row)
{
    
    if (!($pedido == $row['ref']))

    echo "<tr><td colspan='6'><br></td></tr>
    <tr tr class='encabezadcos_tablas '><td colspan='6' align='center' class='pedido'>
    <a href='consulta_pedidos.php?ref=" . $row['ref'] . "' target='_self' class='pedidos_links'>PEDIDO" . $row['ref'] ."<br><font color='#FFFF00'>NUEVO</font></a>
    </td></tr>
    <tr><td colspan='6'><br></td></tr>";
    ?>
    <td>
    <table>
    <tr>
    <td align='left' class='tablas_items'> <?php echo utf8_encode($row['nombre']); ?></td>
    </tr>
    <tr>
    <td align='left'> Precio:</td><td align='left' class='precio'><?php echo $row['precio']."€" ?> </td>
    </tr>
    </table>
    <?php
    if ($cont==3)
        echo "</tr><tr>";
        $pedido=$row['ref']; //Para luego comparar con el siguiente ref haber si es otro distinto
        $cont++;
        
    }
?>
</table>
<?php
}

function ver_pedidos_servidos() {
$conn = db_connect();
$result = mysql_query("SELECT ref, nombre, precio FROM pedidos_articulos
						WHERE servido='1'
						ORDER BY ref ");

$articles = db_result_to_array($result);

if (!$articles)
echo "<table align='center'><tr><td>No hay pedidos Servidos en la base de datos</td></tr></table>";

//Abrimos fila
$pedido=0;
$cont=1;
?>
<table align="center" >
<tr>
	<td class="ref"> <?php echo $row['ref'] ?> </td><td></td>
	</tr>
<tr>
<?php
foreach($articles as $row)
{
if (!($pedido==$row['ref']))
/*  echo "<tr><td colspan='6'><br></td></tr>
<tr><td colspan='6' align='center' class='pedido'>PEDIDO $row[ref] </td></tr>
<tr><td colspan='6'><br></td></tr>";*/

echo "<tr><td colspan='6'><br></td></tr>
<tr><td colspan='6' align='center' class='pedido'>
<a href='consulta_pedidos.php?ref=$row[ref]&opcion=1' target='_self'>PEDIDO $row[ref] </a>
</td></tr>
<tr><td colspan='6'><br></td></tr>";
?>
<td>
<table  align="center">
<?php
if ($cont==3)
echo "</tr><tr>";
$pedido=$row['ref']; //Para luego comparar con el siguiente ref haber si es otro distinto
$cont++;
}
?>
</table>
</table>
<?php
}