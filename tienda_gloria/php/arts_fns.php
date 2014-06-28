<?php


function get_arts($catid)
{
   // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   $query = "SELECT artid,catid,art_name,art_name_eng,art_details,art_details_eng,art_price,id_ext,ref
             FROM articles
			 WHERE catid='$catid'
			ORDER BY artid ASC";
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $result = db_result_to_array($result);
   return $result; //guarda los resultados en un array
}
function display_arts ($art_array)
{
@session_start();
include ("idiomas/idiomas_fns.php");
$admin_user=$_SESSION['admin_user'];
$idioma=$_SESSION['idioma'];

  if (!is_array($art_array))
  {
   echo "<table class='no_hay_articulos'> <tr> <td>$no_articles</td></tr></table>";
   exit;
  }
 ?>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
 <tr>
 <?php 
  $i=0; //inicializamos contador a 0 para las columnas de art�culos
 ?>

  <table align="center" >
  <?php  
  $categorie=get_categorie_name ( $_GET['catid']);
  ?>
  <tr> <td colspan="4"   align="center" class='titulo_categoria_despliegue'> <? echo $categorie ['cat_name']?> </td>
  </tr>
  </table>
<?php
 foreach ($art_array as $row)  
  {
  	$id_ext= $row["id_ext"];
	$ext=extension_check($id_ext);
	if (($row["id_ext"])==4 )
	$img="demo.jpeg"; //sino hay ninguna imagen asociada a ese art�culo, se carga esta por defecto
	else
	$img=($row["artid"])."art.$ext";

	/*	$ruta="../../on/php/admin/panel/img/arts/$img";
		$anchura = ImageSX($ruta);
		$altura = ImageSY($ruta);  

		$size=130;
		$img=imagen_proportion ($ruta,$size);*/
	
	if(!$_SESSION["novedades"])
	
	$cat=$row ["catid"];
	else
	{
		$cat=2;
		$novedades="show_las_articles.php";
	}
	$title=corta_texto($title, 15);
	$details_short=corta_texto($details, 18);
	$url = "show_article_individual.php?artid=$row[artid]&cat=$row[catid]"; //descativado mientras no exista ese enlace
	$ref=$row["ref"];
	//Comprobamos si hay existencias de ese producto
	$existencias=get_almacen($row[artid]);
	//limitamos el n�mero de caracteres que aparecera en la breve descripci�n de art�culo
        $price=$row["art_price"];
	$name=$row["art_name"];
 //Creamos las filas que contendr� los art�culos
if ($existencias['unidades'] != -1 or  session_is_registered("admin_user") )
{
  include('vistas/articulos-lista.html.php');
}
}
}//fin de la funci�n display_arts 
function display_arts_numbero_fijo ($art_array)
{
@session_start();
include ("idiomas/idiomas_fns.php");
$admin_user=$_SESSION['admin_user'];
$idioma=$_SESSION['idioma'];
if (!is_array($art_array))
  {
   echo "<table class='no_hay_articulos'> <tr> <td>$no_articles</td></tr></table>";
   exit;
  }
 ?>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
 <title>Artículos</title><table cellpadding="10px" cellspacing="10px" >
 <tr>
 <?php
 $i=0; //inicializamos contador a 0 para las columnas de art�culos
 ?>
  <table align="center"  width="100%">
  <?php
  $categorie=get_categorie_name ($_GET['catid']);
  ?>
  <tr> <td  colspan="5" align="center" class='titulo_categoria_despliegue'> <?php echo utf8_encode($categorie['cat_name']); ?> </td>
  </tr>
   <tr> <td  colspan="5" align="left" class='usuariobienvenido'><?php is_registered_user (); ?> </td>
  </tr> 
 <tr>
<?php
 foreach ($art_array as $row) 
  {		
	$id_ext= $row["id_ext"];
	$ext=extension_check($id_ext);
	if (($row["id_ext"])==4 )
	$img="demo.jpeg"; //sino hay ninguna imagen asociada a ese art�culo, se carga esta por defecto
	else
	$img=($row["artid"])."art.$ext";

	/*	$ruta="../../on/php/admin/panel/img/arts/$img";
		$anchura = ImageSX($ruta);
		$altura = ImageSY($ruta);  

		$size=130;
		$img=imagen_proportion ($ruta,$size);*/
	
	if(!$_SESSION["novedades"]) {	
            $cat = $row ["catid"];
        }
	else{
            $cat=2;
            $novedades = "show_las_articles.php";
	}
	$title = corta_texto($title, 15);


	$details_short = corta_texto($details, 18);
	$url = "show_article_individual.php?artid=$row[artid]&cat=$row[catid]"; //descativado mientras no exista ese enlace
	$ref=$row["ref"];
	//Comprobamos si hay existencias de ese producto
	$existencias=get_almacen($row[artid]);
	//limitamos el número de caracteres que aparecera en la breve descripción de artículo
    $price=$row["art_price"];
	$name=$row["art_name"];
 //Creamos las filas quef contendr� los art�culos
if ($existencias['unidades'] != -1 or  session_is_registered("admin_user") )
{
//view
    include('views/articulos-lista-num-fijo.html.php');
}}
?>
</table>      				 
</table>	
<?php
}//fin de la funci�n display_arts 
//Art�culo individual
function article_individual($artid,$cat)
{
include("idiomas/idiomas_fns.php");

$articles_array=get_article($_GET['artid']);

//comprobamos la extensi�n de la imagen
$id_ext=$articles_array[id_ext];
$ext=extension_check ($id_ext);
//$artid=$article['artid'];
$ref=$articles_array['ref'];
$cost=$articles_array['art_price'];
if ( ($articles_array[id_ext]) ==4)
$img="demo.jpeg";
else
$img=$artid."art.$ext";
$catid=$articles_array['catid'];
if (!$_SESSION['idioma']==2)
    {	
		$title = $articles_array["art_name"];
		$details= $articles_array["art_details"];
		$precio="Precio";

	}
	else if ($_SESSION['idioma']==2)
	{	
		$title = $articles_array["art_name_eng"];
	    $details= $articles_array["art_details_eng"];
		$precio="Price";
		

	}
	$ref=$articles_array["ref"];
?>
<body>
<table width="425" height="265" border="0" align="center" >
  <tr>
    <td width="263">
    <p align="center">
<img oncontextmenu="alert('Opcion deshabilitada');return false"
 oncopy="alert('Opcion deshabilitada');return false" src=../../tienda_gloria/php/admin/panel/img/arts/<? echo $img ?> class='img_big' /></p>
<p style="text-align: left;"></p>
    
    </td>
    <td width="152"><table width="200" border="0">
      <tr>
        <td class="nombre"><?php echo $title; ?></td>
      </tr>
      <tr>
        <td class="ref" align="center">Ref:<?php echo $ref ?></td>
      </tr>
      <tr>
          <td class="descript"><?php echo $details; ?></td>
      </tr>
      <tr>
        <td class="precio"><?php echo $cost ?> € </td>
      </tr>
      <tr>
        <td class="anadir_cesta">
		<?php
		echo "<a href='../carrito_php/mete_producto.php?catid=$catid&nombre=$title&id=$artid&precio=$cost
				&img=$img&ref=$ref'";
		?>
		class='anadir_cesta'><?php echo $comprar; ?>
		</a></td>				
      </tr>
	  <tr>
	  <td></td>
	  </tr>
	    <tr>
	  <td></td>
	  </tr>
	    <tr>
	  <td></td>
	  </tr>
	  
	  <tr>		
<td align="center">	<a href="javascript:history.back(1)" class="volver">Volver</a></td>
</tr>
    </table></td>
  </tr>
</table>

</body>
<?php
}
function get_all_arts_from_categorie($catid)
{
   // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   $query = "SELECT artid,art_name
             FROM articles
			 WHERE catid='$catid' ";
			
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $result = db_result_to_array($result);
   return $result; //guarda los resultados en un array
}
//BORRAR CATEGORIAS
function get_article($artid)
{
   // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   $query = "SELECT *
             FROM articles
	     WHERE artid='$artid' ";
			 
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $result =mysql_fetch_array($result);
   return $result; //guarda los resultados en un array
}
//Modificar Art�culo
function mod_article_form ($article,$unidades,$catid) 
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
		
		//Comprobamos si esta marcado la categor�a escaparate
		
		$escaparate=comprueba_escaparate($artid);
		
