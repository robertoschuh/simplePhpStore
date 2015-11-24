<?php
@session_start();
include ("admin/admin_fns.php");
include ("fns.php");
$apagar = $_POST['apagar'];

$user = login_user($_POST["email"], $_POST["password"]);

if (!$user) {
    echo "<div text-align='center'> <br/><br/><br/> O bien no est&aacute; registrado o bien cometi&oacute; un error introduciendo el mail o la contrase&ntilde;a. <br><br>	Int&eacute;ntelo de nuevo.<br>";
    echo "<br/><br/><br/><form action='javascript:history.back(-1)' name='form1' method='post' ><input type='submit' value='Volver'></form></a>
</div><br/>";
}
if ($user) {
    $_SESSION['valid_user'] = $user;
    //Si ha comenzado ya sesión
    echo "<center> <br><br><br> <span class='titulos_bienvenido'> <b><br><br><br><br>Bienvenido </b>" . $_SESSION['valid_user']['name'] . "</span><br><br> <br>";
    echo "<meta http-equiv='refresh' content='5;URL=../carrito_php/envio_form.php?apagar=$apagar'> ";
    echo "En breves segundos ser&aacute; redireccionado,de no ser as&iacute; por favor haga clic en ";
    echo "<br/><br/><a href='../carrito_php/envio_form.php?apagar=$apagar' class='boton'>  Seguir comprando</a></center><br>";
}