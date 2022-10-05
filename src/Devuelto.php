<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}
require("../conexion.php");
$id_user = $_SESSION['idUser'];


if (!empty($_GET['id_prod']) || !empty($_GET['id_cab']) || !empty($_GET['id_usua']) ) {
    $id_cab= $_GET['id_cab'];
    $id_pro= $_GET['id_prod'];
    $id_usua= $_GET['id_usua']; 

    $query_dañado = mysqli_query($conexion, "UPDATE log_prestamo_cab SET id_estatus = 2, fh_entrega = SYSDATE() WHERE id_prestamo = $id_cab;");
    $query_dañado = mysqli_query($conexion, "UPDATE log_prestamo_det SET id_estatus = 2, id_usuariorecibe = $id_user WHERE id_prestamo = $id_usua;");
    $query_dañado = mysqli_query($conexion, "UPDATE cat_producto SET cantidad= cantidad + 1 WHERE id_producto = $id_pro");    
    
    mysqli_close($conexion);
    header("Location: consultas.php");
}
?>