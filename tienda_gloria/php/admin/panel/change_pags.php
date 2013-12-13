<?
require_once ("../../fns.php");
require_once ("../admin_fns.php");
if (session_is_registered("admin_user")) 


panel_control ();
?>

<table align="center" width="100%">
<tr>
<td align="right" > <a href='<?=$PHP_SELF."?opt=como" ?>'" >Como comprar </a> </td>
<td> </td>
<td> </td>

<td align="left"> <a href='<?=$PHP_SELF."?opt=quienes" ?>'" >¿Quienes somos? </a> </td> 
</tr>
</table>
<?

//Cambiamos los textos de las páginas



if ( $_GET['opt']=="como" )
mod_page_form_como_comprar ();

if ( $_GET['opt']=="quienes" )

mod_page_form_quienes_somos ();

if ($mod_quienes )
{
	//Actualizamos la página de Queines somos
	if ( update_quienes_page( $_POST['campo1'],$_POST['campo2'] )  )
	echo "<center>Actualización correcta<br></center>";
	else
	
	echo "<center>Actualización INCORRECTA<br></center>";
	

}
if ( $boton_como_comprar )
{
	
	//Actualizamos la página de Como comprar
	
	if ( 
	update_como_comprar_page( $_POST['campo1_header'],$_POST['campo1'] ,$_POST['campo2_header'],$_POST['campo2'] 
	,$_POST['campo3_header'],$_POST['campo3'],$_POST['campo4_header'],$_POST['campo4'],$_POST['campo5_header'],$_POST['campo5']
	,$_POST['campo6_header'],$_POST['campo6'],$_POST['campo7_header'],$_POST['campo7']) 
	
	)//Cierro el If


	//Si se lleva acabo la actualización correctamente 
	echo "<center>Actualización correcta<br></center>";
	else
	echo "<center>Actualización INCORRECTA<br></center>";


}
	
	
?>
<link href="../../../gloria.css" rel="stylesheet" type="text/css">

