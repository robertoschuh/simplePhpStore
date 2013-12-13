<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html><head><TITLE>Gloria Botonero</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<meta name="keywords" content="belenes,miniaturas,belen,bel�n,artesan�a andaluc�a,artesan�a belenes"  />
<meta name="description" content="artesana que elabora belenes y miniaturas a mano" />
<link href="gloria.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body,td,th {
	color: #003366;
}
body {
	background-color: #ECFBF4;
}
.style1 {
	font-size: 16px;
	font-weight: bold;
}
.style2 {font-size: 14px}
-->
</style>
</head>
<body leftMargin=0 topMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<?php
@session_start();

if (!isset($_SESSION["init"]) )
	{
?>		
<a href='http://www.gloriabotonero.com/tienda_gloria/index.php' target="_parent"><center><h2> Ir a Tienda de <br>
																							Gloriabotonero.com</h2></center> </a> 

<?php
exit;
	}
require ("php/fns.php");
require ("php/admin/admin_fns.php");
include ("php/idiomas/idiomas_fns.php");
?>
<p>&nbsp;</p>
<div align="center">
  <p class="style1">CONTACTAR  </p>
</div>
<table width="704" border="0" align="center" cellpadding="9" cellspacing="9">
  <tr bgcolor="#FFFFFF">
    <td height="582"><div align="center">
      <p>Nos complacer&aacute; atenderle si tiene cualquier duda o necesita ampliar la informaci&oacute;n que le ofrecemos. </p>
	  
      <p>Le agradecemos las sugerencias que desee aportarnos y si necesita alg&uacute;n encargo personalizado  de miniaturas y complementos para belenes, no dude en ponerse en contacto con nosotros. </p>
      <p>Nuestros datos son los siguientes:</p>
      <p class="style2">M&ordf; Gloria Botonero Morillo<br>
        C/ Carreras, 58<br>
        41400 &Eacute;cija (Sevilla)</p>
      <p class="style2">Tel&eacute;fono y Fax + (34) 955904274<br>
        M&oacute;vil + (34) 615623896</p>
      <p class="style2">E-mail: info@gloriabotonero.com<br>
        Web: www.gloriabotonero.com </p>
      <p class="style2">Soporte t&eacute;cnico:soportetecnico@gloriabotonero.com</p>
      <p class="style2"><img src="img/pu4.jpg" width="533" height="353"></p>
      <p>Le invitamos a que nos visite en la Feria del Bel&eacute;n, que se celebra cada a&ntilde;o en la Plaza de San Francisco de Sevilla, desde finales de Noviembre hasta el 23 de diciembre.</p>
    </div></td>
  </tr>
</table>
<?php

foother () ;

?>
</body></html>