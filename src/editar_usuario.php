<?php 
include_once "includes/header.php";
require "../conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['usuario']) || empty($_POST['nombre']) || empty($_POST['apellidoP']) || empty($_POST['apellidoM']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['contrasena']) || empty($_POST['id_perfil'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $id_usuario = $_GET['id'];
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $apellidoM = $_POST['apellidoM'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];
        $id_perfil = $_POST['id_perfil'];

        $sql_update = mysqli_query($conexion, "UPDATE cat_usuario SET usuario = UPPER('$usuario'), nombre = UPPER('$nombre'), apellidoP = UPPER('$apellidoP'), apellidoM = UPPER('$apellidoM'), telefono = '$telefono', correo = '$correo', contrasena = '$contrasena',  id_perfil = '$id_perfil' WHERE id_usuario = $id_usuario");
        
        if ($sql_update) {
            $alert = '<div class="alert alert-success" role="alert">Usuario Actualizado</div>';
        } else {
            $alert = '<div class="alert alert-danger" role="alert">Error al Actualizar usuario</div>'; 
        }
    }
}

// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: usuarios.php");
}
$id_usuario = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT a.id_usuario,a.usuario,a.nombre,a.apellidoP,
a.apellidoM,a.telefono,a.correo,a.contrasena,b.descripcionperfil
FROM cat_usuario a,
     cat_perfil b
WHERE a.id_perfil = b.id_perfil 
 AND a.id_usuario = $id_usuario;");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("Location: usuarios.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $id_usuario = $data['id_usuario'];
        $usuario = $data['usuario'];
        $nombre = $data['nombre'];
        $apellidoP = $data['apellidoP'];
        $apellidoM = $data['apellidoM'];
        $telefono = $data['telefono'];
        $correo = $data['correo'];
        $contrasena = $data['contrasena'];
    }
}
?>
  <?php echo isset($alert) ? $alert : ''; ?>
<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Modificar Usuario
            </div>
            <div class="card-body">
<!------------------------------------------------------------------------------------------------------------------->
 
                <form action="" class="formulario" id="formulario" method="post">
                  

                    
                    <div class="formulario__grupo" id="grupo__">
                    <input type="hidden" name="id" value="<?php echo $id_usuario; ?>">
                   
                   <!-- Grupo: Usuario -->
                   <div class="formulario__grupo" id="grupo__usuario">
                   <label for="usuario" class="formulario__label">Usuario</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" placeholder="Ingrese usuario" name="usuario" id="usuario" value="<?php echo $usuario; ?>">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
                   <!-- Grupo: nombre -->
                   <div class="formulario__grupo" id="grupo__nombre">
                   <label for="nombre" class="formulario__label">Nombre</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" placeholder="Ingrese nombre" class="formulario__input" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
                   <!-- Grupo: Apellido Paterno -->
                   <div class="formulario__grupo" id="grupo__apellidoP">
                   <label for="apellidoP" class="formulario__label">Apellido Paterno</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" placeholder="Ingrese Apellido Paterno"  class="formulario__input" name="apellidoP" id="apellidoP" value="<?php echo $apellidoP; ?>">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
                    <!-- Grupo: Apellido Materno -->
                   <div class="formulario__grupo" id="grupo__apellidoM">
                   <label for="apellidoM" class="formulario__label">Apellido Materno</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" placeholder="Ingrese Apellido Materno" class="formulario__input" name="apellidoM" id="apellidoM" value="<?php echo $apellidoM; ?>">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>   
                    </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
            <!-- Grupo: Telefono-->
            <div class="formulario__grupo" id="grupo__telefono">
                   <label for="telefono" class="formulario__label">Telefono</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" placeholder="Ingrese telefono" class="formulario__input" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>    
                    </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
                   <!-- Grupo: Correo Electronico-->
            <div class="formulario__grupo" id="grupo__correo">
                   <label for="correo" class="formulario__label">Correo Electronico</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="email" placeholder="Ingrese correo" class="formulario__input" name="correo" id="correo" value="<?php echo $correo; ?>">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>  
                    </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
                    <!-- Grupo: Contraseña-->
            <div class="formulario__grupo" id="grupo__contrasena">
                   <label for="contrasena" class="formulario__label">Contraseña</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" placeholder="Ingrese password" class="formulario__input" name="contrasena" id="password" value="<?php echo $contrasena; ?>">
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>     
                    </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
                    
                    <label>Tu perfil es: <b><?php echo $data['descripcionperfil']; ?></b></label>
                        <select name="id_perfil" id="id_perfil" class="formulario__input">
                     <option value="0" >Perfil</option>
                     
        <?php
          $query = $conexion -> query ("SELECT * FROM cat_perfil");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_perfil].'">'.$valores[descripcionperfil].'</option>';
          }
        
        ?>
      </select>
      
<BR></BR>
<lingth><button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Actualizar Usuario</button>
                        <a href="usuarios.php" class="btn btn-danger">Atras</a></lingth>
</div>
</form>
<script src="validacion/formulariousuarios.js"></script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</div>
</div>
</div>
</div>

<?php include_once "includes/footer.php"; ?>