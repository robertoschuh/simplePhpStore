<link href="carrito.css" rel="stylesheet" type="text/css" />
<?php
class carrito {
	//atributos de la clase
   	public $num_productos;
   	public $array_id_art;
	public $array_qty; //Cantidad de  unidades   de    cada art�culos
   	public $array_name;
        public $array_price;
	public $array_price_total;
	public $array_img;
	
	//constructor. Realiza las tareas de inicializar los objetos cuando se instancian
	//inicializa el numero de productos a 0

	public function carrito () {
   		//Cuando crea el objeto carrito inicia el contador de num_productos a 0
		$this->num_productos=0;
	}

    //Si un producto ya existe entonces actualiza la cantidad de este en array_qty[$pos]
	function introduce_producto($id_art,$nombre_prod,$precio_prod,$img,$ref,$qty  ){

    //inicioamos la variable exists a false
        $exist = false;
	if (@in_array($id_art,$this->array_id_art) )

	//Buscamos la posici�n el la que sa haya el art�culo para sumarle 1
		foreach ( $this->array_id_art as  $pos => $value )
		{
			if ( $id_art  == $value && $exist==false)
				{
				
				
		//Actualiza la cantidad de unidades de un art�culo determinado y llama a la funci�n que actualiza el precio        //total del art�culo
		 $qty=1;
		   			//$qty=$this->array_qty[$pos] + 1; //Esto para cuando se de un clic desde la tienda 
		   									
		//actualizamos las cantidades de los productos sum�ndoles 1 solamente
				 $this->array_qty[$pos]=$qty;
				 $this->update_cart ($pos,$qty);
				 $exist=true;
					
		 
		 		}
		 
		 }//fin del foreach
		
		if ($exist==false)
		{
			$this->array_qty[$this->num_productos]=1;

			$this->array_id_art[$this->num_productos]=$id_art;
			$this->array_name[$this->num_productos]=$nombre_prod;
			$this->array_price[$this->num_productos]=$precio_prod;
			$this->array_img[$this->num_productos]=$img;
			$this->array_price_total[$this->num_productos]=$this->array_price[$this->num_productos];
			
			 //guardamos el nombre de la imagen de cada producto en array
		//$this->array_ref_prod[$this->num_productos]=$ref;
		$this->num_productos++;
		}
	
	}
	//Funci�n que actualiza el carrito con los nuevos totales y nuevas cantidades
	public function update_cart($pos,$qty) 
	{
	//Actualizamos las cantidades del articulo que queremos
	$this->array_qty[$pos]=$qty;
	//Actualizamos el precio total multiplicando por la nueva cantidad el precio de una unidad
	$this->array_price_total[$pos]= $this->array_price[$pos] * $qty;

	}

	//Muestra el contenido del carrito de la compra
	//ademas pone los enlaces para eliminar un producto del carrito
	public function imprime_carrito($catid){
	
	include ("../php/idiomas/idiomas_fns.php");
		include ("../php/admin/admin_fns.php");


		$uservalid=is_registered_user ();
	
		$suma = 0;
		echo '<br><br><br><br><br><br>
			
			
				<table border=0 align="left" cellpadding="0" cellspacing="5" width="100%">
			<tr>
				<td colspan="7" align="center" class="titulos_texto">'. $uservalid .'</td>
				</tr>
				<tr>
				<td colspan="7" align="center" class="titulos_texto">'. $cesta .'</td>
				</tr>
				
				<tr>
				<td colspan="7"  align="center" class="textito">'. $textito_cesta .'</td>
				</tr>			  
			  <tr class="tablas_encabezados">
		        <td width="84"><div align="center" >'. $image.'</div></td>
				<td width="238"><div align="center" >'.$article. '</div></td>
				<td width="100"><div align="center" >'.$price.'</div></td>
				<td width="100"><div align="center" >'.$units.'</div></td>
				<td width="100"><div align="center" >Total</div></td>
			
			  </tr>';
			  

	for ($i=0;$i<$this->num_productos;$i++){
			if($this->array_id_art[$i]!=0){
				$img=$this->array_img[$i];
					  echo '<form id="form1" name="form1" method="post" action="update_carrito.php?catid=$catid">';

				echo '<tr >';
				echo "<td class='tablas_items'> <div align='center' > 
					<img  src='../../tienda_gloria/php/admin/panel/img/arts/$img' class='img_carrito'></div></td>"; 
				echo "<td class='tablas_items'><div align='center' >" . $this->array_name[$i] . "</div> </td>";
				echo "<td class='tablas_items'><div align='center' >" . $this->array_price[$i] . " &euro;</div></td>";
				echo "<td width='238' class='tablas_items'><div align='center' >
					<input name='qty'  type='text'  size='10' 
					value=".$this->array_qty[$i]."></div></td>";
					echo "<input name='pos' type='hidden' value=".$i." />";
				echo "<td  width='238' class='amount'><div align='center' >".$this->array_price_total[$i].
				" &euro;</div>
				</td> 
				<input name='catid' type='hidden' value='$catid'/>

				<td align='center' class='tablas_items'><input type='submit' name='Submit' value='Actualizar' /></td>

				</form>";


				if (!$pagar==1)
				
				echo " <td  class='tablas_items'><a href='eliminar_producto.php?linea=$i&catid=$catid'>
				<div align='center' class='boton' >".$delete."</div></td>";
				echo '</tr>';
				$suma += $this->array_price_total[$i];
				
			}
		}
		//muestro el total
		echo "<tr class='tablas_items'><td colspan='2'><div align='center'><b>TOTAL:</b></div></td><td> <div 	 align='center' ><b>$suma &euro;</b></div></td>
			</tr>";
		
		
		echo "<tr><td colspan='7'><div align='center' >
		  <table width='60%' border='0' align='center'>
            <tr>";
			if ($_SESSION['novedades']=='novedades')
			
            echo "  <td  align='center'><a href='../php/show_last_articles.php' class='boton'>".$comprar_mas."</a></td>
			<br><br>";
			  else
			    echo "  <td  align='center'><a href='../php/show_arts.php?catid=$catid' class='boton' >".$comprar_mas."</a></td>
				<br><br>";
			  //Si est� en la p�gina del formulario para rellenar los datos NO MOSTRAR BOTON PAGAR porque ya esta pagando
		if ( !( stristr ($_SERVER['PHP_SELF'],"envio_form.php") ) )// != "/tienda_gloria/carrito_php/envio_form.php" )
		  //  if ( $_SESSION['valid_user'] )

		echo "	  
           <td  align='center'><a href='envio_form.php?apagar=$suma&catid=$catid' class='boton'> $pay </a></td>";
		echo"	  
            </tr>
			
			</table>
			
				";

			
	}
	
	
	
	//elimina un producto del carrito. recibe la linea del carrito que debe eliminar
	//no lo elimina realmente, simplemente pone a cero el id, para saber que esta en estado retirado
	public function elimina_producto($linea){
		$this->array_id_art[$linea]=0;
	}

	
}//Fin de la clase "carrito"
//inicio la sesi�n
@session_start();
//si no esta creado el objeto carrito en la sesion, lo creo
if (!isset($_SESSION["ocarrito"])){
	$_SESSION["ocarrito"] = new carrito();
}	