<link href="gloria.css" rel="stylesheet" type="text/css" />

<?
@session_start();
require ("php/admin/admin_fns.php");
require ("php/admin/pedidos_fns.php");
require ("php/fns.php");



//Ponemos esto para asegurarnos de que el usuario viene a través de URL que pincha desde su Correo
if ( $HTTP_GET_VARS['user_mail']==1 )
	
		login_box_user_no_promo();
	
if ( $_POST['email'] && $_POST['password'] )
//Comprobamos si esta registrado el usuario
{
	$login=login_user($_POST['email'] , $_POST['password'] );

	if ($login)
	{
	//Si se ha verificado que es un usuario registrado lo configuramos para que no reciba más mensjes promocionales.
	     if ( $result = no_more_promo($_POST['email'])      )
		    echo "Su petición se ha cursado satisfactoriamente, en el futuro NO recibirá más            Emails de esta web, Saludos. <br>";

			else
			echo "Por algún tipo de problema NO se ha podido cursar su petición, inténtelo 		            de nuevo más tarde, Gracias.<br>";
	}
	else

	echo "Acceso solo a usuarios, Gracias.";

}


?>