?>
<form action="mod_art.php" method="post" enctype="multipart/form-data" name="form1" id="form1">

<table width="514" border="0" align="center" cellpadding="5" cellspacing="2">

    <tr bgcolor="#8E8EC6">
      <th height="41" colspan="2" align="center"> Modificar Art&iacute;culo</th>
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
      <td width="259"><div align="right"><span class="Estilo4">Categor�a</span></div></td>
      <td width="229">
     <select name="catid" name="catid">
    <?php
	$cat_array=get_categories();
	foreach ($cat_array as $row)
  {
  if ($row[catid] == $catid)
   echo  "<option value='$row[catid]' selected='selected'>$row[cat_name]</option>";
   else
      echo  "<option value='$row[catid]' >$row[cat_name]</option>";

   }
   ?>
  	</select> 
      </td>
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
        <input name="art_details_eng" id="art_details_eng" maxlength="500" size="80"  value='<?php echo $details_eng  ?>'>
      
      </span></div>
      <div align="center"></div></td>
     
      <td><div align="left"><span class="Estilo4">
     200 caracteres máximo (cuando no te deja escribir m�s es por as alcanzado el límite)
      <input name="art_details" id="art_details" maxlength="200" size="80" value='<?php  echo $details  ?>' />
      </span></div></td>
  </tr>
    <tr bgcolor="#EDEDF6">
      <td><div align="right"><span class="Estilo4">Precio</span></div></td>
      <td><span class="Estilo4">
        <label></label>
        <input name="art_price" type="text" value="<?php echo $price ?>" size="7" maxlength="10" />
      </span> �</td>
  </tr>
  <tr bgcolor="#EDEDF6">
	 <td align="right">L�mite existencias</td>
	 <td><input name="stock" type="text" class='box' id="stock" size="8" value="<?php echo $stock ?>"/></td>
   </tr>
   
   <tr bgcolor="#EDEDF6">
      <td><div align="right"><span class="Estilo4"></span></div></td><td>Imagen (tiene que tener m�ximo 1100px X 1100px
              <input type="file" name="file" />

      </td>
      <tr>
      <?php
	  if ($escaparate)
	  {
	  ?>
           <td align='center' colspan='2'>Escapar�te <input name="escaparate" type="checkbox" checked="checked" /></td>
		<?php
		}
		else
		{
		?>
		 <td align='center' colspan='2'>Escapar�te <input name="escaparate" type="checkbox"  />
		<?php
		}
		?>
</tr>    
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
      <td>
        <input name="ext" type="hidden" id="ext" value="<?php echo $ext ?>" />
        <input name="artid" type="hidden" id="artid" value="<?php echo $artid ?>" />
        <input name="catid_tienda" type="hidden" id="catid_tienda" value="<?php echo $catid ?>" />
        <input name="cat" type="hidden" id="cat" value="<?php echo $_GET['cat'] ?>" />

		</td>
        </tr>
     
  <p>&nbsp; </p>
  <p>&nbsp;</p>
</form>
<?php
}
//Formularia para a�adir nuevaos art�culos 
function display_form_add_art($cats_list) 
{
?>
<div class='form_art'>
<form action="add_art.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p>&nbsp;</p>
<table width="20%"  align="center" cellpadding="5" cellspacing="5">

  <tr bgcolor="#E3E3ED">
  <th colspan='2'> Datos del artículo </th>
  </tr>
 <tr bgcolor="#E3E3ED">
    <td align='right' > Nombre </td>
     <td> <input name="art_name" type="text" id="art_name" class='box' maxlength="20"/>    </td>
  </tr>
  <tr bgcolor="#E3E3ED">
  <td align='right' >Name </td>
  <td>  <input name="art_name_eng" type="text" id="art_name_eng" class='box' maxlength="20"/>    </td>
  </tr>
  <tr bgcolor="#EDEDF6">
    <td align='right' >Referencia </td>
    <td> <input name="ref" type="text" id="ref"  maxlength="20"  />    </td>
</tr>
<tr bgcolor="#EDEDF6">
    <td align='right' >Unidades</td>
    
      <td><input name="unidades" type="text" id="unidades" value="" maxlength="20" />    </td>
</tr>
</table>
<table width="69%" align="center" cellpadding="5" cellspacing="5">

  </tr>
  <tr bgcolor="#E3E3ED">
    <td  align='left' rowspan="2"> <p>Detalles </p>
    <p>
      <input name="details" type="text" id="details" size="80" maxlength="200" />
    </p></td>
    <td rowspan="2"><p>Details </p>
    <p>
      <input name="details_eng" type="text" id="details_eng" size="80" maxlength="200"/>
    </p></td>
  </tr>
  <tr>
    <td width="0"></td>
  </tr>
  
  <tr>
    <td height="2"></td>
  </tr>
  <tr bgcolor="#E3E3ED">
    <th  align='left'>Limite existencias 
    <input name="stock" type="text" class='box' id="stock" size="8" /></th>
    <td>Im&aacute;gen 
    <input type="file" name="file" class='box'/></td>
  </tr>
  
  <tr bgcolor="#E3E3ED">
    <td colspan="3"  align='center'> <div align="left">Elija en quee categoría
        <select name="catid" id="catid" class='box'>
          <?php
		
		foreach ($cats_list as $row)
		{
		$catid=$row['catid'];
		$cat_name=$row['cat_name'];
		echo "<option value=$catid/>$cat_name</option>";
		}
         ?>
        </select>
        </div>
      <p></p></td>
  </tr>
  <tr bgcolor="#E3E3ED">
    <th width="480"><div align="left">Precio 
      <input name="price" type="text" id="price" size="10" class='box'/>
    &euro;</div></th>
    <td>Escaparate
    <input name="escaparate" type="checkbox" /></td>
   </tr>
  <tr bgcolor="#E3E3ED">
    <td height="26" colspan="3"><div align="center">
      <input type="submit" name="Submit" value="Enviar" />
    </div></td>
  </tr>
</table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <label></label>
  <p>
    <label></label>
  </p>
  <p>
    <label></label>
  </p>
</form>
</div>
<?php	}
function menu_articles()
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Borrar artículos</title>
<link href="../gloria.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="menu_articulos"><table width="75%" border="0" align="center" cellpadding="15" cellspacing="9">
  <tr bgcolor="#CED0C9">
    <td colspan="3"><div  class='menu' align="center" >
      <div align="center">Menú Artículos </div>
    </div></td>
  </tr>
  <tr bgcolor="#CED0C9">
    <td><div align="center"><a href="form_art.php">Insertar</a></div></td>
    <td><div align="center"><a href="delete_art_form_step1.php">Borrar</a></div></td>
	<td><div align="center"><font color="#000066"> Aparecerá la opción "modificar" junto a cada artículo en la ventana de tienda</font></div></td>
