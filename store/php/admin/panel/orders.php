<?php
// Autoload classes.
require '../../../../vendor/autoload.php';

use store\Controllers\OrderController;

$ref = $_GET['ref'];

$order = new OrderController;

$products = $order->show($ref);

var_dump($products);