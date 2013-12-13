<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Factura</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">


function AbreVentanaPortes()  {
    //sustituir ejemplo.html por la ruta y nombre de la pagina a cargar en la ventana
    window.open("inserta_portes.php?sid=<?=$sid?>","" ,"" ,"width=40,heigth=20")
}
</script>
<style type="text/css">
<!--
.style1 {font-size: 9px}
-->
</style>
</head>

<body background="../../../img/marcadAgua.jpg">
<?
@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
require ("../stock_fns.php");
require ("../pedidos_fns.php");

if ($_GET['salir']==1)
session_destroy();

//Variables de sesión con los datos de  la factura ,fecha y número
if ($_POST['fecha'] )
$_SESSION['factura']['fecha']=$_POST['fecha'];
if ($_POST['num_fact'] )
$_SESSION['factura']['num_fact']=$_POST['num_fact'];
if ($_POST['forma_pago'] )
$_SESSION['forma_pago'] = $_POST['forma_pago'];

//Si hemos rellenado los datos del clientes creamos la sesión cliente
if ($_POST['cliente'] )
{
if ($_POST['rsocial'] )
$_SESSION[cliente][rsocial]=$_POST['rsocial'];
if ($_POST['nif'] )
$_SESSION[cliente][nif]=$_POST['nif'];
if ($_POST['adress'] )
$_SESSION[cliente][adress]=$_POST['adress'];
if ($_POST['city'] )
$_SESSION[cliente][city]=$_POST['city'];
if ($_POST['cp'] )
$_SESSION[cliente][cp]=$_POST['cp'];
if ($_POST['state'] )
$_SESSION[cliente][state]=$_POST['state'];
if ($_POST['telf'] )
$_SESSION[cliente][telf]=$_POST['telf'];
if ($_POST['celular'] )
$_SESSION[cliente][celular]=$_POST['celular'];
if ($_POST['email'] )
$_SESSION[cliente][email]=$_POST['email'];

}

if (!$_GET['continuar'])
{
$continuar=1;
$next=0;
}
else if ($_GET['continuar'])
$continuar=$_GET['continuar'];


/*
$total= total compra
$_SESSION['portes'] = portes insertados por el administrador
$descuento = descuento opcional 

*/
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#003366">
 <tr >
 <td align="left">
 
   <?
echo "<a href='$PHP_SELF?imprimir=0'>$datos_factura </a>";


?>   </td>
 <td width="100%"  align="left">
   <table width="80"  border="0" >
  <tr>
      <td ><label> 
      <div align="left" class='items'><? echo  $_SESSION[cliente][rsocial] ?> </div>
      </label></td>
  </tr>
  <tr>
      <td ><div align="left" class='items'> NIF: <? echo  $_SESSION[cliente][nif] ?></div></td>
  </tr>
  <tr>
      <td ><div align="left" class='items'><? echo  $_SESSION[cliente][adress] ?></div></td>
  </tr>
  <tr>
      <td ><div align="left" class='items'><? echo $_SESSION[cliente][city] ?> <? echo  $_SESSION[cliente][cp] ?> </div></td>
  </tr>
   <tr>
      <td ><div align="left" class='items'> <? echo  $_SESSION[cliente][state] ?> </div></td>
  </tr>


    

  <tr>
    <td align="left" ><div class='items'><? echo  $_SESSION[cliente][telf]."-".$_SESSION[cliente][celular] ?></div>
      <div align="right"></div></td>
  </tr>
  <tr>
    <td ><div align="left" class='items'><? echo  $_SESSION[cliente][email] ?></div>
      <div align="right"></div>
      <div align="right"></div></td>
  </tr>
</table>
</table>
<?
if (!$_GET['pagina'] )
 $pagina=1;
 else
 $pagina=$_GET['pagina'];
 if ($_GET['next'])
 { 
  //contador para saber en que resutado seguir
// $siguiente=$_GET['next'];
 $contador=$_GET['next'];
 $next=$_GET['next'];
 }
 else
 {
 $siguiente=0;
$next=0;
 }

?>
<table border="1" width="80%" align="left">    
  <tr>
  <td>
  <? echo "Página ".$pagina; ?>   </td>
  
      <td> Fecha:
<? echo $_SESSION['factura']['fecha'] ?>          </td>
          <td>
          Número factura: <? echo $_SESSION['factura']['num_fact'] ?>          </td>
