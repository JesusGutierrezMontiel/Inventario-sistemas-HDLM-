<?php
require_once "includes/header.php";
require  ("../conexion.php");

// AVISO DE QUE ESTEN COMPLETOS LOS CAMPOS DE LA TABLA cat_proveedor formulario
if(!empty($_POST)){
    $alert = "";
    if ( empty($_POST['razon_social'] || empty($_POST['telefono']) || empty($_POST['id_area'])) ) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
}else{
        $razon_social = $_POST['razon_social'];
        $telefono = $_POST['telefono'];
        $id_area = $_POST['id_area'];
        
        $query = mysqli_query($conexion, "SELECT * FROM cat_proveedor WHERE razon_social = '$razon_social'");
        $result = mysqli_fetch_array($query);
        if($result > 0){
            $alert= '<div class="alert alert-danger" role="role">
            La razon social ya existe
            </div>';
        }else{
            $query_insert = mysqli_query($conexion, "INSERT INTO cat_proveedor (id_proveedor,razon_social,telefono,id_area) VALUES
            (NULL,(UPPER('$razon_social')),'$telefono','$id_area')");
            if($query_insert){
                $alert = '<div class="alert alert-success" role="alert">
                Proveedor registrado
            </div>';
        } else {
             $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar
        </div>';
        }
    }
}
mysqli_close($conexion);
}
?>
<div class="form-group">
            <h4 class="text-center">Proveedores</h4>
        </div>
<button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_cliente"><i class="fas fa-plus"></i></button>
<?php echo isset($alert) ? $alert : ''; ?>
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Razon Social</th>
                <th>Telefono</th>
                <th>Estado</th>
                <th></th>
</tr>
</thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT * FROM cat_proveedor");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    if ($data['estatus'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
            ?>
            <tr>
                        <td><?php echo $data['id_proveedor']; ?></td>
                        <td><?php echo $data['razon_social']; ?></td>
                        <td><?php echo $data['telefono']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <?php if ($data['estatus'] == 1) { ?>
                                <a href="editar_proveedor.php?id=<?php echo $data['id_proveedor']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_proveedor.php?id=<?php echo $data['id_proveedor']; ?>" method="post" class="confirmar d-inline">
                                    <button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
                                </form>
                                <?php } ?>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
        </table>
</div>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nuevo Proveedor</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              

            <!------------------------------------------------------------------------------------------------------------------->
            <form action="" class="formulario" id="formulario" method="post">

			<!-- Grupo: Razon Social -->
			<div class="formulario__grupo" id="grupo__razon">
				<label for="razon_social" class="formulario__label">Razon Social</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="razon_social" id="razon_social" placeholder="Ingresa la Razon Social"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
			</div>
<br>
			

			<!-- Grupo: Teléfono -->
			<div class="formulario__grupo" id="grupo__telefono">
				<label for="telefono" class="formulario__label">Teléfono</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="telefono" id="telefono" placeholder="Escribe tu numero de telefono">
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
                    
				</div>
				</div>
                <br>
  <!-- Grupo: area -->
  <div class="formulario__grupo" id="grupo__area">
<label for="id_area" class="formulario__label">Area</label>
<select name="id_area" id="id_area" class="formulario__input" >
<div class="formulario__grupo-input">
                     <option value="">Area:</option>
        <?php
        $query = $conexion -> query ("SELECT * FROM cat_area");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_area].'">'.$valores[descripcion]. '</option>';
          }
        
        ?>
      </select> 
                   <BR>
      <BR></BR><Center>
      <input type="submit" value="Guardar Proveedor" class="btn btn-primary"></Center>
			</div>
		</form>
        <script src="validacion/formularioproveedores.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            </div>
        </div>
    </div>
</div>


<?php include_once "includes/footer.php"; ?>
