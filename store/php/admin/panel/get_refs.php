<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Referencias productos</title>
</head>

<body>
<?php
@session_start();

require ("../../fns.php");
require ("../admin_fns.php");

if (!$_SESSION['admin_user'])
//if (!$_SESSION["admin_user"] )
{
echo "acces denied";
exit;
}
panel_control () ;

$refs = get_refs();

display_refs($refs);
?>
</body>