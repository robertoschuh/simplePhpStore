<?php
//Recordad ��� funciones de articulos en arts_fns.php
$result = escaparate();
?>
<table width='100%'>
    <tr>
        <td align="center"  class='box_no_more_promo style1'>E S C A P A R A T E</td>
    </tr>
</table>
<?php
//display_arts ($result);
if (!is_array($art_array)) {
    echo "<table class='no_hay_articulos'> <tr> <td>$no_articles</td></tr></table>";
    exit;
}

foreach ($art_array as $row) {
    $id_ext = $row["id_ext"];
    $ext = extension_check($id_ext);
    if (($row["id_ext"]) == 4)
        $img = "demo.jpeg"; //sino hay ninguna imagen asociada a ese art�culo, se carga esta por defecto
    else
        $img = ($row["artid"]) . "art.$ext";

    /* 	$ruta="../../on/php/admin/panel/img/arts/$img";
      $anchura = ImageSX($ruta);
      $altura = ImageSY($ruta);

      $size=130;
      $img=imagen_proportion ($ruta,$size); */

    if (!$_SESSION["novedades"])
        $cat = $row ["catid"];
    else {
        $cat = 2;
        $novedades = "show_las_articles.php";
    }
    $title = corta_texto($title, 15);


    $details_short = corta_texto($details, 18);
    $url = "show_article_individual.php?artid=$row[artid]&cat=$row[catid]"; //descativado mientras no exista ese enlace
    $ref = $row["ref"];
    //Comprobamos si hay existencias de ese producto
    $existencias = get_almacen($row[artid]);
    //limitamos el n�mero de caracteres que aparecera en la breve descripci�n de art�culo
    $price = $row["art_price"];
    $name = $row["art_name"];
    //Creamos las filas quef contendr� los art�culos
    if ($existencias['unidades'] != -1 or session_is_registered("admin_user")) {
        //view
        ?><div class='articulos'>
            <span>Name</span> : <?php $name; ?>
            <span><img src="../../tienda_gloria/php/admin/panel/img/arts/peq/<?php echo $img; ?>" class="img_med" alt="<?php echo $name; ?>"></span>
        </div><?php
    }
}

include('footer.html.php')
