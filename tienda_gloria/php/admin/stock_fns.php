<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Untitled Document</title>
</head>

<body>
<?

function display_menu_stock($menu) 
{
@session_start();
?>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.Estilo1 {
	font-size: medium;
	font-weight: bold;
}
-->
</style>

<?
 foreach ($menu as $row)
  {
    //RECORDAR: language es una variable de sesión que valdrá uno para "español" y 2 para "inglés"
	
	$catid=$row["catid"];
	
	
    $title = $row["cat_name"];
	if(!$_SESSION['idioma']==2)//Si es diferente a 2 la variable de sesión language , muestra las cateorias en español
	{
    	$title = $row["cat_name"];
		$details=$row["cat_details"];
	}
	elseif($_SESSION['idioma']==2)//Si es igual a 2 muestras las categorias en inglés
	{
		$title = $row["cat_name_eng"];
		$details=$row["cat_details_eng"];
	}
	
		//Comprobamos si en esa categoría hay artículos en excaseces

			$art_array=get_arts_almacen($catid);
			if (!$art_array)	  	
			$color="#DEBDFF";
	  
	 		else
			$color="white";
	  	
			$url = "show_arts_stock.php?catid=$catid&stock=$stock"; //descativado mientras no exista ese enlace

	?>
	
	<table width="100%"  border="0"  bgcolor="#DEBDFF"">
  	<tr>
    <td bgcolor='<? echo $color ?>'><a  title='<? echo "$details" ?>'  href=<? echo $url ?> target='_SELF'class='stock_links ' >
	<? echo $title ?></a><span class="Estilo1"></span></td>
  </tr>

 <?
 	
	}//fin del foreach
?>

</table>

<?
}
function display_arts_stock($art_array)
{

@session_start();
$admin_user=$_SESSION['admin_user'];
$idioma=$_SESSION['idioma'];

  if (!is_array($art_array))
  {
   echo "<table class='no_hay_articulos'> <tr> <td>$no_articles</td></tr></table>";
   exit;
  }



 ?>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
<link href="../gloria.css" rel="stylesheet" type="text/css" />


 <title>Artículos</title><table cellpadding="10px" cellspacing="10px" >
 <tr>
 <?
 
  $i=0; //inicializamos contador a 0 para las columnas de artículos
 ?>

  <table >
  <?
  
  $categorie=get_categorie_name ( $_GET['catid']);
  ?>
  <tr> <td colspan="4"  class="categories_header_stock" align="center"> <? echo $categorie ['cat_name']?> </td>
  </tr>
  <tr>
  <td>
  </td>
  </tr>
 <tr>
<?
 foreach ($art_array as $row)
   
   
  {
  			
	$id_ext= $row["id_ext"];
	$ext=extension_check($id_ext);
	if (($row["id_ext"])==4 )
	$img="demo.jpeg"; //sino hay ninguna imagen asociada a ese artículo, se carga esta por defecto
	else
	$img=($row["artid"])."art.$ext";
	
	if ($_SESSION['idioma']==2)
    {	
		
		$title = $row["art_name_eng"];
	    $details= $row["art_details_eng"];
		$comprar="Add to cart";
		
		
	}
	else
	{	
		$title = $row["art_name"];
		$details= $row["art_details"];
		$comprar="Añadir a carrito";
	}
	$cat=$row ["catid"];
	//$details_short=corta_texto($details, 10);
	$title=corta_texto($title, 15);


	$details_short=corta_texto($details, 18);
	$url = "show_article_individual.php?artid=$row[artid]&cat=$row[catid]"; //descativado mientras no exista ese enlace
	$ref=$row["ref"];
	//Comprobamos si hay existencias de ese producto
	$existencias=get_almacen($row[artid]);
	//limitamos el número de caracteres que aparecera en la breve descripción de artículo
    $price=$row["art_price"];
 //Creamos las filas que contendrá los artículos

//SOLO MUESTRA LOS ARTÍCULOS CUYAS EXITENCIAS ESTEN ESCASEANDO SEGÚN LÍMITES PUESTOS POR EL ADMINISTRADOR
if ($row ['stock'] <= $existencias['unidades']  && session_is_registered("admin_user") )
{
   echo " 
		<div class='articulos_stock'><td width='190px' ><table ><tr><td class='nombre' width='100%'>$title</td></tr>
		<tr><td class='ref' align='center'>Ref: $ref</td></tr>
			<tr><td> <a href=$url class='images_links'><img src=img/arts/$img class='img_med'> </a></td> </tr>
					<tr><td class='descript'> $details_short</td> </tr>
					<tr><td class='precio'> $price  €</td> </tr>";
					
					if(session_is_registered("admin_user") )//&& $existencias['unidades'] < 15 )
						{	
							if ($existencias['unidades'] == 0 )
							echo "<tr><td class='agotado'>Producto Agotado</td> </tr>";
							else
							echo "<tr><td class='agotado'>Existencias: ". $existencias['unidades']."</td> </tr>";
						
						}
					else
					echo "<tr><td class='agotado'>' '</td> </tr>";

				if(session_is_registered("admin_user"))
					echo "<tr><td align='center'><a href='mod_art_form_stock.php?artid=$row[artid]&ref=$ref&catid=$cat' 		                    class='modificar'
					target='_PARENT'> Modificar</a> </td> </tr>";

				else
				echo "<td class='comprar'><a href='../carrito_php/mete_producto.php?catid=$cat&nombre=$title&id=$row[artid]&precio=$row[art_price]
				&img=$img&ref=$ref'>".$comprar."</a></td>";
				
				
			echo "
			</table>
			
			</td>
			</div>
			";
			
		if ($i===3)
		{
			echo "</tr><tr><td></td></tr><tr><td></td></tr><table><tr> ";
			
			$i=0; /*pone el contador a 0 una vez haya saltado de linea para que vuelva a sumar otros 3 artículos antes de saltar a la 			                   siguiente linea */
		}
		else
		$i++; 
	
	}

	}
	?>
				 </table>      
				 
<?

	
?>

</table>	

<?
}//fin de la función display_arts_STOCK
function mod_article_form_stock ($article,$unidades,$catid) 

	{
	 //Llenamos variables con los valores del array
		$title_esp=$article['art_name'];
		$title_eng=$article['art_name_eng'];

		$details=$article['art_details'];
		$details_eng=$article['art_details_eng'];
		$price=$article['art_price'];
		$artid=$article['artid'];
		$ext=$article['id_ext'];	
		$ref=$article['ref'];	
		$unidades=$unidades['unidades'];
		$stock=$article['stock'];
?>
<form action="mod_art.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label></label>
<table width="514" border="0" align="center" cellpadding="5" cellspacing="2">

    <tr bgcolor="#8E8EC6">
      <td height="41" colspan="2"><div align="center"><span class="Estilo1"> Modificar Art&iacute;culo </span></div>	  </td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td width="259"><div align="right"><span class="Estilo4">Nombre</span></div></td>
      <td width="229"><input name="art_name" type="text" id="art_name" value="<? echo $title_esp ?>" maxlength="20" /></td>
  </tr>
   <tr bgcolor="#EDEDF6">
      <td width="259"><div align="right"><span class="Estilo4">Name</span></div></td>
      <td width="229"><input name="art_name_eng" type="text" id="art_name_eng" value="<? echo $title_eng ?>" maxlength="20" /></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td><div align="right" class="Estilo4">Referencia</div></td>
      <td><span class="Estilo4">
        <label></label>
        <input name="ref" type="text" id="ref" value="<? echo $ref ?> " maxlength="20" />
      </span></td>
  </tr>
  <tr bgcolor="#EDEDF6">
      <td><div align="right" class="Estilo4">Unidades</div></td>
      <td><span class="Estilo4">
        <label></label>
        <input name="unidades" type="text" id="unidades" value="<? echo $unidades ?> " maxlength="20" />
      </span></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td><span class="Estilo4">Descripci&oacute;n-ingl&eacute;s</span></td>
      <td><span class="Estilo4">Descripci&oacute;n-espa&ntilde;ol</span></td>
    </tr>
    <tr bgcolor="#EDEDF6">
      <td><div align="left"><span class="Estilo4">
        <textarea name="art_details_eng" id="art_details_eng" maxlength="200"><? echo $details_eng  ?></textarea>
      </span></div>
      <div align="center"></div></td>
      <td><div align="left"><span class="Estilo4">
      <textarea name="art_details" id="art_details"><? echo $details  ?></textarea>
      </span></div></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td><div align="right"><span class="Estilo4">Precio</span></div></td>
      <td><span class="Estilo4">
        <label></label>
        <input name="art_price" type="text" value="<? echo $price ?>" size="7" maxlength="10" />
      </span> €</td>
  </tr>
  <tr bgcolor="#EDEDF6">
	 <td align="left">Límite existencias</td>
	 <td><input name="stock" type="text" class='box' id="stock" size="8" value="<? echo $stock ?>"/></td>
   </tr>
   
   <tr bgcolor="#EDEDF6">
      <td><div align="right"><span class="Estilo4"></span></div></td><td>Imagen (tiene que tener máximo 1100px X 1100px</td>
      <td><span class="Estilo4">
        <input type="file" name="file" />
      </span></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td colspan="2"><div align="right"><span class="Estilo5"></span></div>        
        <div align="center"><span class="Estilo4">
        </span><span class="Estilo4">
        <input type="submit" name="Submit" value="Modificar" />
        </span></div>        <span class="Estilo4"><label></label>
        </span></td>
  </tr>
    <tr>
      <td><div align="right"><span class="Estilo5"></span></div></td>
      <td><span class="Estilo5">
        <input name="ext" type="hidden" id="ext" value="<? echo $ext ?>" />
        <input name="artid" type="hidden" id="artid" value="<? echo $artid ?>" />
		 <input name="catid" type="hidden" id="artid" value="<? echo $catid ?>" />

     
  <p>&nbsp; </p>
  <p>&nbsp;</p>
</form>
<?
}
//Recoge SOLO  los artículos que tienen las existencias o menos definidos por el administrador DE UNA CATEGORÍA DETERMINADA
function get_articles_stock ($stock,$catid)
{

   // Petición a la base de datos de una lista de artículos ordenados por categorías donde el estocaje está al límite indicado
   $conn = db_connect();
   $query = "SELECT *
             FROM articles
			 WHERE unidades<='$stock'
			 AND catid='$catid'
			  ";
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $result = mysql_fetch_array($result);
   return $result; //guarda los resultados en un array
}
function get_arts_almacen($catid)
{
   // Petición a la base de datos de una lista de categorías
   $conn = db_connect();
   $query = "SELECT articles.art_name,articles.art_details,articles.stock,almacen.artid,almacen.unidades,articles.catid,
   			articles.ref,articles.id_ext,articles.art_price
             FROM articles,almacen
			 WHERE articles.catid=$catid
			 AND articles.artid=almacen.artid
			 AND  articles.stock <= almacen.unidades  
			  ";
			  
		
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $result = db_result_to_array($result);
   return $result; //guarda los resultados en un array
}
function stock_discount ($artid,$unidades) {

$conn = db_connect();


  $query= "UPDATE almacen
             SET unidades= unidades - $unidades
             WHERE artid='$artid' ";
   $result = mysql_query($query);
   if (!$result)
     return false;
  
   return true; 

}
//Función que comprueba que un artículo existe y nos devuelve su artid

function ask_exists($ref) {

$conn = db_connect();
   $query = "SELECT artid
             FROM articles
			 WHERE ref='$ref'  ";
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $artid_array = mysql_fetch_array($result);
   return $artid_array; 
}


?>
</body>
</html>