</tr>
</table>
</div>
</body>
</html>
<?php
} //fin de la funcion menu_articles()		
//A�ade un nuevo art�culo a una categor�a
function add_art($catid,$art_name,$art_name_eng,$art_details,$art_details_eng,$art_price,$id_ext,$ref,$stock,$escaparate)
 {
$conn = db_connect();
$date=date("j,�n,�Y");
$query ="insert into articles values
 		('','$catid','$art_name','$art_name_eng','$art_details','$art_details_eng',
		'$art_price','$id_ext','$ref','$stock','$date','$escaparate' ) 
		";
		
		
		
$result=mysql_query($query);
if (!result)
return false;
$mensaje=" El nuevo art�culo se ha a�adido correctamente a la Base de datos";
return $mensaje;
}	
//Llenamos el almacen con n� unidades de este producto
function add_unidades($artid,$unidades)	
 {
 
 $conn = db_connect();
 $query ="insert into almacen values
 		('$artid','$unidades' ) ";
		
 $result=mysql_query($query);	
	
if (!$result)
return false;
return true; 
}
 //Borrar art�culos de una categor�a en concreto
function delete_art($artid,$art_name) 
{
  $conn = db_connect();
  $query = " DELETE from articles
             WHERE artid='$artid' ";
	
	 $query2 = " DELETE from almacen
                     WHERE artid='$artid' ";			 
   $result = mysql_query($query);
   $result2 = mysql_query($query2);
   if (!$result ||   !$result2)
     echo " Lo sentimos pero no se ha podido borrar el art�culo seleccionado, consulte con su administrador ,Gracias ";
	 else 
	 {
	 	echo "<center>Se ha borrado correctamente el art�culo: <h3> $art_name <h3></center> ";

		echo "<center><a href='delete_art_form_step1.php'> Borrar Otra </a></br></center> ";
		 }
}	
function update_articles($art_name,$art_name_eng,$art_details,$art_details_eng,$art_price,$artid,
                          $id_ext,$ref,$unidades,$stock,$catid,$escaparate)
{
$conn = db_connect();
if ($id_ext!=NULL)
  { //Si no se sube imagen , para que no se remplace por una en blanco
   $query = "UPDATE articles
             SET art_name='$art_name' ,
			 art_name_eng='$art_name_eng' ,
			 art_price='$art_price' ,
			 art_details='$art_details' ,
			 art_details_eng='$art_details_eng' ,
			 id_ext='$id_ext'	,
			 ref='$ref'	 ,
			 stock='$stock',
			 catid='$catid',
			 escaparate='$escaparate'
             WHERE artid='$artid' ";
   }
   else
   {
   		$query = "UPDATE articles
             SET art_name='$art_name' ,
			 art_name_eng='$art_name_eng' ,
			 art_price='$art_price' ,
			 art_details='$art_details' ,
			 art_details_eng='$art_details_eng' ,
			 ref='$ref',
			 stock='$stock',
			 catid='$catid',
			 escaparate='$escaparate'

             WHERE artid='$artid' 
			 	 ";
	}
 
   		$query2 = "UPDATE almacen
             SET unidades='$unidades'
             WHERE artid='$artid' 
			 	 ";
	  $result = mysql_query($query);
	  $result2 = mysql_query($query2);
   if (!$result || !$result2)
     
	 return false;
   else
	
     return true;
}
//CONSULTAMOS EL �LTIMO ARTID A�ADIDO A LA BASE DE DATOS PARA PODER NOMBRAR LAS IM�GENES
function ask_artid() {
$conn = db_connect();
$query = "SELECT artid FROM articles
		   ";
$result=mysql_query($query);
if (!result)
return false;
$result = db_result_to_array($result);
return $result; //guarda los resultados en un array
}
//Esta funci�n nos sirve para saber el �ltimo id de art�culos o categorias (artid y catid)
function last_id($id) {
 $i=0;
 foreach ($id as $row)
 	{
	$last_id=$row[0];
	}
	return $last_id++;    
						 //�ltimo catid o artid de todas las claves de categories que ser� el nombre de la imagen que subamos + cat.jpg
	}
