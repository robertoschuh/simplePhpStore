<? session_start();
 //ini_set("display_errors", 2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Administración | Enviar correo al cliente</title>
<link href="../../gloria.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF
}
.style2 {
	font-size: large;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<?
require ("../admin/admin_fns.php");
require ("../admin/pedidos_fns.php");
require ("../fns.php");




if (!session_is_registered('admin_user')) 

{
  echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias, <b><br>
  <h3>
	<a href='javascript:history.back(-1)'>Volver</a><br>";
  
  exit;
}
?>
<table width="80%" border="1" align='center' >
  <tr>
    <td colspan="3" class='fondo_filas_panel'><div align="center" class="style1">
      <div align="center" class="style2">Textos (Copiar y pegar) </div>
    </div></td>
  </tr>
  <tr class='encabezadcos_tablas '>
    <td width="30%"><div align="center" class="titulo">HAY EXISTENCIAS Y EL PAGO ES CONTRAREEMBOLSO</div></td>
    <td width="40%"><div align="center" class="titulo"><span class="style1"></span><span class="style1">HAY EXISTENCIAS Y EL PAGO ES POR BANCO</span></div></td>
    <td width="30%"><div align="center" class="titulo">NO HAY EXISTENCIAS</div></td>
  </tr>
  <tr class='fondo_filas_panel'>
    <td height="23"><p align="center" class="style1">&lt;p&gt;Su pedido ya esta disponible.&lt;/p&gt;
    <p> &lt;p&gt;Cuando nos confirme este  email, procederemos a envi&aacute;rselo por Correos contra reembolso. &lt;/p&gt;</p>
      <p align="center" class="style1">&lt;p&gt;Recibir&aacute; el  paquete en su domicilio dentro de 5 &oacute; 6 d&iacute;as. A la entrega del mismo deber&aacute;  abonar el <b>importe total que figura en su pedido , </b>más los gastos de env&iacute;o seg&uacute;n la tarifa de<br />
      Correos.&lt;/p&gt;</p>
      <p align="center" class="style1"><br />
        &lt;h4&gt;&lt;font color='blue'&gt;Gracias por su compra,  esperamos que todo sea de su<br />
agrado.&lt;/h4&gt;&lt;/font&gt;</p></td>
    <td height="23"><p align="center" class="style1">&lt;p&gt;Su pedido ya esta disponible.&lt;/p&gt;<br />
       &lt;p&gt;Tiene que realizar el  ingreso por el </b><b>importe total  que figura en su pedido </b> en la siguiente <b>&lt;b&gt;</b>cuenta corriente de La Caixa:</p> 
      <b> CCC  2100-1828-82-0100111029 &lt;b&gt;&lt;/p&gt;</b>.</p>
      <p align="center" class="style1"><span class="important"><br >
      Muy importante</span> poner en el ingreso su nombre y n&uacute;mero de  pedido.&lt;/p&gt; Para agilizar el proceso de env&iacute;o, nos puede enviar un fax con el  justificante de ingreso &oacute; un email con la<br />
        informaci&oacute;n de la operaci&oacute;n. En un plazo de dos d&iacute;as  recibir&aacute; el paquete en su<br />
      domicilio por Tourline Express. </p>
      <p align="center" class="style1">&lt;h4&gt;&lt;font color='blue'&gt;Gracias por su compra,  esperamos que todo sea de su<br />
    agrado.&lt;/h4&gt;&lt;/font&gt;</p></td>
    <td><p align="center" class="style1">Lamentamos informarle que no disponemos de existencias de  los/del siguiente art&iacute;culo (s) ........... </p>
      <p align="center" class="style1">Por este motivo el env&iacute;o de su  pedido se retrasar&iacute;a hasta ........... Si lo desea podemos enviar el resto del  pedido, &oacute; bien esperar a que dispongamos de existencias y enviarlo todo junto.</p>
      <p align="center" class="style1"><br />
      Le rogamos que contacte con nosotros y nos informe de su  preferencia.</p>
      <p align="center" class="style1"><br />
    Gracias por su confianza.</p></td>
  </tr>
</table>
<?
//Si hemos recibido por hidden el campo ref
if ( $_POST['ref'] )
$ref=$_POST['ref'];

 

	//Si hemos enviado el formulario
	if ( $_POST['mensaje'] && $_POST['email'] && session_is_registered('admin_user')  )	
	{
	
	
	if (!mail_confirm ( $_POST['mensaje'] ,$_POST['email'] ,$_POST['asunto'],$_POST['ref'],$_POST['portes']  ) )
	
		{
			echo "Su Mail NO se ha enviado correctamente, inténtelo de nuevo porfavor";
			echo $_POST['email'];
			echo $_POST['mensaje'];
		}
		else
		{
		echo "Mail de confirmación correctamente enviado,en breve será redireccionado, Gracias<br>";
		echo "	<meta http-equiv='refresh' content='1;URL=../../php/admin/panel/consulta_pedidos.php?ref=$ref'> ";


		}
	
	}
			
		else if ( !$_POST['mensaje'] && !$_POST['email'] && session_is_registered('admin_user')  )	
		
		mail_confirm_form($_GET['email'],$_GET['ref'],$_GET['portes']);
			
			echo " <a href='javascript:history.back(-1)'>Volver</a><br>";


?>
</body>
</html>
