<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?

@session_start();
$idioma=$_SESSION['idioma'];

require ("../../fns.php");
require ("../admin_fns.php");
require ("../stock_fns.php");

if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorizaci�n.<br>";
  echo "<a href='../acces.html'>Volver</a>";
  exit;
  
}
 panel_control ();

//Recibimos artid por medio de get 
$artid=$_GET[artid];
//obtenemos todos los detalles de este art�culo a trav�s de la funci�n get_article
$article=get_article($artid);
$unidades=get_almacen($artid);

//Formulario al que enviamos el array $article con los detalles del art�culo como valores por defecto

mod_article_form_stock  ($article,$unidades,$_GET['catid']);

?>