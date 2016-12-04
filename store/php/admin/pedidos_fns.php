<?php

function pedido_add($id,$ref,$nombre,$precio_total){
	$precio_unidad= precio_articulo($id);
	$unidades=$precio_total/$precio_unidad[0];
	//Conecatamos a la Bd

	// se a�ade el campo a la bd "servido" que valdr� 0 "false" cuando se acabe de insertar en la bd,
	//es decir cuando a�n no se haya  servido

 	$query ="insert into pedidos_articulos values
 		('','$id','$ref','$nombre','$unidades','$precio_unidad[0]','0')";
	$result=mysql_query($query);

	if (!$result) { return false; }

	return true;

}

function consultar_pedido($ref, $servido){

	include("biblioteca_vars.php");
	$conn = db_connect();

	$result = mysql_query("SELECT * FROM pedidos WHERE ref='" .$ref. "' ");
	//if (!$result)
	if ( !$result OR mysql_num_rows($result) < 1 ){

		return FALSE;
	}

	$result   = mysql_fetch_array($result);
	$total    = $result['total'];
	$articles = datos_pedido($ref);

	// Datos factura view.
	include ('vistas/datos_factura.html.php');

		if ( isset($_GET['imprimir']) && $_GET['imprimir'] == 1 ){

			//Si hacemos clic en imprimir ya no sale el MENU OPCIONES para que el cliente no lo vea en el tiket
			//y se retaen los art�culos de stock VER MAS ABAJO
			?><h4><a href='http://gloriabotonero.dev/store/orders.php?ref=<?php echo trim($ref);?>'  target="_blank">  GENERAR PDF </a></h4><?php

		}
		if ( !isset($_GET['imprimir']) && $_GET['imprimir'] != 1 ){
			// Menu factura view.
			include ('vistas/menu_factura.html.php');
			
		}

		if ( isset($_GET['pdf']) ){
			generate_pdf($_GET['ref']);
		}

	$email = $result['email'];
	

	// Muestra los artículos comprados. 
	include ('vistas/pedido_lista.html.php');
}
//inserta los datos del cliente en la tabla "pedidos" y nos devuelve el numero de referencia de ese pedido
function get_ref($name,$surname,$address,$city,$state,$zip,$country,$email,$total,$telf,$movil,$modo){
	$date=date("j,�n,�Y");
	$query ="insert into pedidos values
	 		('','$name','$surname','$address','$city','$state','$zip','$country','$email','$total','$telf','$movil','$modo','$date')";
	$result=mysql_query($query);
	if (!$result) {return false;}

	$query="SELECT ref FROM pedidos  ORDER BY ref DESC LIMIT 1 ";
	$result=mysql_query($query);
	if (!$result) {return false;}
		
	$result = mysql_fetch_array($result);
	return $result; //guarda los resultados en un array
}
//Actualizamos el campo "servido" con el valor '1' "TRUE" ,q significa que el pedido ya esta servido
//tambi�nb actualizamos el stok de cada uno de ellos
function pedidos_servidos($ref){
	$conn = db_connect();
	$query = "update pedidos_articulos
	             set servido='1'
				 where ref='$ref' ";
	 $result = @mysql_query($query);
   if (!$result) {return false;}
   
   return true;
 }

