<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="JavaScript">

function CierraVentana() {

window.close();
}
function AbreVentanaPortes()  {
    //sustituir ejemplo.html por la ruta y nombre de la pagina a cargar en la ventana
    window.open("inserta_portes.php?sid=<?=$sid?>","" ," ","width=80,height=60")




}
</script>
</head>

<body>
<?
@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
require ("../stock_fns.php");
require ("../pedidos_fns.php");


$total=$_SESSION['portes'] + ($_SESSION['suma_total']*1.16) ;

?>

<table width="100%" height="342" border="0" cellpadding="4" cellspacing="4" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  <tr>
    <td height="334"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#003366">
      <tr>

        <td colspan="6">GLORIA BOTONERO <br />
N.I.F. 52240218-L <br />
C/ Carreras n� 58 <br />
41400 Ecija (Sevilla) <br />
Tfno.Fax 955904274 <br />
Email gloriabotonero@yahoo.es</td>
      </tr>
	  <tr>
	  <td colspan="6"> Visitanos en www.gloriabotonero.com</td>
	  
	  </tr>
	  <tr>
	  <?
	  if ($_GET['imprimir']!=1)
	  {
	  ?>
            <td colspan="4" align="left" ><? re($_GET['activar_re']); ?> </td>
          <?
	 }
	  ?>
	              <td colspan="2" align="left" >
				  <a href='<?=$PHP_SELF."?imprimir=1" ?>'" >
				   imprimir</a>
				   </td>
 
	  
          </tr>
      
	  <tr>

        <td height="146" colspan="5">
		<table width="100%" border="1" cellpadding="5" cellspacing="5" bordercolor="#003366" align="center">
          <tr>
            <td width="20%"><div align="center">Referencia</div></td>
            <td width="53%"><div align="center">Art�culo</div></td>
            <td width="53%"><div align="center">Unidades</div></td>
            <td width="27%"><div align="center">Precio</div></td>
			<td width="27%"><div align="center">Total</div></td>
          </tr>
		  			

		  <?
		  
		 
		  //Llenamos la tabla con todos los art�culos del pedido
		  for ($i=0 ; $i<=count($_SESSION['pedidos']) ; $i++)
			{
			 //Para que no muestre las filas vacias
		  	if ($_SESSION['pedidos'][$i][2] * $_SESSION['pedidos'][$i][3] !=0 )
		  		{	
					//Comprobamos de que esta referencia existe en nuestra Bd
					if ( !ask_exists($_SESSION['pedidos'][$i][0]) )
					$color="yellow";
					
					else
					$color="white";
					
					$artid_array=ask_exists( $_SESSION['pedidos'][$i][0] );
					
					if ( $artid_array && $_GET['stock_discount']==1)
					{	
					
						if (stock_discount ($artid_array['artid'], $_SESSION['pedidos'][$i][2]  ) )
						echo "<i>Se han descontado correctamente la cantidad de:<b>  ".$_SESSION['pedidos'][$i][2].
						"  </b>del art�culo:  <b>". $_SESSION['pedidos'][$i][1]. " </b>del stock.</i> <br>";
						else
						echo "NO se han podido descontar del stock la cantidad de:<b>  ".$_SESSION['pedidos'][$i][2].
						"  </b>del art�culo:  <b>".$_SESSION['pedidos'][$i][1]. "  </b>, int�ntelo m�s tarde.
						".$artid_array['artid']." <br>";
						
					}
		  ?>
          <tr>
		 
			 <tr>
            <td width="20%" bgcolor="<? echo $color ?>"><div align="center"><? echo $_SESSION['pedidos'][$i][0] ?></div></td>
            <td width="53%"><div align="center"><? echo $_SESSION['pedidos'][$i][1] ?></div></td>
            <td width="53%"><div align="center"><? echo $_SESSION['pedidos'][$i][2] ?></div></td>
            <td width="27%"><div align="center"><? echo $_SESSION['pedidos'][$i][3] ?></div></td>
			<td width="27%"><div align="center"><? echo "Total: ". $_SESSION['pedidos'][$i][2] * $_SESSION['pedidos'][$i][3] 
			?></div></td></tr>
		  	<?
			}
			}
			?>
			<tr>
			<td width="27%" colspan="5" align="right"><? echo "<h5>Total:</h5> ". $_SESSION['suma_total'] ." � +". ($_SESSION[		            'suma_total']/100)*16 ." � de IVA";?> </td>
			<tr>
			<td colspan="3" align="right"> Portes = <? echo $_SESSION['portes']." �" ?> </td>
			<td colspan="2"> RE = <? echo $_SESSION['re']." �" ?> </td>
			</tr> 
			<tr>
			<td width="27%" colspan="5" align="right"><?
			if ($_SESSION['re'])
			{
			//Si esta activado el RE 
			 echo "<h5>Total</h5> ". 1.04*$total." �"; ?> </td>
			<?
			}
		//Si NO esta activado el RE 

		   if (!$_SESSION['re'])
			{
			//Si esta activado el RE 
			 echo "<h5>Total</h5> ".$total." �"; ?> </td>
			<?
			}
			?>
			<tr>
			<td width="27%" colspan="4" align="center"><a href="#" onclick="CierraVentana() ;">Cerrar</a></td>
			<td width="27%" colspan="5" align="center"><a href='<?=$PHP_SELF."?stock_discount=1" ?>'" >
			Retraer Stock</a></td>
			<?
			  if ($_GET['imprimir']!=1)
	  {
	  ?>
			<td width="27%" colspan="5" align="center"><a href="#" onclick="AbreVentanaPortes() ;">Insertar Portes</a></td>
		<?
			  
	  }
	  ?>	
			
			</tr>

			
      </tr>
    </table>
	</td>
  </tr>
</table>
<table align='center'>
<tr> 
<td><? echo $mercancia_enviada ?></td>
</tr>
</table>
<?

					
					
					
?>
		

</body>
</html>
