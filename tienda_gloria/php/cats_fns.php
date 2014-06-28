<?php
// Render functions

function display_categories($cat_array)
{
  if (!is_array($cat_array))
  {
     echo "No hay categorías actualmente disponibles<br>";
     return;
  }

  foreach ($cat_array as $row)
  {
    $url = "show_arts.php?catid=".($row["catid"]); //descativado mientras no exista ese enlace
	//$id_ext= $row["id_ext"];
	$ext=extension_check($id_ext);
	//$img=($row["catid"])."cat.$ext";
    $title = $row["cat_name"];
	$details= $row["cat_details"];

    do_categories($title,$url,/*$img*/$details);
  }

}

function do_categories ($title,$url,/*$imagen,*/$details)
{
	//crea table que muestra resultado de la consulta

?>


<table border='0' >
		<tr>
		<td  > <a href='<? echo $url ?>' class="categories_menu"><? echo  $title ?></a></td>
		</tr>
		</table>


		<table>

		 <tr>
		 <td> <br> </td>
		 </tr>

		</table>

<?php
} //fin de la funci�n que muestra en pantalla las categor�as habidas

//Funci�n que a�ade una categor�a a la Bd
function add_cat($cat_name,$cat_name_eng,$cat_details,$cat_details_eng,$id_ext,$stock,$pos) {
$conn = db_connect();

//A�ade una categor�a nueva y su descripci�n

 $query ="insert into categories values
 		('','$cat_name','$cat_name_eng' ,'$cat_details','$cat_details_eng','$id_ext','$stock','$pos') ";


$result=mysql_query($query);

if (!$result)

return false;

else
return true;
}
function get_categories()
{
   // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   //Los ordena seg�n posici�n , a mayor posici�n se muestra antes, de mayor a menor
   $query = "select catid,cat_name,cat_details,id_ext
             FROM categories
			 ORDER BY pos DESC";
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_cats = mysql_num_rows($result);
   if ($num_cats ==0)
      return false;
   $result = db_result_to_array($result);
   return $result; //guarda los resultados en un array
}

function get_details ($catid)
{
 $conn = db_connect();
   $query = "SELECT *
             FROM categories
			 WHERE catid=$catid";
$result = mysql_query($query);
   if (!$result)
     return false;
   $num_cats = mysql_num_rows($result);
   if ($num_cats ==0)
      return false;
   $result = mysql_fetch_array($result);
   return $result; //guarda los resultados en un array
}

function get_categorie_name ($catid)
{
 $conn = db_connect();
   $query = "SELECT cat_name,stock
             FROM categories
			 WHERE catid=$catid";
$result = mysql_query($query);
   if (!$result)
     return false;
   $num_cats = mysql_num_rows($result);
   if ($num_cats ==0)
      return false;
   $result = mysql_fetch_array($result);
   return $result; //guarda los resultados en un array
}


function show_menu_categories() {
    require ("fns.php");

    $menu = show_categories ();

    display_menu($menu);

}

//Consulta a la Bd de las categor�as existentes
function show_categories () {
$conn = db_connect();

//Consultamos todos los campos de la tabla "categories", recordar que hay dos idiomas diferentes, es decir 1 campo para "esp"
// y otro igual peron en ingles "eng"
$query = "SELECT *
             FROM categories
			ORDER BY pos ASC";
//Guarda el resultado de la consulta en la variable result
 $result = mysql_query($query);
   //Si no se obtienen resultados devuleve false la funci�n
   if (!$result)
     return false;
	//sino cuenta el n�mero de regitros obtenidos
   $num_arts = mysql_num_rows($result);
   if ($num_arts == 0)
       return false;
   $result = db_result_to_array($result);
  
   return $result; //guarda los resultados en un array

}
function display_menu($menu)
{
?>
<script language="javascript" type="text/javascript">
function imagenfondo() {
document.all.table.td.background="../img/boton2.jpg";
}
</script>
<body>
<?php
 foreach ($menu as $row)
  {
    //RECORDAR: language es una variable de sesi�n que valdr� uno para "espa�ol" y 2 para "ingl�s"
	$catid=$row["catid"];
	$stock=$row["stock"];
	$pos=$row['pos'];

    $title = $row["cat_name"];
	if(!$_SESSION['idioma']==2)//Si es diferente a 2 la variable de sesi�n language , muestra las cateorias en espa�ol
	{
    	$title = $row["cat_name"];
		$details=$row["cat_details"];
	}
	elseif($_SESSION['idioma']==2)//Si es igual a 2 muestras las categorias en ingl�s
	{
		$title = $row["cat_name_eng"];
		$details=$row["cat_details_eng"];
	}
	//Deajmos abierta la posibilidad de incorporar m�s idiomas a la bd

	$url = "categories.php?catid=$catid"; //descativado mientras no exista ese enlace
	?>

	<table width="100%"  border="0" class="fondo_categorias"  >
  	<tr>

 	<td  class='botones_cats' onMouseOut="this.className='botones_cats' " onMouseOver="this.className='botones_cats_over' ">
            <a  title='<?php echo utf8_encode($$details); ?>' href='<?php  echo $url; ?>'  target='content' class='categories_menu' ><?php echo  utf8_encode($title); ?></a> </td>
	<?php
	if ($_SESSION['admin_user'])
	 echo "<td align='right'> Pos:  $pos </span></td>";
	 ?>

  </tr>

 <?php
	}
?>

</table>

<?php
}
function mod_cat_form ($cats)
{
?>
<form action="mod_cat_form2.php" method="post" name="form2" id="form2">
<table width="75%" align="center" cellpadding="9" cellspacing="4">
	<tr bgcolor="#DEDEF4"> <td colspan='2'> Modificar Categoría  </td>
	</tr>
	<tr bgcolor="#DEDEF4"> <td width="85%"> Nombre</td>
	<td width="15%"><label>

	  <select name="catid" class='box'>
	  <?php
	foreach ($cats as $row)
	{
            $catid=$row[catid];
            $cat_name=$row['cat_name'];
	?>

        <option value='<? echo $catid ?>'><?php echo $cat_name ?></option>


        <?php
        }
        ?>
</select>
</div></td>

	<tr bgcolor="#DEDEF4"> <td colspan='2'><input type="submit" name="Submit2" value="Siguiente" /></td></tr>
</table>
	</form>
<?php
}


