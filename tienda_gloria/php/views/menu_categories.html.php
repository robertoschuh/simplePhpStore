<ul class="nav nav-sidebar">
    <li class="nav nav-sidebar">
        <?php
        if ($_SESSION['idioma'] == 2)
            $news_add = News;
        else
            $news_add = Novedades;


        $menu = show_categories();

        //Url que abrirá mostrando caractrísticas de esta categoría
        $url = "categories.php?catid=" . "2";
        $url_escaparate = "escaparate.php";


        if ($_SESSION['admin_user']) {
            echo "
               <a title='Últimos artículos añadidos' href='almacen.php'
              target='mainFrame' class='categories_menu_news'>Almacen</a>
             ";
        }
        ?>                                                      

    </li>

    <li class="nav nav-sidebar">
        <a title='Escaparate' href='<?php echo $url_escaparate ?>'  target='mainFrame' class='categories_menu_news'>
            <?php echo "Escaparate" ?></a>   
    </li>





    <li class="nav nav-sidebar">
        <a title='Últimos artículos añadidos' href='<?php echo $url ?>'  target='mainFrame' class='categories_menu_news'>
            <?php echo $news_add ?>
        </a>  
    </li>



    <?php
    foreach ($menu as $row) {
        //RECORDAR: language es una variable de sesi�n que valdr� uno para "espa�ol" y 2 para "ingl�s"
        $catid = $row["catid"];
        $stock = $row["stock"];
        $pos = $row['pos'];

        $title = $row["cat_name"];
        if (!$_SESSION['idioma'] == 2) {//Si es diferente a 2 la variable de sesi�n language , muestra las cateorias en espa�ol
            $title = $row["cat_name"];
            $details = $row["cat_details"];
        }
        elseif ($_SESSION['idioma'] == 2) {//Si es igual a 2 muestras las categorias en ingl�s
            $title = $row["cat_name_eng"];
            $details = $row["cat_details_eng"];
        }
        //Deajmos abierta la posibilidad de incorporar m�s idiomas a la bd

        $url = "categories.php?catid=$catid"; //descativado mientras no exista ese enlace
        ?>

        <li class="nav nav-sidebar">
            <a  title='<?php echo $details ?>' href='<? echo $url ?>'  target='mainFrame' class='categories_menu' >
            <?php echo $title; ?>
            </a> 
            <?php
            if ($_SESSION['admin_user'])
                echo "<td align='right'> Pos:  $pos </span></td>";
            
        }
        ?>
    </li>
</ul>





