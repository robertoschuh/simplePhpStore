<?php
function extension_check($id_ext)
{
//Devuelve la extensi�n de la imagen del art�culo en cuestion

if ($id_ext==0)
	{
		$ext="jpeg";
		return $ext;
	}
if ($id_ext==1)
	{
		$ext="jpg";
		return $ext;
	}
	
if ($id_ext==2)
	{
		$ext="gif";
		return $ext;
	}
	
if ($id_ext==3)
	{
	  $ext="png";
	  return $ext;
	 }
	
}//fin de la funci�n 
function corta_texto($texto, $num) {
$txt = (strlen($texto) > $num) ? substr($texto,0,$num)." ..." : $texto;
return $txt;
}
function display_envio_form($total)
{
@session_start();
//Si es un usuario registrado
include ("idiomas/idiomas_fns.php");
?>
<script language="JavaScript" type="text/javascript" src="../php/admin/form_valida.js"></script>

<link href="../gloria.css" rel="stylesheet" type="text/css" />


  <table width="75%" border="0" align="center">
  <tr >
 
      <th  align="left" class="title" >Datos de Cliente:</th>
    </tr>
  <form name="fvalida" method="post" action="../php/envio_pedido.php" onsubmit="return valida_envia()" >

       <tr>
      <td  class="tablas_items" ><?php echo $name ?></td>
      <td class="tablas_encabezados" ><input name = name type = text value = "<?php echo $_SESSION['valid_user']['name'] ?>" size = 40 maxlength = 40></td>
    </tr>
     <tr>
      <td  class="tablas_items" ><?php echo $surname ?></td>
      <td class="tablas_encabezados" ><input name = surname type = text value = "<?php echo $_SESSION['valid_user']['surname'] ?>" size = 40 maxlength = 40></td>
    </tr>
    <tr>
      <td class="tablas_items" ><?php echo $adress ?></td>
      <td class="tablas_encabezados" ><input name = address type = text value ="<?php echo $_SESSION['valid_user']['adress'] ?>"size = 40 maxlength = 40></td>
    </tr>
    <tr>
      <td class="tablas_items" ><?php echo $city ?></td>
      <td class="tablas_encabezados"  ><input name = city type = text value = "<?php echo $_SESSION['valid_user']['city'] ?>" size = 50 maxlength = 50></td>
    </tr>
    <tr>
      <td class="tablas_items" ><?php echo $state ?></td>
      <td class="tablas_encabezados"  ><input name = state type = text value = "<?php echo $_SESSION['valid_user']['state'] ?>" size = 50 maxlength = 50></td>
    </tr>
    <tr>
      <td class="tablas_items" ><?php echo $postal ?></td>
      <td class="tablas_encabezados"  ><input name = zip type = text value = "<?php echo $_SESSION['valid_user']['zip'] ?>" size = 40 maxlength = 10></td>
    </tr>
    <tr>
	
      <td class="tablas_items" ><?php echo $country ?> </td>
      <td class="tablas_encabezados"  ><input name=country type = text value = "<?php echo $country_value; ?>" 
	  									size = 50 maxlength = 50></td>
    </tr>
    <tr>
      <td class="tablas_items" ><?php echo $telf ?></td>
      <td class="tablas_encabezados" >
	  <input name =telf type = text size = 40  maxlength = 20 
	  value="<?php echo $_SESSION['valid_user']['telf'] ?>"  />
	  </td>
    </tr>
    <tr>
      <td class="tablas_items" ><?php echo $celular ?></td>
      <td class="tablas_encabezados"  >
	  <input name =celular type = text size = 40  maxlength = 20
	  value="<?php echo $_SESSION['valid_user']['celular'] ?>" />
	  </td>
    </tr>
    <tr>
      <td class="tablas_items" >email </td>
      <td class="tablas_encabezados" >
	  <input name = email type = text value ="<?php echo $_SESSION['valid_user']['email'] ?>" 
	  size = 40 maxlength = 50>
	  </td>
    </tr>
	<tr> 
	<td  align="right" valign="top"> Comentarios <td> <textarea name="coments" cols="30" rows="5"></textarea></td>
    <tr>
      <th class="title" align="right">Modo de pago y envío:</th>
    </tr>
  <tr>
	<td  align="right"><input name="payment" type="radio" value="1"  /></td> <td  align="left">  <?php echo $transferencia ?></td>
	  </tr>
	  <tr>
	<td  align="right"><input  name="payment" type="radio" value="2" checked="checked" /></td> <td  align="left"> <?php echo $rembolso ?></td>
	  </tr>
	  
 	
    <tr>
      <td height="113" colspan="2"><div align="center">
	  	  <input name="total" type="hidden" value="<?php echo $total ?>" />
		  	  	  <input name="email2" type="hidden" value="<?php echo $_SESSION['valid_user']['email'] ?>" />


        <input name="Aceptar" type="submit" id="Aceptar" value="<?php echo $enviar ?>">
		<input name="Actualizar" type="submit" id="Actualizar" value="ACTUALIZAR MIS DATOS">
 </td>
    </tr>
	</form>

  </table>

	  

<?php
}
function display_form_button($image, $alt)
{
  echo "<center><input type = image src=\"images/$image".".gif\"
           alt=\"$alt\" border=0 height = 50 width = 135></center>";
}
function ver_carrito () {
?>
<div class='carrito'>
<table border='0'>
<tr>
<td align='center'><a href='../carrito_php/ver_carrito.php' target="_self"><img src='../img/cart.gif' /></a></td>
</tr>
<tr><td class='aviso_img'>Ver mi compra</td></tr>

</table>
</div> 
<?php
}
function login_box_user($total)
{
include("idiomas/idiomas_fns.php");
?>
 <br /><p > 
 <span class='titulo_categoria_despliegue'><center><?php echo  $acceso_cliente ?></center></span>
<p align="center" >&middot; Es necesario estar regristrado para continuar el proceso de compra.<br />
&middot; Introduzca su e-mail y contrase&ntilde;a para acceder a sus datos o registrese. </p>
 <form id="form1" name="form1" method="post" action="../php/comprueba_registrado_usuario.php">
  <table width="83%" border="0" align="center" cellpadding="3" cellspacing="3">
    <tr>
      <td align="center"><table width="62%" border="0" cellspacing="3" cellpadding="3">
        <tr>
          <td width="33%" height="35" align="right">Email </td>
          <td width="67%"><div align="left">
              <input type="text" name="email" id="email" />
          </div></td>
        </tr>
        <tr>
          <td height="36" align="right"><?php echo $pass ?></td>
          <td><div align="left">
              <input type="password" name="password" id="password" />
          </div></td>
        </tr>
		<tr>
		<td colspan="2" align="center"><input type="submit" name="Submit2" id="Submit2" value="<?php echo $enviar ?>" /></td>
		</tr>
  	  	  <input name="apagar" type="hidden" value="<?php echo $total ?>" />

  </form>
      </table>
        <p>
        </p>
        <table width="87%" border="0" cellspacing="3" cellpadding="3">
          <tr align="center" valign="middle">
            <td><form action='../php/register.php?apagar=<?php echo $total ?>' name='form5' method='post' >
			 <input type='submit' value='<?php echo $register_form ?>' />
			 </form></a></td>
            <td><form action='../php/admin/recupera_pwd.php?change_mail=1' name='form6' method='post' >
			<input type='submit' value='<?php echo $forget_pwd ?>' name"submit"/>
			</form>
			</a></td>
          </tr>
        </table></td>
    </tr>
    <tr><td colspan="2" align="center">Si tiene alg&uacute;n problema para acceder al sitio, puede llamar al <b>soporte t&eacute;cnico al 622281972</b></td></tr>
  </table>

<?php
}
function foother () {

?>
<script LANGUAGE="JavaScript">

function agregar(){
   if ((navigator.appName=="Microsoft Internet Explorer") && (parseInt(navigator.appVersion)>=4)) {
      var url="http://www.TuSitio.com/";
      var titulo=" Descripci&oacute;n de mi sitio web";
      window.external.AddFavorite(url,titulo);
   }
   else {
      if(navigator.appName == "Netscape")
         alert ("Presione Crtl+D para agregar este sitio en sus Bookmarks");
   }
}
</script> 
<div  align="center">






<font size="2">&#064; 2008 Gloria Botonero Belenes y Miniaturas</font><br />
<font size="2">Administradora<a href='mailto:gloriabotonero@gmail.com' >  Webmaster</a></font> telf: + (34) 657 51 39 39 
 <font size="2"> <a href='mailto:rob@masquebits.com' >  Soporte t&eacute;cnico (622 28 19 72)</a> </font> <br />
 <font size="2"><a href="javascript:agregar()">Agregar a favoritos &middot;</a></font> <br />
.

</div> 
<?php
}

