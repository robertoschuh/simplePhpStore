
<?
require ("../admin_fns.php");
require ("../pedidos_fns.php");
include ("../../fns.php");

@session_start();


if ( $_GET['user_mail']==1 )
{
	login_box_user_no_promo();

}
if ( $HTTP_POST_VARS && $action)
//Comprobamos si esta registrado el usuario
{
	$is_register=login_user($_POST['email'] , $_POST['password']  );

	if ($is_register==false)
	{
		echo "usuario NO registrado";
echo "<br>".$_POST['password'] ;
		exit;
	}
	else	
	//Si se ha verificado que es un usuario registrado lo configuramos para que no reciba más mensjes promocionales.
	{
	$result=no_more_promo($_POST['email'] );
		if ($result)
		echo "Su petición se ha cursado satisfactoriamente, en el futuro NO recibirá más Emails de esta web, Saludos <br>";
		else
		echo "No se ha podido cursar su petición , porfavor inténtelo más tarde, Gracias";
	}
}

else
echo "Ha surgido un error inseperado, profavor inténtelo más tarde, Gracias";


?>