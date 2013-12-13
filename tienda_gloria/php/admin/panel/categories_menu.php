<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?

@session_start();

	$admin_user=$_SESSION['admin_user']; 


require ("../../fns.php");
require ("../admin_fns.php");
 panel_control ();
menu_categorias();
?>




