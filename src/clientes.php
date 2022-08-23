<?php include_once "includes/header.php";
include "../conexion.php";

// AVISO DE QUE ESTEN COMPLETOS LOS CAMPOS DE LA TABLA cat_cliente formulario
if (!empty($_POST)) {

   

    if (empty($_POST['nombre']) || empty($_POST['apellidoP']) || empty($_POST['apellidoM']) || empty($_POST['telefono'])) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $apellidoM = $_POST['apellidoM'];
        $telefono = $_POST['telefono'];
        $id_area = $_POST['id_area'];
        $usuario_id = $_SESSION['idUser'];

        $query = mysqli_query($conexion, "SELECT * FROM cat_cliente WHERE nombre = '$nombre'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El cliente ya existe
                                </div>';
        } else {
          
            $query_insert = mysqli_query($conexion, "INSERT INTO cat_cliente (nombre, apellidoP, apellidoM, telefono, id_area ) values ((UPPER('$nombre')), (UPPER('$apellidoP')), (UPPER('$apellidoM')), '$telefono', '$id_area')");
            if ($query_insert) {
                $alert = '<div class="alert alert-success" role="alert">
                                    Cliente registrado
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
            <h4 class="text-center">Clientes</h4>
        </div>
        <?php echo isset($alert) ? $alert : ''; ?>
<button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_cliente"><i class="fas fa-plus"></i></button>

<div class="table-responsive">
    <table class="table table-striped table-bordered" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido Materno</th>
                <th>Área</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            
<!-- consulta (query) de el id apareciendo solo la descripcion de que area es el cliente -->
            <?php
            include "../conexion.php";
            $query = mysqli_query($conexion, "SELECT a.id_cliente, a.nombre, a.apellidoP,a.apellidoM, a.telefono, b.descripcion, a.estatus
            FROM cat_cliente a,
                 cat_area b 
           WHERE a.id_area = b.id_area 
           AND a.id_cliente = id_cliente");
            $result = mysqli_num_rows($query);
            if ($result > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    if ($data['estatus'] == 1) {
                        $estado = '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        $estado = '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
            ?>
<!-- se manda a llamar las variables que se requieren mostrar en la tabla de clientes -->
                    <tr>
                        <td><?php echo $data['id_cliente']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $data['apellidoP']; ?></td>
                        <td><?php echo $data['apellidoM']; ?></td>
                        <td><?php echo $data['descripcion']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
<!-- nos direcciona al boton verde de modificar cliente -->
                            <?php if ($data['estatus'] == 1) { ?>
                                <a href="editar_cliente.php?id=<?php echo $data['id_cliente']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_cliente.php?id=<?php echo $data['id_cliente']; ?>" method="post" class="confirmar d-inline">
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
                <h5 class="modal-title" id="my-modal-title">Nuevo Cliente</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

<!---------------------------------------------------------------------------------------------------------------------------->


            <form action="" class="formulario" id="formulario" method="post">
			
			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingresa tu Nombre" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>
            <!-- Grupo: Apellido Paterno -->
			<div class="formulario__grupo" id="grupo__apellidoP">
				<label for="apellidoP" class="formulario__label">Apellido Paterno</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="apellidoP" id="apellidoP" placeholder="Ingresa tu Apellido Paterno" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El Apellido Paterno tiene que ser de 4 a 16 dígitos y solo puede letras .</p>
			</div>
<br>
             <!-- Grupo: Apellido Materno -->
			<div class="formulario__grupo" id="grupo__apellidoM">
				<label for="apellidoM" class="formulario__label">Apellido Materno</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="apellidoM" id="apellidoM" placeholder="Ingresa tu Apellido Materno" required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El Apellido Materno tiene que ser de 4 a 16 dígitos y solo  letras.</p>
			</div>
<br>

			<!-- Grupo: Teléfono -->
			<div class="formulario__grupo" id="grupo__telefono">
				<label for="telefono" class="formulario__label">Teléfono</label>
				<div class="formulario__grupo-input">
					<input type="number" class="formulario__input" name="telefono" id="telefono" placeholder="Escribe tu numero de teléfono " required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
                    
				</div>
				<p class="formulario__input-error">El teléfono  solo puede contener numeros y el maximo son 14 dígitos.</p>
			</div>
<br> 
    <!-- Grupo: Área -->
    <div class="formulario__grupo" id="grupo__area">
<label for="id_area" class="formulario__label">Área</label>
<select name="id_area" id="id_area" class="formulario__input" required>
<div class="formulario__grupo-input">
                     <option value="">Área:</option>
        <?php
        $query = $conexion -> query ("SELECT * FROM cat_area");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_area].'">'.$valores[descripcion]. '</option>';
          }
        
        ?>
      </select> 
                   <BR>
                   

			

			<div class="formulario__grupo formulario__grupo-btn-enviar">
				<button type="submit" class="formulario__btn">Enviar</button>
				</div>
		</form>
        <script src="validacion/formularioclientes.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>