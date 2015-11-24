<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<title>Catálogo tienda gloriabotonero</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />


<!-- jQuery Mobile from CDN -->

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
    <link rel="stylesheet" href="../tienda_gloria/gloria.css" />
    <link rel="stylesheet" href="movil.css" />

<?php
require_once('../tienda_gloria/php/fns.php');
$menu=show_categories ();
$category_path = '../tienda_gloria/php/admin/panel/img/cats/';
$product_path = '../tienda_gloria/php/admin/panel/img/arts/peq/';
?>
</head>
<body>

<div id="categories" data-role="page" data-title="catálogo productos"><!-- Page: categores -->
    <div data-role="header"
         data-position="fixed"
         >
        <h1>CATÁLOGO GLORIABOTONERO</h1>
    </div>

    <div data-role="content">
        
        <ul data-role="listview" data-filter="true" data-filter-placeholder="¿Qué categoría busca?">>
        <?php
            foreach ($menu as $key=>$value){
            echo '
            <li>        
            <p><a href="#cat'.$value["catid"].'"  data-role="button" data-icon="arrow-r">'
            .utf8_encode($value["cat_name"]).' <span class="small-txt">'.utf8_encode($value["cat_details"]).'</span></a>
            </p>
            <img src="'.$category_path.$value["catid"].'cat.jpg" alt="View Source logo" width="60px" />
            </li>
            ';
    } ?>
        </ul>
    </div>

    <div data-role="footer"
         data-position="fixed"
         data-id="vs_footer"
         data-fullscreen="true"
         class="ui-bar">
        <div data-role="navbar">
            <ul>
                <li> <a href="#" data-role="button" data-icon="arrow-r" >Inicio</a></li>
                <li> <a href="#contacto" data-role="button" data-icon="arrow-r" >Contacto</a></li>
            </ul>
        </div>
    </div>

</div> <!-- End Page: categorías -->

<?php //Add a page for each product category ?>
<?php foreach ($menu as $key=>$value){       ?>

    <!-- Page: <?php echo $value["cat_name"]; ?> -->
    <div id="cat<?php echo $value["catid"];?>" data-role="page"
         data-title="<?php echo utf8_encode($value["cat_name"]); ?>" class="product-category">
        <div data-role="header"
             data-id="vs_header"
             data-position="fixed"
          

             >
            <a href="#categories" data-icon="home" data-iconpos="left" class="ui-btn-left">Categorías</a>
            <h1>Artesanía | <?php echo utf8_encode($value["cat_name"]); ?></h1>
        </div>
        <?php $productos = get_arts($value["catid"]);
        if (empty($productos)){
            echo '<div class="centrado">No hay productos</div>';
        }
        else {
            echo '<div data-role="controlgroup">';
            foreach($productos as $producto){
                echo
                '<div id="'.utf8_encode($producto['art_name']).'" class="product-individual"><span class="nombre">'.utf8_encode($producto['art_name']).'</span><br />
                 <img src="'.$product_path.$producto['artid'].'art.jpg" /><br />
                 
                            <span class="ref">'.$producto['ref'].'</span><br />
                            <span class="precio">'.number_format($producto['art_price'],2).' €</span><br />'.

                '</div>';
            }
            echo '</div>';
        }
        ?>
        <div data-role="footer"
        data-position="fixed"
      
        data-id="vs_footer"
        class="ui-bar">
            <div data-role="navbar">
                <ul>
                    <li> <a href="#categories" data-role="button" data-icon="arrow-r" >Inicio</a></li>
                    <li> <a href="#contacto" data-role="button" data-icon="plus" >Contacto</a></li>
                </ul>
            </div>
        </div>

    </div> <!-- End Page: <?php echo $value["cat_name"]; ?> -->
<?php } ?>

<div id="contacto" data-role="page" data-title="Contacta" data-theme="b" ><!-- Page: contacto -->
    <div data-role="header"
         data-position="fixed"
         >
        <h1>Contacto GloriaBotonero.com</h1>
    </div>
    <div data-role="content">
        <div data-role="fieldcontain" class="ui-hide-label">
        <fieldset data-role="controlgroup" data-mini="true">
        <label for="username">Nombre:</label>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="nombre" id="username" value="" placeholder="Username" data-mini="true"/>
        <label for="username">Asunto:</label>
        <input type="text" name="asunto" id="username" value="" placeholder="Username" data-mini="true" />
        <label for="textarea-a">Tema:</label>
        <textarea name="tema" id="textarea-a" data-mini="true">
        I'm a basic textarea. If this is pre-populated with content, the height will be automatically adjusted to fit without needing to scroll. That is a pretty handy usability feature.
        </textarea>
        <input type="submit" name="contactar" value="contactar" data-mini="true"/>
        </form>
        </fieldset>
        </div>
    </div>

    <div data-role="footer"
         data-position="fixed"
         data-id="vs_footer"
         data-fullscreen="true"
         class="ui-bar">
        <div data-role="navbar">
            <ul>
                <li> <a href="#categories" data-role="button" data-icon="arrow-r" >Inicio</a></li>
                <li> <a href="#contacto" data-role="button" data-icon="arrow-r" >Contacto</a></li>
            </ul>
        </div>
    </div>

</div> <!-- End Page: contacto -->

</body>
</html>