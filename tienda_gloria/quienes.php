<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD><TITLE>Gloria Botonero</TITLE>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">

<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<meta name="keywords" content="belenes,miniaturas,belen,belén,artesanía andalucía,artesanía belenes"  />
<meta name="description" content="artesana que elabora belenes y miniaturas a mano" />


<link href="gloria.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body,td,th {
	color: #003366;
}
body {
	background-color: #ECFBF4;
}
.style1 {font-size: 16px}
-->
</style>
</HEAD>
<BODY leftMargin=0 topMargin=0 MARGINHEIGHT="0" MARGINWIDTH="0">
<?
@session_start();

if (!isset($_SESSION["init"]) )
	{
?>		
<a href='http://www.gloriabotonero.com/tienda_gloria/index.php' target="_parent"><center><h2> Ir a Tienda de <br>
																							Gloriabotonero.com</h2></center> </a> 

<?
exit;
	}
require ("php/fns.php");
require ("php/admin/admin_fns.php");
include ("php/idiomas/idiomas_fns.php");
?>
<p>&nbsp;</p>
<p align="center"><font color="#003366"><strong><span class="style1">Quienes somos</span></strong></font></p>
<table width="594" border="0" align="center" cellpadding="9" cellspacing="9">
  <tr bgcolor="#FFFFFF">
    <td width="558"><div align="center">
      <p align="justify">
	  Hace 22 años, entré en contacto con el mundo de las miniaturas. Primero como admiradora y después como trabajo a tiempo parcial, pues me servía para descargar la mente y centrarme en una actividad que me relajaba.

Desde hace doce años, me dedico profesionalmente a la elaboración de miniaturas y complementos para Belenes , también aplicables a decorados, dioramas, casitas de muñecas, etc.
	  </p>
      <p align="center"><font color="#003366"><strong><img src="img/Gloria2.jpg" width="264" height="264" border="1"></strong></font></p>
          <p align="justify">
 Siempre tengo tendencia a innovar y recrear ambientes luminosos, llenos de vida, con colorido, y sobre todo alegres y divertidos.</p>
      <p align="justify">

La experiencia y una dedicación casi exclusiva a los Belenes , unida a la necesidad constante de dar rienda suelta a la creatividad, da como resultado un estilo propio que viene a refrescar el Belén clásico y tradicional, y a crear un estilo popular, vivo y con mucha luz.
</p>
      <p align="justify">

También hay que destacar que realizamos reproducciones de objetos que pertenecen al uso popular de generaciones pasadas y que evocan nuestras costumbres tradicionales, en su mayoría ya desaparecidas. A través de las miniaturas es posible mantenerlas presentes
</p>
      <p align="justify">

Utilizamos materiales muy diversos, entre los que podemos destacar: barro, madera, estaño, resina, latón, porcelana rusa, tela, corcho, escayola, etc. Estas materias primas nos permiten conseguir en las miniaturas efectos y acabados dotados de máximo realismo. 
</p>
    </div></td>
  </tr>
</table>
<?

foother () ;

?>
</BODY></HTML>
