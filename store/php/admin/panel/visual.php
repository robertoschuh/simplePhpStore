<link href="../../../gloria.css" rel="stylesheet" type="text/css">

<?
require ("../../fns.php");
require ("../admin_fns.php");

require ("../visual_fns.php");
panel_control ();


//Mostramos menu con opciones de Presentación en pantalla de la Tienda Online
menu_config_web();

//Para Cambiar el número de artículo
if ( $_POST['number']!=NULL && $Action)
{
	$update=change_visual_number($_POST['number']) ;
	if ($update)
	echo "Actualización correcta, número de artículos por fila ".$_POST['number']."<br>";
	else
	echo "Actualización Incorrecta<br>";
	
}

if ( $_POST['color']!=NULL && $Action)
{
	$update=change_visual_color($_POST['color']) ;
	if ($update)
	echo "Actualización correcta, nuevo color de fondo ".$_POST['color']."<br>";
	else
	echo "Actualización Incorrecta<br>";

}
if ( $_POST['color_conjunto']!=NULL && $Action)
{
	$update=change_visual_color_conjunto($_POST['color_conjunto']) ;
	if ($update)
	echo "Actualización correcta, nuevo color de fondo del Conjunto ".$_POST['color_conjunto']."<br>";
	else
	echo "Actualización Incorrecta<br>";
	
}
if ( $_POST['ancho_pag']!=NULL && $Action)
{
	$update=change_visual_width($_POST['ancho_pag']) ;
	if ($update)
	echo "Actualización correcta, nuevo Ancho de la Página ".$_POST['ancho_pag']."<br>";
	else
	echo "Actualización Incorrecta<br>";
	
}
if ( $_POST['colorcabecera']!=NULL && $Action)
{
	$update=change_visual_color_cabecera($_POST['colorcabecera']) ;
	if ($update)
	echo "Actualización correcta, nuevo Color de la Cabecera ".$_POST['colorcabecera']."<br>";
	else
	echo "Actualización Incorrecta<br>";
	
}
if ( $_POST['fondo_lados']!=NULL && $Action)
{
	$update=change_visual_color_lados($_POST['fondo_lados']) ;
	if ($update)
	echo "Actualización correcta, nuevo Color del fondo de ambos lados ".$_POST['fondo_lados']."<br>";
	else
	echo "Actualización Incorrecta<br>";
	
}

?>
</body>
</html>
