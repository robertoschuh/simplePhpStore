<?php

// Return a json product list.
include ('php/db_fns.php');
include ('php/arts_fns.php');

try{
	$products = get_arts();

}catch (Exception $e) {
	 echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

$json = str_replace('\/','/',json_encode($products));
//write to json file
$fp = fopen('products-list.json', 'w');
try{
	fwrite($fp, $json);

}catch (Exception $e) {
	 echo 'Excepción escribiendo json: ',  $e->getMessage(), "\n";
}

fclose($fp);