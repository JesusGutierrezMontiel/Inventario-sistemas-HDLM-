<?php
require("../conexion.php");
$id_user = $_SESSION['idUser'];
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE cat_salon SET estatus = 0 WHERE id_salon = $id");
    mysqli_close($conexion);
    header("Location: salon.php");
}