function login_box_user_no_promo()
{
include ("idiomas/idiomas_fns.php");
?>

<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table width="220" border="0" class="box_no_more_promo" align="center">
    <tr>
      <td colspan="2"><div align="center">Login</div></td>
    </tr>
    <tr>
      <td width="60">Email</td>
      <td width="144"><label>
        <input type="text" name="email" id="email" />
      </label></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input type="password" name="password" id="password" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><label>
        <input type="submit" name="action" id="Submit" value="<?php echo $no_more_promo?>" />        </label></td>
    </tr>
    
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>
<?php
}
function restore_pwd_form() {

?>
<table align="center"> <tr> <td align="left"> <?php echo $confirm_mail_pwd_rescue ?></td></tr>
</table>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table width="220" border="0" align="center">
    <tr>
      <th colspan="2">Inserte su email</th>
    </tr>
    <tr>
      <td width="60" class="tablas_items" >email</td>
      <td width="144"><label>
        <input type="text" name="email" id="email" />
      </label></td>
    </tr>
    <tr>
      <td class="tablas_items" >Repetir email</td>
      <td>        <input type="text" name="email2" id="email2" />
</td>
    </tr>
	  <tr>
        <td colspan="2" align="center"><label>
		<input type="hidden" name="restore" value="1"  />
          <input type="submit" name="Submit" id="Submit" value="OK" />          </label></td>
    </tr>
   
    
  </table>
</form>

<?php

}
function change_pwd_form () {
    
    
?>
<h3>Por favor establezca una nueva contraseña) </h3>
<form id="form1" name="form1" method="post" action=<?php  echo $_SERVER['PHP_SELF'] ?> >
    <table  border="0" style="margin:0 auto;">
        <tr>
          <td colspan="2"><div align="center">Login</div></td>
        </tr>
        <tr>
          <td width="60" class="tablas_items" >Contrase&ntilde;a</td>
          <td width="144"><label>
                  <input type="text" name="password" id="password" placeholder="Nueva contraseña" />
          </label></td>
        </tr>
        <tr>
          <td class="tablas_items" >Contrase&ntilde;a (repetir)</td>
          <td>        <input type="text" name="password2" id="password2" placeholder="Repetir contraseña" />
      </td>
        </tr>
              <tr>
            <td colspan="2" align="center"><label>
                     <input type="hidden" name="email" id="email" value="<?php echo $_GET['email']?>"/>
              <input type="submit" name="Submit" id="Submit" value="OK" />          </label></td>
        </tr>
  </table>
