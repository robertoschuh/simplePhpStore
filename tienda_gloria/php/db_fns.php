<?php

function db_connect() {

    try{
        $result = mysql_pconnect("localhost", "root", "nubi");

    }catch (Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
    try{
        $local = mysql_select_db("wwwglor_gloria");
        
    }catch (Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
    try{
        mysql_query("SET NAMES 'utf8'", $result);
    }catch (Exception $e){
        echo 'Excepción capturada: ',  $e->getMessage(), "\n";
    }
 
    return $result;
}

function db_result_to_array($result) {
    $res_array = array();

    for ($count = 0; $row = mysql_fetch_array($result); $count++)
        $res_array[$count] = $row;

    return $res_array;
}
