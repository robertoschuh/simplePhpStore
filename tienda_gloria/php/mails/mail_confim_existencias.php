<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=charset=utf-8" />
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
        tinymce.init({selector:'textarea'});
</script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../js/admin.js"></script>


<title>Administracíon | Enviar correo al cliente</title>
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
<?php
session_start();

require ("../admin/admin_fns.php");
require ("../admin/pedidos_fns.php");
require ("../fns.php");


if (!$_SESSION['admin_user']) 

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
      <div align="center" class="style2">Textos (Textos (HACER CLICK ENCIMA DEL TEXTO DESEADO) </div>
    </div></td>
  </tr>
  <tr class='encabezadcos_tablas '>
    <td width="30%"><div align="center" class="titulo">HAY EXISTENCIAS Y EL PAGO ES CONTRAREEMBOLSO</div></td>
    <td width="40%"><div align="center" class="titulo"><span class="style1"></span><span class="style1">HAY EXISTENCIAS Y EL PAGO ES POR BANCO</span></div></td>
    <td width="30%"><div align="center" class="titulo">NO HAY EXISTENCIAS</div></td>
  </tr>
  <tr class='fondo_filas_panel'>
    <td height="23" class="col1"><p align="center" class="style1">Su pedido ya esta disponible.
    <p class="style1"> Cuando nos confirme este  email, procederemos a enviárselo por Correos contra reembolso;</p>
      <p align="center" class="style1">Recibirá el  paquete en su domicilio dentro de 5 ó 6 días. A la entrega del mismo deberá  abonar el <b>importe total que figura en su pedido , 
          </b>más los gastos de envío según la tarifa de<br />
      Correos.</p>
      <p class="style1"><br />
          <h4  style="text-align:center"><font color='blue' >Gracias por su compra,  esperamos que todo sea de su<br />
                  agrado.</h4></font></p></td>

    <td height="23" class="col2">
        <p align="center" class="style1">Su pedido ya esta disponible.<br />
       Tiene que realizar el  ingreso por el </b><b>importe total  que figura en su pedido </b> en la siguiente <b></b>cuenta corriente de La Caixa:
        </p> 
        <p align="center" class="style1"><strong> CCC  2100-1828-82-0100111029</strong></b></p>
      <p align="center" class="style1"><span class="important"><br /> 
              <font color='red'>Muy importante</font></span> poner en el ingreso su nombre y número de  pedido.</p> 
        <p align="center" class="style1">Para agilizar el proceso de envío, nos puede enviar un fax con el  justificante de ingreso ó un email con la<br />
        información de la operación. En un plazo de dos días  recibirá el paquete en su<br />
      domicilio por Tourline Express. </p>
      <p align="center" class="style1">
          <h4 style="text-align:center"><font color='blue'>Gracias por su compra,  esperamos que todo sea de su  agrado.</font></h4></p></td>
<br />
    <td class="col3"><p align="center" class="style1">Lamentamos informarle que no disponemos de existencias de  los/del siguiente artículo (s) ........... </p>
      <p align="center" class="style1">Por este motivo el envío de su  pedido se retrasaría hasta ........... Si lo desea podemos enviar el resto del  pedido, ó bien esperar a que dispongamos de existencias y enviarlo todo junto.</p>
      <p align="center" class="style1"><br />
      Le rogamos que contacte con nosotros y nos informe de su  preferencia.</p>
      <p align="center" class="style1"><br />
          <h4 style="text-align:center"> <font color='blue'>Gracias por su confianza.</font></h4></p></td>
  </tr>
</table>
<?php
//Si hemos recibido por hidden el campo ref
if ( $_POST['ref'] )
$ref=$_POST['ref'];

 

	//Si hemos enviado el formulario
	if ( $_POST['mensaje'] && $_POST['email'] && $_SESSION['admin_user'] )	
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
			
		else if ( !$_POST['mensaje'] && !$_POST['email'] && $_SESSION['admin_user']){			
                    mail_confirm_form($_GET['email'],$_GET['ref'],$_GET['portes']);
                }	
			echo " <a href='javascript:history.back(-1)'>Volver</a><br>";


?>
</body>
</html>
