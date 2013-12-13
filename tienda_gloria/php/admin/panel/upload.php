<?
function upload_image($image,$path,$path_peq,$size,$size_peq)

{
include('class.upload.php');
if ($image) {

    // ---------- IMAGE UPLOAD ----------
    
    // we create an instance of the class, giving as argument the PHP object 
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($image);
	$handle_peq= new Upload($image);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {
       $handle_peq->uploaded ;
        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        $handle->image_resize            = true;
        $handle->image_ratio_y       = true;
        $handle->image_x                 = $size;
						
		
		$handle_peq->image_resize            = true;
        $handle_peq->image_ratio_y           = true;
        $handle_peq->image_x                 = $size_peq;

        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
        $handle->Process( $path );
		$handle_peq->Process( $path_peq );

        
        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<fieldset>';
            echo '  <legend>Imagen subida correctamente </legend>';
			
			
			$info = getimagesize($handle->file_dst_pathname);
            echo '  <p>' . $info['mime'] . ' &nbsp;-&nbsp; ' . $info[0] . ' x ' . $info[1] .' &nbsp;-&nbsp; ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB</p>';
            
		
			echo '</fieldset>';
        } 
		
		  if ($handle_peq->processed) {
            // everything was fine !
         echo '<fieldset>';
            echo '  <legend>Imagen subida correctamente </legend>';
			
			
			$info = getimagesize($handle_peq->file_dst_pathname);
            echo '  <p>' . $info['mime'] . ' &nbsp;-&nbsp; ' . $info[0] . ' x ' . $info[1] .' &nbsp;-&nbsp; ' . round(filesize($handle_peq->file_dst_pathname)/256)/4 . 'KB</p>';
            
		
			echo '<br>Esta imagen es la pequeña que se puede ver de los articulos</fieldset>';
        } 
}
}
}

function upload_image_cat($image,$path,$size)

{
include('class.upload.php');
if ($image) {

    // ---------- IMAGE UPLOAD ----------
    
    // we create an instance of the class, giving as argument the PHP object 
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($image);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {
       $handle->uploaded ;
        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        $handle->image_resize            = true;
        $handle->image_ratio_y       = true;
        $handle->image_x                 = $size;
						
		
	

        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->Process('/home/www/my_uploads/');
        $handle->Process( $path );
		

        
        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<fieldset>';
            echo '  <legend>Imagen subida correctamente </legend>';
			
			
			$info = getimagesize($handle->file_dst_pathname);
            echo '  <p>' . $info['mime'] . ' &nbsp;-&nbsp; ' . $info[0] . ' x ' . $info[1] .' &nbsp;-&nbsp; ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB</p>';
            
		
			echo '</fieldset>';
        } 
		
		 
}
}
}

?>