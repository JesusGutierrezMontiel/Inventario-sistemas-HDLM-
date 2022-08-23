<?php 
include_once "includes/header.php";
include "../conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['razon_social']) || empty($_POST['telefono']) || empty($_POST['id_area']) ) {
        $alert = '<div class="alert alert-danger" role="alert">Todo los campos son requeridos</div>';
    } else {
        $id_proveedor = $_GET   ['id'];
        $razon_social = $_POST['razon_social'];
        $telefono = $_POST['telefono'];
        $id_area = $_POST['id_area'];
        
        
        $sql_update = mysqli_query($conexion, "UPDATE cat_proveedor SET razon_social = UPPER('$razon_social') ,telefono = '$telefono', id_area = '$id_area'  WHERE id_proveedor = $id_proveedor");


            if ($sql_update) {
                $alert = '<div class="alert alert-success" role="alert">Cliente Actualizado correctamente</div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">Error al Actualizar el Cliente</div>'; 
            }
    }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
    header("Location: proveedor.php");
}
$id_proveedor = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT a.id_proveedor,a.razon_social,a.telefono, b.descripcion
FROM cat_proveedor a,
     cat_area b
WHERE a.id_area = b.id_area 
 AND a.id_proveedor = $id_proveedor");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
    header("Location: proveedor.php");
} else {
    if ($data = mysqli_fetch_array($sql)) {
        $id_proveedor = $data['id_proveedor'];
        $razon_social = $data['razon_social'];
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

<!-- Grupo: Razon Social -->
<div class="formulario__grupo" id="grupo__razon">
    <label for="razon_social" class="formulario__label">Razon Social</label>
    <div class="formulario__grupo-input">
        <input type="text" class="formulario__input" name="razon_social" id="razon_social" placeholder="Ingresa la Razon Social"value="<?php echo $razon_social; ?>"required>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
    </div>
</div>
<br>


<!-- Grupo: Teléfono -->
<div class="formulario__grupo" id="grupo__telefono">
    <label for="telefono" class="formulario__label">Teléfono</label>
    <div class="formulario__grupo-input">
        <input type="number" class="formulario__input" name="telefono" id="telefono" placeholder="Escribe tu numero de telefono" value="<?php echo $telefono; ?>"required>
        <i class="formulario__validacion-estado fas fa-times-circle"></i>
        
    </div>
    </div>
    <br>
<!-- Grupo: area -->
<div class="formulario__grupo" id="grupo__area">
<label for="id_area" class="formulario__label">Area</label>
<label>Tu Àrea es: <b><?php echo $data['descripcion']; ?></b></label>
<select name="id_area" id="id_area" class="formulario__input" required >
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
<BR>
<lingth><button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>Guardar Proveedor</button>
                        <a href="proveedor.php" class="btn btn-danger">Atras</a></lingth>
</form>
<script src="validacion/formularioproveedores.js"></script>
<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
</div>
</div>
</div>
</div>


<?php include_once "includes/footer.php"; ?>
