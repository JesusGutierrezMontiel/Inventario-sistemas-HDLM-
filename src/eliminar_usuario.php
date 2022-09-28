<?php
require("../conexion.php");
$id_user = $_SESSION['idUser'];
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE cat_usuario SET estatus = 0 WHERE id_usuario = $id");
    mysqli_close($conexion);
    header("Location: usuarios.php");
}
