<?php
function get_almacen($artid)
{
$conn = db_connect();
   $query = "SELECT unidades
             FROM almacen
			 WHERE artid='$artid' ";
			 
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $result =mysql_fetch_array($result);
   return $result; //guarda los resultados en un array

}
function almacen_excaseces()
{
$conn = db_connect();
   $query = "SELECT *
             FROM almacen,articles
			 WHERE almacen.unidades<'30' 
			 AND almacen.artid=articles.artid
			 ";
			 
   $result = mysql_query($query);
   if (!$result)
     return false;
   $num_arts = mysql_num_rows($result);
   if ($num_arts ==0)
      return false;
   $result =db_result_to_array($result);
   return $result; //guarda los resultados en un array

}