//Muestra los �ltimos N� (pongamos 5 por ejemplo) art�culo a�adidos recientemente
function last_articles_add()
{
 // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   //Ordena los art�culos por fecha del �ltimo a�adido al primero
   $query = "SELECT artid,catid,art_name,art_name_eng,art_details,art_details_eng,art_price,id_ext,ref
             FROM articles
			 ORDER BY artid DESC
			 LIMIT 20";
			 
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
 $result = db_result_to_array($result);
   return $result; //guarda los resultados en un array
}
function arts_info ($artid) {
 $conn = db_connect();

 // Set query to Utf8
 mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8',"
     . " character_set_connection = 'utf8', character_set_database = 'utf8', "
     . "character_set_server = 'utf8'", $conn);

 
// función que nos devuelve el precio y demas datos de cada artículo 
$result= mysql_query("SELECT *
					 FROM articles
					 WHERE artid='$artid' ");							
if (!$result)
     return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$arts = mysql_fetch_array($result);

return $arts;
}				
function escaparate() 
{

  // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   //Ordena los art�culos por fecha del �ltimo a�adido al primero
   $query = "SELECT *
             FROM articles
			 WHERE escaparate=1
			 ORDER BY artid DESC
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
function comprueba_escaparate($artid) {
 // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   //Ordena los art�culos por fecha del �ltimo a�adido al primero
   $query = "SELECT escaparate
             FROM articles
			 WHERE artid=$artid
			
			 ";			 
   $result = mysql_query($query);
 	
	$sql=mysql_fetch_array($result);
	
 	if ( $sql['escaparate']  == 1 )
	return 1;
	else
	return 0;
}	
function get_refs() {
$conn = db_connect();
$query = "SELECT ref,art_name,art_price FROM articles 
		   ";
$result=mysql_query($query);
if (!result)
return false;
$result = db_result_to_array($result);
return $result; //guarda los resultados en un array
}	
function display_refs($refs) {
?>

<table width="60%" align="center" border='0'>
<tr>
<td class="pedido_items">Referencia</td > <td class="pedido_items">Nombre</td>
<td class="pedido_items">Precio</td>
</tr>

<?php
$contador=0;
foreach ($refs as $row) {
echo "<tr> <td class='items'>". utf8_encode($row['ref']) ."</td> <td class='items'>". utf8_encode($row['art_name']) ."</td>
			<td class='items'>" . $row['art_price'] ." €</td> </tr>
	<tr><td colspan='3'> <hr> </td></tr>
	"; 
	$contador++;
	}	
?>

<tr> <td colspan='3'>Total artículos: <?php echo $contador ?></td></tr>
</table>

<?php
}	
function  ask_art_by_ref($ref) {
$conn = db_connect();
//funci�n que nos devuelve el precio y demas datos de cada art�culo 
$result= mysql_query("SELECT *
					 FROM articles
					 WHERE ref='$ref' ");							
if (!$result)
 return false;
 $num_arts = mysql_num_rows($result);	
 if ($num_arts ==0)
      return false;  
$arts = mysql_fetch_array($result);		
return $arts;
}							
