<?php

function display_menu_stock($menu){
    
 foreach ($menu as $row)
  {
    //RECORDAR: language es una variable de sesi?n que valdr? uno para "espa?ol" y 2 para "ingl?s"

	$catid=$row["catid"];


    $title = $row["cat_name"];
	if(!$_SESSION['idioma']==2)//Si es diferente a 2 la variable de sesi?n language , muestra las cateorias en espa?ol
	{
    	$title = $row["cat_name"];
		$details=$row["cat_details"];
	}
	elseif($_SESSION['idioma'] == 2)//Si es igual a 2 muestras las categorias en ingl?s
	{
		$title = $row["cat_name_eng"];
		$details=$row["cat_details_eng"];
	}

		//Comprobamos si en esa categor?a hay art?culos en excaseces

			$art_array=get_arts_almacen($catid);
			if (!$art_array)
			$color="#DEBDFF";

	 		else
			$color="white";

			$url = "show_arts_stock.php?catid=$catid&stock=$stock"; //descativado mientras no exista ese enlace

	?>

	<table width="100%"  border="0"  bgcolor="#DEBDFF"">
  	<tr>
    <td bgcolor='<?php echo $color ?>'><a  title='<?php echo "$details" ?>'  href='<?php echo $url ?>'' target='_SELF'class='stock_links ' >
	<?php echo utf8_encode($title) ?></a><span class="Estilo1"></span></td>
  </tr>

<?php

	}//fin del foreach
?>

</table>

<?php
}
function display_arts_stock($art_array)
{

$admin_user=$_SESSION['admin_user'];
$idioma=$_SESSION['idioma'];

  if (!is_array($art_array))
  {
   echo "<table class='no_hay_articulos'> <tr> <td>$no_articles</td></tr></table>";
   exit;
  }
 ?>

<table cellpadding="10px" cellspacing="10px" >
 <tr>
<?php

  $i=0; //inicializamos contador a 0 para las columnas de art?culos
 ?>

  <table >
<?php

  $categorie = get_categorie_name ( $_GET['catid']);
  ?>
  <tr> <td colspan="4"  class="categories_header_stock" align="center"> <?php echo $categorie ['cat_name']?> </td>
  </tr>
  <tr>
  <td>
  </td>
  </tr>
 <tr>
<?php
 foreach ($art_array as $row)


  {

	$id_ext= $row["id_ext"];
	$ext=extension_check($id_ext);
	if (($row["id_ext"])==4 )
	$img="demo.jpeg"; //sino hay ninguna imagen asociada a ese art?culo, se carga esta por defecto
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
		$comprar="A?adir a carrito";
	}
	$cat=$row ["catid"];
	//$details_short=corta_texto($details, 10);
	$title=corta_texto($title, 15);


	$details_short=corta_texto($details, 18);
	$url = "show_article_individual.php?artid=$row[artid]&cat=$row[catid]"; //descativado mientras no exista ese enlace
	$ref=$row["ref"];
	//Comprobamos si hay existencias de ese producto
	$existencias=get_almacen($row[artid]);
	//limitamos el n?mero de caracteres que aparecera en la breve descripci?n de art?culo
    $price=$row["art_price"];
 //Creamos las filas que contendr? los art?culos

//SOLO MUESTRA LOS ART?CULOS CUYAS EXITENCIAS ESTEN ESCASEANDO SEG?N L?MITES PUESTOS POR EL ADMINISTRADOR
if ($row ['stock'] <= $existencias['unidades']  && $_SESSION["admin_user"] )
{
   echo "
		<div class='articulos_stock'><td width='190px' ><table ><tr><td class='nombre' width='100%'>". utf8_encode($title) ."</td></tr>
		<tr><td class='ref' align='center'>Ref: $ref</td></tr>
			<tr><td> <a href=$url class='images_links'><img src=img/arts/$img class='img_med'> </a></td> </tr>
					<tr><td class='descript'> $details_short</td> </tr>
					<tr><td class='precio'> $price  ?</td> </tr>";

					if($_SESSION["admin_user"] )//&& $existencias['unidades'] < 15 )
						{
							if ($existencias['unidades'] == 0 )
							echo "<tr><td class='agotado'>Producto Agotado</td> </tr>";
							else
							echo "<tr><td class='agotado'>Existencias: ". $existencias['unidades']."</td> </tr>";

						}
					else
					echo "<tr><td class='agotado'>' '</td> </tr>";

				if($_SESSION["admin_user"])
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

			$i=0; /*pone el contador a 0 una vez haya saltado de linea para que vuelva a sumar otros 3 art?culos antes de saltar a la 			                   siguiente linea */
		}
		else
		$i++;

	}

	}
	?>
				 </table>

