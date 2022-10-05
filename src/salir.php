<?php
require("../conexion.php");    
$c = "DELETE FROM `detalle_temporal_pres` WHERE `id_detalle_temp` > 0";
if (mysqli_query($conexion, $c)) {    
    session_start();
    session_destroy();
    header('location: ../');
}else{
	echo('Error');
}
?>
