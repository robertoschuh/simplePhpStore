<?php
if (isset($_SESSION['admin_user'])) {
    $admin_user=$_SESSION['admin_user']; 
}
//require ("php/fns.php");
require_once ("php/fns.php");
require_once ("php/admin/admin_fns.php");
if (!  ($_SESSION['idioma' ] == 2 ) )
{
    $info="info.php";
    $quienes="quienes.php";
}
else
{
$info="info_eng.htm";
$quienes="quienes_eng.htm";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Gloria Botonero</title>
<link href="gloria.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id='header'>
  <table width="100%" height="100%" border="0" align="center" background="../fondoestrellas.jpg" bgcolor="#374F95">
    <tr>
      <td width="7%" valign="top"><img src="../hada.jpg" alt="hada" width="156" height="146" align="bottom" /></td>
      <td width="82%" align="center"  valign="top">
      <div align="center">
        <p align="center">
        <img src="../banner.jpg" alt="banner" width="486" height="101" border="0" usemap="#Map4" /></p>
<div id='tabla_menu' align="center"> 
    <a href='php/show_last_articles.php ' target='mainFrame'  class='bread' >Inicio</a>&nbsp;
    <a href='<?php echo $url_cart ?>' target='mainFrame' class='bread' ><?php echo $cart ?></a> &nbsp;
    <a href='<?php echo $quienes ?>' target='mainFrame' class='bread'  ><?php echo $whom ?></a> &nbsp;
    <a href='<?php echo $info ?>' target='mainFrame' class='bread'  > <?php echo $how ?></a>&nbsp;
              <?php
	$result=promo ();
	if (!$result == 0) {
?><a href='php/ver_promo.php' target='mainFrame' class='bread'  ><?php echo $promo; ?></a><?php } ?>&nbsp;
<a href='<?php echo $url_contacto ?>' target='mainFrame' class='bread' ><?php echo $contact ?></a>&nbsp;
</div>
      </div></td>   
    </tr>
  </table>
</div>
<map name="Map" id="Map">
  <area shape="circle" coords="138,27,14" href="php/admin/panel/acces.php" target="_blank" />
<area shape="circle" coords="220,71,0" href="#" /></map>
<map name="Map2" id="Map2"><area shape="circle" coords="154,20,0" href="php/admin/panel/acces.php" target="_blank" />
</map>
<map name="Map3" id="Map3">
<area shape="circle" coords="165,22,16" href="php/admin/panel/acces.php" target="_blank" />
</map>

<map name="Map4" id="Map4">
  <area shape="circle" coords="191,18,10" href="php/admin/panel/acces.php" target="_blank" />
</map></body>
</html>
