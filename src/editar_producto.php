<?php
include_once "includes/header.php";
include "../conexion.php";


if (!empty($_POST)){
  $id_producto = $_GET['id'];
    $descripcion = $_POST['descripcionproducto'];
    $cantidad = $_POST['cantidad'];
    $id_marca = $_POST['id_marca'];
    $modelo = $_POST['modelo'];
    $serie = $_POST['serie'];     
    $id_tipo = $_POST['id_tipo'];

    $query_update = mysqli_query($conexion, "UPDATE cat_producto SET descripcionproducto = UPPER('$descripcion'), cantidad = '$cantidad', id_marca= $id_marca, modelo = UPPER('$modelo'), serie = '$serie', id_tipo = '$id_tipo', fh_baja = SYSDATE() WHERE id_producto = $id_producto");
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
 

// Muestra la descripciones de cada campo (marca o usuario fijo)

if (empty($_REQUEST['id'])) {
  header("Location: productos.php");
} 
  $id_producto = $_REQUEST['id'];
  $query_producto = mysqli_query($conexion, "SELECT a.id_producto,a.descripcionproducto,a.cantidad,b.descripcionmarca,
  a.modelo, a.serie,a.precio,d.usuario, c.descripciontipo,a.fh_alta,a.fh_baja,a.estatus
  FROM cat_producto a,
       cat_marca b,
       cat_tipo_producto c,
       cat_usuario d
  WHERE  a.id_marca= b.id_marca
   AND a.id_tipo = c.id_tipo
   AND a.id_usuarioalta = d.id_usuario
   AND a.id_producto = $id_producto");
  $result_sql = mysqli_num_rows($query_producto);
  // 
  if ($result_sql == 0) {
      header("Location: productos.php");
  } else {
      if ($data = mysqli_fetch_array($query_producto)) {
        $descripcion = $data['descripcionproducto'];
        $cantidad = $data['cantidad'];
        $modelo = $data['modelo'];
        $serie = $data['serie'];     
    
      }
  } 
  


?>
<?php echo isset($alert) ? $alert : ''; ?>
<div class="row">
  <div class="col-lg-6 m-auto">

    <div class="card">
      <div class="card-header bg-primary text-white">
        Modificar producto
      </div>
      <div class="card-body">


           <!------------------------------------------------------------------------------------------------------------------->
           <form action="" class="formulario" id="formulario" method="post">
          
          
<!-- Grupo: Descripcion -->
<div class="formulario__grupo" id="grupo__descripcionproducto">
				<label for="descripcionproducto" class="formulario__label">Descripcion</label>
				<div class="form-group">
        <div class="formulario__grupo-input">
                         <input type="text" placeholder="Ingrese la descripcion del producto" name="descripcionproducto" id="descripcionproducto" class="formulario__input" value="<?php echo $descripcion; ?>" required>
                         <i class="formulario__validacion-estado fas fa-times-circle"></i> 
                        </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
      </div>
      <br>

  


 <!-- Grupo: Cantidad -->
 <div class="formulario__grupo" id="grupo__cantidad">
				<label for="cantidad" class="formulario__label">Cantidad</label>
				<div class="form-group">
        <div class="formulario__grupo-input">
                         <input type="number" placeholder="Ingrese la cantidad producto" name="cantidad" id="cantidad" class="formulario__input"  value="<?php echo $cantidad; ?>"required>
                         <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
                         <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
</div>
<br>
         
                     
<!-- Grupo: Marca -->
                     <div class="form-group">
                     <label>Tu Marca es: <b><?php echo $data['descripcionmarca']; ?></b></label>
                     <select name="id_marca" id="id_marca" class="form-control">
                     <option value="0" >Marca:</option>
        <?php
          $query = $conexion -> query ("SELECT * FROM cat_marca");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_marca].'">'.$valores[descripcionmarca].'</option>';
          }
        
        ?>
      </select> 

 <!-- Grupo: Modelo -->
 <div class="formulario__grupo" id="grupo__modelo">
				<label for="modelo" class="formulario__label">Modelo</label>
				<div class="form-group">
        <div class="formulario__grupo-input">
                         <input type="text" placeholder="Ingrese el modelo del producto" name="modelo" id="modelo" class="formulario__input" value="<?php echo $modelo; ?>" required>
                         <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
                         <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
        </div>
<br>

              <!-- Grupo: Serie -->
              <div class="formulario__grupo" id="grupo__serie">
				<label for="serie" class="formulario__label">Serie</label>
				<div class="form-group">
        <div class="formulario__grupo-input">
                         
                         <input type="text" placeholder="Ingrese la serie del producto" name="serie" id="serie" class="formulario__input" value="<?php echo $serie; ?>" required >
                         <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
                         <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
        </div>
<br>
                

           <!-- Grupo: descripciontipo  -->      
 
      <div class="form-group">
      <label>El tipo es: <b><?php echo $data['descripciontipo']; ?></b></label>
<select name="id_tipo" id="id_tipo" class="form-control"required>
                     <option value="0" >Tipo:</option>
        <?php
          $query = $conexion -> query ("SELECT * FROM cat_tipo_producto");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[id_tipo].'">'.$valores[descripciontipo].'</option>';
          }
        ?>
      </select>   
      </div>        
    

      <input type="submit" value="Guardar Producto" class="btn btn-primary">
      <a href="productos.php" class="btn btn-danger">Atras</a></lingth>

                 </form>
                 <script src="validacion/formularioproductos.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
             </div>
         </div>
     </div>
 </div>

 <?php include_once "includes/footer.php"; ?>