</form>
<?php

}
function mod_page_form_quienes_somos () {


$textos=ask_quienes_page ();
?>

<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table width="329" border="0" align="center">
    <tr>
      <td colspan="2"><div align="center">&iquest;Quienes somos? </div></td>
    </tr>
    <tr>
      <td>Texto 1 </td>
      <td><label>
        <textarea name="campo1" cols="38" rows="10"><?php echo $textos['campo1'] ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td><p>Texto 2 </p>
          <p>&nbsp;</p></td>
      <td><textarea name="campo2" cols="38" rows="10"><?php echo $textos['campo2'] ?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="mod_quienes" value="Modificar" /></td>
      
    </tr>
  
  </table>
</form>
<?php
//Actualizamos los campos de la p�ginas de la cabecera

}
function mod_page_form_como_comprar () {

$textos=ask_como_comprar_page ();
?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  <table width="475" border="0" align="center">
    <tr>
      <th colspan="2"><div align="center">Como comprar </div></th>
    </tr>
    <tr>
      <td width="69">cabecera1</td>
      <td width="390"><label>
        <input type="text" name="campo1_header" value="<?php echo $textos['campo1_header'] ?>" />
      </label></td>
    </tr>
    <tr>
      <td><p>texto1</p>
          <p>&nbsp;</p></td>
      <td><textarea name="campo1" cols="38" rows="10"><?php echo $textos['campo1'] ?></textarea></td>
    </tr>
    <tr>
      <td>cabecera2</td>
      <td><input type="text" name="campo2_header" value="<?php echo $textos['campo2_header'] ?>" /></td>
    </tr>
    <tr>
      <td>texto2</td>
      <td><textarea name="campo2" cols="38" rows="10"><?php echo $textos['campo2'] ?></textarea></td>
    </tr>
    <tr>
      <td>cabecera3</td>
      <td><input type="text" name="campo3_header" value="<?php echo $textos['campo3_header'] ?>" /></td>
    </tr>
    <tr>
      <td>texto3</td>
      <td><textarea name="campo3" cols="38" rows="10"><?php echo $textos['campo3'] ?></textarea></td>
    </tr>
    <tr>
      <td>cabecera4</td>
      <td><input type="text" name="campo4_header" value="<?php echo $textos['campo4_header'] ?>" /></td>
    </tr>
    <tr>
      <td>texto4</td>
      <td><textarea name="campo4" cols="38" rows="10"><?php echo $textos['campo4'] ?></textarea></td>
    </tr>
    <tr>
      <td>cabecera5</td>
      <td><input type="text" name="campo5_header" value="<?php echo $textos['campo5_header'] ?>" /></td>
    </tr>
    <tr>
      <td>texto5</td>
      <td><textarea name="campo5" cols="38" rows="10"><?php echo $textos['campo5'] ?></textarea></td>
    </tr>
    <tr>
      <td>cabecera6</td>
      <td><input type="text" name="campo6_header" value="<?php echo $textos['campo6_header'] ?>" /></td>
    </tr>
    <tr>
      <td>texto6</td>
      <td><textarea name="campo6" cols="38" rows="10"><?php echo $textos['campo6'] ?></textarea></td>
    </tr>
    <tr>
      <td>cabecera7</td>
      <td><input type="text" name="campo7_header" value="<?php echo $textos['campo7_header'] ?>" /></td>
    </tr>
    <tr>
      <td>texto7</td>
      <td><textarea name="campo7" cols="38" rows="10"><?php echo $textos['campo7'] ?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><label>
        <div align="center">
          <input type="submit" name="boton_como_comprar" value="Submit" />
        </div>
      </label></td>
    </tr>
  </table>
</form>
<?php

}

function texto_carrito () {

?>
<div id="recordatorio">


<h2>RECUERDE </h2>

<table align="center">
<tr>
<td align="left">
<ul >
<li>Si desea añadir algún artículo a su compra haga clic en<b> seguir comprando</b>. </li>
<li>Para modificar algunos de sus datos, introduzca la informaci�n correcta y haga clic en <b>Actualizar mis datos</b>.</li>
<li>Elija el modo de pago y envío.</li>
<li>Revise sus datos y si son correctos haga clic en <b>Hacer pedido</b>.</li>
</ul>
</td>
</tr>
</table>
</div>
<?php }?>