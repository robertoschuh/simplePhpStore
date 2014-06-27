<?php
header("Content-Type: text/html;charset=utf-8");

function pedido_add($id,$ref,$nombre,$precio_total)
{
$precio_unidad= precio_articulo($id);
$unidades=$precio_total/$precio_unidad[0];
//Conecatamos a la Bd

// se a�ade el campo a la bd "servido" que valdr� 0 "false" cuando se acabe de insertar en la bd,
//es decir cuando a�n no se haya  servido

 	$query ="insert into pedidos_articulos values
 		('','$id','$ref','$nombre','$unidades','$precio_unidad[0]','0')";
	$result=mysql_query($query);

	if (!$result)

	return false;

	else

	return true;

}

function form_consultar_pedido()
{
?>
<form action="consulta_pedidos.php" method="post" >
<table align="center">
<tr>
<td> Referencia: </td><td><input name="ref" type="text" id="ref" /></td>
</tr>
<tr>
<td><input type="submit" name="Submit" value="Enviar" /></td>
</tr>
</table>
</form>
<table align="center">
<tr>
<?php
echo "<td><h3> <a href='ver_pedidos.php?servidos=0 target='_self'> Pedidos Pendientes </a></h3></td> ";
?>

	<td></td>
	<td></td>
	<?php
	echo "<td><a href='ver_pedidos.php?servidos=1  target='_self'>Pedidos Servidos</a></td>";
	?>
</tr>
</table>
<?php
}

