<?php 
include_once "includes/header.php";
include "../conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['nombre']) || empty($_POST['apellidoP']) || empty($_POST['apellidoM']) || empty($_POST['telefono'])|| empty($_POST['id_area'])) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $id_cliente = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellidoP'];
        $apellidoM = $_POST['apellidoM'];
        $telefono = $_POST['telefono'];
        $id_area = $_POST['id_area'];
        
        $sql_update = mysqli_query($conexion, "UPDATE cat_cliente SET nombre = UPPER('$nombre') , apellidoP =  UPPER('$apellidoP'), apellidoM = UPPER('$apellidoM'),telefono = '$telefono', id_area = '$id_area'  WHERE id_cliente = $id_cliente");


            if ($sql_update) {
                $alert = '<div class="alert alert-success" role="alert">Cliente Actualizado correctamente</div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">Error al Actualizar el Cliente</div>'; 
            }
    }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: clientes.php");
}
$id_cliente = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT a.id_cliente,a.nombre,a.apellidoP,a.apellidoM,
a.telefono, b.descripcion
FROM cat_cliente a,
     cat_area b
WHERE a.id_area = b.id_area 
 AND a.id_cliente = $id_cliente");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("Location: clientes.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $id_cliente = $data['id_cliente'];
        $nombre = $data['nombre'];
        $apellidoP = $data['apellidoP'];
        $apellidoM = $data['apellidoM'];
        $telefono = $data['telefono'];
    }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
<?php echo isset($alert) ? $alert : ''; ?>
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Modificar Cliente
                </div>
                <div class="card-body">
                <!------------------------------------------------------------------------------------------------------------------->
 
                <form action="" class="formulario" id="formulario" method="post">
                  

                    
                    <div class="formulario__grupo" id="grupo__">
                    <input type="hidden" name="id" value="<?php echo $id_cliente; ?>">
                   
                   <!-- Grupo: nombre -->
                   <div class="formulario__grupo" id="grupo__nombre">
                   <label for="nombre" class="formulario__label">Nombre</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" placeholder="Ingrese nombre" class="formulario__input" name="nombre" id="nombre" value="<?php echo $nombre; ?>"required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
				</div>
			</div>
            </div>
                   <!-- Grupo: Apellido Paterno -->
                   <div class="formulario__grupo" id="grupo__apellidoP">
                   <label for="apellidoP" class="formulario__label">Apellido Paterno</label>
                   <div class="form-group">
                   <div class="formulario__grupo-input">
                        <input type="text" placeholder="Ingrese Apellido Paterno"  class="formulario__input" name="apellidoP" id="apellidoP" value="<?php echo $apellidoP; ?>"required>
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
                        <input type="text" placeholder="Ingrese Apellido Materno" class="formulario__input" name="apellidoM" id="apellidoM" value="<?php echo $apellidoM; ?>"required>
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
                        <input type="text" placeholder="Ingrese telefono" class="formulario__input" name="telefono" id="telefono" value="<?php echo $telefono; ?>" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>    
                    </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
            </div>
                    
                    <label>Tu Àrea es: <b><?php echo $data['descripcion']; ?></b></label>
                        <select name="id_area" id="id_area" class="formulario__input" required>
                     <option value="" >Àrea</option>
                     
        <?php
          $query = $conexion -> query ("SELECT * FROM cat_area");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_area].'">'.$valores[id_area].'-'.$valores[descripcion].'</option>';
          }
        
        ?>
      </select>
      <BR> <BR>
<button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Actualizar Cliente</button>
                        <a href="clientes.php" class="btn btn-danger">Atras</a>
</div>
</form>
<script src="validacion/formulariousuarios.js"></script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</div>
</div>
</div>
</div>

<?php include_once "includes/footer.php"; ?>






