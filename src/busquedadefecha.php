<?php 
    include "../conexion.php";
    
    if(ISSET($_POST['search'])){
      $date1 = date("Y-m-d", strtotime($_POST['date1']));
      $date2 = date("Y-m-d", strtotime($_POST['date2']));
      
      $query=mysqli_query($conexion, "SELECT a.id_prestamocab, CONCAT(c.nombre, ' ', c.apellidoP)as nombre_cliente,
      d.descripcion,
       (SELECT descripcionproducto from cat_producto where id_producto  = b.id_producto) as Producto,	
       (SELECT id_producto from cat_producto where id_producto  = b.id_producto) ,
       (SELECT id_prestamodet from log_prestamo_det where id_prestamodet  = b.id_prestamodet),
       (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
       a.fh_prestamo,a.id_estatus 
      FROM log_prestamo_cab a,
          log_prestamo_det b,
          cat_cliente c, 
          cat_salon d,
          cat_producto e
      WHERE a.id_prestamocab = b.id_prestamodet 
      AND a.id_cliente = c.id_cliente
      AND a.id_salon = d.id_salon
      AND b.id_producto = e.id_producto
      AND a.fh_prestamo BETWEEN '$date1' AND '$date2'") or die(mysqli_error());

$row=mysqli_num_rows($query);
if($row > 0){ 
while($fetch=mysqli_fetch_array($query)){
    if ($fetch['id_estatus'] == 3) {
      $estado = '<span class="badge badge-pill badge-dañado">Dañado</span>';
  } elseif  ($fetch['id_estatus'] == 2){
      $estado = '<span class="badge badge-pill badge-devuelto">Devuelto</span>';
  }elseif ($fetch['id_estatus'] == 1) {
      $estado = '<span class="badge badge-pill badge-prestado">Prestado</span>';
  }else{
      $estado = '<span class="badge badge-pill badge-extraviado">Extraviado</span>';  
  }
?>
<tr>
<td><?php echo $fetch[0]?></td>
  <td><?php echo $fetch[1]?></td>
  <td><?php echo $fetch[2]?></td>
  <td><?php echo $fetch[3]?></td>
  <td><?php echo $fetch[6]?></td>
  <td><?php echo $fetch[7]?></td>
  <td><?php echo $estado ?></td>
  <td>
   
  <?php if ($fetch['id_estatus'] == 1) { ?>
    
    <form action="Devuelto.php?id_cab=<?php echo $fetch[0];?> && id_prod=<?php echo $fetch[4];?>
       && id_usua=<?php echo $fetch[5];?>" method="post" class="confirmardevuelto d-inline">
      
    <button class="btn btn-devuelto" type="submit">Devuelto</button>
    
    </form>
    <form action="Extraviado.php?id=<?php echo $fetch[0]; ?>&& id_est=<?php echo $fetch[5];?>" method="post" class="confirmarextraviado d-inline">
        <button class="btn btn-extraviado" type="submit">Extraviado</button>
    </form>
    <form action="Dañado.php?id=<?php echo $fetch[0]; ?>&& id_est=<?php echo $fetch[5];?>" method="post" class="confirmardañado d-inline">
        <button class="btn btn-danger" type="submit">Dañado</button>
    </form>
  <?php } ?>
      </td>
    </tr>
            
  <?php
        }
      }else{
        echo'
        <tr>
          <td colspan = "6"><center>Registros no Existen</center></td>
        </tr>';
      }
    }else{
$query=mysqli_query($conexion, " SELECT a.id_prestamocab, CONCAT(c.nombre, ' ', c.apellidoP)as nombre_cliente,
d.descripcion,
 (SELECT descripcionproducto from cat_producto where id_producto  = b.id_producto) as Producto,	
 (SELECT id_producto from cat_producto where id_producto  = b.id_producto) ,
 (SELECT id_prestamodet from log_prestamo_det where id_prestamodet  = b.id_prestamodet),
 (SELECT usuario from cat_usuario where id_usuario  = b.id_usuarioprestamo) as Usuario_Presta,
 a.fh_prestamo,a.id_estatus 
FROM log_prestamo_cab a,
    log_prestamo_det b,
    cat_cliente c, 
    cat_salon d,
    cat_producto e
WHERE a.id_prestamocab = b.id_prestamodet 
AND a.id_cliente = c.id_cliente
AND a.id_salon = d.id_salon
AND b.id_producto = e.id_producto ") or die(mysqli_error());
 
    $row=mysqli_num_rows($query);
    if($row > 0){ 
    while($fetch=mysqli_fetch_array($query)){
        if ($fetch['id_estatus'] == 3) {
          $estado = '<span class="badge badge-pill badge-dañado">Dañado</span>';
      } elseif  ($fetch['id_estatus'] == 2){
          $estado = '<span class="badge badge-pill badge-devuelto">Devuelto</span>';
      }elseif ($fetch['id_estatus'] == 1) {
          $estado = '<span class="badge badge-pill badge-prestado">Prestado</span>';
      }else{
          $estado = '<span class="badge badge-pill badge-extraviado">Extraviado</span>';  
      }
  ?>
    <tr>
    <td><?php echo $fetch[0]?></td>
      <td><?php echo $fetch[1]?></td>
      <td><?php echo $fetch[2]?></td>
      <td><?php echo $fetch[3]?></td>
      <td><?php echo $fetch[6]?></td>
      <td><?php echo $fetch[7]?></td>
      <td><?php echo $estado ?></td>
      <td>
       
      <?php if ($fetch['id_estatus'] == 1) { ?>
        
        <form action="Devuelto.php?id_cab=<?php echo $fetch[0];?> && id_prod=<?php echo $fetch[4];?>
           && id_usua=<?php echo $fetch[5];?>" method="post" class="confirmardevuelto d-inline">
          
        <button class="btn btn-devuelto" type="submit">Devuelto</button>
        
        </form>
        <form action="Extraviado.php?id=<?php echo $fetch[0]; ?>&& id_est=<?php echo $fetch[5];?>" method="post" class="confirmarextraviado d-inline">
            <button class="btn btn-extraviado" type="submit">Extraviado</button>
        </form>
        <form action="Dañado.php?id=<?php echo $fetch[0]; ?>&& id_est=<?php echo $fetch[5];?>" method="post" class="confirmardañado d-inline">
            <button class="btn btn-danger" type="submit">Dañado</button>
        </form>
      <?php } ?>
      </td>
    </tr>
  <?php
      }
    }
    }
  ?>