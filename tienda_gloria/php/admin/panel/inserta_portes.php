<?
@session_start();
require ("../../fns.php");


if ($_POST['portes'])

$_SESSION['portes']=$_POST['portes'];



?>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

  <table width="400" border="0" align="center">

<form name="form1" method="post" action="<?=$PHP_SELF ?>">

    <tr>

      <td  align="right"> Total-Portes</td>
       <td  align="left"><input type="text" name="portes" /></td>
	   </tr>
	   
	   <tr>
	   <td colspan='2' align="center">         
	    <input type="submit" name="Submit" value="Actualizar portes"></td>
		</tr>
	
  
  <p>&nbsp;</p>
</form>
<tr>
<td colspan='2' class='recuerde'><font color='red'> Recuerde:</font> despúes de haberle dado al boton "Actualizar portes" dele a cerrar y en la pantalla principal donde se ve el pedido tiene que hacer click en el enlace situado a la izquierda de su pantalla que pone "Modo Opciones - ACTUALIZAR" , esto es necesario para que sus cambios se lleven a cabo, puede modificar los portes las veces que necesite en caso de haberse equivocado metiendo el importe, pero <font color='red'>¡¡RECUERDE¡¡</font> tiene que darle al botón Actualizar portes , luego a cerrar y luego en la pantalla del pedido hacer clik en "Modo Opciones - ACTUALIZAR" .
</td>
</tr>
<tr><td><a href="#" onclick="CierraVentana() ;">Cerrar</a> </td> </tr>
</table>
<script language="JavaScript">
function CierraVentana() {

window.close();
ventana2.window.close();
}
</script>