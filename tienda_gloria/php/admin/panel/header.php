<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Tienda Online
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

</title>
</head>

<body>
<?
@session_start();
require ("php/fns.php");
require ("php/admin/admin_fns.php");

if (@session_is_registered("admin_user")) 

panel_control_shop ();
else
{	
?>
<table>
<tr>
<TD width="796" valign="top" bgcolor="#FFFFFF"> 
        <div align="center"></div>
    </TD>
  </tr>
</table>
     <table width="100%" border="0" bgcolor="#CBE4E4">
            <tr> 
              <td width="176"><div align="center">                <a href="wellcomen_msg.php" target="center_frame">Inicio</a></div></td>
              <td width="149"><div align="center"> 
                  <p><a href="cesta.htm" target="center_frame" class="menu">Cesta</a></p>
                </div></td>
              <td width="247"><div align="center"><font size="3" face="Georgia, Times New Roman, Times, serif"><a href="quienes.htm" target="center_frame" class="menu">Quienes 
                  somos</a></font></div></td>
              <td width="315"><div align="center"><font size="3" face="Georgia, Times New Roman, Times, serif"><a href="info.htm" target="center_frame" class="menu">Informaci&oacute;n 
                  de compra</a></font></div></td>
              <td width="215"><div align="center"><font size="3" face="Georgia, Times New Roman, Times, serif"><a href="contacto.htm" target="center_frame" class="menu">Contacto</a></font></div></td>
            </tr>
</table>
     <img src="img/banner.jpg" width="796" height="104" />
</body>
</html>
<?
}
?>