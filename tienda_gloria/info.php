<?php
@session_start();
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body,td,th {
	color: #003366;
	font-size: 13px;
}
body {
	background-color: #ECFBF4;
}
.style1 {
	font-size: 16px;
	color: #003366;
	font-weight: bold;
}
.style3 {font-size: 14px}
.style5 {
	font-size: 16px;
	font-weight: bold;
}
.style7 {
	color: #336699;
	font-size: 13px;
}
.style8 {font-size: 12px}
.style9 {font-size: 13px}
-->
</style>
</HEAD>
<?php

if (!isset($_SESSION["init"]) )
	{
?>		
<a href='http://www.gloriabotonero.com/tienda_gloria/index.php' target="_parent"><center><h2> Ir a Tienda de <br>
																							Gloriabotonero.com</h2></center> </a> 

<?php
exit;
	}
	?>

<script type="text/javascript" language="javascript" >

function postal() {

ventana=("envio/info_postal.htm "," "," ");
window.open(ventana);
}

function agencia() {

ventana=("envio/info_agencia.htm "," ","width=400px , height=300px");
window.open(ventana);

}

</script>


<BODY leftMargin=0 topMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<?
require ("php/fns.php");
require ("php/admin/admin_fns.php");
include ("php/idiomas/idiomas_fns.php");
?>
<table width="100%" border="0" cellspacing="9" cellpadding="9">
  <tr>
    <td align="center" valign="middle"><p>
      
      <p class="style1">INFORMACI&Oacute;N DE COMPRA
      <table width="700" border="0" cellspacing="9" cellpadding="9">
        <tr bgcolor="#FFFFFF">
          <td width="719"><p align="justify" class="style8">
La informaci&oacute;n a continuacioacute;n detallada se refiere a compras realizadas dentro del territorio nacional, para compras internacionales p&oacute;ngase en contacto con nosotros a trav&eacute;s de nuestra direcci&oacute;n de correo electr&oacute;nico.

Las miniaturas y belenes ofrecidos en nuestra web est&aacute;n elaborados artesanalmente por lo que las medidas que se especifican son de car&aacute;cter orientativo. As&iacute;, nuestros art&iacute;culos pueden presentar ligeras variaciones en cuanto a sus dimensiones y tonalidades, realizadas en algunos casos a prop&oacute;sito con el fin de que adquieran una apariencia m&aacute;s realista. Le sugerimos que nos indique en comentarios el tama&#328;o de sus figuras.