//FUNCION COMPROBADA
function consulta_unidades($artid) {
	$conn = db_connect();

	//Consultamos unidades disponibles de un art�culo en concreto "artid"
	$consulta_almacen=mysql_query("SELECT unidades FROM almacen
							  			   WHERE artid='$artid' ");
	$almacen=mysql_fetch_array($consulta_almacen);
	if (!$consulta_almacen){
		echo "No existencias";
	}
	else{
		return $almacen['unidades'];
	}
}

function update_stok($stok,$artid){
	$conn = db_connect();
	//Actualizamos el Stock de cada articulo del pedido
	$result =mysql_query ("update almacen
	                       set unidades='$stok'
	                       where artid='$artid' " );
	if (!$result) {return false;}
	
	return true;
}
function pregunta_borrar($ref,$option){
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
	?><table border='0' width='100%' class='mail'>
		<tr>
			<td colspan='3' class='carrito_ver'><b>SU PEDIDO</b></td>		
		</tr>
		<tr bgcolor='#9292C8'>
			<td> Art&iacute;culo </td> <td> Unidades </td> <td> Total </td>
		</tr>
	<?php
	for ($i=0 ; $i < $_SESSION["ocarrito"]->num_productos ; $i++ ){
		//Si array_id_art[$this->num_productos] es = a 0 significa que es un art�culo eliminado de la cesta
		if ($_SESSION["ocarrito"]->array_id_art[$i] !=0){
			echo "<tr bgcolor='#CBCED8'>".
					  "<td>" .$_SESSION["ocarrito"]->array_name[$i]." </td>".
					  "<td>".$_SESSION["ocarrito"]->array_qty[$i]." </td>".
					  "<td>".$_SESSION["ocarrito"]->array_price_total[$i]." &euro; </td>". 
			 	  "</tr>";
		}
	}
	?>
	</table>
	<?php
	return ob_get_clean();
	}

function precio_articulo($artid){
	$conn = db_connect();
			  //Consultamos el precio unitario de cada art�culo para luego dividir el total entre esta cantidad
							  //y saber el n�mero de unidades de cada art�culo pedido
	$result = mysql_query("SELECT art_price
			       FROM articles
			       WHERE artid='$artid' ");

	if ($result){
	 $articles_price = mysql_fetch_array($result);
	 return  $articles_price;
	}
	
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
				<a href='archivar_pedidos.php?ref=" .$ref. "'>ARCHIVAR</a></td><td></td>
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
	if ($result) {
	 $pedido = mysql_fetch_array($result);
	 return  $pedido['email'];
	}

	return false;
}

function precio_pedido ($ref) {
	$conn = db_connect();
	$result = mysql_query("SELECT precio
			       FROM pedidos_articulos
			       WHERE ref='$ref' ");
	//Si obtenemos resultado dele pedido ahora buscamos las unidades de cada art�culos pedidas
	if ($result){
		$articles = db_result_to_array($result);
	}
	else { return false; }

	//inicializamos total a 0
	$total=0;
	foreach($articles as $row){
		$total+= $row['precio'] ;
	}
	return $total;
}
function calcula_re($activar,$total,$portes) {
	//Si pulsamos activar Re creamos la sesi�n RE
	if ($activar==1){
		$_SESSION['re']=($total+$portes)*0.04;
	//Activamos o desactivamos el RE
	?>
		<td align='left'><a href='<?php $PHP_SELF ?>?imprimir=0&ref=<?php echo $_GET['ref']; ?>&activar_re=2'  >
		Desactivar RE</a> </td>
	<?php
	}
	//Si el Re NO est� activado entonces saldra Activar RE
	if ($activar!=1){
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
	if (!$result) { return 0; }
	
	$pedido =db_result_to_array($result);
	//creamos tabla con el pedido entero
	ob_start();
	?>
	<table border='0' width='100%' class='mail'>
		<tr>
			<td colspan='3' class='carrito_ver'><b>SU PEDIDO</b></td>
		</tr>
		<tr bgcolor='#9292C8'>
			<td> Art&iacute;culo </td> <td> Unidades </td>
		</tr>
		<?php
		$total=0;
		foreach ($pedido as $row ){
			$total=$total+$row['precio'];
			?>
			<tr bgcolor="#CBCED8">
				<td><?php echo $row['nombre'] ?></td><td><?php echo $row['precio'] ?> &euro;</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="2" align="right"><b>Total: </b><?php echo $total ;?> &euro;</td>
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

	if (!$result) { return 0; }

	$pedido =mysql_fetch_array($result);
	//creamos tabla con el pedido entero
	ob_start();

	// Carga los datos del cliente.
	include('vistas/datos_cliente.html.php');
	
	return ob_get_clean();
}
function edit_pedido($ref) {
	$conn = db_connect();
	$query = mysql_query("SELECT *
			      FROM pedidos_articulos
			      WHERE ref='$ref' ");
	$result=db_result_to_array($query) ;
	mysql_free_result($query);
	if (!$result){
		return false;
	}

    return $result;
}
function update_articles_pedido($article) {
//return count($articles);
	$conn = db_connect();
	for ($i=0;$i<count($article);$i++) {
		//En el caso de que seleccione -1 no se actualiza el artículo ,sino que se borra
		if ($article[$i][1] == -1){
			$sSQL=" DELETE from pedidos_articulos
			WHERE pedidoid ='".$article[$i][0]."'  ";
		}
		else {
			$sSQL = "UPDATE  pedidos_articulos
			SET unidades='".$article[$i][1]."'
			WHERE pedidoid ='".$article[$i][0]."' ";
		}

		$result=mysql_query($sSQL)or die(mysql_error());
		if (!$result){
			return 0;
		}
	}
	return 1;
}
function datos_pedido($ref) {
	$connect=db_connect();
	if (!$connect){
		return 0;
	}
	$result = mysql_query("SELECT *
			       FROM pedidos_articulos
			       WHERE ref='$ref' ");
	//Si obtenemos resultado dele pedido ahora buscamos las unidades de cada art�culos pedidas
	if ($result){
	$articles = db_result_to_array($result);
	}
	else{
		return false;
	}
	
	return  $articles;
}

function add_new_art($ref_art,$ref_pedido,$items_art) {
	$connect=db_connect();
	if (!$connect)
	return 0;
	//obtenemos todos los datos del articulo cuya referencia es ref
	if (!$article=ask_art_by_ref($ref_art)) { return false; }
	
	//Comprobamos que el art�culo no est� ya a�adido a el pedido
	$Ssql="SELECT * FROM pedidos_articulos
			WHERE ref='".$ref_pedido."'
			AND artid='".$article[artid]."' ";
	$result=mysql_query($Ssql);
	$num_arts = mysql_num_rows($result);
	if ($num_arts == 0){
		$query ="insert into pedidos_articulos values
		('','$article[artid]','$ref_pedido','$article[art_name]','$items_art','$article[art_price]','0')";

		if ( !mysql_query($query) ){
			return 2;
		}

		return 1;
	}
	
	return 3;
	
}

function generate_pdf($ref) {

	require_once  '../../../../vendor/autoload.php';
	//print 'http://'.$_SERVER['PHP_SELF']; exit;

	$file = "../../../store/orders.php?ref=278";
	$html = file_get_contents($file);

	// instantiate and use the dompdf class
	$dompdf = new Dompdf\Dompdf();
	//$dompdf->loadHtml('hello world');
	//$dompdf->loadHtmlFile('http://masquebits.com');

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream('pedido-'.$ref);

}
