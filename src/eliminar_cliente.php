<?php
require("../conexion.php");
$id_user = $_SESSION['idUser'];
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "UPDATE cat_cliente SET estatus = 0 WHERE id_cliente = $id");
    mysqli_close($conexion);
    header("Location: clientes.php");
}
