<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
<style type="text/css">

.style1 {
	font-size: x-large;
	font-family: "Times New Roman", Times, serif;
}

</style>
</head>

<body>
<?php
//ini_set('error_reporting', 0);
@session_start();

require_once("admin/admin_fns.php");
require_once("fns.php");


//Recordad ��� funciones de articulos en arts_fns.php
$result = escaparate();
?>
<table width='100%'>
<tr>
<td align="center"  class='box_no_more_promo style1'>E S C A P A R A T E</td>
</tr>
</table>
<?php
//display_arts ($result);
display_arts_numbero_fijo ($result);

echo "<br><br>";
footer ();
?>
</body>
</html>