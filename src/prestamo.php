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
<script type="text/javascript" src="actualizarpagina.js"></script>
<script type="text/javascript">
$(function() {
            $("#curso").autocomplete({
                source: "autoincrementar.php",
                minLength: 2,
                select: function(event, ui) {
					event.preventDefault();
					$('#curso').val(ui.item.nombre);
					$('#idn').val(ui.item.idn);
					$('#Nombre').val(ui.item.Nombre);
					$('#ApellidoP').val(ui.item.ApellidoP);
                    $('#ApellidoM').val(ui.item.ApellidoM);
					$("#curso").focus();
			     }
            });
		});
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="card-header bg-primary text-white text-center">
                Datos Cliente
            </div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                          <div>
                            <input type="hidden" id="id_cliente" value="1" name="id_cliente" required>
                            <label>Nombre</label>
								<!-- Lista de clientes -->
                            <select style="width: 200px" name="id_cliente" id="id_cliente" class="formulario__input" required>
<div class="formulario__grupo-input">
                     <option value="">Cliente:</option>
        <?php
        $query = $conexion -> query ("SELECT * FROM cat_cliente");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_cliente].'">'.$valores[nombre]." ".$valores[apellidoP]." ".$valores[apellidoM]. '</option>';
          }
        ?>
      </select> 
                         <!-- Grupo: Salon -->
<label>Salon</label>
<select style="width: 200px" name="id_salon" id="id_salon" class="formulario__input" required>
<div class="formulario__grupo-input">
                     <option value="">Salon:</option>
        <?php
        $query = $conexion -> query ("SELECT * FROM cat_salon");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_salon].'">'.$valores[descripcion]. '</option>';
          }
        
        ?>
      </select> 
	 <!-- Lista de productos -->
<label for="id_prod" class="formulario__label">Producto</label>
<select style="width: 200px" name="id_prod" id="id_prod" class="formulario__input" required> 
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
	<form method="post" action="eliminar.php">
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

			 <table  class="table table-dark table-striped">
			<thead class="productsHeader">
				<tr>
					<th colspan="6">LISTA DE PRODUCTOS</th>
				</tr>
				<tr>
					<th>Producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
					<th>Opcion</th>
				</tr>
				<?php 
					$query = $conexion -> query ("SELECT p.id_producto ,p.descripcionproducto, p.precio, d.cantidad, d.id_detalle_temp 
												 from cat_producto p join detalle_temporal_pres d ON (p.id_producto = d.id_producto)")
                                 or die( mysqli_error($conexion));
					     while ($valores = mysqli_fetch_array($query)) {
						 ?>
				<tr>
					     <th width="50" height="30"><?php echo $valores['descripcionproducto'];?></th>
						 <th width="50" height="30"><?php echo $valores['precio'];?></th>
						 <th width="50" height="30"><?php echo $valores['cantidad'];?></th>
						 <th width="50" height="30"> <input type="hidden" name="id_detalle_temp" id="id_detalle_temp" value="<?php echo $valores['id_detalle_temp']; ?>" > <input type="hidden" name="id_prod" id="id_prod" value="<?php echo $valores['id_producto']; ?>" ><button type="submit" value="Eliminar producto" target="_blank">Eliminar producto</button></th>;
     				</tr>
				<?php
					 }
				?>
			</thead>			
		</table>
			 </div>
				</form>
				<br>
				<form method="post" action="../pdf.php" target="_blank">
				<button onClick="location.href = location.href" type="submit" value="Guardar Pedido" target="_blank">Guardar pedido</button><br>
				</form>
		</div>
			<?php include_once "includes/footer.php"; ?>