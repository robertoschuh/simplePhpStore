
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?

@session_start();

require_once ("../../fns.php");
require_once ("../admin_fns.php");

$catid=$_POST['catid'];
$result=get_details($catid);
?>

<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="mod_cat.php">
  <p>&nbsp;</p>
  <table width="75%" border="0">
    <tr>
      <td bgcolor="#993300">&nbsp;</td>
      <td bgcolor="#000000"><div align="right" class="Estilo1">Paso 2/2 </div></td>
    </tr>
    
  
    <tr>
      <td height="21" bgcolor="#DEDEF4" class="comprar_option">&nbsp;</td>
      <td bgcolor="#DEDEF4"><strong>Detalles</strong>- espa&ntilde;ol </td>
      <td bgcolor="#DEDEF4"><strong>Detalles</strong>- ingl&eacute;s </td>
    </tr>
    <tr>
      <td height="201" bgcolor="#DEDEF4" class="comprar_option">&nbsp;</td>
	  <?
	 
	
	  	$details=$result['cat_details'];
		$cat_name=$result['cat_name'];
		$details_eng=$result['cat_details_eng'];
		$cat_name_eng=$result['cat_name_eng'];
		$stock=$result['stock'];
		$pos=$result['pos'];
	
	  ?>
      <td bgcolor="#DEDEF4"><textarea name="details" cols="50" rows="8"><? echo $details ?></textarea></td>
	  <td bgcolor="#DEDEF4"><textarea name="details_eng" cols="50" rows="8"><? echo $details_eng ?></textarea></td>
    </tr>
	 <tr>
      <td bgcolor="#999999" class="comprar_option"><strong>Nuevo Nombre </strong></td>
      <td bgcolor="#999999"><input name="newname" type="text" id="newname" value="<? echo $cat_name ?>"/></td>
    </tr>
	<tr>
      <td bgcolor="#999999" class="comprar_option"><strong>New name </strong></td>
      <td bgcolor="#999999"><input name="newname_eng" type="text" id="newname_eng" value="<? echo $cat_name_eng ?>"/></td>
   
	 </tr>
		<tr bgcolor="#E3E3ED">
		 <td><div align="right">
        Avisar a partir de
        <input name="stock" type="text" class='box' id="stock" size="8" value="<? echo $stock ?>" />
      existencias</div></td>
	   <td><div align="right">
     	Posición
        <input name="new_pos" type="text" class='box' id="new_pos" size="8" value="<? echo $pos ?>" />
      </div></td>
      <td colspan="3"><div align="center"> Reemplazar imagen
        <input type="file" name="file" class='box'/>
      </div></td>
    </tr>
	<tr bgcolor="#DEDEF4"> 
	<td>	<input name="catid" type="hidden" id="catid"  value="<? echo $catid ?>"/>
		<td>	<input name="old_pos" type="hidden" id="old_pos"  value="<? echo $pos ?>" />

	</td>
	</tr>
   <tr bgcolor="#DEDEF4"> 
      <td height="77" colspan="2"><label>
        <div align="center">
          <input name="Submit" type="submit" class="precio" value="Enviar" />
        </div>
      </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>

