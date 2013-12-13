<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?
@session_start();

require ("../../fns.php");
require ("../admin_fns.php");

if ($_SESSION["admin_user"] ) 

panel_control () ;
else
{
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>ArrikiShop2008</title>
</head>

<body>
<?

 login_panel_admin () ;


 
 ?>
</body>
</html>
<?
}
?>
