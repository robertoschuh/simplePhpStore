<?php

function db_connect() {

    //$result = mysql_pconnect("vps39665.ovh.net", "www_botonero", "wch88C^9");
    $result = mysql_pconnect("localhost", "root", "nubi");
    if (!$result)
        return false;


    $local = mysql_select_db("wwwglor_gloria");
    mysql_query("SET NAMES 'utf8'", $result);
    if (!$local)
        return false;
    else
        return $result;
}

function db_result_to_array($result) {
    $res_array = array();

    for ($count = 0; $row = mysql_fetch_array($result); $count++)
        $res_array[$count] = $row;

    return $res_array;
}
