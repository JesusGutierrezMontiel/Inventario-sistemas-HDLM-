<?php
require("../conexion.php");
$producto = $_POST['id_detalle_temp'];
$prod = $_POST["id_prod"];
$sentencia="DELETE 
            FROM `detalle_temporal_pres` 
			WHERE `id_detalle_temp` ='$producto' ";
$actualizar = "UPDATE cat_producto SET cantidad= cantidad + 1 WHERE id_producto = '$prod';";
if (mysqli_query($conexion, $sentencia)) {
if (mysqli_query($conexion, $actualizar)) {
} } else {
     echo "Error: " . $sentencia . "<br>" . mysqli_error($conexion);
}
?>
<script type="text/javascript">
	alert("Producto Eliminado exitosamente");
	window.location.href='prestamo.php';
    </script>