//Formulario para a�adir nuevas categorias

function display_form_add_cat ()
{
?>
<div class='form_cat'>
<form action="add_cat.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <p>&nbsp;</p>
  <table width="75%" border="0" align="center" cellpadding="15" cellspacing="9">

    <tr bgcolor="#EFF3F5">
      <td>
        <div align="center">Nombre de Categor&iacute;a
          <input name="cat_name" type="text" id="cat_name" class='box' />
         </div></td>
      <td width="46%">English
        <input name="cat_name_eng" type="text" id="cat_name_eng" class='box' /></td></tr>
    <tr bgcolor="#EFF3F5">
      <td><div align="center">Detalle de Categor&iacute;a
        <input name="cat_details" type="text" id="cat_details" class='box' />
      </div></td>
      <td>Details
        <input name="cat_details_eng" type="text" id="cat_details_eng" class='box' /></td>
		<tr bgcolor="#E3E3ED">


      <td>Im&aacute;gen
        <input type="file" name="file" class='box'/></td>
      <td>&nbsp;</td>
	</tr>
    </tr>
    <tr bgcolor="#EFF3F5">
      <td height="54" colspan="2"><div align="center">
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
<?php
}
function menu_categorias (){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Men� Categor�as</title>
</head>

<body>
<table width="75%" border="0" align="center" cellpadding="15" cellspacing="9">
  <tr bgcolor="#C7D4C5">
    <td colspan="3"> <div  class='menu' align="center" >
      <div align="center"><span class="Estilo1">Men&uacute; Categor&iacute;as</span></div>
    </div> </td>
  </tr>
  <tr bgcolor="#C7D4C5">
    <td><div align="center"><a href="form_cat.php">Insertar</a></div></td>
    <td><div align="center"><a href="del_cat_form.php">Borrar</a></div></td>
    <td><div align="center"><a href='mod_cat_form1.php'>Modificar</a></div></td>
  </tr>
</table>

</body>
</html>
<?php
}
function delete_cat ($catid)
{

  $conn = db_connect();

   $query = " delete from categories
             where catid='$catid' ";

   $query2 = "delete from articles
             where catid='$catid' ";
   $result = mysql_query($query);
   $result2 = mysql_query($query2);
   if (!$result && !$result2)
     echo " Lo sentimos pero no se ha podido borrar la categor�a seleccionada, consulte con su administrador ,Gracias ";
	 else
	 {
	 ?>
	 <table width="72%" border="0" align="center" cellpadding="5" cellspacing="5" align="center">
  <tr bgcolor="#EAEAF1">
    <td colspan="2"><div align='center"'>Se ha borrado correctamente la categor&iacute;a y todo su contenido ,Gracias</div></td>
  </tr>
  <tr>
  <td><a href='articles_menu.php'> Volver </a></br></td>


  <td><a href='del_cat_form.php'> Borrar Otra </a></td>
  </tr>
</table>
<?php
}
}
//BORRAR CATEGORIAS O ART�CULOS DE CATEGORIAS SEG�N EL VALOR DE OPTION  SI ES 1 SE TRATA DE CATEGORIAS SI ES 2 DE ARTICULOS
function display_cats_arts_delete ($list,$option) {
//@session_start();
if ($option==1)

$url="del_cat.php";

if ($option==2)
$url="";
echo "<form id='form1' name='form1' method='post' action='$url' ";
?>
  <p>&nbsp;</p>
  <table width="75%" border="0" align="center" cellpadding="9" cellspacing="9">
  <tr bgcolor="#CCCCCC">
    <td><label> </label>
        <div align="center">Categor&iacute;a
          <select name="cats" class='box'>
              <? //Listamos TODAS las categor�as para seleccionar la que deseamos ver sus art�culos
		foreach ($list as $row)
		{
		$catid=$row['catid'];
		$cat_name=$row['cat_name'];
		echo "<option value=$catid/>$cat_name</option>";

		}
		?>
            </select>
           <?php
	//Si quremos borrar una categoria
	if ($option==1)
	{

		echo "  <input type='submit' name='Submit' value='Borrar' />";
		echo "<br>";

	//Solamente si hemos decidido borrar solo una categoria NO art�culos
	echo "</form>";
		exit;
	}


		//Si queremos borrar un art�culo en concreto de una categor�a en concreto
	if ($option==2)
	 	{

 		//Obtenemos lista de los art�culos de esa categor�a en concreto
		$catid=$_GET['catid'];
		$art_array=get_arts($catid);
?>
            <select name="arts">
              <?php	 //Listamos todos los art�culos de la categor�a seleccionada previamente
		 foreach ($art_array as $row)
  {


	//$img=($row["artid"])."art.jpg";
     $title = $row["art_name"];
	//$details= $row["art_details"];
	 $artid=$row["artid"];
    //$price=$row["art_price"];
			echo "<option value=$artid/>$art_name</option>";
 }
  	?>
            </select>
      </div></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td> <input type='submit' name='Submit' value='Seleccionar' /></td>
  </tr>
  <tr>
  <td><a href='../../../demo_marcos.html'>Volver Tienda</a> </td>
  </tr>
</table>

</form>
<?php
}// Fin del segundo if
}
function update_categories($newname,$newname_eng,$catid,$details,$details_eng,$id_ext,$stock,$new_pos,$old_pos)
{
$conn = db_connect();
//Comprobamos si ys est� ocupada la POSici�n de la categor�a
 $conn = db_connect();
 $query = "SELECT pos
             FROM categories
			 WHERE pos=$new_pos";
$result = mysql_query($query);
   //Solo actualizar si existe ese pos
   if (mysql_num_rows ($result) > 0)
   {
   //Si ya est� ocupada esa posici�n aumentamos en todas una posici�n desde la que a�adimos en adelante
   if (mysql_num_rows($result)>0 )
     $result =mysql_query("UPDATE categories
             			   set pos=pos + 1
			              WHERE pos >= $new_pos
						  AND pos < $old_pos
						  ");
//Actualizamos la posici�n de la categor�a que queremos cambiar
  if ($result)
    $result=mysql_query ( "update categories
                            set pos='$new_pos'
                            where catid='$catid' " );
   }
//Si la id_ext no es NULL , es decir si se sube una imagen de remplazo
if ($id_ext!=NULL)
{
   $query = "UPDATE categories
             SET cat_name='$newname' ,
			 	 cat_name_eng='$newname_eng' ,
			 	 cat_details='$details',
				 cat_details_eng='$details_eng',
				  id_ext='$id_ext',
				  stock='$stock'
			 WHERE catid='$catid' ";
}
else
{
$query = "UPDATE categories
             SET cat_name='$newname' ,
			 	 cat_name_eng='$newname_eng' ,
			 	 cat_details='$details',
				 cat_details_eng='$details_eng',
				 stock='$stock'
			 WHERE catid='$catid' ";
}
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;

}
function get_all_cats()
{
   // Petici�n a la base de datos de una lista de categor�as
   $conn = db_connect();
   $query = "SELECT catid,cat_name
             FROM categories
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

//Obtener listado de todos los art�culos de una categor�a determinada
function ask_catid() {
$conn = db_connect();
$query = "SELECT catid FROM categories";
$result=mysql_query($query);
if (!result)
return false;
$result = db_result_to_array($result);
return $result;
//guarda los resultados en un array
}
//Esta funci�n nos sirve para saber el �ltimo id de art�culos o categorias (artid y catid)
function last_catid($id) {
 $i=0;
 foreach ($id as $row)

 	{
	$last_id=$row[0];
	}
	return $last_id++;
}
//CONSULTAS A LAS BASE DE DATOS PARA OBTENER LISTADO DE TODAS LAS CATEGORIAS

function avisar_stock ($stock)
{
$conn = db_connect();
$query = "SELECT articles.artid ,
          FROM articles,categories
		  WHERE catid=$catid
		  AND articles.unidades <= $stock
		   ";
$result=mysql_query($query);
if (!$result)
return false;
$result = db_result_to_array($result);
return $result;
//guarda los resultados en un array
}
function last_pos () {
$conn = db_connect();
$query = "SELECT pos
          FROM categories
		  ORDER by pos desc
		   ";
$result=mysql_query($query);
if (!$result)
return false;
$result = db_result_to_array($result);
return $result[0][0]+1;
//guarda los resultados en un array
}
