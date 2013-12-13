<?php
function db_connect()
{

      $result = mysql_pconnect("localhost", "wwwglor_gloria", "t5(GUO3?oE%{");
	  if (!$result)
      return false;
	 	

	$local=mysql_select_db("wwwglor_botonero");
	 if (!$local)
 	 
      return false;
else
   return $result;
}

function db_result_to_array($result)
{
   $res_array = array();

   for ($count=0; $row = mysql_fetch_array($result); $count++)
     $res_array[$count] = $row;

   return $res_array;
}

?>
