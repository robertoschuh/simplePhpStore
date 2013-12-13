<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="../gloria.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <?php
        @session_start();

        if (!isset($_SESSION["init"])) {
            ?>		
            <a href='http://www.gloriabotonero.com/tienda_gloria/index.php' target="_parent"><center><h2> Ir a Tienda de <br>
                            Gloriabotonero.com</h2></center> </a> 

            <?php
            exit;
        }

        require_once("admin/admin_fns.php");
        require_once("fns.php");

//Recordad ��� funciones de articulos en arts_fns.php
        $result = last_articles_add();
        ?>
        <table width='100%'>
            <tr>
                <td align="center"  class='titulo_categoria_despliegue'>&Uacute;ltimas Novedades de la tienda</td>

            </tr>
        </table>
        <?php
        display_arts_numbero_fijo($result);
        echo "<br><br>";
        foother();
        ?>
    </body>
</html>
