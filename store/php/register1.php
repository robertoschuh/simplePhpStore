<?php
include ("idiomas/idiomas_fns.php");
$apagar=$_GET['apagar'];

?>
<div id='register'>
<form id="form1" name="form1" method="post" action="insert_new_user.php">
  <p>&nbsp;</p>
  <table width="80%" heigth="100%"  border="0" align='center' >
    <tr>
      <th colspan="3" class="titulos_texto"><div align="center" ><? echo $register ?></div></th>
    </tr>
	<tr>
	<td colspan="3" align="center"> <b>Bienvenido: </b></br></td>
	</tr>
	<tr>
	<td colspan="3" align="center">Complete sus datos y recuerde bien la contrase�a (m�ximo 10 d�gitos).</br> La pr�xima vez que regrese
		a la tienda solo tendr� que introducir su Email y su Contrase�a.<br /><br /></td>
	</tr>
	<tr>
	<td> </td>
	</tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $name  ?></span></td>
      <td><label>
        <input name="name" type="text" id="name" />
      </label></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $surname  ?></span></td>
      <td><input name="surname" type="text" id="surname" /></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $adress  ?></span></td>
      <td><input name="adress" type="text" id="adress" size="50" /></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $city ?></span></td>
      <td><input name="city" type="text" id="city" /></td>
    </tr>
	 <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $postal  ?></span></td>
      <td><input name="zip" type="text" id="zip" /></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $state  ?></span></td>
      <td><input name="state" type="text" id="state" /></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $country  ?></span></td>
      <td><label>
        <select name="country">
          <option value="1" selected="selected">Espa&ntilde;a</option>
          <option value="2" >Alemania</option>
          <option value="3">Suecia</option>
          <option value="4">Portugal </option>
          <option value="5">Suiza</option>
          <option value="6">Francia</option>
          <option value="7">Italia</option>
          <option value="8">Holanda</option>
          <option value="9">Belgica</option>
          <option value="10">Andorra</option>
		   <option value="11">Dinamarca</option>
          <option value="12">Grecia</option>
          <option value="13">Austria</option>
       
        </select>
      </label></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $telf  ?></span></td>
      <td><input name="telf" type="text" id="telf" /></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo  $celular  ?></span></td>
      <td><input name="celular" type="text" id="celular" /></td>
    </tr>
    <tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names">Email </span></td>
      <td><input name="email" type="text" id="email" size="50" maxlength="50" /></td>
    </tr>
	
	<tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo $pass ?></span></td>
      <td><input name="password" type="text" id="password" size="50" maxlength="50" /></td>
    </tr>
	<tr>
      <td bordercolor="#1A1A1A" align="right"><span class="form_names"><? echo $pass_repeat ?></span></td>
      <td><input name="password2" type="text" id="password2" size="50" maxlength="50" /></td>
    </tr>
	<tr>
	<td> </td>
	</tr>
	<tr>
	<td> </td>
	</tr>
    <tr>
	<td colspan='2' class='form_names' ><center><? echo $texto_ofertas ?></center> </td>
	</tr> 
	<tr>
	
	<td colspan='2' align="center"><p>
	  <label>
	    <input name="promo" type="radio" value="1" checked="checked"  />
	    Si</label>
	  <br />
	  <label>
	    <input  name="promo" type="radio" value="2" />
	   No</label>
	  <br />
	  </p></td>
	</tr>
      <td colspan="2" align="center"><label>
        <div align="center"> <br />
        <input type="submit" name="Submit" value="Enviar" />
          </div></label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  	  	  <input name="apagar" type="hidden" value="<? echo $apagar ?>" />
</form>
</div>