<?php
        if(isset($_POST['enviar'])) {
                // creamos la función que valida que la dirección de correo ingresada sea correcta
                function email_valido($correo) {
                        if(eregi( "^[_\.0-9a-z-]+@[0-9a-z\._\-]+\.[a-z]{2,4}$", $correo)) return true;
                        else return false;
                }
                if($_POST['nombre'] == '') {
                        echo "No ha ingresado su nombre.<br /><a href='javascript:history.back()'>Regresar</a>";
                }elseif(!email_valido($_POST['email'])) {
                        echo "No ha ingresado su Email, o la dirección ingresada no es correcta.<br /><a href='javascript:history.back()'>Regresar</a>";
                }elseif($_POST['asunto'] == '') {
                        echo "No ha ingresado el asunto.<br /><a href='javascript:history.back()'>Regresar</a>";
                }elseif($_POST['mensaje'] == '') {
                        echo "No ha escrito el mensaje.<br /><a href='javascript:history.back()'>Regresar</a>";
                }else {
                        $nombre = $_POST['nombre'];
                        $email = $_POST['email'];
                        $asunto = $_POST['asunto'];
                        $para = "prueba@gloriabotonero.com";
                        $mensaje = '<html>
                                        <head><title>Contacto</title></head>
                                        <body>
                                                '.nl2br($_POST[mensaje]).'
                                        </body>
                                </html>';
                        $sheader = "From:".$nombre." <".$email.">\nReply-To:".$email."\n";
                        $sheader = $sheader."Mime-Version: 1.0\n";
                        $sheader = $sheader."Content-Type: text/html";
                        mail($para,$asunto,$mensaje,$sheader);
                        echo "El mensaje se ha enviado correctamente. Le estaremos respondiendo a la brevedad posible. Gracias.";
                }
        }else {
?>
<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
        <label>Nombre:</label>
        <input type="text" name="nombre" />
        <label>Email:</label>
        <input type="text" name="email" />
        <label>Asunto:</label>
        <input type="text" name="asunto" />
        <label>Mensaje:</label>
        <textarea name="mensaje" rows="5" cols="50"></textarea>
        <input type="submit" name="enviar" value="Enviar mensaje" />
        <input type="reset" value="Restablecer" />
</form>
<?php
        }
?>
