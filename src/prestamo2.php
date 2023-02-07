<?php 
include_once "includes/header.php";
require("../conexion.php");
?>
<!-- Custom styles for this template -->
<script type="text/javascript" src="libs/ajax.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />

<div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-header bg-primary text-white text-center">
                Datos Cliente
            </div>
            <div class="card-body">
				<form method="post" action="actualizarprestamo.php">
                    <div class="row">
                        <div class="col-lg-4">
                          <div>
                            <label for="id_prod" class="formulario__label">Nombre:</label>
								<!-- Lista de clientes -->
                            <?php
							 $query = $conexion -> query ("SELECT distinct p.nombre, p.apellidoP, p.apellidoM, d.id_cliente from cat_cliente p join detalle_temporal_pres d ON (p.id_cliente = d.id_cliente)")
                                                  or die( mysqli_error($conexion));
                            while ($valores = mysqli_fetch_array($query)) {
                            echo '<th>'.$valores['nombre']." ".$valores['apellidoP']." ".$valores['apellidoM'].'</th>';
								?>
							 <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $valores['id_cliente']; ?>" >
							  <?php
					         }
								?>
                            
                            <!-- Grupo: Salon -->
<label for="id_prod" class="formulario__label">Salon:</label>
<?php
							$query = $conexion -> query ("SELECT distinct s.descripcion, d.id_salon from cat_salon s join detalle_temporal_pres d ON (s.id_salon = d.id_salon)")
                                                  or die( mysqli_error($conexion));
                            while ($valores = mysqli_fetch_array($query)) {
                            echo '<th>'.$valores['descripcion'].'</th>';
								?>
							<input type="hidden" name="id_salon" id="id_salon"  value ="<?php echo $valores['id_salon']; ?>" >
							  <?php
					         }
							?>

	 <!-- Lista de productos -->
<label for="id_prod" class="formulario__label">Producto</label>
<select style="width: 200px" name="id_prod" id="id_prod" class="formulario__input"> 
<div class="formulario__grupo-input">
                     <option value="">Producto:</option>
        <?php
        $query = $conexion -> query ("SELECT * FROM cat_producto");
          while ($valores = mysqli_fetch_array($query)) {
			  if ($valores['cantidad']>0){
				echo '<option value="'.$valores[id_producto].'">'.$valores[descripcionproducto]. '</option>';  
			  }else{
				  
			  }
          }
        
        ?>
      </select>
                          </div>
	<br>
	<button type="submit">Agregar producto</button><br>
                    </div>
            </div>
			</div>
		 
<BR>
	</form>
	<form method="post" action="eliminar.php" >
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                Datos Prestamo
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label><i class="fas fa-user"></i> USUARIO</label>
                            <p style="font-size: 16px; text-transform: uppercase; color: red;"><?php echo $_SESSION['nombre']; ?></p>
                        </div>
                    </div>
            </div>
                     <div class="modal-body">
			 <table border="1px" cellpadding="5px" width="100%" class="table table-dark table-striped">
			<thead >
				<tr>
					<th colspan="6"><CENTER>LISTA DE PRODUCTOS</CENTER></th>
				</tr>
				<tr>
					<th>Producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Opcion</th>
				</tr>
				<?php 
					$query = $conexion -> query ("SELECT p.id_producto,p.descripcionproducto, p.precio, d.cantidad, d.id_detalle_temp 
												 from cat_producto p join detalle_temporal_pres d ON (p.id_producto = d.id_producto)")
                                 or die( mysqli_error($conexion));
					     while ($valores = mysqli_fetch_array($query)) {
						 ?>
				<tr>
					     <th width="50" height="30" ><?php echo $valores['descripcionproducto'];?></th>
						 <th width="50" height="30"><?php echo $valores['precio'];?></th>
						 <th width="50" height="30"><?php echo $valores['cantidad'];?></th>
						 <th width="50" height="30"> 
					     <input type="hidden" name="id_detalle_temp" id="id_detalle_temp" value="<?php echo $valores['id_detalle_temp']; ?>" > 
						 <input type="hidden" name="id_prod" id="id_prod" value="<?php echo $valores['id_producto']; ?>" >
						 <CENTER><button type="submit" class="btn btn-outline-danger"  value="Eliminar producto" target="_blank">Eliminar producto</button></th>;
     				
						 </CENTER>	</tr>
				<?php
					 }
				?>
			</thead>			
		</table>
			 </div>
				</form>
				<br>
			    <form method="post" action="../pdf.php" target="_blank">
				<button onclick="miFunc()" type="submit" value="Guardar Pedido" target="_blank">Guardar pedido</button><br>
				</form>
		</div>
			<?php include_once "includes/footer.php"; ?>
	<script>
  function miFunc() {
	  setInterval("location.reload('prestamo.php')");
  }
</script>
		