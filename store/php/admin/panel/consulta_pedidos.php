<?php
@session_start();

// Error and warnings track.
 error_reporting(1); 
ini_set('display_errors',1);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gloria Botonero Consultar Pedido</title>
    <link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>
<?php
require ("../admin_fns.php");
require ("../pedidos_fns.php");
require ("../../fns.php");
?>
<body>
<?php
if (!$_GET['ref']) { $ref = $_POST['ref']; }

else { $ref = $_GET['ref']; }

if (!$_SESSION['admin_user']){
    echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias<br>";
    echo "<a href='admin/acces.html'>Volver</a>";

}
else{
 
        if ( isset($_GET['imprimir']) AND $_GET['imprimir'] <> 1  ) {
            panel_control (); 
            include ('vistas/forms/consultar_pedido.html.php');

            if(!isset($ref)) {
                print '<div style="text-align:center">
                <h4>Por favor seleccione que tipo de pedidos quiere ver (pendientes o servidos), gracias</h4>
                </div>';
            }
        }

        else{

            $pedido = consultar_pedido($ref, $_GET['opcion']);
           
            if (!$pedido){
                panel_control (); 
                include ('vistas/forms/consultar_pedido.html.php');

                print '<div style="text-align:center">No hay ningún pedido que concuerde con esa referencia de pedido, 
                 Gracias, gracias</h4>
                </div>';
            }

            $precio_total = precio_pedido($ref);
            //dias_demora($ref,$precio_total);

        }   
    }
?>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../../js/admin.js" type="text/javascript"></script>

<script language="JavaScript">

function AbreVentanaPortes()  {
    //sustituir ejemplo.html por la ruta y nombre de la pagina a cargar en la ventana
    window.open("inserta_portes.php?sid=<?php echo $sid;?>","" ,"" ,"width=40,heigth=20")
}
</script>
</body>
</html>
