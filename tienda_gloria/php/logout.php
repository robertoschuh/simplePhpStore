<style type="text/css">
<!--
body {
	background-color: #FFFFFF;
}
-->
</style><?

// include function files for this application

@session_start();
require_once("admin/admin_fns.php");
require_once("fns.php");



$result_unreg = session_unregister("valid_user");
$result_dest = session_destroy();

 if ($result_unreg && $result_dest)
  {
    // si ellos estuvieron logged in y ahora están logged out
  echo "Ha hecho LogOff correctamente, Gracias y hasta la vista<br>";
  }







?>