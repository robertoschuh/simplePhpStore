<?php
// Autoload classes.
require '../vendor/autoload.php';
define('ROOT_FOLDER', 'store');

use store\Controllers\OrderController;
use Windwalker\Renderer\BladeRenderer;
use store\Helpers\Pdf;

$paths = array(__DIR__ . '/resources/views');
$renderer = new BladeRenderer($paths, array('cache_path' => __DIR__ . '/cache'));


$ref = $_GET['ref'];

$order = new OrderController;

$output = getHtml($order->show($renderer, $ref));

//echo $order->show($renderer, $ref);

// get pdf
if(!isset($_GET['pdf'])) {

    //Pdf::show("http://" . $_SERVER['HTTP_HOST'] . "/" . ROOT_FOLDER . "/orders.php?ref=$ref&pdf=1");
    Pdf::show($output, $ref);
}

function getHtml($html){
   // var_dump($html); exit;
    return $html;
}