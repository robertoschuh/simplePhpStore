<?

function menu_header()
{
if (session_is_registered("admin_user")) 

panel_control ();
else
{	
?>
<link href="../gloria.css" rel="stylesheet" type="text/css" />

<table width="100%" height="100%" border="0" align="center" bgcolor="#FFFFFF" class="menu_cabecera">
  <tr>
    <td height="63"><h1>Gloria botonero</h1></td>
  </tr>
  <tr>
    <td height="43">
    Tienda &middot; Ver carrito &middot; Como comprar &middot; Quienes somos &middot; Contacto &middot; <a href="php/admin/acces.html">Admin </a></td>
  </tr>
  <tr>
    <td height="281">&nbsp;</td>
  </tr>
</table>

</body>
</html>
<?
}
}//fin de la función

//PARTE DEL ADMINISTRADOR 

/*
FUNCIONES DE SALIDA EN PANTALLA PARA EL PANEL DE ADMINISTRACIÓN DE LA TIENDA 
 
display_form_add_cat //Formulario para añadir nueva categoria
display_form_add_art //Formulario para añadir nueva categoria
display_add_del_cat($valor) //Muestra mensaje de añadido o borrado de categoría según sea valor=0 "borrado"o valor=1 "añadida"
display_add_del_art($valor)  //Muestra mensaje de añadido o borrado de artículo según sea valor=0 "borrado"o valor=1 "añadido"
display_show_ships //Lista en pantalla todos los pedidos activos de la tienda (opción de archivar pedido y borrar)
display_getdown_ship //dar de baja , es decir archivar pedido servido de la tienda o borrar 
 
 
*/


?>