function consultar_pedido($ref,$servido)
{
include("biblioteca_vars.php");
$conn = db_connect();
	$result = mysql_query("SELECT * FROM pedidos WHERE ref='$ref' ");
	//if (!$result)
	if (mysql_num_rows($result)<1)
	echo "No hay ningún pedido que concuerde con esa referencia de pedido, Gracias<br> ";
	else
	{
	$result = mysql_fetch_array($result);
	$total=$result['total'];
	$articles=datos_pedido($ref);
	?>
<table width="100%" height="342" border="0" cellpadding="4" cellspacing="4" bordercolor="#FFFFFF" >
<tr><td height="334" valign="top">
<?php
echo "<a href='$PHP_SELF?imprimir=0&ref=$ref'>$datos_factura</a>";;
?>
<td width="27%" valign="top">
<table width="100%" align='center' cellpadding="2" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
<tr>
<td> </td>
</tr>
<tr><th colspan='5' align='center'>&nbsp;</th></tr>
<tr><th colspan='5' align='center'>&nbsp;</th></tr>
<tr><th colspan='5' align='center'>DATOS DE ENVIO </th></tr>
<tr><td width="68%" colspan='4'   ><?php print  $result['name'] ;?> <?php print " ".$result['surname'] ;?></td>
</tr>
<tr><td width="68%" colspan='4'  ><?php print  $result['address'];?>          </tr>
<tr><td colspan='5'  ><?php print $result['city'];?>  -<?php print  $result['zip'];?></td></tr>
<tr><td colspan='4'  ><?php print $result['state'];?></td></tr>
<tr><td colspan='4'  ><?php print $result['country'];?></td></tr>
<tr><td class='datos_envio' colspan='4' > <?php if ($result['telf']!=0) print $result['telf']; ?>
 Tel&eacute;fono: <?php print $result['movil'];?>            </td>
</tr>
<tr><td class='datos_envio' colspan='4' > Modo de pago:<?php if  ($result['modo']==1)
print "Transferencia o ingreso";
else
print "Contrareembolso"; ?></td>
</tr>
<tr>
<?php print "<td colspan='4' >
<a href='../../mails/mail_confim_existencias.php?email=$result[email]&ref=$ref&portes=".$_SESSION[portes]." '>
".$result['email']."</a></td>
</tr>";?>
</table ></td>
</tr>
<?php
		if ($_GET['imprimir']==1)
		{


		//Si hacemos clic en imprimir ya no sale el MENU OPCIONES para que el cliente no lo vea en el tiket
		//y se retaen los art�culos de stock VER MAS ABAJO
		}
		if ($_GET['imprimir']!=1)
		{

		//Creamos otra nueva funci�n para que al imprimir la factura para el cliente NO SALGAN LOS DATOS DEL MEN�
		?>
		<tr>
		<td colspan="2" align="center"> <?php echo menu_factura ($servido,$ref) ;?>  </td>
		</tr>
		</table>
<?php			}
$email=$result['email'];
?>
</table>
<table border="1" width="70%" align="center">
<tr>
<td align="center"><B>Pedido Ref:</B>   <?php echo $ref; ?></b></td>
<td align="center"><B>FECHA</B> <?php echo fecha(); ?></td>
</tr>
</table>
<br>
<table border='0' align='center' width="100%">
<tr>
<td  align='center'  class='encabezadcos_tablas ' width="7%">Ref </td>
<td  align='center' class='encabezadcos_tablas '  >Nombre</td>
<td  align='center'  class='encabezadcos_tablas '>Unidades </td>
<td  align='center'  class='encabezadcos_tablas '>Precio </td>
<td  align='center' class='encabezadcos_tablas ' >Importe</td>
</tr>
<?php
//inicializamos total a 0
$total=0;
?>
<form method="post" action="<? $PHP_SELF ?> " name="form1">
<?php
foreach($articles as $row)
{
$artid=$row['artid'] ;

// Función para saber referencia y datos del artículo.
$arts_datos = arts_info ($row['artid']);
if (!$arts_datos)
echo "No hay datos<br>";

$unidades=$row['unidades'];
if ($unidades==0)
$unidades="NULO";
$total+= $arts_datos['art_price']*$unidades ;

//Guardamos las unidades y la Id del art�culo en un array
$arts_unidades_array[$artid] = $unidades;
if ( !$_SESSION['arts_unidades_array']){
  $_SESSION['arts_unidades_array'] = $arts_unidades_array;
}
?>
<tr>
<?php
if ( !$_POST['ref'] )
{
?>
<td width="7%" class="items"><div align="center">
<?php echo $arts_datos['ref'] ?></div></td>
<?php
}
else
{
    ?>
    <td width="30%" class="items"><div align="center">
    <?php $_POST['ref'] ?></div></td>
    <?php
}
if ( !$_POST['name'] )
{
    
    ?>
    <td width="30%" class="items"><div align="center">
           <?php print $row['nombre'] ;?></div></td>
    <?php
}
else
{
    ?>
    <td width="10%" class="items"><div align="center"><?php print $row['nombre']; ?>/div></td>
    <?php
}
if ( !$_POST['unidades'] )
{
?>
    <td width="20%"><div align="center"><?php print $unidades ?></div></td>
    <?php
}
else
{
?>
    <td width="20%"><div align="center"><?php print $_POST['unidades']; ?></div></td>
    <?php
}
if ( !$_POST['price'] )
{
?>
    <td width="20%"><div align="center"><?php echo redondear_dos_decimal($arts_datos['art_price']); ?> </div></td>
    <?php
}
else
{
?>
    <td width="20%"><div align="center"><?php  print redondear_dos_decimal($arts_datos['art_price']);?></div></td>
    <?php
}
if ( !$_POST['price_tot'] )
{
?>
    <td width="20%"><div align="center"><?php  print redondear_dos_decimal($arts_datos['art_price']*$unidades); ?></div></td>
    <?php
}
else
{
?>
    <td width="20%"><div align="center"><?php print $_POST['price_tot']*$unidades; ?>"</div></td>
    <?php
}?>
</tr>
<tr><td colspan="8"> <hr /> </td></tr>
<?php
		}//fin foreach
		?>
		<tr>
             <td  colspan="4"  align="right" class="items" >Suma: </td>
            <td align='right'  class="precio" >
              <?php echo  redondear_dos_decimal($total); ?>  &euro;
             </td>
            </tr>
            <tr>
             <td  colspan="4"  align="right" class="items" >Portes: </td>
           <td align="right"  class="precio"  >
           <?php echo  $_SESSION['portes']; ?>
           </td>
             </tr>
	<tr>
	<?php
//$total_pagar=calcula_total($total,$_SESSION['portes']);
 $total_pagar=$total+$_SESSION['portes'];

//$base_imponible=$total_pagar/1.18;
$base_imponible=$total_pagar/1.21; //cambiamos al 21%
$iva=$total_pagar - $base_imponible;


	?>
	<tr>
	<td  colspan="4"  align="right" class="items" >Importe Total : </td>
	 <td align='right'  class="precio" >
         <?php echo redondear_dos_decimal($total_pagar) ?> &euro;
        </td>
        </tr>
        <tr>
<td  colspan="4"  align="right" class="items" >IVA aplicado 21% : </td>
        <td align='right'  class="precio" >

       <?php echo $iva=redondear_dos_decimal($iva); ?> &euro; </td>
       </tr>
      </table>
     <br /><br />
<table>
     <?php
	}
        ?>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
<tr><td></td></tr>
</table>
<table border='0' align='center' width="100%">
		<tr>
		<?php
		if ( $_GET['imprimir']!=1 )
		{
		?>
		<td align='left' ><a href='consulta_pedidos.php'> Ver Más Pedidos </a></td>
		<?php
		}
		if ($_GET['imprimir']!=1)

		{
		?>
			<td align='left'  >	<a href='#'  onclick='AbreVentanaPortes() ;'>
			 Insertar Portes</a> </td>

		<td align='right' >	<a href='retraer_stock.php?ref=$ref'>
			 RETRAER STOCK </a> </td>
	<?php
		}

		?>
		</tr>

 <tr>
 <td align='left' ><font size="-4" >La mercancía enviada por Gloria Botonero mediante la agencia Tourline Express está asegurada. Cualquier rotura o desperfecto causado durante el transporte, deberá ser comunicado a Gloria Botonero en un plazo máximo de 24 horas desde la recepción del paquete, de lo contrario se entenderá que se ha recibido en perfecto estado y no procederá la reclamación de la misma."
"La mercancía que viaje por otro medio de transporte, será responsabilidad del cliente".</font>
</td>
</tr>
</table>
<?php
}
//inserta los datos del cliente en la tabla "pedidos" y nos devuelve el numero de referencia de ese pedido
function get_ref($name,$surname,$address,$city,$state,$zip,$country,$email,$total,$telf,$movil,$modo)
{
$date=date("j,�n,�Y");
$query ="insert into pedidos values
 		('','$name','$surname','$address','$city','$state','$zip','$country','$email','$total','$telf','$movil','$modo','$date')";
$result=mysql_query($query);
if (!result)
return false;
else
{
$query="SELECT ref FROM pedidos  ORDER BY ref DESC LIMIT 1 ";
$result=mysql_query($query);
if (!$result)
	return false;
	if ($result)
	{
	$result = mysql_fetch_array($result);
	return $result; //guarda los resultados en un array
       }
}
}
//Actualizamos el campo "servido" con el valor '1' "TRUE" ,q significa que el pedido ya esta servido
//tambi�nb actualizamos el stok de cada uno de ellos
function pedidos_servidos($ref)
{
$conn = db_connect();
$query = "update pedidos_articulos
             set servido='1'
			 where ref='$ref' ";
 $result = @mysql_query($query);
   if (!$result)
     return false;
   else
   return true;
 }

