<?php 
include_once "includes/header.php";
require("../conexion.php");
$nombre = $_POST["id_cliente"];
$Salon = $_POST["id_salon"];		
$prod = $_POST["id_prod"];
$usuario = $_SESSION['idUser'];
$fecha = strftime( "%Y-%m-%d %H-%M-%S", time() );
$insertar = "INSERT into detalle_temporal_pres (id_detalle_temp,id_cliente,id_usuario,id_salon,id_producto,cantidad,fh_prestamo) 
values(NULL,'$nombre','$usuario','$Salon','$prod',1,sysdate())";
$actualizar = "UPDATE cat_producto SET cantidad= cantidad-1 WHERE id_producto = '$prod';";
if (mysqli_query($conexion, $insertar)) {
	if (mysqli_query($conexion, $actualizar)) {
	header("Location: prestamo2.php");
} }else {
     echo "Error: " . $insertar . "<br>" . mysqli_error($conexion);
}
?>   