<?php


?>

</table>

<?php
}//fin de la funci?n display_arts_STOCK
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
      <td width="229"><input name="art_name" type="text" id="art_name" value="<?php echo $title_esp ?>" maxlength="20" /></td>
  </tr>
   <tr bgcolor="#EDEDF6">
      <td width="259"><div align="right"><span class="Estilo4">Name</span></div></td>
      <td width="229"><input name="art_name_eng" type="text" id="art_name_eng" value="<?php echo $title_eng ?>" maxlength="20" /></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td><div align="right" class="Estilo4">Referencia</div></td>
      <td><span class="Estilo4">
        <label></label>
        <input name="ref" type="text" id="ref" value="<?php echo $ref ?> " maxlength="20" />
      </span></td>
  </tr>
  <tr bgcolor="#EDEDF6">
      <td><div align="right" class="Estilo4">Unidades</div></td>
      <td><span class="Estilo4">
        <label></label>
        <input name="unidades" type="text" id="unidades" value="<?php echo $unidades ?> " maxlength="20" />
      </span></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td><span class="Estilo4">Descripci&oacute;n-ingl&eacute;s</span></td>
      <td><span class="Estilo4">Descripci&oacute;n-espa&ntilde;ol</span></td>
    </tr>
    <tr bgcolor="#EDEDF6">
      <td><div align="left"><span class="Estilo4">
        <textarea name="art_details_eng" id="art_details_eng" maxlength="200"><?php echo $details_eng  ?></textarea>
      </span></div>
      <div align="center"></div></td>
      <td><div align="left"><span class="Estilo4">
      <textarea name="art_details" id="art_details"><?php echo $details  ?></textarea>
      </span></div></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td><div align="right"><span class="Estilo4">Precio</span></div></td>
      <td><span class="Estilo4">
        <label></label>
        <input name="art_price" type="text" value="<?php echo $price ?>" size="7" maxlength="10" />
      </span> ?</td>
  </tr>
  <tr bgcolor="#EDEDF6">
	 <td align="left">L?mite existencias</td>
	 <td><input name="stock" type="text" class='box' id="stock" size="8" value="<?php echo $stock ?>"/></td>
   </tr>

   <tr bgcolor="#EDEDF6">
      <td><div align="right"><span class="Estilo4"></span></div></td><td>Imagen (tiene que tener m?ximo 1100px X 1100px</td>
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
        <input name="ext" type="hidden" id="ext" value="<?php echo $ext ?>" />
        <input name="artid" type="hidden" id="artid" value="<?php echo $artid ?>" />
		 <input name="catid" type="hidden" id="artid" value="<?php echo $catid ?>" />


  <p>&nbsp; </p>
  <p>&nbsp;</p>
</form>
<?php
}
//Recoge SOLO  los art?culos que tienen las existencias o menos definidos por el administrador DE UNA CATEGOR?A DETERMINADA
function get_articles_stock ($stock,$catid)
{

   // Petici?n a la base de datos de una lista de art?culos ordenados por categor?as donde el estocaje est? al l?mite indicado
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
   // Petici?n a la base de datos de una lista de categor?as
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
//Funci?n que comprueba que un art?culo existe y nos devuelve su artid

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
