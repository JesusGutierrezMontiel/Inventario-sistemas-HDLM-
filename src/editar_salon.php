<?php
include_once "includes/header.php";
include "../conexion.php";

if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['descripcion'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $id_salon = $_GET['id'];
    $descripcion = $_POST['descripcion'];
    $query_update = mysqli_query($conexion, "UPDATE cat_salon SET descripcion = '$descripcion' WHERE id_salon = $id_salon");
    if ($query_update) {
      $alert = '<div class="alert alert-primary" role="alert">
              Producto Modificado
            </div>';
    } else {
      $alert = '<div class="alert alert-primary" role="alert">
                Error al Modificar
              </div>';
    }
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: salon.php");
} else {
  $id_salon = $_REQUEST['id'];
  if (!is_numeric($id_salon)) {
    header("Location: salon.php");
  }
  $query_salon = mysqli_query($conexion, "SELECT * FROM cat_salon WHERE id_salon = $id_salon");
  $result_salon = mysqli_num_rows($query_salon);

  if ($result_salon > 0) {
    $data_salon = mysqli_fetch_assoc($query_salon);
  } else {
    header("Location: salon.php");
  }
}
?>
<div class="row">
  <div class="col-lg-6 m-auto">

    <div class="card">
      <div class="card-header bg-primary text-white">
        Modificar salon
      </div>
      <div class="card-body">
        <form action="" method="post">
          <?php echo isset($alert) ? $alert : ''; ?>
          <div class="form-group">
            <label for="descripcion">descripcion</label>
            <input type="text" placeholder="Ingrese descripcion" name="descripcion" id="descripcion" class="form-control" value="<?php echo $data_salon['descripcion']; ?>">
          </div>
          
          </div>
          <input type="submit" value="Actualizar Producto" class="btn btn-primary">
          <a href="salon.php" class="btn btn-danger">Atras</a>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once "includes/footer.php"; ?>