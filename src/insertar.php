<?php
session_start();
$host = "localhost";
$user = "root";
$clave = "";
$bd = "sis_inventario";
$conexion = mysqli_connect($host,$user,$clave,$bd);
    if (mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos";
        exit();
    }else
    mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos");
    mysqli_set_charset($conexion,"utf8");
$nombre = $_POST["id_cliente"];
$Salon = $_POST["id_salon"];
$prod = $_POST["id_prod"];
$usuario = $_SESSION['nombre'];
$insertar = "insert into detalle_temporal_pres (id_detalle_temp,idcliente,idusuario,idsalon,idproducto) values(NULL,'$nombre','$usuario','$Salon','$prod')";
if (mysqli_query($conexion, $insertar)) {
      header('Location: '.'../src/prestamo2.php');
} else {
     echo "Error: " . $insertar . "<br>" . mysqli_error($conexion);
}
mysqli_close($conexion);
?>