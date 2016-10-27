<?php
@session_start();
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
if (!$_GET['ref']) {
    $ref = $_POST['ref'];
}
else {
    $ref=$_GET['ref'];
}
$servido=$_GET['opcion'];

//$admin_user=$_SESSION['admin_user'];


if (!$_SESSION['admin_user'])
{
    echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias<br>";
    echo "<a href='admin/acces.html'>Volver</a>";

}
else
{
    if ($_GET['imprimir']!=1  )

        panel_control ();
     //no hay datos de variables ni $_post ni $_get
    if (!$HTTP_POST_VARS && !$_GET['ref'] )

        form_consultar_pedido();

    else
            {

                consultar_pedido($ref,$servido);

                $precio_total=precio_pedido($ref);

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
