<?
function update_categories($newname,$newname_eng,$catid,$details,$details_eng,$id_ext,$stock,$new_pos)
{
$conn = db_connect();

//Comprobamos si ys está ocupada la POSición de la categoría

 $conn = db_connect();
   $query = "SELECT pos
             FROM categories
			 WHERE pos=$new_pos";
		
$result = mysql_query($query);
   //Solo actualizar si existe ese pos
   if (mysql_num_rows ($result) > 0)
   {
   	$last_pos=last_pos ();
   //Si ya está ocupada esa posición aumentamos en todas una posición desde la que añadimos en adelante
   /*if (mysql_num_rows($result)>0 )
     $result =mysql_query("UPDATE categories
             			   set pos=pos + 1
			              WHERE pos >= $new_pos
						  ");
		
	*/
	$result = mysql_query("	SELECT catid,pos
             				FROM categories
			 				WHERE pos=$new_pos");
	if ($result)
	{
		$catid_array= db_result_to_array($result);
	}		 
	
	//Actualizamos la posición de la categoría que queremos cambiar
  if ($result)
    $result=mysql_query ( "update categories 
             				set pos='$new_pos',
			 				where catid='$catid' " ); 
	$result=mysql_query ( "update categories 
             				set pos='$catid_array[1]',
			 				where catid='$catid_array[0]' " ); 
   
   }
//Si la id_ext no es NULL , es decir si se sube una imagen de remplazo
if ($id_ext!=NULL)  
{
   $query = "UPDATE categories
             SET cat_name='$newname' ,
			 	 cat_name_eng='$newname_eng' ,
			 	 cat_details='$details',
				 cat_details_eng='$details_eng',
				  id_ext='$id_ext',
				  stock='$stock'
			 WHERE catid='$catid' ";

}		
else
{

$query = "UPDATE categories
             SET cat_name='$newname' ,
			 	 cat_name_eng='$newname_eng' ,
			 	 cat_details='$details',
				 cat_details_eng='$details_eng',
				 stock='$stock'
			 WHERE catid='$catid' ";

}	 
   $result = mysql_query($query);
   if (!$result)
     return false;
   else
     return true;

}
?>