</td>
</tr>
</table>
<p>&nbsp;</p>
<table align="center" cellpadding="0" cellspacing="0" width="101%">
    <tr>
      <td width="10%" class="enunciados" align="center">Referencia</td>
            <td width="50%" class="enunciados" align="center">Artículo</td>
      <td width="10%" class="enunciados" align="center">Unidades</td>
      <td width="10%" class="enunciados" align="center">Precio</td>
	  <td width="20%" class="enunciados" align="center">Total</td>
  </tr>
  
    <span class="enunciados">
    <?
/*
Comprobamos se se han activado variables
como RE , discount etc etc
*/
if ($_GET['re']==1)
$_SESSION['re']=1;

else if ($_GET['re']==2)
unset( $_SESSION['re']);


if ($_POST['discount']!=0 )
$_SESSION['discount']=$_POST['discount'];

if ($_POST['discount']==-1)
 unset( $_SESSION['discount']);
 
 //Llenamos la tabla con todos los artículos del pedido
 $j=0; //contador para paginar resultado

 
		  for ($i=$next ; $i<$next+$articulos_por_page ; $i++)
			{
			 //Para que no muestre las filas vacias
			 // esto $_GET['continuar']==1  es para paginar los resultado de 15 en 15
		  	if ($_SESSION['pedidos'][$i][2] * $_SESSION['pedidos'][$i][3] !=0 && $continuar==1 )
		  		{	
					//Comprobamos de que esta referencia existe en nuestra Bd
					if ( ask_exists($_SESSION['pedidos'][$i][0])==0 && $_GET['imprimir']!=1)
					$color="yellow";
					
					else 
				
					$color= "white";
					
					$artid_array=ask_exists( $_SESSION['pedidos'][$i][0] );
					
					if ( $artid_array && $_GET['stock_discount']==1 )
					{	
					
						if (stock_discount ($artid_array['artid'], $_SESSION['pedidos'][$i][2]  ) )
						echo "<i>Se han descontado correctamente la cantidad de:<b>  ".$_SESSION['pedidos'][$i][2].
						"  </b>del artículo:  <b>". $_SESSION['pedidos'][$i][1]. " </b>del stock.</i> <br>";
						else
						echo "NO se han podido descontar del stock la cantidad de:<b>  ".$_SESSION['pedidos'][$i][2].
						"  </b>del artículo:  <b>".$_SESSION['pedidos'][$i][1]. "  </b>, inténtelo más tarde.
						".$artid_array['artid']." <br>";
						
						
					}
					
		  ?>
    </span>
    <tr>
    <td bgcolor="<? echo $color ?>"  class='items' align="center"><? echo $_SESSION['pedidos'][$i][0] ?></td>
    <td   class='items' align="center"><? echo $_SESSION['pedidos'][$i][1] ?></td>
    <td  class='items' align="center"><? echo $_SESSION['pedidos'][$i][2] ?></td>
    <td  class='items' align="center"><? echo $_SESSION['pedidos'][$i][3] ?> €</td>
	<td  class='items' align="center"><? echo $_SESSION['pedidos'][$i][2] * $_SESSION['pedidos'][$i][3] ;
			?> €</td></tr>

		  	<?
			$j++;
			//$_SESSION['suma_total']+=$_SESSION['pedidos'][$i][2] * $_SESSION['pedidos'][$i][3];
			}
				if ($j==$articulos_por_page)
			
				$continuar=2;
				
			}
			if ($_GET['imprimir']!=1)
			{
				?>
				<table align="center" width="60%">	
				<?	
				if ($next >0)
					{
				?>	
				<td><a href='<? $PHP_SELF ?>?continuar=1&next=<? echo $next-$articulos_por_page ?>&pagina=<? echo $pagina-1 ?>'>Anteriores  </a> </td>
				<?
					}
				if ($j > 4)
				{
				?>
				<td><a href='<? $PHP_SELF ?>?continuar=1&next=<? echo $next+$articulos_por_page ?>&pagina=<? echo $pagina+1 ?>'>Siguiente  </a> </td>
				<?
				}
			}
			?>
			 </tr>

			<?
		
			//Calculamos el total con iva , re y descuento si lo hubiera

			if ($_SESSION['re'] )
	$apagar=($_SESSION['suma_total']+$_SESSION['portes'] -$_SESSION['discount']) * 1.16 + 
		 	($_SESSION['suma_total']+$_SESSION['portes'] -$_SESSION['discount']  ) * 0.04 ;
			else
	$apagar=($_SESSION['suma_total']+$_SESSION['portes']-$_SESSION['discount'] )  *  1.16 ;

			?>

