$(document).ready(function() {
  $( ".fondo_filas_panel TD " ).click(function() {
  var td_html = $(this).html();
  tinyMCE.activeEditor.setContent(td_html);
  
    });

 
    $(".pedido").click(function() {
        $( ".pedido ul" ).addClass( "hide_cls" );          
        var pedido = $(this).find('ul');     
        pedido.removeClass( "hide_cls" ).addClass( "selected_cls" );
        });  
    
    //desplegados
    $("#desplegados").click( function(){
        if( $(this).is(':checked') ) {
            $( ".pedido ul" ).removeClass( "hide_cls" ).addClass( "selected_cls" );    
        } else {
            $( ".pedido ul" ).removeClass( "selected_cls" ).addClass( "hide_cls" );    
        }
    });
});

