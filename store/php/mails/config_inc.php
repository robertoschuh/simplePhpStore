<?php
//Datos de envío de correos
$url="http://gloriabotonero.local/tienda_gloria";
$panel_control=$url."/tienda_gloria/php/admin/panel/acces.php";
$mail_webmaster="info@gloriabotonero.com";
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Tienda de artesanía Gloria Botonero <'.$mail_webmaster.'>' . "\r\n";

//$remitente="From: info@loquewebs.com  \n \r\nContent-type: text/html\r\n";
$tienda_name="Tienda gloriabotonero.com";
$datos_vendedor="<br><p> Gloria Botonero<br>
C/ Carreras, 58<br>
41400 &Eacute;cija (Sevilla)<br>

<p>
Tel&eacute;fono y Fax + (34) 955904274
Móvil + (34) 615623896 </p><br>
<p>
<b>E-mail</b>: info@gloriabotonero.com<br>
<b>Soporte técnico</b>: soporte@masquebits.com <br>
<b>Web:</b> www.gloriabotonero.com </p><br>
";
//$banner="<img src='../banner.jpg' alt='Tienda Gloria Botonero'/>";

//PANEL DE CONTROL CONFIG

//imagen marca de agua tiket
$marca_agua="../../../img/marcadAgua.jpg";

//Número de artículos por página en tiket
$articulos_por_page="5";