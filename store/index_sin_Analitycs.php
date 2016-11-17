<?
@session_start();

if (!$_SESSION['init'])
	$_SESSION['init']=1;

if ($_GET['loged_of']==1)

	 session_unregister("valid_user");

//Comprueba el idioma
if (session_is_registered("idioma"))
{
	$_SESSION['idioma']=$_GET['language'];
	
}		
else
{
	session_register("idioma");	
	$_SESSION['idioma']=$_GET['language'];
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="belenes,artesanía belensística,artesanía,natividad,miniaturas" />
<meta name="description" content="belenes artesanos y miniaturas elaborados por artesana gloria botonero" />

<title>artesanía de belenes y miniaturas</title>
<link href="gloria.css" rel="stylesheet" type="text/css" />

</head>

<frameset  class='frame_header' rows="140,*" cols="*" framespacing="0" frameborder="no" border="0">

  <frame src="header.php" name="topFrame" frameborder="no" scrolling="no" marginwidth="0" marginheight="7" bordercolor="#993300" id="topFrame" title="topFrame"  />
  
  <frameset rows="*" cols="180,*" framespacing="0" frameborder="no" border="0" >
  
		<frame src="php/show_menu_categories.php" name="leftFrame" frameborder="no" scrolling="auto" marginheight="0" id="leftFrame" title="leftFrame" />
        
		<frame src="php/categories.php"  name="mainFrame" frameborder="no" scrolling="auto" bordercolor="#FF9933" id="mainFrame" title="mainFrame"/>
 
 </frameset>
</frameset>


<noframes><body>
</body>
</noframes></html>
