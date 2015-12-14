<?php

// Return a json product list.
include ('php/db_fns.php');
include ('php/cats_fns.php');

try{
	$categories = get_categories();

}catch (Exception $e) {
	 echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}

$json = str_replace('\/','/',json_encode($categories));
//write to json file
$fp = fopen('categories-list.json', 'w');
try{
	fwrite($fp, $json);

}catch (Exception $e) {
	 echo 'Excepción escribiendo json: ',  $e->getMessage(), "\n";
}

fclose($fp);