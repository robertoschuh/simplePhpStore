<div class='articulos'>
<table align='left' ><tr><td width='100%' ><?php echo $title;?></td></tr>
<tr><td  align='center' align='center'><?php echo $name;?></td></tr>
<tr ><td class='ref' align='center'>Ref: <?php echo $ref;?></td></tr>
<tr><td> <a href=$url class='images_links'>
 <img src='../../tienda_gloria/php/admin/panel/img/arts/$img?=rand(0,999)'
class='img_med'></a></td> </tr>
<tr><td class='descript' ><a href=$url class='ampliar'>Ampliar</a></td> </tr>
<tr><td class='descript'><?php echo $details_short;?></td> </tr>
<tr><td class='precio'><?php echo $cost;?>: <?php echo $price;?>  &euro;</td> </tr>
<?php
if(session_is_registered("admin_user") )
{	
if ($existencias['unidades'] == 0 )
echo "<tr><td class='agotado'>Producto Agotado</td> </tr>";
else
echo "<tr><td class='agotado'>Existencias: ". $existencias['unidades']."</td> </tr>";
}
else
echo "<tr><td class='agotado'> </td> </tr>";
if(session_is_registered("admin_user"))
echo "<tr><td align='center'><a href='admin/panel/mod_art_form.php?artid=$row[artid]&ref=$ref'class='modificar'> Modificar</a> </td> </tr>";
else {?>
<td  align='center'>
<a href='../carrito_php/mete_producto.php?catid=<?php echo $cat;?>&nombre=<?php echo $name;?>&id=<?php echo $row['artid'];?>&precio=<?php echo $row['art_price'];?>
&img=$img&ref=$ref'
class='anadir_cesta'><?php echo utf8_encode($comprar);?></a></td></table>
</div>
<?php }?>