//FUNCION COMPROBADA
function consulta_unidades($artid) {
$conn = db_connect();

//Consultamos unidades disponibles de un art�culo en concreto "artid"
$consulta_almacen=mysql_query("SELECT unidades FROM almacen
						  			   WHERE artid='$artid' ");

$almacen=mysql_fetch_array($consulta_almacen);
if (!$consulta_almacen)
echo "No existencias";
else
return $almacen['unidades'];
}
//FUNCION COMPROBADA
function update_stok($stok,$artid)
{
$conn = db_connect();
//Actualizamos el Stock de cada articulo del pedido
$result =mysql_query ("update almacen
                       set unidades='$stok'
                       where artid='$artid' " );
if (!$result)
return false;
else
return true;
}
function pregunta_borrar($ref,$option)
{
echo "<table align='center'><tr> <td class='importante'> �Esta seguro de que desea borrar este pedido? :RECUERDE QUE LOS PEDIDOS BORRADOS SE PERDER�N PARA SIEMPRE</td></tr>";
echo "<tr><td><a href='pagados.php?ref=$ref&option=1'>SI</a></td>
	<td></td>	<td></td>	<td></td>	<td></td>
	<td><a href='pagados.php?option=0'>NO</a></td></tr>";
?>
</table><br>
<?php
}
function su_pedido () {
ob_start();
echo "<table border='0' width='100%' class='mail'><tr><td colspan='3' class='carrito_ver'><b>SU PEDIDO</b></td></tr>
<tr bgcolor='#9292C8'>
<td> Art�culo </td> <td> Unidades </td> <td> Total </td>
</tr>";
for ($i=0 ; $i < $_SESSION["ocarrito"]->num_productos ; $i++ )
{
//Si array_id_art[$this->num_productos] es = a 0 significa que es un art�culo eliminado de la cesta
if ($_SESSION["ocarrito"]->array_id_art[$i] !=0)
{
echo "<tr bgcolor='#CBCED8'>
<td>" .$_SESSION["ocarrito"]->array_name[$i]." </td>";
echo " <td>".$_SESSION["ocarrito"]->array_qty[$i]." </td>";
echo " <td>".$_SESSION["ocarrito"]->array_price_total[$i]." � </td> </tr>";
}}
?>
</table>
<?php
return ob_get_clean();
}
function precio_articulo($artid)
{
$conn = db_connect();
		  //Consultamos el precio unitario de cada art�culo para luego dividir el total entre esta cantidad
						  //y saber el n�mero de unidades de cada art�culo pedido
$result = mysql_query("SELECT art_price
		       FROM articles
		       WHERE artid='$artid' ");

if ($result)
{
 $articles_price = mysql_fetch_array($result);
 return  $articles_price;
}
else
return false;
}

/*
 * Opciones de edición del pedido
 */
function menu_factura ($servido,$ref){
?>
<table align="center" cellpadding="4">
<tr>
<td><a href='borrar_pedidos.php?ref=<?php echo $ref ?>' >BORRAR  </a> </td><td></td>
<td> <a href='<?php echo $PHP_SELF; ?>?imprimir=1&ref=<?php echo trim($ref);?>' >  PANTALLA IMPRIMIR </a> </td>
</tr>
<?php
//Si estamos viendo los ya archivados entonces no necesitamos la opci�n de archivar
if ($servido != 1)
echo "<tr>
<td>
<a href='archivar_pedidos.php?ref=$ref '  >ARCHIVAR 	              </a></td><td></td>
<td>
<a href='edit_pedido.php?ref=$ref ' >EDITAR</a></td>
     </tr>";
}
?>
</table>
<?php


function buscar_mail_pedido($ref) {
$conn = db_connect();
$result = mysql_query("SELECT email
		       FROM pedidos
		       WHERE ref='$ref' ");
if ($result)
{
 $pedido = mysql_fetch_array($result);
 return  $pedido['email'];
}
else
return false;
}
function precio_pedido ($ref) {
$conn = db_connect();
$result = mysql_query("SELECT precio
		       FROM pedidos_articulos
		       WHERE ref='$ref' ");
//Si obtenemos resultado dele pedido ahora buscamos las unidades de cada art�culos pedidas
if ($result)
{
$articles = db_result_to_array($result);
}
else
return false;
//inicializamos total a 0
$total=0;
foreach($articles as $row)
{
$total+= $row['precio'] ;
}
return $total;
}
function calcula_re($activar,$total,$portes) {
//Si pulsamos activar Re creamos la sesi�n RE
if ($activar==1)
{
$_SESSION['re']=($total+$portes)*0.04;
//Activamos o desactivamos el RE
?>
<td align='left'>	<a href='<?php $PHP_SELF ?>?imprimir=0&ref=<?php echo $_GET['ref']; ?>&activar_re=2'  >
Desactivar RE</a> </td>
<?php
}
//Si el Re NO est� activado entonces saldra Activar RE
if ($activar!=1)
{
//Si existe la sesi�n re "desregistrarla"
if ($_SESSION['re'])
session_unregister('re') ;
?>
<td align='left'><a href='<?php echo $PHP_SELF; ?>?imprimir=0&ref=<?php echo $_GET['ref']; ?>&activar_re=1'  >
Activar RE</a> </td>
<?php
}
}
function calcula_total($total,$portes) {
$result=($total+$portes)*1.18;
return $result;
}
function pedido($ref,$envio) {
$conn = db_connect();
$result = mysql_query("SELECT *
		       FROM pedidos_articulos
		       WHERE ref='$ref' ");
if (!$result)
return 0;
 $pedido =db_result_to_array($result);
 //creamos tabla con el pedido entero
 ob_start();
 ?>
 <table border='0' width='100%' class='mail'><tr><td colspan='3' class='carrito_ver'><b>SU PEDIDO</b></td></tr>
<tr bgcolor='#9292C8'>
<td> Artículo </td> <td> Unidades </td>
</tr>
<?php
$total=0;
 foreach ($pedido as $row )
 {
 $total=$total+$row['precio'];
?>
<tr bgcolor="#CBCED8">
<td><?php echo $row['nombre'] ?></td><td><?php echo $row['precio'] ?> €</td>
</tr>
<?php
}
?>
<tr>
    <td colspan="2" align="right"><b>Total: </b><?php echo $total ;?> €</td>
</tr>
</table>
<?php
return ob_get_clean();
}
function datos_cliente($ref) {

$conn = db_connect();
$result = mysql_query("SELECT *
		       FROM pedidos
		       WHERE ref='$ref' ");
if (!$result)
return 0;
$pedido =mysql_fetch_array($result);
//creamos tabla con el pedido entero
ob_start();
?>
<table border='0' width='100%' class='mail'><tr>
<td colspan='3' class='carrito_ver'><b>Sus datos de envío</b></td>
</tr>
<tr bgcolor='#9292C8'><td class="mini_text"> Nombre </td><td class="mini_text"> Dirección</td><td class="mini_text"> Ciudad</td> 	                      
    <td class="mini_text">Provincia </td><td class="mini_text">CP</td><td class="mini_text"> País</td>
</tr>
<tr bgcolor="#CBCED8">
<td class="mini_text"><?php echo $pedido['name'] ?> </td><td class="mini_text"> <?php echo $pedido['address'] ?>
</td><td class="mini_text"><?php echo $pedido['city'] ?> </td>
<td class="mini_text"><?php echo $pedido['state'] ?>  </td><td class="mini_text"> <?php echo $pedido['zip'] ?>
</td><td class="mini_text"> <?php echo $pedido['country'] ?> </td>
</tr>
<tr bgcolor='#9292C8'>
<td class="mini_text"> Email</td> <td class="mini_text">Teléfono</td> <td class="mini_text"> Movil</td>
<td class="mini_text"> Fecha</td>
</tr>
<tr bgcolor="#CBCED8">
<td class="mini_text"> <?php echo $pedido['email']; ?> </td> <td class="mini_text"><?php echo $pedido['telf'] ?>
</td>
<td class="mini_text"> <?php echo $pedido['movil']; ?> </td>
<td class="mini_text"> <?php echo fecha(); ?> </td>
</tr>
</table>
<?php
return ob_get_clean();
}
function edit_pedido($ref) {
$conn = db_connect();
$query = mysql_query("SELECT *
		      FROM pedidos_articulos
		      WHERE ref='$ref' ");
	$result=db_result_to_array($query) ;
	mysql_free_result($query);
	if (!$result)
	return false;

        return $result;
}
function update_articles_pedido($article) {
//return count($articles);
$conn = db_connect();
for ($i=0;$i<count($article);$i++) {
//En el caso de que seleccione -1 no se actualiza el artículo ,sino que se borra
if ($article[$i][1] == -1)
$sSQL=" DELETE from pedidos_articulos
        WHERE pedidoid ='".$article[$i][0]."'  ";
else {
 	$sSQL = "UPDATE  pedidos_articulos
             	 SET unidades='".$article[$i][1]."'
		 WHERE pedidoid ='".$article[$i][0]."' ";
		}
	$result=mysql_query($sSQL)or die(mysql_error());
	if (!$result)
	return 0;
	}
	return 1;
}
function datos_pedido($ref) {
$connect=db_connect();
if (!$connect)
return 0;
	$result = mysql_query("SELECT *
			       FROM pedidos_articulos
			       WHERE ref='$ref' ");
	//Si obtenemos resultado dele pedido ahora buscamos las unidades de cada art�culos pedidas
	if ($result)
	{
	$articles = db_result_to_array($result);

	}
	else
	return false;
	return  $articles;
	}
function add_new_art($ref_art,$ref_pedido,$items_art) {
$connect=db_connect();
if (!$connect)
return 0;
//obtenemos todos los datos del articulo cuya referencia es ref
if (!$article=ask_art_by_ref($ref_art))
return false;
//Comprobamos que el art�culo no est� ya a�adido a el pedido
$Ssql="SELECT * FROM pedidos_articulos
		WHERE ref='".$ref_pedido."'
		AND artid='".$article[artid]."' ";
$result=mysql_query($Ssql);
$num_arts = mysql_num_rows($result);
   if ($num_arts == 0)
    {
                $query ="insert into pedidos_articulos values
 		('','$article[artid]','$ref_pedido','$article[art_name]','$items_art','$article[art_price]','0')";

		if ( !mysql_query($query) )

		return 2;

		return 1;

		}
	else
return 3;
}
