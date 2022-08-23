<?php 
include_once "includes/header.php";
include "../conexion.php";
/*datos de la base datos*/
    if (!empty($_POST)) {
        $descripcionproducto = $_POST['descripcionproducto'];
        $cantidad = $_POST['cantidad'];
        $id_marca = $_POST['id_marca'];
        $modelo = $_POST['modelo'];
        $serie = $_POST['serie'];
        $precio = $_POST['precio'];
        $id_tipo = $_POST['id_tipo'];
        $usuario = $_SESSION['idUser'];
        
        $alert = "";
        if ( empty($descripcionproducto) || empty($cantidad) || empty($id_marca) || empty($modelo) || empty($serie) || empty($id_tipo) ) {
            $alert = '<div class="alert alert-danger" role="alert">
                Todo los campos son obligatorios
              </div>';
        } else {
            $query = mysqli_query($conexion, "SELECT * FROM cat_producto WHERE serie = '$serie'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = '<div class="alert alert-warning" role="alert">
                        La serie ya existe
                    </div>';
            } else {
				$query_insert = mysqli_query($conexion,  "INSERT INTO cat_producto(descripcionproducto,cantidad,id_marca,modelo,serie,precio,id_usuarioalta,id_usuariobaja,id_tipo,fh_alta,fh_baja)
                values((UPPER('$descripcionproducto')),'$cantidad','$id_marca',(UPPER('$modelo')),'$serie','$precio','$usuario ',NULL,'$id_tipo',SYSDATE(),NULL)");
                if ($query_insert) {
                    $alert = '<div class="alert alert-success" role="alert"> 
                Producto Registrado
              </div>';
                } else {
                    $alert = '<div class="alert alert-danger" role="alert">
                Error al registrar el producto
              </div>';
                }
            }
        }
    }
    ?>
     <div class="form-group">
            <h4 class="text-center">Productos</h4>
        </div>
 <button class="btn btn-primary mb-2" type="button" data-toggle="modal" data-target="#nuevo_producto"><i class="fas fa-plus"></i></button>
 <?php echo isset($alert) ? $alert : ''; ?>
 <div class="table-responsive">
     <table class="table table-striped table-bordered" id="tbl">
         <thead class="thead-dark">
             <tr>
                 <th>#</th>
                 <th>Descripción</th>
                 <th>Cantidad</th>
                 <th>Marca</th>
                 <th>Modelo</th>
                 <th>Serie</th>
                 <th>Fecha de alta</th>
                 <th>Estado</th>
                 <th></th>
             </tr>
         </thead>
         <tbody>
             <?php
                include "../conexion.php";

                $query = mysqli_query($conexion, "SELECT a.id_producto,a.descripcionproducto,a.cantidad,b.descripcionmarca,
                c.nombre, a.modelo, a.serie,a.fh_alta,a.estatus
                FROM cat_producto a,
                     cat_marca b,
                     cat_usuario c
               WHERE a.id_marca = b.id_marca 
               AND a.id_usuarioalta = c.id_usuario
                 AND a.id_producto = id_producto");
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
                         
                         <td><?php echo $data['id_producto']; ?></td>
                         <td><?php echo $data['descripcionproducto']; ?></td>
                         <td><?php echo $data['cantidad']; ?></td>
                         <td><?php echo $data['descripcionmarca']; ?></td>
                         <td><?php echo $data['modelo']; ?></td>
                         <td><?php echo $data['serie']; ?></td>
                         <td><?php echo $data['fh_alta']; ?></td>
                         <td><?php echo $estado ?></td>
                         <td>
                             <?php if ($data['estatus'] == 1) { ?>
                                

                                 <a href="editar_producto.php?id=<?php echo $data['id_producto']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>

                                 <form action="eliminar_producto.php?id=<?php echo $data['id_producto']; ?>" method="post" class="confirmar d-inline">
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
 <div id="nuevo_producto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header bg-primary text-white">
                 <h5 class="modal-title" id="my-modal-title">Nuevo Producto</h5>
                 <button class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 
              <!------------------------------------------------------------------------------------------------------------------->
            <form action="" class="formulario" id="formulario" method="post">
                    

			<!-- Grupo: Descripcion -->
            <div class="formulario__grupo" id="grupo__descripcionproducto">
				<label for="descripcionproducto" class="formulario__label">Descripcion</label>
				<div class="formulario__grupo-input">
                         <input type="text" placeholder="Ingrese la descripcion del producto" name="descripcionproducto" id="descripcionproducto" class="formulario__input" required>
                         <i class="formulario__validacion-estado fas fa-times-circle"></i> 
                        </div>
				<p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>
                    <!-- Grupo: Cantidad -->
            <div class="formulario__grupo" id="grupo__cantidad">
				<label for="cantidad" class="formulario__label">Cantidad</label>
				<div class="formulario__grupo-input">
                         <input type="number" placeholder="Ingrese la cantidad producto" name="cantidad" id="cantidad" class="formulario__input" required>
                         <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
                         <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>
                     <!-- Grupo: Marca -->
                     <div class="form-group">
                         <label for="marca">Marca</label>  
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
				<div class="formulario__grupo-input">
                         <input type="text" placeholder="Ingrese el modelo del producto" name="modelo" id="modelo" class="formulario__input" required>
                         <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
                         <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>
              <!-- Grupo: Serie -->
          <div class="formulario__grupo" id="grupo__serie">
				<label for="serie" class="formulario__label">Serie</label>
				<div class="formulario__grupo-input">
                         
                         <input type="text" placeholder="Ingrese la serie del producto" name="serie" id="serie" class="formulario__input" required >
                         <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
                         <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>

  <!-- Grupo: precio -->
  <div class="formulario__grupo" id="grupo__precio">
				<label for="precio" class="formulario__label">precio</label>
				<div class="formulario__grupo-input">
                         
                         <input type="number" placeholder="Ingrese el precio del producto" name="precio" id="precio" class="formulario__input" required >
                         <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
                         <p class="formulario__input-error">El nombre tiene que ser de 4 a 16 dígitos y solo puede letras.</p>
			</div>
<br>
  

                   

      <!-- Grupo: TIPO -->
      
 
      <div class="form-group">
                         <label for="serie">Tipo</label>
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
                 </form>
                 <script src="validacion/formularioproductos.js"></script>
	<script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
             </div>
         </div>
     </div>
 </div>

 <?php include_once "includes/footer.php"; ?>
