<link href="../../../gloria.css" rel="stylesheet" type="text/css">
<?
@session_start();

require ("../../fns.php");
require ("../admin_fns.php");

if (!session_is_registered("admin_user"))
//if (!$_SESSION["admin_user"] ) 
{
echo "acces denied";
exit;
}
panel_control () ;

$refs=get_refs();

display_refs($refs);



?>
