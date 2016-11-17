<?
//Funciones de Configuración personalizada de presentación de la Tienda
function menu_config_web(){
?>
<style type="text/css">
<!--
.style1 {font-size: x-large}
-->
</style>

  <div class='fondo_filas_panel'>
<form action="<?= $PHP_SELF ?>" method="post" >
 <table width="100%" border="0">
  <tr >
    <td width="19%" >Numero Articulos * Fila </td>
    <td width="23%" >Color Fondo Articulos </td>
    <td width="28%" >Color Fondo Conjunto Art&iacute;culos </td>
    <td width="13%">Ancho P&aacute;gina  </td>
    <td width="17%">Color Fondo lados </td>
    <td width="17%">Color Cabecera </td>
  </tr>
  <tr>
    <td><input name="number" type="text" id="number" size="5" /></td>
    <td><input name="color" type="text" id="color" size="20" /></td>
    <td><input name="colorconjunto" type="text" id="colorconjunto" size="20" /></td>
    <td><input name="ancho_pag" type="text" id="ancho_pag" size="7" />%</td>
    <td><input name="fondo_lados" type="text" id="fondo_lados" size="20" /></td>
    <td><input name="colorcabecera" type="text" id="colorcabecera" size="20" /></td>
  </tr>
  
  <tr>
    <td colspan="6"><div align="center">
      <input name="Action" type="submit" id="Action" value="Modificar" />
    </div></td>
  </tr>
</table>
</body>
</html>

</form>
  </div>

<?
}
//Cambiamos los valores de configuración de presentación de la página
function change_visual_number($number) 

{
   		$conn = db_connect();

  //Actualizamos el Stock de cada articulo del pedido 
 	$result =mysql_query ( "update visual   
             				set NumberArts='$number'
			 				 " );
	if (!$result)
	return false;
	else
	return true;
									
									
}
function get_NumberOfArts() {


$conn = db_connect();

//función que nos devuelve el precio y demas datos de cada artículo 
$result= mysql_query("SELECT NumberArts
					 FROM visual
					  ");
							
if (!$result)
     return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$number = mysql_fetch_array($result);		

return $number;

}
function change_visual_color($color) 

{
   		$conn = db_connect();

  //Actualizamos el Stock de cada articulo del pedido 
 	$result =mysql_query ( "update visual   
             				set ColorBgArts='$color'
			 				 " );
	if (!$result)
	return false;
	else
	return true;
									
									
}
function get_BgColor() {


$conn = db_connect();

//función que nos devuelve el precio y demas datos de cada artículo 
$result= mysql_query("SELECT ColorBgArts
					 FROM visual
					  ");
							
if (!$result)
     return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$number = mysql_fetch_array($result);		

return $number;

}
function change_visual_color_conjunto($color_conjunto) {


   		$conn = db_connect();

  //Actualizamos el Stock de cada articulo del pedido 
 	$result =mysql_query ( "update visual   
             				set ColorBgArtsConjunto='$color_conjunto'
			 				 " );
	if (!$result)
	return false;
	else
	return true;
									
									
}


function get_BgColor_Conjunto() {


$conn = db_connect();

//función que nos devuelve el precio y demas datos de cada artículo 
$result= mysql_query("SELECT ColorBgArtsConjunto
					 FROM visual
					  ");
							
if (!$result)
     return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$color = mysql_fetch_array($result);		

return $color;

}
//Modificamos el ancho de la página
function change_visual_width($ancho_pag) {


   		$conn = db_connect();

  //Actualizamos el Stock de cada articulo del pedido 
 	$result =mysql_query ( "update visual   
             				set AnchoPag='$ancho_pag'
			 				 " );
	if (!$result)
	return false;
	else
	return true;
									
									
}
function get_Ancho_Pag() {


$conn = db_connect();

//función que nos devuelve el precio y demas datos de cada artículo 
$result= mysql_query("SELECT AnchoPag
					 FROM visual
					  ");
							
if (!$result)
     return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$ancho = mysql_fetch_array($result);		

return $ancho;

}
function change_visual_color_cabecera($colorcabecera)  {


   		$conn = db_connect();

  //Actualizamos el Stock de cada articulo del pedido 
 	$result =mysql_query ( "update visual   
             				set ColorCabecera='$colorcabecera'
			 				 " );
	if (!$result)
	return false;
	else
	return true;
									
									
}
function get_ColorCabecera() {


$conn = db_connect();

//función que nos devuelve el precio y demas datos de cada artículo 
$result= mysql_query("SELECT ColorCabecera
					 FROM visual
					  ");
							
if (!$result)
     return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$color = mysql_fetch_array($result);		

return $color;

}
function change_visual_color_lados($fondo_lados){


   		$conn = db_connect();

  //Actualizamos el Stock de cada articulo del pedido 
 	$result =mysql_query ( "update visual   
             				set Fondo_Lados='$fondo_lados'
			 				 " );
	if (!$result)
	return false;
	else
	return true;
									
									
}
function get_ColorFondoLados() {


$conn = db_connect();

//función que nos devuelve el precio y demas datos de cada artículo 
$result= mysql_query("SELECT Fondo_Lados
					 FROM visual
					  ");
							
if (!$result)
     return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$color = mysql_fetch_array($result);		

return $color;

}

?>