
$( document ).ready(function() {
  $( ".fondo_filas_panel TD " ).click(function() {
//  alert( "El texto del mensaje va a cambiar." );
  var td_html = $(this).html();
  tinyMCE.activeEditor.setContent(td_html);


});
});

