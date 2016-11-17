<?php
require_once('vistas/lista-pedidos.html.php');
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
 echo "<div align='center'><h3>No hay pedidos nuevos</h3></div>";
}
else {
?>

<?php
$pedido=0;
$cont=1;

to_view_articulos($articles);

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

if (!$articles){
    echo "<div align='center'>No hay pedidos Servidos en la base de datos</div>";
}
else{
    to_view_articulos($articles);
}
}