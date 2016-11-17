<link href="../gloria.css" rel="stylesheet" type="text/css" /><?

require ("fns.php");
@session_start();
//ver_carrito ();	
 
$cat=$_GET['cat']; 
$articles_array=get_article($_GET['artid']);

article_individual( $_GET['artid'],$cat );
?>