Las compras realizadas en www.gloriabotonero.com, est&aacute;n sometidas a la normativa vigente y se entiende que las operaciones de venta est&aacute;n hechas en el domicilio de la empresa de: </p></td>
        </tr>
      </table>
      <p class="style3">M&ordf; Gloria Botonero Morillo<br>
      DNI: 52240218L<br>
      Domicilio: C/ Carreras, 58. 41400 &Eacute;cija (Sevilla)</p>
      <p>&nbsp;</p>
      <p>Los precios incluyen el 18 % de IVA.</p>
      <p>&nbsp;</p>
      <p class="style5">Esquema de compra</p>
      <table width="851" border="0" cellpadding="9" cellspacing="9" bordercolor="#66CCCC">
        <tr bgcolor="#FFFFFF">
          <td width="56"><div align="center">Elegir productos</div></td>
          <td width="55"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="72"><div align="center">Registro cliente</div></td>
          <td width="225"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="29"><div align="center">Hoja de pedido y elegir forma pago</div></td>
          <td width="29"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="13"><div align="center">Enviar pedido</div></td>
          <td width="14"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="36"><div align="center">Recibir&aacute; email autom&aacute;tico</div></td>
          <td width="36"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="36"><div align="center">Recibir&aacute; email con los detalles de compra</div></td>
        </tr>
      </table>
      <p><br>
      Deber&aacute; confirmar el segundo email y se inicia el proceso de pago:</p>
      <table width="273" border="0" cellspacing="9" cellpadding="9">
        <tr bgcolor="#FFFFFF">
          <td width="56"><div align="center">Pago contra reembolso</div></td>
          <td width="55"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="72"><div align="center">Le enviamos pedido por correo</div></td>
        </tr>
      </table>
      <br>
      <table width="389" border="0" cellspacing="9" cellpadding="9">
        <tr bgcolor="#FFFFFF">
          <td width="53" height="71"><div align="center">Pago por banco</div></td>
          <td width="55"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="68"><div align="center">Usted hace el ingreso</div></td>
          <td width="55"><div align="center"><img src="../gip_flecha_azul_grande.gif" alt="flecha" width="37" height="26"></div></td>
          <td width="213"><div align="center">Le enviamos el pedido por agencia</div></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p class="style5">C&oacute;mo hacer el pedido</p>
      <table width="700" border="0" cellspacing="9" cellpadding="9">
        <tr bgcolor="#FFFFFF">
          <td><ul>
            <li>Entre en la categor&iacute;a deseada a trav&eacute;s de la barra que aparece a la izquierda, seleccione los art&iacute;culos deseados y a&#328;&aacute;dalos a la cesta de la compra.</li>
            <li>Si es la primera vez que realiza un pedido, deber&aacute; registrarse como cliente una vez finalizada la compra.
			</li>
            <li>Si por el contrario ya es usuario registrado, introduzca su clave de usuario y aparecer&aacute;n sus datos, confirme que son correctos y seleccione la forma de pago.</li>
            <li>Una vez realizado el pedido, recibir&aacute; un e-mail con los detalles de su compra. Deber&aacute; responder a este e-mail confirmando su pedido si desea recibir la mercanc&iacute;a.  </li>
            <li>Le recomendamos revisar su bandeja de Spam para evitar que nuestros e-mails entren como correo no deseado.           </li>
            <li> No efect&uacute;e ning&uacute;n pago hasta recibir nuestra confirmaci&oacute;n.  </li>
          </ul></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p class="style5">Env&iacute;o del pedido    </p>
      <table width="700" border="0" cellspacing="9" cellpadding="9">
        <tr bgcolor="#FFFFFF">
          <td><ul>
            <li>Los gastos de env&iacute;o corren por cuenta del cliente. Tanto si el env&iacute;o se realiza por correo postal como si es mediante alguna empresa transportista, los gastos ser&aacute;n aplicados seg&uacute;n las tarifas que se tengan establecidas en cuanto a peso y volumen. </li>
            <li>El plazo de entrega depender&aacute; de las existencias, habitualmente disponemos de todos los art&iacute;culos, no obstante esto puede variar seg&uacute;n la &eacute;poca del a&ntilde;o. </li>
            <li>Debido al car&aacute;cter artesanal de los productos,  le sugerimos que anticipe sus compras al m&aacute;ximo evitando las fechas pr&oacute;ximas a Navidad. </li>
            <li>Tras la confirmaci&oacute;n por e-mail, para env&iacute;os dentro del territorio nacional y teniendo en cuenta las existencias, recibir&aacute; el pedido en un plazo de dos d&iacute;as si es a trav&eacute;s de una empresa transportista y de cinco o seis d&iacute;as si es por correo convencional. En caso de retraso no dude en contactar con nosotros. </li>
            <li>Disponemos de dos formas de env&iacute;o que est&aacute;n en funci&oacute;n de la modalidad de pago elegida: 
              <ul>
                <li>Por correo contra reembolso. Abonar&aacute; el importe de su compra m&aacute;s los gastos de env&iacute;o al recibir el paquete. Los gastos de env&iacute;o ser&aacute;n los aplicados por la oficina de Correos. <br>
                 </li>
                <li> Por Tourline Express a portes pagados. Abonar&aacute; el importe de su pedido m&aacute;s los gastos de env&iacute;o mediante transferencia bancaria, una vez haya confirmado la compra. Como orientaci&oacute;n, le informamos de que el importe de los gastos de un paquete de menos de 10 kg. de peso o volumen es de 9  euros.</li>
              </ul>
            </li>
            <li>Las miniaturas y belenes son cuidadosamente embalados a fin de evitar que se deterioren o que sufran desperfectos durante el transporte.</li>
            <li>La mercanc&iacute;a enviada a trav&eacute;s de la agencia Tourline Express esta asegurada. Si recibe alg&uacute;n producto que este roto o en mal estado, comun&iacute;quelo inmediatamente por tel&eacute;fono para que podamos reclamar a la agencia. (Plazo m&aacute;ximo 24 horas). La mercanc&iacute;a que viaje por otro medio de transporte, ser&aacute; responsabilidad del cliente. </li>
            <li>Del mismo modo, si al recoger su paquete observa alg&uacute;n desperfecto en el embalaje, h&aacute;galo constar en el recibo que deber&aacute; firmar a la agencia. </li>
          </ul>            <p align="justify"></p></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p class="style5">Forma de pago </p>
      <table width="700" border="0" cellspacing="9" cellpadding="9">
        <tr bgcolor="#FFFFFF">
          <td><p align="left" class="style9">Puede elegir entre dos modalidades de pago:</p>
            <p align="left" class="style7"> - Contra reembolso a la entrega de la mercanc&iacute;a.<br>
              - Ingreso o transferencia bancaria </p>
            <p align="left" class="style9"> Para transferencias desde el extranjero necesitar&aacute; los c&oacute;digos BIC e IBAN:</p>
           
            <p align="left" class="style9"> Titular de la cuenta: M&ordf; Gloria Botonero Morillo</p>
            <p align="left" class="style9">Deber&aacute; hacer constar el n&uacute;mero de referencia del pedido y su nombre.</p>
            <p align="left" class="style9">Los gastos de transferencia correr&aacute;n por cuenta del cliente. </p>
            <p align="left" class="style9">Para agilizar el env&iacute;o una vez efectuada la transferencia o el ingreso, env&iacute;enos un fax o un e-mail con los detalles de la transacci&oacute;n.</p>
            <p align="left" class="style9">Fax: (+34) 955904274</p>
            <p align="left" class="style9">E-mail: info@gloriabotonero.com</p>
            <p align="left" class="style9">
			Si usted elige el pago contra reembolso, la forma de env&iacute;o tambicn ser&aacute; contra reembolso.</p>
            <p align="left" class="style9">Si elige el pago a trav&oacute;s de ingreso o transferencia en cuenta bancaria, el env&iacute;o ser&aacute; a trav&oacute;s de la agencia Tourline Express. En ambos casos, los gastos de env&iacute;o corren por cuenta del cliente. 
			 </p>
          <p align="left" class="style9">Le recordamos que no debe efectuar el pago hasta recibir nuestra confirmaci&oacute;n por e-mail. </p></td>
        </tr>
      </table>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p class="style5">Devoluciones </p>
      <table width="700" border="0" cellspacing="9" cellpadding="9">
        <tr bgcolor="#FFFFFF">
          <td width="672"><p align="justify" class="style9">En caso de haber recibido alg&uacute;n producto deteriorado, deber&aacute; comunicarlo antes de 24 horas a fin de poder reclamar al seguro de la empresa transportista. </p>
            <p align="justify" class="style9">Si recibe un producto deteriorado por defecto de elaboraci&oacute;n, deber&aacute; comunicarlo en un plazo de 5 d&iacute;as y se lo cambiaremos por otro. Tendr&aacute; que devolverlo  en su embalaje original y con la factura de compra. </p>
          <p align="justify" class="style9">Si desea realizar una devoluci&oacute;n por alg&uacute;n motivo diferente al defecto de f&aacute;brica, se lo cambiaremos por otro art&iacute;culo o por un abono para su pr&oacute;xima compra. En este caso los portes tambi&eacute;n correr&aacute;n por cuenta del cliente 