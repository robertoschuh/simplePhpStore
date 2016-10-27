<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Noticias gloriabotonero.com</title>
<style>

.promo {text-align:justify; padding:60px }
</style>
</head>
<body>
<?php
@session_start();
if (!isset($_SESSION["init"]) )	{
?>		
<a href='http://www.gloriabotonero.com/tienda_gloria/index.php' 
   target="_parent"><center><h2> Ir a Tienda de <br/>
            Gloriabotonero.com</h2></center> </a> 
<?php
exit;
}
require ("fns.php");
require ("admin/admin_fns.php");
include ("idiomas/idiomas_fns.php");
//Ver promoci�n
$promo=ver_promo ();
$promo=nl2br($promo) ;
$promo=ucfirst($promo) ;
?>
<table class="promo " align='center' width="75%"> 
<tr>
    <td><?php echo utf8_decode(trim($promo));  ?></td>
</tr>
</table>
<br />
<br />
<?php
foother () ;
?>
</body>
</html>