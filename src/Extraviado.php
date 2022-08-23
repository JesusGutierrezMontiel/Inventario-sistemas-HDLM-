<?php
require("../conexion.php");
$id_user = $_SESSION['idUser'];

if (!empty($_GET['id'])|| !empty($_GET['id_est'])) {
    $id = $_GET['id'];
    $id_est = $_GET['id_est'];
    $query_dañado = mysqli_query($conexion, "UPDATE log_prestamo_cab SET id_estatus = 0 WHERE id_prestamocab = $id;");
    $query_dañado = mysqli_query($conexion, "UPDATE log_prestamo_det SET id_estatus = 0 WHERE id_prestamodet = $id_est;");
   mysqli_close($conexion);
    header("Location: consultas.php");
}
