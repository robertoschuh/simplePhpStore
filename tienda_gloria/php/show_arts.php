<?php @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../gloria.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
require ("admin/admin_fns.php");
require ("fns.php");

//ver_carrito ();	
$catid = $_GET['catid'];
$art_array = get_arts($catid);
//display_arts($art_array);

display_arts_numbero_fijo($art_array);

echo "<br /><br />";

footer();
?>
</body>