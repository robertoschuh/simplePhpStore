<?php
    
function to_view_articulos($articles) {
          $pedidos= array();

    foreach ($articles as $row) {
     
        // Reorden de los artículos en un array bidimensional, agrupados por Pedidos-Referencias.
         $pedidos[$row['ref']][] = $row;

    }
    $actual_ref = FALSE;

    print '<div class="lista-pedidos">';
    foreach ($pedidos as $pedido => $productos) {
       
        if ($actual_ref != $pedido){
            if ($actual_ref == FALSE){ // primera vez que se ejecuta.
                print '<div class="pedido"><p class= "ver">Ver pedido</p><h2> '
                . '<a href= "consulta_pedidos.php?ref='. $pedido .'" target="_self" class="pedidos_links">Pedido Ref: '. $pedido . '</a>'
                    . '</h2>';
                           print '<ul class = "hide_cls">'; 

            }
         else {   
            print '</ul></div>';
            print '<div class="pedido"><p class= "ver">Ver pedido</p><h2> ' 
            . '<a href= "consulta_pedidos.php?ref='. $pedido .'" target="_self" class="pedidos_links">Pedido Ref: '. $pedido . '</a>'
                    . '</h2>';
         
           print '<ul class = "hide_cls">'; 
         }
        }
        foreach ($productos as $producto){
           
            print '<li>' . $producto['nombre'] . '</li>';
            print '<li>' . $producto['precio'] . '</li>';
            
        }
        
         $actual_ref = $pedido;
    }
    print '</div>';

}
