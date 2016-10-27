<?php
/*
FUNCIONES A IMPLEMENTAR PARA EL PANEL DE ADMINISTRACI�N DE LA TIENDA
function user_admin() //Comrpueba que eres el administrador y puedes entrar al panel de administraci�n de la tienda
function add_cat() // a�adir categor�a
function change_cat() //Cambiar nombre de categor�a
function del_cat() // borrar categor�a de la tienda
function add_art() //a�adir nuevo art�culo a la tienda
function del_art() //Borrar art�culo
function list_ships() //Listar pedidos
funcion archiv_ship() //Archivar pedidos
function del_ship() //Borrar pedidos
function ask_catid() //Consulta todos los catid de la tabla Categories
function last_catid() //Saber cual es el �ltimo catid para poder nombrar a la imagen inequivocamente
function ask_artid() //Consulta todos los artid de la tabla articles
function last_artid() //Saber cual es el �ltimo artid para poder nombrar a la imagen inequivocamente
*/
function login($username, $password)

// comprueba el nombre del usuario y el password con la base de datos
// si s�, devuelve verdadero
// si no devueelve falso
{
  // conectar a la base de datos
  $conn = db_connect();
  if (!$conn)
    return 0;

  // comprobar que el nombre de usuario sea �nico
  $result = mysql_query("select * from admin
                         where username='$username'
                         and password = md5('$password')");
                         //and password = password('$password')");
  if (!$result)
     return 0;

  if (mysql_num_rows($result)>0) //Si encuentra almenos 1 registro
     return 1;
  else
     return 0;
}

//Comprueba que un determinado mail esta registrado en la Bd
function email_exists  ($email) {

  // conectar a la base de datos
  $conn = db_connect();
  if (!$conn)
    return 0;

  // comprobar que el nombre de usuario sea �nico
  $result = mysql_query("select email from usuarios
                         where email='".trim($email)."'") or die (mysql_error());
  if (!$result)
     return 0;

  if (mysql_num_rows($result)>0) //Si encuentra almenos 1 registro
     return 1;
  else
     return 0;
}
function panel_control(){

//Si estamos viendo la tienda
//if ($url=="/tienda_gloria/header.php")
//Si estamos en el panel de control (o en cualquier sitio con acceso del administrador)
$categorias="categories_menu.php";
$articulos="articles_menu.php";
$salir="salir.php";
$tienda= "../../../index.php ";
$pedidos="consulta_pedidos.php";
$stock="stock.php";
$tiket="tiket.php";
?>
<table width="75%" border="0" align="center" cellpadding="9" cellspacing="5">
  <tr class='encabezadcos_tablas '>
    <td colspan="9" class="panel"><div align="center" class="Estilo1">MODO ADMINISTRADOR </div></td>
  </tr>
  <tr class='fondo_filas_panel'>

	<td width="203" >
	<div align="center">
	<a href="<?php echo $categorias ?>" target="_self" class="opciones_tablas">CATEGORIAS</a></div></td>
    <td width="165">
	<div align="center"><a href="<?php echo $articulos ?>" target="_self" class="opciones_tablas">ARTÍCULOS</a></div></td>
  <td width="165" >
  <div align="center"><a href="<?php echo $pedidos ?>" target="_self" class="opciones_tablas">PEDIDOS</a></div></td>
    <td width="165" >
	<div align="center"><a href="<?php echo $stock ?>" target="_self" class="opciones_tablas">STOCK</a></div></td>
	    <td width="165" >
		<div align="center"><a href="<?php echo $tiket ?>" target="_self" class="opciones_tablas">FACTURA</a></div></td>


    <td width='165'>
      <div align='center'><a href='promo.php' target='_self '  class="opciones_tablas">NOTICIAS</a></div>
    </td>
    <td width='165' class="opciones_tablas" ><a href="get_refs.php" target="_self" class="opciones_tablas">REFS</a></td>
      <td width="220"><div align="center">  
        <button name="salir">Salir</button>
     </td>
  </tr>
</table>
<?php

}
//Menu categorias
//Crea página con el mune de las categorías

//Cajita de login para entrar en el "panel de control"
function login_box()
 {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Tienda administración</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="index.php">
  <p>&nbsp;</p>
  <tr>
  <td ><h4>Usuario: </h4></td><td><input name="username" type="text" id="username" /></td>
 </tr>
 <tr>
  <td ><h4>Contrase&ntilde;a:</h4> </td><td><input type=password name=passwd></td>
  </tr>
 <tr>
  <td colspan="2" ><input name="Submit" type="submit" id="Submit" value="Entrar" /></td>
  </tr>

</form>
</body>
</html>
<?php
}
function login_user($email, $password)
// check username and password with db
// if yes, return true
// else return false
{
  // connect to db
  $conn = db_connect();
  if (!$conn)
    return 0;
$pwd=trim(md5($password));
  // check if username is unique
  $result = mysql_query("select * from usuarios
                         where email='$email'
                         and password ='".$pwd."'");
  if (!$result)
     return 0;

//Si encuentra almenos 1 registro
if (mysql_num_rows($result)>0)
	{
    	$user=mysql_fetch_array($result);
  		return $user;
	}
  else
     return 0;
}
function unregister_user ()
{
$result_unreg = session_unregister("user");
$result_dest = session_destroy();
if (!empty($old_user))
{
  if ($result_unreg && $result_dest)
  {
    // if they were logged in and are now logged out
    echo "Logged out.<br>";

  }
  else
  {
   // they were logged in and could not be logged out
    echo "No hemos podido hacer Log Out.<br>";
  }
}
else
{
  // if they weren't logged in but came to this page somehow
  echo "No te encuentras logged in, as� que no hemos podido hacer logged out.<br>";

}
}
//Promociones
function promo () {

// connect to db
  $conn = db_connect();
  if (!$conn)
    return 0;

  // check if username is unique
  $result = mysql_query( " select * from promociones WHERE id=1 " );
  if (!$result)
     return 0;

  if (mysql_num_rows($result)>0)
    {
		$promo=mysql_fetch_array($result);

		if ($promo['value']==1)

	 	return $promo['promo'];
	}
  else
     return false;
}

function ver_promo () {

// connect to db
  $conn = db_connect();
  if (!$conn)
    return 0;

  // check if username is unique
  $result = mysql_query( " select promo from promociones WHERE id=1 " );
  if (!$result)
     return 0;

  if (mysql_num_rows($result)>0)
    {
		$promo=mysql_fetch_array($result);

		if ($promo);

	 	return $promo['promo'];
	}
  else
     return false;
}

function imagen_proportion ($img) {

$img_nueva_anchura=320;
$img_nueva_altura=320;
    // crear imagen nueva
    //$thumb = ImageCreate($img_nueva_anchura,$img_nueva_altura);
$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura);
    // redimensionar imagen original copiandola en la imagen
 imagecopyresized ($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));
ImageJPEG($thumb,$img,85);
}

function no_more_promo($email){
$conn = db_connect();
$query = "update usuarios
             set promo='0'
			 where email='$email' ";

 $result = @mysql_query($query);
   if (!$result)
     return false;

	 return true;


}
//Cambiamos el Pwd del usuario
function change_pwd ($pwd,$email) {
$conn = db_connect();
$pwd=trim(md5($pwd));
$query = "update usuarios
             set password ='".$pwd."' where email='".$email."'";
 $result = mysql_query($query);
   if (!$result)
     return false;

	 return true;



}
function update_quienes_page($campo1,$campo2) {
$conn = db_connect();
$query = "update whom_textos
             set campo1='$campo1',
			 	 campo2='$$campo2'
				 ";
$result = mysql_query($query);
   if (!$result)
     return false;

	 return true;
}

function ask_quienes_page () {
// connect to db
  $conn = db_connect();
  if (!$conn)
    return 0;

  // check if username is unique
  $result = mysql_query( " select * from whom_textos  " );
  if (!$result)
     return 0;

  if (mysql_num_rows($result)>0)
    {
		$textos=mysql_fetch_array($result);

		if ($textos);

	 	return $textos;
	}
  else
     return false;
}
function ask_como_comprar_page () {
// connect to db
  $conn = db_connect();
  if (!$conn)
    return 0;

  // check if username is unique
  $result = mysql_query( " select * from how_textos  " );
  if (!$result)
     return 0;

  if (mysql_num_rows($result)>0)
    {
		$textos=mysql_fetch_array($result);

		if ($textos);

	 	return $textos;
	}
  else
     return false;
}
//function update_como_comprar_page ($array_textos)
	function update_como_comprar_page ($cabecera1,$texto1,$cabecera2,$texto2,$cabecera3,$texto3,$cabecera4,$texto4,
									$cabecera5,$texto5,$cabecera6,$texto6,$cabecera7,$texto7)
 {
$conn = db_connect();

 /*$query = "update how_textos
             set campo1_header='$array_textos[campo1_header]',

				 campo1='$array_textos[campo1]',

				 campo2_header='$array_textos[campo2_header]',

			 	 campo2='$array_textos[campo2]',

			 	 campo3_header='$array_textos[campo3_header]',

			 	 campo3='$array_textos[campo3]',

			 	 campo4_header='$array_textos[campo4_header]',

			 	 campo4='$array_textos[campo4]',

			 	 campo5_header='$array_textos[campo5_header]',

			 	 campo5='$array_textos[campo5]',

			 	 campo6_header='$array_textos[campo6_header]',

				 campo6='$array_textos[campo6]',

			 	 campo7_header='$array_textos[campo7_header]',

			 	 campo7='$array_textos[campo7]'
				 ";*/

$query = "update how_textos
             set campo1_header='$cabecera1',

				 campo1='$texto1',

				 campo2_header='$cabecera2',

			 	 campo2='$texto2',

			 	 campo3_header='$cabecera3',

			 	 campo3='$texto3',

			 	 campo4_header='$cabecera4',

			 	 campo4='$texto4',

			 	 campo5_header='$cabecera5',

			 	 campo5='$texto5',

			 	 campo6_header='$cabecera6',

				 campo6='$texto6',

			 	 campo7_header='$cabecera7',

			 	 campo7='$texto7'
				 ";


 $result = mysql_query($query);

   if (!$result)
     return false;

	 return true;
}
function login_panel_admin () {
?>
<form id="form1" name="form1" method="post" action="index.php" a>
 <table align="center" cellpadding="15" cellspacing="9" >
 <tr>
 	<td colspan='2' bordercolor="#CCCCCC" bgcolor="#CCCCCC" class='panel'> <div align="center"><strong>Acceso al Panel de Control del Administrador </strong></div></td>
	</tr>
	<tr>
	  <td width="86" bgcolor="#E5EDE9" class='login'><div align="center">Usuario</div></td><td width="228" bgcolor="#E5EDE9" >     <div align="center">
		  <input name="username" type="text" id="username" class='box'/>
		  </div></td>
    </tr>
	<tr>
	  <td bgcolor="#E5EDE9" class='login'><div align="center">Contrase&ntilde;a</div></td><td bgcolor="#E5EDE9">    <div align="center">
		  <input type=password name=passwd class='box'>
		  </div></td>
	</tr>
	<tr>

    <td bgcolor="#E5EDE9" class='login' colspan="2" align="center">
    <!-- pass a session id to the query string of the script to prevent ie caching -->
<img src="/tienda_gloria/php/admin/panel/seguridad/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"><BR/>
<input type="text" name="code" />
</td>
</tr>
<tr>
		<td colspan='2' >    <div align="center">
		  <input name="Submit" type="submit" id="Submit" value="Acceder Panel de Control"  />
	    </div></td>
    </tr>
  </table>
</form>
<?php
}
function is_registered_user (){

if  ( $_SESSION["valid_user"] )
$user=$_SESSION["valid_user"]["name"];
else
$user="Visitante";
?>
<table align="left" >  </tr>
<tr> <td  colspan="5" align="left" class='usuariobienvenido'><b>Sr/Sra:  </b><?php echo $user ;?> </td>
  </tr>
   <tr> <td  colspan="5" align="left" class='usuariobienvenido'>
<?php
if  ( $_SESSION["valid_user"] )
{
?>
   <a href='../../../tienda_gloria/index.php?loged_of=1' target="_parent" class='volver '> Salir</a> </td>
 </td>
 <?php
}
?>
  </tr>
 </table>

<?php

}
function update_datos_clientes($name,$surname,$adress,$city,$state,$zip,$country,$telf,$celular,$email,$email2) {
//calculamos el codigo numerico del pais para a�adirlo a la bd
$value=pais_value($country);
$connect=db_connect();
if (!$connect)
return 0;
$query = "update usuarios
             set email='$email',
			 	 name='$name',
				 surname='$surname',
				 adress='$adress' ,
				  city='$city',
				 zip='$zip' ,
				  state='$state',
				 country='$value' ,
				 telf='$telf',
				  celular='$celular'
				  where email='$email2'

				 ";

$result = mysql_query($query);
   if (!$result)
     return false;

	 return true;
}
function pais_value($country) {
 //Pasar el string del nombre del pais a n�mero
  if (strtolower($country)=="espa�a")
 $value=1;
    if (strtolower($country)=="alemania")
 $value=2;
   if (strtolower($country)=="suecia")
 $value=3;
   if (strtolower($country)=="portugal")
 $value=4;
   if (strtolower($country)=="suiza")
 $value=5;
   if (strtolower($country)=="francia")
 $value=6;
   if (strtolower($country)=="italia")
 $value=7;
   if (strtolower($country)=="holanda")
 $value=8;
   if (strtolower($country)=="belgica")
 $value=9;
    if (strtolower($country)=="andorra")
 $value=10;
   if (strtolower($country)=="dinamarca")
 $value=11;
   if (strtolower($country)=="grecia")
 $value=12;
   if (strtolower($country)=="austria")
 $value=13;

 return $value;

 }
 function fecha() {
$date=date("j,m,Y");
$date = str_replace (",", "-",$date);
return $date;
}
//redondeo a dos decimales
function redondear_dos_decimal($valor) {
$float_redondeado=round($valor * 100) / 100;
return $float_redondeado;
}
function pet($emailMd5) {
$connect=db_connect();
if (!$connect)
return 0;
$SqL="INSERT into pets VALUES ('','".trim($emailMd5)."')";
if (!mysql_query($SqL))
return 0;
return 1;
}
//comprobamos que exista petici�n vigente.
function comprueba_pet($email) {
$connect=db_connect();
if (!$connect)
return 0;
$pet="SELECT CodPet from pets WHERE Md5='".trim($email)."' ";
  // check if username is unique
  $res=mysql_query($pet);
  $row=mysql_fetch_array($res);

if(!$row )
  return 0;


    $delete_pet = " DELETE from pets
             WHERE Md5='".$email."' ";
mysql_query($delete_pet);

 return 1;
 }