</table>
<div align="center"></div>
<div align="center"></div>
<?

if ($_GET['VerTotal']==1)
{
?>
<br /><br />
<table width="100%" border="0" align="right">


  <tr>
  <td align="center" class="enunciados"> Forma de pago:  <? echo  $_SESSION['forma_pago'] ?>   </td>
   <td align="center" class='items' width="20%" >Suma: <? echo $_SESSION['suma_total'] ?> € </td>
  </tr>
  	<tr>
        <td> </td>

	<td align="center" class='items'>
	Portes:</h5> <? echo $_SESSION['portes'] ?> €	</td>
	</tr>
    <?
	if ($_SESSION['discount'] )
	{
	?>
    <td> </td>
	<td align="center" class='items' width="20%"  >
	Descuento:</h5> <? echo $_SESSION['discount']; ?> €	</td>
	<?
	}
	?>
    	<tr>
            <td> </td>

	<td align="center" class='items' width="20%" >
	IVA </h5>  16% :<? echo ($_SESSION['suma_total']+$_SESSION['portes']-$_SESSION['discount'])*0.16 ;?>
	<tr>
    <tr>
        <td> </td>

	<td align="center" class='items' width="20%" >
	RE:</h5>  4% : <? echo ($_SESSION['suma_total']+$_SESSION['portes'] -$_SESSION['discount'] ) * 0.04 ;?></td>
	</tr>

    
		<?
	if ($_SESSION['re'])
	{
	?>
	
	<?
	}
	?>
	
		<tr>
	
	</tr>
<tr>
    <td> </td>

    <td align="center" class='items' width="20%"  >
	
	Total:</h5> <? echo $apagar." € ";?></td>
  </tr>
	<tr>  </tr>
  </table>

<br /><br /><br /><br /><br /><br /><br /><br />
  <table border="0">
 <tr>
 <td align='left'  class='peq'>La mercancía enviada por Gloria Botonero mediante la agencia Tourline Express está asegurada. Cualquier rotura o desperfecto causado durante el transporte, deberá ser comunicado a Gloria Botonero en un plazo máximo de 24 horas desde la recepción del paquete, de lo contrario se entenderá que se ha recibido en perfecto estado y no procederá la reclamación de la misma."

"La mercancía que viaje por otro medio de transporte, será responsabilidad del cliente".</td>
</tr>
</table>
<?
}
//Mostrar menú administrador SOLO si imprimir no vale 1 ,sino hemos dado clik a Pantalla imprimir
if ($_GET['imprimir']!=1)
{
?>
<table width="100%" border="1" cellpadding="8" cellspacing="8">
  <tr>
    <td colspan="7" class="anadir_cesta"><div align="center">Menu del Administrador de facturas <a href='<? $PHP_SELF ?>?salir=1'>Salir- <span class="style1">dos cliks </span></a></div></td>
  </tr>
  <tr>
    <td height="19" colspan="7" valign="top" class="anadir_cesta"><form id="form3" name="form3" method="post" action="">
        <label>        </label>
        <label></label>
    </form>    </td>
  </tr>
  <tr>
    <td width="10%" valign="top" class="anadir_cesta"><a href="<? $PHP_SELF ?>?next=<? echo $next ?>&amp;pagina=<? echo $pagina ?>">ACTUALIZAR</a></td>
    <td width="9%" valign="top" class="anadir_cesta"><span class="anadir_cesta">
      <? 
	if ($_SESSION['re'])
	{
	 ?>
      <a href="<? $PHP_SELF ?>?re=2&next=<? echo $next ?>&pagina=<? echo $pagina ?> " >
      <?
	 echo "Descativar RE</a>";
	 }
	 else if (!$_SESSION['re'])
	 {
	 ?>
      <a href="<? $PHP_SELF ?>?re=1&next=<? echo $next ?>&pagina=<? echo $pagina ?> " >
      <?
	 echo "Activar RE</a>";
	 }

	 ?>
    </span></td>
    <td width="5%" valign="top" class="anadir_cesta" ><a href='javascript:void(0)' onclick="AbreVentanaPortes();">portes</a></td>
    <td width="18%" valign="top" class="anadir_cesta"><form id="form1" name="form1" method="post" action="">
      <div align="left">
        <p align="center"><strong>Descuento</strong></p>
        <p align="center">
            <input name="discount" type="text" id="discount" size="8" />
            <input type="submit" name="Submit" value="Actualizar" />
          </p>
        <div align="center">poner -1 para anular </div>
        </label>
        <label> </label>
        <p>&nbsp; </p>
      </div>
    </form></td>
    <td width="11%" valign="top" class="anadir_cesta"><a href="<? $PHP_SELF ?>?imprimir=1&amp;next=<? echo $next ?>
	&amp;pagina=<? echo $pagina ?>">Imprimir p&aacute;gina: <? echo $pagina ?></a></td>
    <td width="9%" valign="top" class="anadir_cesta"><p><a href="<? $PHP_SELF ?>?imprimir=1&amp;next=<? echo $next ?>&amp;VerTotal=1">TOTAL</a></p>
    <p><a href='<? $PHP_SELF ?>?stock_discount=1'>STOCK</a><a href='<? $PHP_SELF ?>?salir=1'></a></p></td>
    <td width="38%" valign="top" class="anadir_cesta">
    <form name='customer' method="post" action="<? $PHP_SELF ?>">
    <table width="90%" border="0">
      <tr>
        <td colspan="2"><div align="center">Datos Factura</div></td>
      </tr>
      <tr>
        <td align="right"><div align="right">Num factura</div></td>
        <td align="left"><input type="text" name="num_fact" id="num_fact" /></td>
      </tr>
      <tr>
        <td align="right"><div align="right">Fecha</div></td>
        <td align="left"><input type="text" name="fecha" id="fecha" /></td>
      </tr>
       <tr>
        <td align="right"><div align="right">Forma pago</div></td>
        <td align="left"><input type="text" name="forma_pago" id="forma_pago" maxlength="90" /></td>
      </tr>
      <tr>
        <td height="39" colspan="2"><label>
            <div align="center">
              <input type="submit" name="factura" id="factura" value="Actualizar factura" />
            </div>
          </label></td>
      </tr>
    </table>
    </form>    </td>
  </tr>
  <tr>
    <td height="115" colspan="7" class="anadir_cesta"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <form id="form2" name="form1" method="post" action="">
          <tr>
            <td colspan="2"><div align="center" class="input">Datos Cliente </div></td>
          </tr>
          <tr>
            <td width="45%"><div align="right">Raz&oacute;n social </div></td>
            <td width="55%"><label>
              
              <div align="left">
                <input name="rsocial" type="text" id="rsocial" />
                </div>
            </label></td>
          </tr>
          <tr>
            <td><div align="right">NIF</div></td>
            <td><div align="left">
              <input name="nif" type="text" id="nif" />
            </div></td>
          </tr>
          <tr>
            <td><div align="right">Direcci&oacute;n</div></td>
            <td><div align="left">
              <input name="adress" type="text" id="adress" />
            </div></td>
          </tr>
          <tr>
            <td><div align="right">Ciudad</div></td>
            <td><div align="left">
              <input name="city" type="text" id="city" />
            </div></td>
          </tr>
          <tr>
            <td><div align="right">CP</div></td>
            <td><div align="left">
              <input name="cp" type="text" id="cp" />
            </div></td>
          </tr>
            <tr>
            <td><div align="right">Provincia</div></td>
            <td><div align="left">
              <input name="state" type="text" id="state" />
            </div></td>
          </tr>
          <tr>
            <td><div align="right">Tel&eacute;fono</div></td>
            <td><div align="left">
              <input name="telf" type="text" id="telf" />
            </div></td>
          </tr>
          <tr>
            <td><div align="right">Movil</div></td>
            <td><div align="left">
              <input name="celular" type="text" id="celular" />
            </div></td>
          </tr>
          <tr>
            <td><div align="right">Email</div></td>
            <td><div align="left">
              <input name="email" type="text" id="email" />
            </div></td>
          </tr>
          <tr>
            <td height="48" colspan="2"><label>
                <div align="center">
                  <input name="cliente" type="submit" id="cliente" value="Actualizar Cliente" />
                </div>
              </label></td>
          </tr>
        </form>
      </table>
     </td>
  </tr>
</table>
<?
}
?>
</body>
</html>
