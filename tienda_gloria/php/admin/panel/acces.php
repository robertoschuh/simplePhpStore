<?php
@session_start();
error_reporting(0); 
ini_set('display_errors',0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
require_once ("../../fns.php");
require_once ("../admin_fns.php");

if ($_SESSION["admin_user"] ) {

	panel_control () ;
}
else
{
	?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<title>Gloria Botonero | Panel de Control</title>
	</head>

	<body>
	<?php
	 login_panel_admin () ;
	 ?>

	
	<?php
}
	?>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="../../js/admin.js" type="text/javascript"></script>
</body>