<?php include_once "includes/header.php";
include "../conexion.php";

if (!empty($_POST)) {
    
    if (empty($_POST['usuario']) || empty($_POST['nombre']) || empty($_POST['apellidoP']) || empty($_POST['apellidoM']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['id_perfil'])) {
        $alert = '<div class="alert alert-danger" role="alert">
        Todo los campos son obligatorios
        </div>';
    } else {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $apellidoM = $_POST['apellidoM'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $id_perfil = $_POST['id_perfil'];


    
        $query = mysqli_query($conexion, "SELECT * FROM cat_usuario where correo = '$correo'");
        $result = mysqli_fetch_array($query);
        if ($result > 0) {
            $alert = '<div class="alert alert-warning" role="alert">
                        El correo ya existe
                    </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO cat_usuario(usuario, nombre, apellidoP, apellidoM, telefono, correo,contrasena,id_perfil) values ((UPPER('$usuario')), (UPPER('$nombre')), (UPPER('$apellidoP')), (UPPER('$apellidoM')),'$telefono', '$correo', '$contrasena', '$id_perfil')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                            Usuario registrado
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
            <h4 class="text-center">Usuarios</h4>
        </div>
        <?php echo isset($alert) ? $alert : ''; ?>
<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#nuevo_usuario"><i class="fas fa-plus"></i></button>
<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered mt-2" id="tbl">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../conexion.php";

            $query = mysqli_query($conexion, "SELECT * FROM cat_usuario ORDER BY estatus DESC");
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

                        <td><?php echo $data['id_usuario']; ?></td>
                        <td><?php echo $data['nombre']; ?></td>
                        <td><?php echo $data['correo']; ?></td>
                        <td><?php echo $data['usuario']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <?php if ($data['estatus'] == 1) { ?>
                                
                                <a href="editar_usuario.php?id=<?php echo $data['id_usuario']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
                                <form action="eliminar_usuario.php?id=<?php echo $data['id_usuario']; ?>" method="post" class="confirmar d-inline">
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

<div id="nuevo_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title">Nuevo Usuario</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
 <!------------------------------------------------------------------------------------------------------------------->
            <form action="" class="formulario" id="formulario" method="post">

			<!-- Grupo: Usuario -->
			<div class="formulario__grupo" id="grupo__usuario">
				<label for="usuario" class="formulario__label">Usuario</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="usuario" id="usuario" placeholder="Ingresa tu Usuario"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>
			<!-- Grupo: Nombre -->
			<div class="formulario__grupo" id="grupo__nombre">
				<label for="nombre" class="formulario__label">Nombre</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Ingresa tu Nombre"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>
            <!-- Grupo: Apellido Paterno -->
			<div class="formulario__grupo" id="grupo__apellidoP">
				<label for="apellidoP" class="formulario__label">Apellido Paterno</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="apellidoP" id="apellidoP" placeholder="Escribe tu Apellido Paterno"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El Apellido Paterno tiene que ser de 4 a 16 dígitos y solo puede letras .</p>
			</div>
<br>
             <!-- Grupo: Apellido Materno -->
			<div class="formulario__grupo" id="grupo__apellidoM">
				<label for="apellidoM" class="formulario__label">Apellido Materno</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="apellidoM" id="apellidoM" placeholder="Escribe tu Apellido Materno"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El Apellido Materno tiene que ser de 4 a 16 dígitos y solo  letras.</p>
			</div>
<br>

			<!-- Grupo: Teléfono -->
			<div class="formulario__grupo" id="grupo__telefono">
				<label for="telefono" class="formulario__label">Teléfono</label>
				<div class="formulario__grupo-input">
					<input type="text" class="formulario__input" name="telefono" id="telefono" placeholder="Escribe tu numero de telefono"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
                    
				</div>
				<p class="formulario__input-error">El telefono solo puede contener numeros y el maximo son 14 dígitos.</p>
			</div>
<br> 
            <!-- Grupo: Correo Electronico -->
            <div class="formulario__grupo" id="grupo__correo">
				<label for="correo" class="formulario__label">Correo Electrónico</label>
				<div class="formulario__grupo-input">
					<input type="email" class="formulario__input" name="correo" id="correo" placeholder="Ingrese tu Correo Electronico"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El correo solo puede contener letras, numeros, puntos, guiones y guion bajo.</p>
			</div>
<br> 
            <!-- Grupo: Contraseña -->
            <div class="formulario__grupo" id="grupo__contrasena">
				<label for="contrasena" class="formulario__label">Contraseña</label>
				<div class="formulario__grupo-input">
					<input type="password" class="formulario__input" name="contrasena" id="contrasena" placeholder="Ingrese tu Contraseña"required>
					<i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">La contraseña tiene que ser de 4 a 12 dígitos.</p>
			</div>
<br> 
    <!-- Grupo: Perfil -->
    <div class="formulario__grupo" id="grupo__perfil">
<label for="id_perfil" class="formulario__label">Perfil</label>
<select name="id_perfil" id="id_perfil" class="formulario__input">
<div class="formulario__grupo-input">
                     <option value="0"  >Perfil:</option>
        <?php
        $query = $conexion -> query ("SELECT * FROM cat_perfil");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_perfil].'">'.$valores[descripcionperfil].'</option>';
          }
        
        ?>
      </select> 
      <BR></BR><Center>
      <input type="submit" value="Guardar Usuario" class="btn btn-primary"></Center>
				<p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
			</div>
		</form>
        <script src="validacion/formulariousuarios.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
            </div>
        </div>
    </div>
</div>


<?php include_once "includes/footer.php"; ?>