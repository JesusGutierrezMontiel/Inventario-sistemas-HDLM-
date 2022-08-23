<?php
require("../conexion.php");

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE cat_producto SET estatus = 0 WHERE id_producto = $id");
    mysqli_close($conexion);
    header("Location: productos.php");
}
